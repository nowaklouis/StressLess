<?php

namespace App\Controller\Admin;

use App\Entity\Choices;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ChoicesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Choices::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('choix', 'Choix'),
            IntegerField::new('val', 'Valeur'),
            AssociationField::new('questions', 'Question associée')->setRequired(false),
        ];
    }
}
