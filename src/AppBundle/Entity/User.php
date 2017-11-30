<?php

declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany as OneToMany;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(name="vk_id", type="string", length=255, nullable=true) */
    protected $vkontakteId;

    /**
     * @var string
     *
     * @ORM\Column(name="github_id", type="string", nullable=true)
     */
    protected $githubID;

    /** @ORM\Column(name="vk_access_token", type="string", length=255, nullable=true) */
    protected $vkontakteAccessToken;

    /**
     * @OneToMany(targetEntity="Post", mappedBy="author")
     */
    protected $posts;

    public function getId(): int
    {
        return $this->id;
    }

    public function __construct()
    {
        parent::__construct();
        $this->posts = new ArrayCollection();
    }

    public function setVkontakteAccessToken(string $token): UserInterface
    {
        $this->vkontakteAccessToken = $token;

        return $this;
    }

    public function setVkontakteId(int $id): UserInterface
    {
        $this->vkontakteId = $id;

        return $this;
    }
}
