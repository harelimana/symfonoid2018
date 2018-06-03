<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuthorsRepository")
 */
class Authors
{
    /**
     * @return ArrayCollection|News[]
     */
    public function getNews(): ArrayCollection
    {
        return $this->news;
    }

    /**
     * @param ArrayCollection $news
     */
    public function setNews(ArrayCollection $news)
    {
        $this->news = $news;
    }

    /**
     * @return ArrayCollection|Images[]
     *
     */
    public function getImages(): ArrayCollection
    {
        return $this->images;
    }

    /**
     * @param ArrayCollection $images
     */
    public function setImages(ArrayCollection $images)
    {
        $this->images = $images;
    }
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
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="datetime")
     */
    private $birthday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $biography;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\News", mappedBy="authors")
     *
     */
    private $news;

    /**
     * @var ArrayCollection
     * @ORM\OneToOne(targetEntity="App\Entity\Images", mappedBy="authors",cascade={"persist"})
     */
    private $images;

    public function __construct()
    {
      $this->news = new arrayCollection();
      $this->images = new ArrayCollection();
    }

    public function getId()
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }
}
