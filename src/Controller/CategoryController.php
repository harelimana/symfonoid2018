<?php

namespace App\Controller;

use App\Entity\Categories;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    /**
     * @Route("/categlisting", name="categlisting")
     */
    public function index()
    {
        $categories = $this->getDoctrine()
            ->getRepository(Categories::class)
            ->findAll();
        return $this->render('category/listCateg.html.twig', [
            'categorie' => $categories,
        ]);
    }

    /**
     * @Route("/addCateg",name="addCategorie")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */

    public function ajoutCategorieAction(Request $request)
    {

        $categorie = new Categories();

        $form = $this->createFormBuilder($categorie)
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('slug', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('Sauver', SubmitType::class, array('attr' => array('label' => 'Create Todo','class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            $this->addflash(
                'notice',
                'Catégorie ajoutée'
            );
            return $this->redirectToroute('categlisting');
        }


        return $this->render('category/ajoutCateg.html.twig', array('form' => $form->createView()));
    }

}
