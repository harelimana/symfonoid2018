<?php
/**
 * Created by PhpStorm.
 * User: axxahretz
 * Date: 11.05.18
 * Time: 22:34
 */

namespace App\Controller;


use App\Entity\News;
use App\Form\NewsFormType;
use App\Services\FixturesManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class NewsController extends AbstractController
{
    /**
     * @var FixturesManager $fm
     */
    private $fm;

    /**
     * NewsController constructor.
     * @param FixturesManager $fm
     */
    public function __construct(FixturesManager $fm)
    {
        $this->fm = $fm;
    }

    /**
     * @Route("/newslist",name="newslisting")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function home() {
        $articles = $this->fm->getArticles(9);
        return $this->render('news/home.html.twig',
            ['articles'=> $articles]
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/addArticle",name="addArticle")
     */
public function addArticle(Request $request){
    $news = new News();

    $form = $this->createForm(NewsFormType::class, $news);
    $form->handleRequest($request);
    /** si le formulaire a été soumis et qu'il est valide */
    if($form->isSubmitted() && $form->isValid()){
        $em = $this->getDoctrine()->getManager();
        $em->persist($news);
        $em->flush();
        return $this->redirectToRoute('newslisting');
    }

    return $this->render('news/addArticle.html.twig',
        ['form'=>$form->createView()]
    );
}
    /**
     * @Route("articles/{id}",name="article_details")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showArticle($id) {
        $article = $this->fm->getArticle();
        // while waiting the use of the DB the id from the url is used as parameter
        $article['id'] = $id;
        return $this->render('news/article_details.html.twig',
            ['article' => $article]
        );
    }
}