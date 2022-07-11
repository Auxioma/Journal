<?php

namespace App\Controller\Site;

use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    public function __construct(private ArticlesRepository $articlesRepository){}

    #[Route('/', name: 'app_site_home')]
    public function index(): Response
    {
        
        // Show the random article
        $RandomArticles = $this->articlesRepository->findRandom();
        
        // Show the five picture on the homepage
        $articles = $this->articlesRepository->Affiche_Le_Slider_4_Articles();

        
        return $this->render('site/home/home.html.twig', [
            'slider' => $articles,
            'random' => $RandomArticles,
        ]);
    }
}
