<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Questions;

class QuestionnaireType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $question = $options['question'];

        $builder
            ->add('choix', ChoiceType::class, [
                'label' => $question->getQuestion(),
                'choices' => array_combine(
                    array_map(fn($choix) => $choix->getChoix(), $question->getChoix()->toArray()),
                    array_map(fn($choix) => $choix->getId(), $question->getChoix()->toArray())
                ),
                'expanded' => true,
                'multiple' => true,
                'required' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Suivant',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
        $resolver->setRequired('question');
    }
}
