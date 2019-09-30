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
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ArticleBackController extends AbstractController
{

    /**
     * @Route("/admin/article/new", name="admin_article_new")
     */
    public function new(EntityManagerInterface $em,Request $request,FileUploader $fileUploader)
    {
        $article = new Article();
        $form = $this->createForm(ArticleFormType::class,$article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $files = $form['uploads']->getData();

            $article->setAuthor($this->getUser());

            $em->persist($article);

            //$lastId = $article->getId();

            //adding gallery
            if ($files) {
                foreach ($files as $file){

                    $newFilename = $fileUploader->uploadFile($file);

                    $gallery = new Gallery();
                    $gallery->setName($newFilename);
                    $gallery->setArticle($article);
                    $gallery->setMainPicture(true);
                    $em->persist($gallery);
                }
            }
            $em->flush();
            $this->addFlash('success','Article crée !');
            return $this->redirectToRoute('app_homepage');
        }
        return $this->render('article_admin/new.html.twig', [
            'articleForm' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/article/edit/{id}", name="admin_edit_article")
     */
    public function edit(Article $article, Request $request, EntityManagerInterface $em,FileUploader $fileUploader)
    {
        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);
        $files = $form['uploads']->getData();
        if ($form->isSubmitted() && $form->isValid()) {
            //gallery
            if ($files) {
                foreach ($files as $file){
                    $newFilename = $fileUploader->uploadFile($file);

                    $gallery = new Gallery();
                    $gallery->setName($newFilename);
                    $gallery->setArticle($article);
                    $gallery->setMainPicture(false);
                    $em->persist($gallery);
                }
            }
            $em->persist($article);
            $em->flush();
            $this->addFlash('success', 'Article modifié!');
            return $this->redirectToRoute('admin_article_editList', [
                'id' => $article->getId(),
            ]);
        }
        return $this->render('article_admin/edit.html.twig', [
            'articleForm' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/article/delete/{id}", name="article_admin_delete")
     */
    public function deleteArticle($id,Article $article,Gallery $gallery, Request $request, EntityManagerInterface $em)
    {

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($article);
        $manager->flush();
        $this->addFlash('deleteArticle', 'L\'article à bien été supprimé');
        return $this->redirectToRoute('admin_article_editList');
    }
    
    /**
     * @Route("/admin/article/gallery/delete/{id}", name="article_admin_delete_gallery")
     */
    public function deleteGallery($id,Gallery $gallery, Request $request, EntityManagerInterface $em)
    {
        $manager = $this->getDoctrine()->getManager();
        $articleMatch = $gallery->getArticle();
        $nameFile = $gallery->getName();

        $fsObject = new Filesystem();
        $current_dir_path = getcwd();

        //remove a directory
        try {
            $arr_dirs = $current_dir_path . "/images/Upload/".$nameFile
            ;

            $fsObject->remove($arr_dirs);
        } catch (IOException $exception) {
            echo "Error deleting directory at". $exception->getPath();
        }

        $manager->remove($gallery);
        $manager->flush();



        $this->addFlash('deleteGallery', 'Le fichier à bien été supprimé');
        return $this->redirectToRoute('article_admin_uploadList', array('articleMatch' => $articleMatch->getId()));
    }
    /**
     * @Route("/admin/article/gallery/mainPicture/{id}/{article}", name="article_admin_changeMainPicture")
     */
    public function changeMainPicture($id,$article,Gallery $gallery,GalleryRepository $galleryRepository, Request $request, EntityManagerInterface $em)
    {
        $manager = $this->getDoctrine()->getManager();
        $articleMatch = $gallery->getArticle();
        $galleryRepository->looseMainPicture($article);
        $galleryRepository->changeMainPicture($id);
        $manager->flush();
        $this->addFlash('deleteGallery', "L'image principale à été changée");
        return $this->redirectToRoute('article_admin_uploadList', array('articleMatch' => $articleMatch->getId()));
    }
    /**
     * @Route("/admin/article/addVideo/{id}" name="galleryList")
     */
}