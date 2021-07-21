<?php

namespace App\Controller\Connected\analyse;

use App\Entity\Post;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use App\Services\ImageServices\ImageService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class CreatePostController extends AbstractController{

    /**
     * @Route("create", name="create")
     */
    public function create(Request $request, EntityManagerInterface $em, ImageService $imageService)
    {
        $form = $this->createForm(PostType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var Post $post */
            $post = $form->getData();

            $image = $form->get("imageUrl")->getData();

            $imageService->save($image, $post);

            $em->persist($post);

            $em->flush();

            $this->addFlash('danger','good');

            return $this->redirectToRoute('forum');

        }
        return $this->render("analyse/create.html.twig", [
            'form' => $form->createView()
        ]);
    }
}