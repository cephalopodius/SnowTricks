<?php

namespace App\DataFixtures;

use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class VideoFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $i=0;
        while ($i < 3) {

            $video = new Video();
            if($i == 0){
                $video->setLink(sprintf('https://www.youtube.com/watch?v=n0F6hSpxaFc'));
                $video->setArticle($this->getReference('article1'));

                $manager->persist($video);
                $manager->flush();
            }if($i == 1){
                $video->setLink(sprintf('https://www.youtube.com/watch?v=n0F6hSpxaFc'));
                $video->setArticle($this->getReference('article2'));

                $manager->persist($video);
                $manager->flush();
            }
            if($i == 2){
                $video->setLink(sprintf('https://www.youtube.com/watch?v=n0F6hSpxaFc'));
                $video->setArticle($this->getReference('article6'));

                $manager->persist($video);
                $manager->flush();
            }if($i == 3){
                $video->setLink(sprintf('https://www.youtube.com/watch?v=n0F6hSpxaFc'));
                $video->setArticle($this->getReference('article3'));

                $manager->persist($video);
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
