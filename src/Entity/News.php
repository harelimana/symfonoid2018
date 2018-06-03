<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NewsRepository")
 */
class News
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image_url;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $publication_date;

    /**
     * @var ArrayCollection
     * @ORM\ManyToOne(targetEntity="App\Entity\Authors", inversedBy="news", cascade={"persist"})
     */
    private $authors;
    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\Categories", mappedBy="news", cascade={"persist"})
     *
     */
    private $categories;
/*
    public function __construct()
    {
        $this->authors = new ArrayCollection();
    } */

    public function getId()
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(?string $image_url): self
    {
        $this->image_url = $image_url;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publication_date;
    }

    public function setPublicationDate(?\DateTimeInterface $publication_date): self
    {
        $this->publication_date = $publication_date;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getAuthors(): ArrayCollection
    {
        return $this->authors;
    }

    /**
     * @param ArrayCollection $authors
     */
    public function setAuthors(ArrayCollection $authors)
    {
        $this->authors = $authors;
    }

    /**
     * @return ArrayCollection
     */
    public function getCategories(): ArrayCollection
    {
        return $this->categories;
    }

    /**
     * @param ArrayCollection $categories
     */
    public function setCategories(ArrayCollection $categories)
    {
        $this->categories = $categories;
    }

}
