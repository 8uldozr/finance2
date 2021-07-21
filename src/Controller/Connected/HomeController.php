<?php

namespace App\Controller\Connected;

use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="public_home")
     */
    public function home(): Response
    {
        return $this->render("public/home.html.twig");
    }
}