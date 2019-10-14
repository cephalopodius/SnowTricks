<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GalleryRepository")
 */
class Gallery
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="galleries")
     * @ORM\JoinColumn(nullable=true,referencedColumnName="id")
     */
    private $article;

    /**
     * @ORM\Column(type="boolean")
     */
    private $mainPicture;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $Article): self
    {
        $this->article = $Article;

        return $this;
    }
    public function findByArticle($i): self
    {
        $this->article = $i;

        return $this;
    }

    public function getMainPicture(): ?bool
    {
        return $this->mainPicture;
    }

    public function setMainPicture(bool $mainPicture): self
    {
        $this->mainPicture = $mainPicture;

        return $this;
    }



}
