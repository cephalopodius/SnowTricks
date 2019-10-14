<?php

namespace App\DataFixtures;

use App\Entity\Groupe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GroupeFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $i=0;
        while ($i <7) {

            $groupe = new Groupe();
            if($i == 0){
                $groupe->setGroupname(sprintf('Les Grabs'));
                $this->addReference('Grabs',$groupe);
            }if($i == 1){
                $groupe->setGroupname(sprintf('Les Rotations'));
                $this->addReference('Rotations',$groupe);
            }if($i == 2){
                $groupe->setGroupname(sprintf('Les Flips'));
                $this->addReference('Flips',$groupe);
            }if($i == 3){
                $groupe->setGroupname(sprintf('Les Rotations Désaxées'));
                $this->addReference('Rotations Désaxées',$groupe);
            }if($i == 4){
                $groupe->setGroupname(sprintf('Les Slides'));
                $this->addReference('Slides',$groupe);
            }if($i == 5){
                 $groupe->setGroupname(sprintf('Les One Foot Tricks'));
                 $this->addReference('Foot',$groupe);
            }if($i == 6){
                $groupe->setGroupname(sprintf('Les oldSchool tricks'));
                $this->addReference('OldSchool',$groupe);
            }
            $manager->persist($groupe);
            $manager->flush();

            $i++;
        }

    }
}
