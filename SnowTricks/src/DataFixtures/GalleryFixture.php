<?php

namespace App\DataFixtures;

use App\Entity\Gallery;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class GalleryFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $i=0;
        while ($i <2) {

            $gallery = new Gallery();
            if($i == 0){
                $gallery->setName(sprintf('grab.jpg'));
                $gallery->setArticle($this->getReference('article1'));
            }if($i == 1){
                $gallery->setName(sprintf('flip.jpg'));
                $gallery->setArticle($this->getReference('article1'));
            }
            $manager->persist($gallery);
            $manager->flush();

            $i++;
        }


    }
    public function getDependencies()
    {
        return [UserFixture::class];

    }
}
