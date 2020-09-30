<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface
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
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="fullName", type="string", length=255)
     */
    private $fullName;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;


    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Article", mappedBy="author")
     */
    private $articles;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Role")
     *
     * @ORM\JoinTable(name="users_roles",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     */
    private $roles;

    /**
     * @var ArrayCollection|Comment[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="author")
     */
    private $comments;


    /**
     * @var ArrayCollection|Message[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Message", mappedBy="sender")
     */
    private $senderMessages;


    /**
     * @var ArrayCollection|Message[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Message", mappedBy="recipient")
     */
    private $recipientMessages;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->roles = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->senderMessages = new ArrayCollection();
        $this->recipientMessages = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set fullName
     *
     * @param string $fullName
     *
     * @return User
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        $stringRoles = [];

        /** @var Role $role */
        foreach ($this->roles as $role){
            $stringRoles[] = $role->getRole();
        }
        return $stringRoles;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @return ArrayCollection
     */
    public function getArticles(): ArrayCollection
    {
        return $this->articles;
    }

    /**
     * @param Article $article
     * @return User
     */
    public function addPost(Article $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * @param Role $role
     * @return User
     */
    public function addRole(Role $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * @param Article $article
     * @return bool
     */
    public function isAuthor(Article $article){
        return $article->getAuthor()->getId() === $this->getId();
    }

    /**
     * @return bool
     */
    public function isAdmin(){
        return in_array("ROLE_ADMIN", $this->getRoles());
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image)
    {
        $this->image = $image;
    }

    /**
     * @return Comment[]|ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param Comment $comments
     * @return User
     */
    public function setComments(Comment $comments)
    {
        $this->comments[] = $comments;
        return $this;
    }

    /**
     * @return Message[]|ArrayCollection
     */
    public function getSenderMessages()
    {
        return $this->senderMessages;
    }

    /**
     * @param Message[]|ArrayCollection $senderMessages
     */
    public function setSenderMessages($senderMessages): void
    {
        $this->senderMessages = $senderMessages;
    }

    /**
     * @return Message[]|ArrayCollection
     */
    public function getRecipientMessages()
    {
        return $this->recipientMessages;
    }

    /**
     * @param Message[]|ArrayCollection $recipientMessages
     */
    public function setRecipientMessages($recipientMessages): void
    {
        $this->recipientMessages = $recipientMessages;
    }


}

