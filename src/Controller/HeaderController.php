<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class HeaderController extends AbstractController
{
    public function header(CategoryRepository $categoryRepository): Response
    {
        
        // select Only the categories with a subcategory=null
        $categories = $categoryRepository->findBy(['SubCategory' => null]);
        
        return $this->render('_partials/_header.html.twig', [
            'categories' => $categories,
        ]);
    }
}