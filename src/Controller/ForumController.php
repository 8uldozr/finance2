<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ForumController extends AbstractController
{
    /**
     *  @Route("/forum/{slug}", name="forum")
     */
    public function displayForum(string $slug,CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findOneBy([
            'slug' => $slug
        ]);
        if(!$category)
        {
            $this->addFlash('warning','La catégorie n\'existe pas');
            return $this->redirectToRoute('public_home');
        }

        return $this->render('public/forum.html.twig',[
            'category' => $category
        ]);
    }
}