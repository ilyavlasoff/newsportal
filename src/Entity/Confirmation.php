<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConfirmationRepository")
 */
class Confirmation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="for_user", nullable=false)
     */
    private $forUser;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $key;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $expired;

    public function __construct(User $user, string $key, int $daysDelta = 0, int $hoursDelta = 0, int $minutesDelta = 0)
    {
        $this->forUser = $user;
        $this->key = $key;
        //$this->expired = (new \DateTime())->add(new \DateInterval("P${daysDelta}DT${hoursDelta}HT${minutesDelta}M"));
        $this->expired = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    public function getExpired(): ?\DateTimeInterface
    {
        return $this->expired;
    }

    public function setExpired(\DateTimeInterface $expired): self
    {
        $this->expired = $expired;

        return $this;
    }

    public function getForUser(): ?User
    {
        return $this->forUser;
    }

    public function setForUser(User $forUser): self
    {
        $this->forUser = $forUser;

        return $this;
    }
}
