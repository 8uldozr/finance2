<?php

namespace App\Controller\Connected\analyse;

use App\Repository\PostRepository;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Services\ImageServices\ImageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class DeletePostController extends AbstractController
    {
    /**
     * @Route("/delete/post/{id}", name="delete")
     */
    public function delete(int $id, PostRepository $postRepository, EntityManagerInterface $em,ImageService $imageService)
    {
       
        $post = $postRepository->find($id);

        // if (!$post)
        // {
        //     $this->addFlash('danger','Cet article n\'existe pas.');
        //     return $this->redirectToRoute('moderator_post_unpublish_list');
        // }

        $imageService->deleteImage($post->getImageUrl());

        $em->remove($post);

        $em->flush();

        $this->addFlash('success','Cet article a bien été supprimé.');

        return $this->redirectToRoute('forum');
    }
}