<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $i = 0;
        while ($i < 12) {
            $comment = new Comment();
            if ($i == 0) {
                $comment->setContent(sprintf('premier commentaire'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $comment->setArticle($this->getReference('article1'));
                $comment->setAuthorId($this->getReference('admin'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
            }
            if ($i == 1) {
                $comment->setContent(sprintf('2em commentaire'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $comment->setArticle($this->getReference('article1'));
                $comment->setAuthorId($this->getReference('admin'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
            }
            if ($i == 2) {
                $comment->setContent(sprintf('mouaha'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $comment->setArticle($this->getReference('article1'));
                $comment->setAuthorId($this->getReference('admin'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
            }
            if ($i == 3) {
                $comment->setContent(sprintf('3em commentaire'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $comment->setArticle($this->getReference('article1'));
                $comment->setAuthorId($this->getReference('admin'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
            }
            if ($i == 4) {
                $comment->setContent(sprintf('4em commentaire'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $comment->setArticle($this->getReference('article1'));
                $comment->setAuthorId($this->getReference('admin'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
            }
            if ($i == 5) {
                $comment->setContent(sprintf('5em commentaire'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $comment->setArticle($this->getReference('article1'));
                $comment->setAuthorId($this->getReference('admin'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
            }
            if ($i == 6) {
                $comment->setContent(sprintf('6em commentaire'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $comment->setArticle($this->getReference('article1'));
                $comment->setAuthorId($this->getReference('admin'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
            }
            if ($i == 7) {
                $comment->setContent(sprintf('7em commentaire'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $comment->setArticle($this->getReference('article1'));
                $comment->setAuthorId($this->getReference('admin'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
            }
            if ($i == 8) {
                $comment->setContent(sprintf('8em commentaire'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $comment->setArticle($this->getReference('article1'));
                $comment->setAuthorId($this->getReference('admin'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
            }
            if ($i == 9) {
                $comment->setContent(sprintf('9em commentaire'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $comment->setArticle($this->getReference('article1'));
                $comment->setAuthorId($this->getReference('admin'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
            }
            if ($i ==10) {
                $comment->setContent(sprintf('10em commentaire'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $comment->setArticle($this->getReference('article1'));
                $comment->setAuthorId($this->getReference('admin'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
            }
            if ($i == 11) {
                $comment->setContent(sprintf('11em commentaire'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $comment->setArticle($this->getReference('article1'));
                $comment->setAuthorId($this->getReference('admin'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
            }
            if ($i == 12) {
                $comment->setContent(sprintf('12em commentaire'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $comment->setArticle($this->getReference('article1'));
                $comment->setAuthorId($this->getReference('admin'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
            }
            $manager->persist($comment);
            $manager->flush();
            $i++;
        }
    }
    public function getDependencies()
    {
        return [UserFixture::class];
    }
}
