<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Gallery;
use App\Entity\Video;
use App\Form\CommentFormType;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use App\Repository\GalleryRepository;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ArticleFrontController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     * @var Article $article
     */
    public function homepage(ArticleRepository $articleRepository,GalleryRepository $galleryRepository )
    {
        return $this->render('article/homepage.html.twig', [
            'articles'=> $articleRepository->findAllPublishedOrderedByNewest(),
            'gallery' => $galleryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/article/{slug}/{commentCurrentPage}",defaults={"commentCurrentPage" = 1} , name="article_show")
     * @var Article $article
     */
    public function show($slug, $commentCurrentPage, Request $request, GalleryRepository $galleryRepository, ArticleRepository $articleRepository, VideoRepository $videoRepository, CommentRepository $commentRepository, EntityManagerInterface $em)
    {
      $pageNumber=$commentRepository->findCountPageNumber($slug);
      $pageNumber=ceil($pageNumber/10);

        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class,$comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $comment->setArticle($articleRepository->find($slug));
            $comment->setAuthorId($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            $this->addFlash('AddComment', 'Le commentaire à bien été ajouté');
            return $this->redirectToRoute('article_show', array('slug' => $slug));
        }

        return $this->render('article/show.html.twig',[
            'article'=>$articleRepository->find($slug),
            'gallery'=>$galleryRepository->findAll(),
            'comment'=>$commentRepository->findComment($slug,$commentCurrentPage),
            'pageNumber'=>$pageNumber,
            'currentPage'=>$commentCurrentPage,
            'video'=>$videoRepository->findAll(),
            'commentForm'=> $form->createView(),
        ]);

    }
    /**
     * @Route("/admin/article/editList", name="admin_article_editList")
     * @Security("is_granted('ROLE_ADMIN')")
     * @var Article $article
     */
    public function editList(ArticleRepository $articleRepository)
    {
        return $this->render('article_admin/editList.html.twig', [
            'article' => $articleRepository->findAllPublishedOrderedByNewest(),
        ]);
    }
    /**
     * @Route("/admin/article/galleryList/{articleMatch}", name="article_admin_galleryList")
     * @Security("is_granted('ROLE_ADMIN')")
     * @var Article $article
     */
    public function uploadList($articleMatch,GalleryRepository $galleryRepository,ArticleRepository $articleRepository)
    {
        return $this->render('article_admin/galleryListUpload.twig', [
            'article'=>$articleRepository->find($articleMatch),
            'gallery'=>$galleryRepository->findAll(),
        ]);
    }
    /**
     * @Route("/admin/article/videoListAdd/{articleMatch}", name="article_admin_videoListAdd")
     * @Security("is_granted('ROLE_ADMIN')")
     * @var Article $article
     */
    public function videoList($articleMatch,VideoRepository $videoRepository,ArticleRepository $articleRepository)
    {
        return $this->render('article_admin/videoListAdd.twig', [
            'article'=>$articleRepository->find($articleMatch),
            'video'=>$videoRepository->findAll(),
        ]);
    }
}
