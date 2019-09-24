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
        $i = 0;
        while ($i < 6) {

            $article = new Article();
            if ($i == 0) {
                $article->setTitle(sprintf('Grab'));
                $article->setContent(sprintf('Beautiful grab'));
                $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $article->setAuthor($this->getReference('admin'));
                $article->setGroupe($this->getReference('Grabs'));

                $manager->persist($article);
                $manager->flush();

                $this->addReference('article1',$article);
            }
            if ($i == 1) {
                $article->setTitle(sprintf('flip'));

                $article->setContent(sprintf('Beautiful flip'));
                $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $article->setAuthor($this->getReference('admin'));
                $article->setGroupe($this->getReference('Flips'));

                $manager->persist($article);
                $manager->flush();

                $this->addReference('article2',$article);
            }
            if ($i == 2) {
                $article->setTitle(sprintf('Rotation'));

                $article->setContent(sprintf('Beautiful Rotation'));
                $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $article->setAuthor($this->getReference('admin'));
                $article->setGroupe($this->getReference('Rotations'));

                $manager->persist($article);
                $manager->flush();

                $this->addReference('article3',$article);
            }
            if ($i == 3) {
                $article->setTitle(sprintf('One foot Trick'));

                $article->setContent(sprintf('Beautiful trick'));
                $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $article->setAuthor($this->getReference('admin'));
                $article->setGroupe($this->getReference('Foot'));

                $manager->persist($article);
                $manager->flush();

                $this->addReference('article4',$article);
            }
            if ($i == 4) {
                $article->setTitle(sprintf('Rotation Désaxées'));

                $article->setContent(sprintf('Beautiful grab'));
                $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $article->setAuthor($this->getReference('admin'));
                $article->setGroupe($this->getReference('Rotations Désaxées'));

                $manager->persist($article);
                $manager->flush();

                $this->addReference('article5',$article);
            }
            if ($i == 5) {
                $article->setTitle(sprintf('Slide'));

                $article->setContent(sprintf('Beautiful slide'));
                $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $article->setAuthor($this->getReference('admin'));
                $article->setGroupe($this->getReference('Slides'));

                $manager->persist($article);
                $manager->flush();

                $this->addReference('article6',$article);
            }
            if ($i == 6) {
                $article->setTitle(sprintf('Old School'));

                $article->setContent(sprintf('Beautiful Oldschool trick'));
                $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $article->setAuthor($this->getReference('admin'));
                $article->setGroupe($this->getReference('Oldschool'));

                $manager->persist($article);
                $manager->flush();

                $this->addReference('article6',$article);
            }
            $i++;
        }
    }

    public function getDependencies()
    {
        return [UserFixture::class];

    }
}
