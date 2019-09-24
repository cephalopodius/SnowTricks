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
        while ($i <8) {

            $gallery = new Gallery();
            if($i == 0){
                $gallery->setName(sprintf('grab.jpg'));
                $gallery->setArticle($this->getReference('article1'));
                $gallery->setMainPicture(true);

                $manager->persist($gallery);
                $manager->flush();
            }if($i == 1){
                $gallery->setName(sprintf('flip.jpg'));
                $gallery->setArticle($this->getReference('article1'));
                $gallery->setMainPicture(false);

                $manager->persist($gallery);
                $manager->flush();
            }
            if($i == 2){
                $gallery->setName(sprintf('flip.jpg'));
                $gallery->setArticle($this->getReference('article2'));
                $gallery->setMainPicture(true);

                $manager->persist($gallery);
                $manager->flush();
            }if($i == 3){
                $gallery->setName(sprintf('OldSchool.jpg'));
                $gallery->setArticle($this->getReference('article3'));
                $gallery->setMainPicture(true);

                $manager->persist($gallery);
                $manager->flush();
            }
            if($i == 4){
                $gallery->setName(sprintf('onefoottrick.jpg'));
                $gallery->setArticle($this->getReference('article4'));
                $gallery->setMainPicture(true);

                $manager->persist($gallery);
                $manager->flush();
            }if($i == 5){
                $gallery->setName(sprintf('Rotation.jpg'));
                $gallery->setArticle($this->getReference('article5'));
                $gallery->setMainPicture(true);

                $manager->persist($gallery);
                $manager->flush();
            }
            if($i == 6){
                $gallery->setName(sprintf('rotationreversal.jpg'));
                $gallery->setArticle($this->getReference('article6'));
                $gallery->setMainPicture(true);

                $manager->persist($gallery);
                $manager->flush();
            }

            $i++;
        }


    }
    public function getDependencies()
    {
        return [UserFixture::class];

    }
}
