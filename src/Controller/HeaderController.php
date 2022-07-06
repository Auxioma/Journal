<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class HeaderController extends AbstractController
{
    public function header(): Response
    {
        return $this->render('_partials/_header.html.twig', [
            
        ]);
    }
}