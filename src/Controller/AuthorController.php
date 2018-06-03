<?php

namespace App\Controller;

use App\Entity\Authors;
use App\Entity\Images;
use App\Entity\News;
use App\Form\AuthorFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AuthorController extends AbstractController
{
    /**
     * @Route("/author", name="authorlist")
     */
    public function index()
    {
        $authors = $this->getDoctrine()
            ->getRepository(Authors::class)
            ->findAll();
        return $this->render('author/index.html.twig', [
            'authors' => $authors,
        ]);
    }

    /**
     * @Route("/addAuthor",name="addauthor")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAuthorAction(Request $request)
    {
        $author = new Authors();

        $form = $this->createForm(AuthorFormType::class,$author);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($author);

            $em->flush();
            $this->addflash(
                'notice',
                'Author added !'
            );
            return $this->redirectToroute('authorlist');
        }


        return $this->render('author/ajout.html.twig', array('form' => $form->createView()));
    }
}
