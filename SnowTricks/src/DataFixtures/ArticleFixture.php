<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {


        $article = new Article();
        $article->setTitle(sprintf('Grab'));
        $article->setContent(sprintf('Beautiful grab'));
        $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
        $article->setPicture(sprintf('grab.jpg'));

        $manager->persist($article);
        $manager->flush();

    }
}
