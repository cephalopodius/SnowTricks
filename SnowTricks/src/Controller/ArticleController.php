<?php


namespace App\Controller;


use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(ArticleRepository $repository)
    {
        $articles = $repository->findAllPublishedOrderedByNewest();
        return $this->render('article/homepage.html.twig', [
          'articles'=> $articles,
        ]);
    }

    /**
     * @Route("/article/{slug}")
     */
    public function show($slug)
    {

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($slug);
        return $this->render('article/show.html.twig',[
           'article'=>$article,
           ]);
    }
}