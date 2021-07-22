<?php 

namespace App\Controller\Admin;

use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CreateCategoryController extends AbstractController
{
    /**
     * @Route("admin/create_category", name="create_category")
     */

    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CategoryType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())

        {

            $category = $form->getData();
            $em->persist($category);
            $em->flush();

            $this->addFlash('success','Votre catégorie ' . $category->getName() . ' a bien été créé.');
            return $this->redirectToRoute('list_category');
        }

        return $this->render('admin/category/create_category.html.twig',[
            'formCategory' => $form->createView()
        ]);
    }
}
