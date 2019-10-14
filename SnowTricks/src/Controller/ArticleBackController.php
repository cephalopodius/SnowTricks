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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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
     * @Security("is_granted('ROLE_ADMIN')")
     * @var Article $article
     */
    public function new(EntityManagerInterface $em,Request $request,FileUploader $fileUploader)
    {
        $article = new Article();
        $form = $this->createForm(ArticleFormType::class,$article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $files = $form['uploads']->getData();
            $mainFile = $form['uploadMainPicture']->getData();
            $article->setAuthor($this->getUser());

            $em->persist($article);

            //adding main picture
              $newFilename = $fileUploader->uploadFile($mainFile);
              $mainPicture = new Gallery();
              $mainPicture->setName($newFilename);
              $mainPicture->setArticle($article);
              $mainPicture->setMainPicture(true);

              $em->persist($mainPicture);
            //adding gallery
            if ($files) {
                $i=0;
                foreach ($files as $file){

                    $newFilename = $fileUploader->uploadFile($file);

                    $gallery = new Gallery();
                    $gallery->setName($newFilename);
                    $gallery->setArticle($article);
                    $gallery->setMainPicture(false);

                    $em->persist($gallery);

                    $i++;
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
     * @Security("is_granted('ROLE_ADMIN')")
     * @var Article $article
     */
    public function edit(Article $article, Request $request, EntityManagerInterface $em,FileUploader $fileUploader)
    {
        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);
        $files = $form['uploads']->getData();
        $mainFile = $form['uploadMainPicture']->getData();
        $galleryRepository = $this->getDoctrine()->getRepository(Gallery::class);
        if ($form->isSubmitted() && $form->isValid()) {
          //adding main picture
            $newFilename = $fileUploader->uploadFile($mainFile);
            $mainPicture = new Gallery();
            $mainPicture->setName($newFilename);
            $mainPicture->setArticle($article);
            $galleryRepository->looseMainPicture($article->getId());
            $mainPicture->setMainPicture(true);


            $em->persist($mainPicture);
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
     * @Route("/admin/article/galley/delete/{id}", name="article_admin_delete")
     * @Security("is_granted('ROLE_ADMIN')")
     * @var Article $article
     */
    public function deleteArticle(Request $request, EntityManagerInterface $em,Article $article)
    {
        $em->remove($article);
        $em->flush();
        $this->addFlash('deleteArticle', 'L\'article à bien été supprimé');

        return $this->redirectToRoute('admin_article_editList');
    }

    /**
     * @Route("/admin/article/gallery/delete/{id}", name="article_admin_delete_gallery")
     * @Security("is_granted('ROLE_ADMIN')")
     * @var Gallery $gallery
     */
    public function deleteGallery(Gallery $gallery, EntityManagerInterface $em)
    {
        $articleMatch = $gallery->getArticle();
        $nameFile = $gallery->getName();

        $fsObject = new Filesystem();
        $current_dir_path = getcwd();

        //remove a directory
        try {
            $arr_dirs = $current_dir_path . "/images/Upload/".$nameFile;
            $fsObject->remove($arr_dirs);
        } catch (IOException $exception) {
            echo "Error deleting directory at". $exception->getPath();
        }

        $em->remove($gallery);
        $em->flush();

        $this->addFlash('deleteGallery', 'Le fichier à bien été supprimé');

        return $this->redirectToRoute('article_admin_uploadList', array('articleMatch' => $articleMatch->getId()));
    }
    /**
     * @Route("/admin/article/gallery/mainPicture/{id}/{article}", name="article_admin_changeMainPicture")
     * @Security("is_granted('ROLE_ADMIN')")
     * @var Gallery $gallery
     */
    public function changeMainPicture(Article $article, Gallery $gallery)
    {
        $galleryRepository = $this->getDoctrine()->getRepository(Gallery::class);
        $articleMatch = $gallery->getArticle();
        $galleryRepository->looseMainPicture($article);
        $galleryRepository->changeMainPicture($id);
        $this->getDoctrine()->flush();
        $this->addFlash('deleteGallery', "L'image principale à été changée");
        return $this->redirectToRoute('article_admin_uploadList', array('articleMatch' => $articleMatch->getId()));
    }
    /**
     * @Route("/admin/article/addVideo/{id}" name="galleryList")
     * @Security("is_granted('ROLE_ADMIN')")
     * @var Video $video
     */
}
