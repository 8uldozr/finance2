<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ForumController extends AbstractController
{
    /**
     *  @Route("/forum", name="forum")
     */
    public function displayForum(): Response
    {
        return $this->render("public/forum.html.twig");
    }
}