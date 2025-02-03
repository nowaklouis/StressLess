<?php

namespace App\Controller;

use App\Entity\Contenu;
use App\Entity\Favorie;
use App\Entity\Image;
use App\Entity\User;
use App\Form\ContenuType;
use App\Form\UserType;
use App\Repository\ContenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class CompteController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    #[Route('/compte', name: 'compte')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function index(): Response
    {
        $user = $this->em->getRepository(User::class)->find($this->getUser());
        return $this->render('compte/index.html.twig', [
            'user' => $this->getUser(),
            'questionnaires' => $user->getQuestionnaires(),
        ]);
    }

    #[Route('/compte/edit', name: 'compte_edit')]
    public function edit(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Informations mises à jour.');
            return $this->redirectToRoute('compte');
        }

        return $this->render('compte/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
