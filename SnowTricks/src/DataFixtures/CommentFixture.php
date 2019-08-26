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
        while ($i < 2) {

            $comment = new Comment();
            if ($i == 0) {
                $comment->setContent(sprintf('premier commentaire'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $comment->setArticle($this->getReference('article1'));
                $comment->setAuthorId($this->getReference('admin'));
            }
            if ($i == 1) {
                $comment->setContent(sprintf('2em commentaire'));
                $comment->setCommentDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $comment->setArticle($this->getReference('article1'));
                $comment->setAuthorId($this->getReference('admin'));
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
