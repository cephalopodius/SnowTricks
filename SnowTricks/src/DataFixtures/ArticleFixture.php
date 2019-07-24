<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $article = new Article();
        $article->setTitle(sprintf('Grab'));
        $article->setContent(sprintf('Beautiful grab'));
        $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
        $article->setPicture(sprintf('grab.jpg'));
        $article->setAuthor($this->getReference('toto'));

        $manager->persist($article);
        $manager->flush();

    }

    public function getDependencies()
    {
        return [UserFixture::class];

    }
}
