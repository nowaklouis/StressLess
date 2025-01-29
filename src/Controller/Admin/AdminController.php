<?php

namespace App\Controller\Admin;

use App\Entity\Choices;
use App\Entity\Contenu;
use App\Entity\Questions;
use App\Entity\Type;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Bundle\MakerBundle\Doctrine\EntityClassGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Stress Less');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Contenu', 'fas fa-newspaper', Contenu::class);
        yield MenuItem::linkToCrud('Choix', 'fas fa-palette', Choices::class);
        yield MenuItem::linkToCrud('Questions', 'fas fa-list', Questions::class);
        yield MenuItem::linkToCrud('Types', 'fas fa-list', Type::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-cog', User::class);
    }
}
