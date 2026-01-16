<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;

/**
 * Tableau de bord Admin
 */
#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    /**
     * Page d’accueil de l’admin
     */
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        return $this->redirect(
            $adminUrlGenerator
            // par défaut, affichage la class ClientCrudController
                ->setController(ClientCrudController::class)
                ->generateUrl()
        );
    }

    /**
     * Titre du dashboard
     */
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Cassandre System');
    }

    

    /**
     * Configuration globale des pages CRUD
     */
    public function configureCrud(): Crud
    {
        return Crud::new()
            ->renderContentMaximized();
    }

    

    /**
     * Menu de navigation
     */
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Clients', 'fas fa-address-card', Client::class);
        yield MenuItem::linkToUrl('Voir le site', 'fas fa-globe', $this->generateUrl('app_accueil'))
            ->setLinkTarget('_blank'); // ouvre dans un nouvel onglet
    }
}
