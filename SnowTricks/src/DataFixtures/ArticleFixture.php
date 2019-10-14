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
        while ($i < 10) {

            $article = new Article();
            if ($i == 0) {
                $article->setTitle(sprintf('Grab'));
                $article->setContent(sprintf("Le grab, comment ça marche?
Il faut d'abord faire un saut, un simple ollie par exemple comme on peut le voir sur le tuto du ollie. Bien plier les jambes une fois en l’air pour se regrouper, et aller chercher la planche avec la main. Attention il ne faut pas que le buste se casse en deux pour aller chercher la board : ce sont bien les genoux qui remontent pour amener la board vers la main.Un grab est d'autant plus réussi que la saisie est longue. De plus, le saut est d'autant plus esthétique que la saisie du snowboard est franche, ce qui permet au rideur d'accentuer la torsion de son corps grâce à la tension de sa main sur la planche. On dit alors que le grab est tweaké (le verbe anglais to tweak signifie « pincer » mais a également le sens de « peaufiner »). "));
                $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $article->setAuthor($this->getReference('admin'));
                $article->setGroupe($this->getReference('Grabs'));

                $manager->persist($article);
                $manager->flush();

                $this->addReference('article1',$article);
            }
            if ($i == 1) {
                $article->setTitle(sprintf('flip'));

                $article->setContent(sprintf("Un flip est une rotation verticale. On distingue les front flips, rotations en avant, et les back flips, rotations en arrière.

Il est possible de faire plusieurs flips à la suite, et d'ajouter un grab à la rotation.

Les flips agrémentés d'une vrille existent aussi (Mac Twist, Hakon Flip, ...), mais de manière beaucoup plus rare, et se confondent souvent avec certaines rotations horizontales désaxées.

Néanmoins, en dépit de la difficulté technique relative d'une telle figure, le danger de retomber sur la tête ou la nuque est réel et conduit certaines stations de ski à interdire de telles figures dans ses snowparks. "));
                $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $article->setAuthor($this->getReference('admin'));
                $article->setGroupe($this->getReference('Flips'));

                $manager->persist($article);
                $manager->flush();

                $this->addReference('article2',$article);
            }
            if ($i == 2) {
                $article->setTitle(sprintf('Rotation'));

                $article->setContent(sprintf("On désigne par le mot « rotation » uniquement des rotations horizontales ; les rotations verticales sont des flips. Le principe est d'effectuer une rotation horizontale pendant le saut, puis d'attérir en position switch ou normal.Une rotation peut être frontside ou backside : une rotation frontside correspond à une rotation orientée vers la carre backside. Cela peut paraître incohérent mais l'origine étant que dans un halfpipe ou une rampe de skateboard, une rotation frontside se déclenche naturellement depuis une position frontside (i.e. l'appui se fait sur la carre frontside), et vice-versa. Ainsi pour un rider qui a une position regular (pied gauche devant), une rotation frontside se fait dans le sens inverse des aiguilles d'une montre."));
                $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $article->setAuthor($this->getReference('admin'));
                $article->setGroupe($this->getReference('Rotations'));

                $manager->persist($article);
                $manager->flush();

                $this->addReference('article3',$article);
            }
            if ($i == 3) {
                $article->setTitle(sprintf('One foot Trick'));

                $article->setContent(sprintf("Figures réalisée avec un pied décroché de la fixation, afin de tendre la jambe correspondante pour mettre en évidence le fait que le pied n'est pas fixé. Ce type de figure est extrêmement dangereuse pour les ligaments du genou en cas de mauvaise réception. "));
                $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $article->setAuthor($this->getReference('admin'));
                $article->setGroupe($this->getReference('Foot'));

                $manager->persist($article);
                $manager->flush();

                $this->addReference('article4',$article);
            }
            if ($i == 4) {
                $article->setTitle(sprintf('Rotation Désaxées'));

                $article->setContent(sprintf("Une rotation désaxée est une rotation initialement horizontale mais lancée avec un mouvement des épaules particulier qui désaxe la rotation. Il existe différents types de rotations désaxées (corkscrew ou cork, rodeo, misty, etc.) en fonction de la manière dont est lancé le buste. Certaines de ces rotations, bien qu'initialement horizontales, font passer la tête en bas.

Bien que certaines de ces rotations soient plus faciles à faire sur un certain nombre de tours (ou de demi-tours) que d'autres, il est en théorie possible de d'attérir n'importe quelle rotation désaxée avec n'importe quel nombre de tours, en jouant sur la quantité de désaxage afin de se retrouver à la position verticale au moment voulu.

Il est également possible d'agrémenter une rotation désaxée par un grab. "));
                $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $article->setAuthor($this->getReference('admin'));
                $article->setGroupe($this->getReference('Rotations Désaxées'));

                $manager->persist($article);
                $manager->flush();

                $this->addReference('article5',$article);
            }
            if ($i == 5) {
                $article->setTitle(sprintf('Slide'));

                $article->setContent(sprintf("Un slide consiste à glisser sur une barre de slide. Le slide se fait soit avec la planche dans l'axe de la barre, soit perpendiculaire, soit plus ou moins désaxé.

On peut slider avec la planche centrée par rapport à la barre (celle-ci se situe approximativement au-dessous des pieds du rideur), mais aussi en nose slide, c'est-à-dire l'avant de la planche sur la barre, ou en tail slide, l'arrière de la planche sur la barre. "));
                $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $article->setAuthor($this->getReference('admin'));
                $article->setGroupe($this->getReference('Slides'));

                $manager->persist($article);
                $manager->flush();

                $this->addReference('article6',$article);
            }
            if ($i == 6) {
                $article->setTitle(sprintf('Old School'));

                $article->setContent(sprintf("Le terme old school désigne un style de freestyle caractérisée par en ensemble de figure et une manière de réaliser des figures passée de mode, qui fait penser au freestyle des années 1980 - début 1990 (par opposition à new school) :

    figures désuètes : Japan air, rocket air, ...
    rotations effectuées avec le corps tendu
    figures saccadées, par opposition au style new school qui privilégie l'amplitude

À noter que certains tricks old school restent indémodables :

    Backside Air
    Method Air"));
                $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $article->setAuthor($this->getReference('admin'));
                $article->setGroupe($this->getReference('OldSchool'));

                $manager->persist($article);
                $manager->flush();

                $this->addReference('article7',$article);
            }
            if ($i == 7) {
                $article->setTitle(sprintf('Les differents style de Grabs'));

                $article->setContent(sprintf("Voici la liste de tous les style de grab :     mute : saisie de la carre frontside de la planche entre les deux pieds avec la main avant ;
    sad ou melancholie ou style week : saisie de la carre backside de la planche, entre les deux pieds, avec la main avant ;
    indy : saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière ;
    stalefish : saisie de la carre backside de la planche entre les deux pieds avec la main arrière ;
    tail grab : saisie de la partie arrière de la planche, avec la main arrière ;
    nose grab : saisie de la partie avant de la planche, avec la main avant ;
    japan ou japan air : saisie de l'avant de la planche, avec la main avant, du côté de la carre frontside.
    seat belt: saisie du carre frontside à l'arrière avec la main avant ;
    truck driver: saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture)"));
                $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $article->setAuthor($this->getReference('admin'));
                $article->setGroupe($this->getReference('Grabs'));

                $manager->persist($article);
                $manager->flush();

                $this->addReference('article8',$article);
            }if ($i == 8) {
                $article->setTitle(sprintf('Les Barres de Slide'));

                $article->setContent(sprintf("Pour les barres de slide, la dénomination se fait de la manière suivante :

    d'abord le nom de la figure d'entrée si elle est autre qu'un 90, suivi du mot anglais to
    le nom du slide (nose slide ou tail slide) ou le mot anglais rail si le slide est classique
    enfin le nom de la figure de sortie si elle est autre qu'un 90, précédée du mot anglais to

Par exemple, un switch 270 to rail signifie que le rideur part du côté non naturel, qu'il effectue trois quarts de tour avant de slider normalement sur la barre, puis qu'il sort avec un quart de tour.

Un « rail to switch » signifie que le rider est sorti de la barre avec un quart de tour qui l'a amené de son côté non naturel. De même, le « switch to rail » consiste à entrer sur la barre en partant en arrière et en effectuant un quart de tour.

Lorsque le rideur effectue une rotation au milieu de la barre, on rajoute au nom de la figure un « to figure to rail ». Par exemple, un 270 to rail to 180 to rail to switch signifie que le rideur rentre sur la barre avec 3 quarts de tours, puis effectue un demi-tour en milieu de barre (que les riders appellent aussi « sexchange »), et sort enfin avec un quart de tour qui le fait atterrir en arrière.

Parfois, quand seule la figure d'entrée ou de sortie est notable, par exemple un 630, on parle d'un « 630 in » ou « 630 out ». "));
                $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $article->setAuthor($this->getReference('admin'));
                $article->setGroupe($this->getReference('Slides'));

                $manager->persist($article);
                $manager->flush();

                $this->addReference('article9',$article);
            }if ($i == 9) {
                $article->setTitle(sprintf('Slide'));

                $article->setContent(sprintf("Un slide consiste à glisser sur une barre de slide. Le slide se fait soit avec la planche dans l'axe de la barre, soit perpendiculaire, soit plus ou moins désaxé.

On peut slider avec la planche centrée par rapport à la barre (celle-ci se situe approximativement au-dessous des pieds du rideur), mais aussi en nose slide, c'est-à-dire l'avant de la planche sur la barre, ou en tail slide, l'arrière de la planche sur la barre. "));
                $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $article->setAuthor($this->getReference('admin'));
                $article->setGroupe($this->getReference('Slides'));

                $manager->persist($article);
                $manager->flush();

                $this->addReference('article10',$article);
            }if ($i == 10) {
                $article->setTitle(sprintf('Les sauts'));

                $article->setContent(sprintf("Les tricks sont pour la plupart du temps, des rotations qui peuvent être de plusieurs types, combinées ou non avec un grab, et effectuées en position normal ou switch. La dénomination des figures ainsi créées répond à l'usage suivant :

    d'abord le mot « switch » si la figure est effectuée du côté non naturel
    ensuite le nom du type de désaxage de la rotation si la figure est une rotation désaxée
    puis le nom de la rotation elle-même, c’est-à-dire le nombre de degrés effectués
    si la figure est grabée, le nom du grab

Par exemple, un « switch rodeo cinq tail grab » est un saut dans lequel le rider part de son côté non naturel, fait une rotation horizontale d'un tour et demi avec un désaxage de type rodeo, et attrape l'arrière de sa planche pendant la rotation.

La connaissance du mode de départ (normal ou switch) et du nombre de tours suffit à connaître le sens dans lequel le rideur atterrira . "));
                $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
                $article->setAuthor($this->getReference('admin'));
                $article->setGroupe($this->getReference('Grabs'));

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
