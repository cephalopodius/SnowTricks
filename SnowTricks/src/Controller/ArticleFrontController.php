<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Gallery;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use App\Repository\GalleryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleFrontController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(ArticleRepository $articleRepository,GalleryRepository $galleryRepository )
    {
        return $this->render('article/homepage.html.twig', [
            'articles'=> $articleRepository->findAllPublishedOrderedByNewest(),
            'gallery' => $galleryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/article/{slug}", name="article_show")
     */
    public function show($slug ,Request $request,GalleryRepository $galleryRepository,ArticleRepository $articleRepository, CommentRepository $commentRepository)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class);

        $form->handleRequest($request);
        return $this->render('article/show.html.twig',[
            'article'=>$articleRepository->find($slug),
            'gallery'=>$galleryRepository->findAll(),
            'comment'=>$commentRepository->findAll(),
        ]);

    }
    /**
     * @Route("/admin/article/editList", name="admin_article_editList")
     */
    public function editList(ArticleRepository $articleRepository)
    {
        return $this->render('article_admin/editList.html.twig', [
            'article' => $articleRepository->findAllPublishedOrderedByNewest(),
        ]);
    }
    /**
     * @Route("/admin/article/galleryList/{articleMatch}", name="article_admin_uploadList")
     */
    public function uploadList($articleMatch,GalleryRepository $galleryRepository,ArticleRepository $articleRepository)
    {
        return $this->render('article_admin/galleryListUpload.twig', [
            'article'=>$articleRepository->find($articleMatch),
            'gallery'=>$galleryRepository->findAll(),
        ]);
    }
}
