<?php

namespace App\Controller;

use App\Entity\Contenu;
use App\Entity\Image;
use App\Form\ContenuType;
use App\Repository\ContenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContenuController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    #[Route('/contenu', name: 'contenu')]
    public function index(Request $request, PaginatorInterface $paginator, ContenuRepository $contenuRepository): Response
    {
        $search = $request->query->get('search', '');
        $order = $request->query->get('order', 'asc');
        $query = $contenuRepository->searchAndOrder($search, $order);
        $contents = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        return $this->render('contenu/index.html.twig', [
            'contents' => $contents,
        ]);
    }

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
}
