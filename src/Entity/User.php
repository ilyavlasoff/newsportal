<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="usr")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"username", "email"}, message="There is already an account with this username or email")
 */
class User implements UserInterface
{
    const roleUser = 'ROLE_USER';
    const roleNewsmaker = 'ROLE_NEWSMAKER';
    const roleAdmin = 'ROLE_ADMIN';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true, nullable=false)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", nullable=false)
     */
    private $password;

    /**
     * @var string User email
     * @ORM\Column(type="string", nullable=false, unique=true)
     *
     */
    private $email;

    /**
     * @var string User description
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $description;

    /**
     * @var string Path to user avatar
     * @ORM\Column(type="string", nullable=true)
     */
    private $userPic;

    /**
     * @return boolean
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $isActivated;

    public function __toString()
    {
        return strval($this->id);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        //$roles[] = self::roleUser;

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $roles[] = self::roleUser;
        $this->roles = $roles;

        return $this;
    }

    public function isAdmin(): bool
    {
        return in_array(self::roleAdmin, $this->roles);
    }

    public function isNewsmaker(): bool
    {
        return in_array(self::roleNewsmaker, $this->roles);
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUserPic(): ?string
    {
        return $this->userPic;
    }

    public function setUserPic(?string $userPic): self
    {
        $this->userPic = $userPic;

        return $this;
    }

    public function getIsActivated(): ?bool
    {
        return $this->isActivated;
    }

    public function setIsActivated(bool $isActivated): self
    {
        $this->isActivated = $isActivated;

        return $this;
    }

}
