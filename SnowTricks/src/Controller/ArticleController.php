<?php


namespace App\Controller;

use App\Form\ArticleFormType;
use App\Entity\Comment;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function show($slug,CommentRepository $commentRepository,UserRepository $userRepository)
    {

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($slug);
        return $this->render('article/show.html.twig',[
           'article'=>$article,

           ]);
    }
    /**
     * @Route("/admin/article/new", name="admin_article_new")
     */
    public function new(EntityManagerInterface $em,Request $request)
    {
        $form = $this->createForm(ArticleFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data=($form->getData());
            $article = new Article();
            $article->setTitle($data['title']);
            $article->setContent($data['content']);
            $article->setAuthor($this->getUser());

            $em->persist($article);
            $em->flush();

        }

        return $this->render('article_admin/new.html.twig', [
            'articleForm' => $form->createView()
        ]);

    }
}