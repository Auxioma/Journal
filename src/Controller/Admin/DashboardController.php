<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    
    
    public function __construct(
        Private AdminUrlGenerator $AdminUrlGenerator
        ){}

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url =  $this->AdminUrlGenerator
                    ->setController(CategoryCrudController::class)
                    ->generateUrl();
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Journal');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        
        yield MenuItem::section('Catégorie');
        yield MenuItem::SubMenu('Catégorie', 'fas fa-plus')->setSubItems([
            MenuItem::linkToCrud('Créer une catégorie', 'fas fa-plus', Category::class)->setAction(Crud::PAGE_NEW)
        ]);

        yield MenuItem::section('Articles');
        yield MenuItem::SubMenu('Articles', 'fas fa-plus')->setSubItems([
            MenuItem::linkToCrud('Créer un Articles', 'fas fa-plus', Articles::class)->setAction(Crud::PAGE_NEW)
        ]);        

        yield MenuItem::section('Mes Vidéos');


    }
}
