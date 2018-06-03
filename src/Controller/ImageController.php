<?php

namespace App\Controller;

use App\Entity\Images;
use App\Form\ImagesFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ImageController extends AbstractController
{
    /**
     * @Route("/image", name="imagelist")
     */
    public function index()
    {
        return $this->render('image/index.html.twig', [
            'controller_name' => 'ImageController',
        ]);
    }

    /**
     * @Route("/addImages", name="addImages")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addImage(Request $request)
    {
        $image = new Images();
        $form = $this->createForm(ImagesFormType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();
            return $this->redirectToRoute('imagelist');
        }
        return $this->render('image/ajoutImage.html.twig',
            ['form'=>$form->createView()]
        );
    }

    private function handleForm(FormInterface $form, Images $image) {
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();
            $this->addFlash('info', 'image sauvegardé');
            return $this->redirectToRoute('imagelist');
        }
        return null;
    }
}
