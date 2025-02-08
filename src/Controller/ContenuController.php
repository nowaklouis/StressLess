<?php

namespace App\Controller;

use App\Entity\Contenu;
use App\Entity\Favorie;
use App\Entity\Image;
use App\Form\ContenuType;
use App\Repository\ContenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\FavorieRepository;

class ContenuController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private ContenuRepository $contenuRepository,
        private FavorieRepository $favorieRepository
    ) {}

    #[Route('/contenu/create', name: 'contenu_create')]
    public function createContenu(Request $request): Response
    {
        $contenu = new Contenu();
        $form = $this->createForm(ContenuType::class, $contenu);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imageFile')->getData();

            if ($imageFile) {
                $image = new Image();
                $image->setImageFile($imageFile);
                $contenu->setImage($image);
            }

            $contenu->setCreatedAt(new \DateTimeImmutable());

            $this->em->persist($contenu);
            $this->em->flush();

            $this->addFlash('success', 'Le contenu a été créé avec succès.');

            return $this->redirectToRoute('contenu');
        }

        return $this->render('contenu/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/contenu/detail/{contenu}', name: 'contenu_show')]
    public function detailContenu(Request $request, Contenu $contenu): Response
    {
        return $this->render('contenu/show.html.twig', [
            'contenu' => $contenu,
        ]);
    }

    #[Route('/contenu/{contenu}/favori', name: 'contenu_favori')]
    public function favoriContenu(Request $request, Contenu $contenu): JsonResponse
    {
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        $favori = $this->em->getRepository(Favorie::class)->findOneBy([
            'Contenu' => $contenu,
            'User' => $user,
        ]);

        if ($favori) {
            $this->em->remove($favori);
            $isFavorited = false;
        } else {
            $favori = new Favorie();
            $favori->setContenu($contenu);
            $favori->setUser($user);
            $this->em->persist($favori);
            $isFavorited = true;
        }

        $this->em->flush();

        return new JsonResponse(['isFavorited' => $isFavorited]);
    }

    #[Route('/contenu/{stressValue}', name: 'contenu')]
    public function index(Request $request, PaginatorInterface $paginator, int $stressValue = null): Response
    {
        $user = $this->getUser();
        $favoris = $user ? $this->favorieRepository->findFavorisIdsByUser($user) : [];

        if ($stressValue) {
            $contents = $this->contenuRepository->findBy(['level' => $stressValue]);
        } else {
            $search = $request->query->get('search', '');
            $order = $request->query->get('order', 'asc');
            $query = $this->contenuRepository->searchAndOrder($search, $order);
            $contents = $paginator->paginate($query, $request->query->getInt('page', 1), 10);
        }

        return $this->render('contenu/index.html.twig', [
            'contents' => $contents,
            'favoris' => $favoris,
        ]);
    }
}
