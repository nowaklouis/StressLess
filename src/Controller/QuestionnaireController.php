<?php

namespace App\Controller;

use App\Entity\Choices;
use App\Entity\Questionnaire;
use App\Entity\Questions;
use App\Entity\Response as EntityResponse;
use App\Form\QuestionnaireMainType;
use App\Form\QuestionnaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class QuestionnaireController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    #[Route('/questionnaire/create', name: 'questionnaire_create')]
    public function createQuestionnaire(Request $request): Response
    {
        $form = $this->createForm(QuestionnaireMainType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionnaire = $form->getData();
            $questionnaire->setCreatedAt(new \DateTimeImmutable());

            $this->em->persist($questionnaire);
            $this->em->flush();

            $firstQuestion = $this->em->getRepository(Questions::class)->findOneBy([]);
            return $this->redirectToRoute('questionnaire_question', ['id' => $firstQuestion->getId(), 'questionnaireId' => $questionnaire->getId()]);
        }

        return $this->render('questionnaire/questionnaire.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/questionnaire/{id}/groupe/{questionnaireId}', name: 'questionnaire_question')]
    public function question($id, Questionnaire $questionnaireId, Request $request): Response
    {
        if (!$questionnaireId) {
            throw $this->createNotFoundException("Questionnaire introuvable !");
            return $this->redirectToRoute('questionnaire_create');
        }
        $question = $this->em->getRepository(Questions::class)->find($id);

        if (!$question) {
            throw $this->createNotFoundException("Question introuvable !");
        }

        $form = $this->createForm(QuestionnaireType::class, null, ['question' => $question]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $choixIds = $form->getData()['choix'];
            foreach ($choixIds as $choixId) {
                $choix = $this->em->getRepository(Choices::class)->find($choixId);
                $reponse = new EntityResponse();
                $reponse->setChoice($choix);
                $reponse->setUser($this->getUser());
                $reponse->setQuestionnaire($questionnaireId);
                $this->em->persist($reponse);
            }

            $this->em->flush();

            $nextQuestion = $this->em->getRepository(Questions::class)->findOneBy(['id' => $id + 1]);
            if ($nextQuestion) {
                return $this->redirectToRoute('questionnaire_question', ['id' => $nextQuestion->getId(), 'questionnaireId' => $questionnaireId->getId()]);
            } else {
                return $this->redirectToRoute('resultats', ['questionnaireId' => $questionnaireId->getId()]);
            }
        }

        return $this->render('questionnaire/question.html.twig', [
            'form' => $form->createView(),
            'question' => $question,
        ]);
    }

    #[Route('/resultats/questionnaire/{questionnaireId}', name: 'resultats')]
    public function resultats(Questionnaire $questionnaireId): Response
    {
        $reponses = $this->em->getRepository(EntityResponse::class)->findBy(['User' => $this->getUser(), 'questionnaire' => $questionnaireId->getId()]);

        $resultat = null;
        foreach ($reponses as $reponse) {
            $resultat = $resultat + $reponse->getChoice()->getVal();
        }

        $questionnaireId->setSomVal($resultat);
        $this->em->persist($questionnaireId);
        $this->em->flush();

        return $this->render('questionnaire/resultats.html.twig', [
            'resultat' => $resultat,
        ]);
    }
}
