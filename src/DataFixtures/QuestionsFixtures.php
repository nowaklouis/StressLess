<?php

namespace App\DataFixtures;

use App\Entity\Choices;
use App\Entity\Questions;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class QuestionsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $question1 = new Questions();
        $question1->setQuestion('Avez-vous perdu un être cher récemment ?');
        $manager->persist($question1);

        $choix1 = new Choices();
        $choix1->setChoix('Décès du conjoint')
            ->setVal(100)
            ->setQuestions($question1);
        $manager->persist($choix1);

        $choix2 = new Choices();
        $choix2->setChoix('Décès d’un proche parent')
            ->setVal(63)
            ->setQuestions($question1);
        $manager->persist($choix2);

        $choix3 = new Choices();
        $choix3->setChoix('Mort d’un ami proche')
            ->setVal(37)
            ->setQuestions($question1);
        $manager->persist($choix3);

        $choix4 = new Choices();
        $choix4->setChoix('Décès enfant')
            ->setVal(100)
            ->setQuestions($question1);
        $manager->persist($choix4);

        // Question 2
        $question2 = new Questions();
        $question2->setQuestion('Avez-vous vécu des changements significatifs dans votre relation familiale ?');
        $manager->persist($question2);

        $choix5 = new Choices();
        $choix5->setChoix('Départ de l’un des enfants')
            ->setVal(29)
            ->setQuestions($question2);
        $manager->persist($choix5);

        $choix6 = new Choices();
        $choix6->setChoix('Problème avec les beaux-parents')
            ->setVal(29)
            ->setQuestions($question2);
        $manager->persist($choix6);

        $choix7 = new Choices();
        $choix7->setChoix('Ajout d’un membre dans la famille')
            ->setVal(39)
            ->setQuestions($question2);
        $manager->persist($choix7);

        // Question 3
        $question3 = new Questions();
        $question3->setQuestion('Avez-vous vécu des changements significatifs dans votre relation avec votre conjoint ?');
        $manager->persist($question3);

        $choix8 = new Choices();
        $choix8->setChoix('Divorce')
            ->setVal(73)
            ->setQuestions($question3);
        $manager->persist($choix8);

        $choix9 = new Choices();
        $choix9->setChoix('Séparation')
            ->setVal(65)
            ->setQuestions($question3);
        $manager->persist($choix9);

        $choix10 = new Choices();
        $choix10->setChoix('Réconciliation avec le conjoint')
            ->setVal(45)
            ->setQuestions($question3);
        $manager->persist($choix10);

        $choix11 = new Choices();
        $choix11->setChoix('Mariage')
            ->setVal(50)
            ->setQuestions($question3);
        $manager->persist($choix11);

        // Question 4
        $question4 = new Questions();
        $question4->setQuestion('Avez-vous récemment rencontré des problèmes de santé ?');
        $manager->persist($question4);

        $choix12 = new Choices();
        $choix12->setChoix('Maladies ou blessures personnelles')
            ->setVal(53)
            ->setQuestions($question4);
        $manager->persist($choix12);

        $choix13 = new Choices();
        $choix13->setChoix('Modification de l’état de santé d’un membre de la famille')
            ->setVal(44)
            ->setQuestions($question4);
        $manager->persist($choix13);

        $choix14 = new Choices();
        $choix14->setChoix('Grossesse')
            ->setVal(40)
            ->setQuestions($question4);
        $manager->persist($choix14);

        $choix15 = new Choices();
        $choix15->setChoix('Difficultés sexuelles')
            ->setVal(39)
            ->setQuestions($question4);
        $manager->persist($choix15);

        // Question 5
        $question5 = new Questions();
        $question5->setQuestion('Avez-vous connu des changements dans votre carrière ?');
        $manager->persist($question5);

        $choix16 = new Choices();
        $choix16->setChoix('Perte d’emploi')
            ->setVal(47)
            ->setQuestions($question5);
        $manager->persist($choix16);

        $choix17 = new Choices();
        $choix17->setChoix('Retraite')
            ->setVal(45)
            ->setQuestions($question5);
        $manager->persist($choix17);

        $choix18 = new Choices();
        $choix18->setChoix('Changement dans la vie professionnelle')
            ->setVal(39)
            ->setQuestions($question5);
        $manager->persist($choix18);

        $choix19 = new Choices();
        $choix19->setChoix('Changement de carrière')
            ->setVal(36)
            ->setQuestions($question5);
        $manager->persist($choix19);

        // Question 6
        $question6 = new Questions();
        $question6->setQuestion('Avez-vous vécu des changements dans votre environnement ?');
        $manager->persist($question6);

        $choix20 = new Choices();
        $choix20->setChoix('Changement de domicile')
            ->setVal(20)
            ->setQuestions($question6);
        $manager->persist($choix20);

        $choix21 = new Choices();
        $choix21->setChoix('Hypothèque supérieure à un an de salaire')
            ->setVal(31)
            ->setQuestions($question6);
        $manager->persist($choix21);

        $choix22 = new Choices();
        $choix22->setChoix('Saisie d’hypothèque ou de prêt')
            ->setVal(30)
            ->setQuestions($question6);
        $manager->persist($choix22);

        $choix23 = new Choices();
        $choix23->setChoix('Hypothèque ou prêt inférieur à un an de salaire')
            ->setVal(17)
            ->setQuestions($question6);
        $manager->persist($choix23);

        // Question 7
        $question7 = new Questions();
        $question7->setQuestion('Avez-vous récemment connu un changement dans vos études ou celles de vos proches ?');
        $manager->persist($question7);

        $choix24 = new Choices();
        $choix24->setChoix('Première ou dernière année d’études')
            ->setVal(26)
            ->setQuestions($question7);
        $manager->persist($choix24);

        $choix25 = new Choices();
        $choix25->setChoix('Changement d’école')
            ->setVal(20)
            ->setQuestions($question7);
        $manager->persist($choix25);

        // Question 8
        $question8 = new Questions();
        $question8->setQuestion('Avez-vous changé vos habitudes ou vos activités personnelles récemment ?');
        $manager->persist($question8);

        $choix26 = new Choices();
        $choix26->setChoix('Modification des activités religieuses')
            ->setVal(19)
            ->setQuestions($question8);
        $manager->persist($choix26);

        $choix27 = new Choices();
        $choix27->setChoix('Modification des activités sociales')
            ->setVal(18)
            ->setQuestions($question8);
        $manager->persist($choix27);

        $choix28 = new Choices();
        $choix28->setChoix('Modification du nombre de disputes avec le conjoint')
            ->setVal(35)
            ->setQuestions($question8);
        $manager->persist($choix28);

        $choix29 = new Choices();
        $choix29->setChoix('Modification des habitudes alimentaires')
            ->setVal(15)
            ->setQuestions($question8);
        $manager->persist($choix29);

        $choix30 = new Choices();
        $choix30->setChoix('Modification du nombre de réunions familiales')
            ->setVal(15)
            ->setQuestions($question8);
        $manager->persist($choix30);

        // Question 9
        $question9 = new Questions();
        $question9->setQuestion('Avez-vous vécu des changements dans vos relations sociales ?');
        $manager->persist($question9);

        $choix31 = new Choices();
        $choix31->setChoix('Voyage ou vacances')
            ->setVal(13)
            ->setQuestions($question9);
        $manager->persist($choix31);

        $choix32 = new Choices();
        $choix32->setChoix('Noël')
            ->setVal(12)
            ->setQuestions($question9);
        $manager->persist($choix32);

        $choix33 = new Choices();
        $choix33->setChoix('Infractions mineures à la loi')
            ->setVal(11)
            ->setQuestions($question9);
        $manager->persist($choix33);

        $manager->flush();
    }
}
