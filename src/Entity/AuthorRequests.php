<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuthorRequestsRepository")
 * @ORM\Table(name="author_requests")
 */
class AuthorRequests
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=30, nullable=false)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=30, nullable=false)
     */
    private $country;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthday;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $language;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=30, nullable=false)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $edu;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $categories;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $bio;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $previousWorks;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $other;

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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): self
    {
        $this->language = $language;

        return $this;
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEdu(): ?string
    {
        return $this->edu;
    }

    public function setEdu(?string $edu): self
    {
        $this->edu = $edu;

        return $this;
    }

    public function getCategories(): ?string
    {
        return $this->categories;
    }

    public function setCategories(?string $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function getPreviousWorks(): ?string
    {
        return $this->previousWorks;
    }

    public function setPreviousWorks(?string $previousWorks): self
    {
        $this->previousWorks = $previousWorks;

        return $this;
    }

    public function getOther(): ?string
    {
        return $this->other;
    }

    public function setOther(?string $other): self
    {
        $this->other = $other;

        return $this;
    }
}
