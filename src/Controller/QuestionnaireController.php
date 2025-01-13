<?php

namespace App\Controller;

use App\Entity\Choices;
use App\Entity\Questions;
use App\Entity\Response as EntityResponse;
use App\Form\QuestionnaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class QuestionnaireController extends AbstractController
{
    #[Route('/questionnaire/start', name: 'questionnaire_start')]
    public function start(EntityManagerInterface $em): Response
    {
        $firstQuestion = $em->getRepository(Questions::class)->findOneBy([]);
        return $this->redirectToRoute('questionnaire_question', ['id' => $firstQuestion->getId()]);
    }

    #[Route('/questionnaire/{id}', name: 'questionnaire_question')]
    public function question($id, Request $request, EntityManagerInterface $em): Response
    {
        $question = $em->getRepository(Questions::class)->find($id);

        if (!$question) {
            throw $this->createNotFoundException("Question introuvable !");
        }

        $form = $this->createForm(QuestionnaireType::class, null, ['question' => $question]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $choixId = $form->getData()['choix'];
            $choix = $em->getRepository(Choices::class)->find($choixId);

            $reponse = new EntityResponse();
            $reponse->setChoice($choix);
            $reponse->setUser($this->getUser());
            $em->persist($reponse);
            $em->flush();

            $nextQuestion = $em->getRepository(Questions::class)->findOneBy(['id' => $id + 1]);
            if ($nextQuestion) {
                return $this->redirectToRoute('questionnaire_question', ['id' => $nextQuestion->getId()]);
            } else {
                return $this->redirectToRoute('resultats');
            }
        }

        return $this->render('questionnaire/question.html.twig', [
            'form' => $form->createView(),
            'question' => $question,
        ]);
    }

    #[Route('/resultats', name: 'resultats')]
    public function resultats(EntityManagerInterface $em): Response
    {
        $reponses = $em->getRepository(EntityResponse::class)->findBy(['utilisateur' => $this->getUser()]);

        $resultats = [];
        foreach ($reponses as $reponse) {
            $resultats[] = [
                'question' => $reponse->getChoix()->getQuestion()->getTexte(),
                'choix' => $reponse->getChoix()->getTexte(),
            ];
        }

        return $this->render('questionnaire/resultats.html.twig', [
            'resultats' => $resultats,
        ]);
    }
}
