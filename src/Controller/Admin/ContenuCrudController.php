<?php

namespace App\Controller\Admin;

use App\Entity\Contenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ContenuCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contenu::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('Title', 'Titre'),
            TextEditorField::new('content', 'Contenu'),
            BooleanField::new('status', 'Publié'),
            DateTimeField::new('createdAt', 'Créé le')->hideOnForm(),
            DateTimeField::new('publishAt', 'Date de publication')->setRequired(false),
            IntegerField::new('level', 'Niveau')->setRequired(false),
            AssociationField::new('type', 'Type de contenu'),
            AssociationField::new('image', 'Image associée')->setRequired(false),
        ];
    }
}
