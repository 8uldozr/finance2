<?php

namespace App\Controller\Connected\analyse;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Services\ImageServices\ImageService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class EditPostController extends AbstractController{

    /**
     * @Route("edit/{id}", name="edit")
     */
    public function create(int $id, Request $request, EntityManagerInterface $em, ImageService $imageService, PostRepository $postRepository)
    {
        $post = $postRepository->find($id);

        $user = $this->getUser();
            if($post->getUser() !== $user)
            {
                $this->addFlash('danger', 'Accès interdit');
                return $this->redirect('home');
            }

        $oldImage = $post->getImageUrl();

        $form = $this->createForm(PostType::class, $post);

        $form = $this->createForm(PostType::class,$post);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var Post $post */
            $post = $form->getData();

            $image = $form->get("imageUrl")->getData();

            $imageService->edit($image, $post, $oldImage);


            $em->flush();

            $this->addFlash('success','Analyse modifiée');

            return $this->redirectToRoute('forum');

        }
        return $this->render("analyse/create.html.twig", [
            'form' => $form->createView()
        ]);
    }
}