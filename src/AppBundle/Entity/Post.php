<?php

declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne as ManyToOne;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity as UniqueEntity;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 * @UniqueEntity(
 *     fields={"title"},
 *     message="This title is already exist!"
 * )
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\Length(min=3)
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="string", length=255)
     */
    private $summary;

    /**
     * @var string
     * @Assert\NotNull()
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string")
     * @Assert\Image(
     *
     * )
     */
    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="posts")
     * @JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setTitle(string $title): Post
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setSummary(string $summary): Post
    {
        $this->summary = $summary;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setContent(string $content): Post
    {
        $this->content = $content;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setDateCreation(\DateTime $dateCreation): Post
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateCreation(): ?\DateTime
    {
        return $this->dateCreation;
    }

    public function setAuthor(UserInterface $author): Post
    {
        $this->author = $author;

        return $this;
    }

    public function getAuthor(): ?UserInterface
    {
        return $this->author;
    }


    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): Post
    {
        $this->image = $image;

        return $this;
    }
}
