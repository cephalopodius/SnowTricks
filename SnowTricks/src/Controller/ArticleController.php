<?php


namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Gallery;
use App\Form\ArticleFormType;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use App\Repository\GalleryRepository;
use App\Repository\UserRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
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
    public function show($slug,CommentRepository $commentRepository,UserRepository $userRepository,ArticleRepository $articleRepository)
    {

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($slug);
        $comment = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->findAll();
        return $this->render('article/show.html.twig',[
           'article'=>$article,
            'comment'=>$comment,
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
            $article->setPicture($data['picture']);
            $article->setAuthor($this->getUser());
            $article->setGroupe(($data['groupe']));


            $em->persist($article);
            $em->flush();
            //$lastId = $article->getId();
            //adding gallery
            $files = $form['uploads']->getData();
         *
            if ($files) {
                foreach ($files as $file){
                    $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

                    // Move the file to the directory where brochures are stored
                    try {
                        $file->move(
                            $this->getParameter('upload_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }

                    $gallery = new Gallery();
                    $gallery->setName($newFilename);
                    $gallery->setArticle($article);
                    $em->persist($gallery);
                    $em->flush();
                }

            }


            $this->addFlash('success','Article crée !');
            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('article_admin/new.html.twig', [
            'articleForm' => $form->createView()
        ]);

    }
    /**
     * @Route("/admin/article/editList", name="admin_article_editList")
     */
    public function editList(ArticleRepository $repository)
    {

        $article = $repository->findAllPublishedOrderedByNewest();
        return $this->render('article_admin/editList.html.twig', [
            'article' => $article,
        ]);
    }
    /**
     * @Route("/admin/article/edit/{id}")
     */
    public function edit(Article $article, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($article);
            $em->flush();
            $this->addFlash('success', 'Article modifié!');
            return $this->redirectToRoute('admin_article_editList', [
                'id' => $article->getId(),
            ]);
        }
        return $this->render('article_admin/new.html.twig', [
            'articleForm' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/article/delete/{id}")
     */
    public function delete($id,Article $article, Request $request, EntityManagerInterface $em)
    {


        $manager = $this->getDoctrine()->getManager();

        $manager->remove($article);
        $manager->flush();
        $this->addFlash('deleteArticle', 'L\'article à bien été supprimé');
        return $this->redirectToRoute('admin_article_editList');
    }
    /**
     * @Route("/admin/article/galleryList/{articleMatch}")
     */
    public function uploadList($articleMatch,GalleryRepository $repository,ArticleRepository $articleRepository)
    {
        $galleryList = $this->getDoctrine()
            ->getRepository(Gallery::class)
            ->findAll();
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($articleMatch);

        return $this->render('article_admin/galleryListUpload.twig', [
            'gallery' => $galleryList,
            'article' => $article,

        ]);
    }

    /**
     * @Route("/admin/article/addVideo/{id}" name="galleryList")
     */

}