<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 * @ORM\Table(name="comment")
 */
class Comment
{
    /**
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="written_by", referencedColumnName="id", nullable=false)
     * })
     */
    private $writtenBy;

    /**
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="to_article", referencedColumnName="id", nullable=false)
     * })
     */
    private $toArticle;

    /**
     * @ORM\Column(name="added_time", type="datetime", nullable=false)
     */
    private $addedTime;

    /**
     * @ORM\Column(name="content", type="string", length=1024, nullable=false)
     */
    private $content;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getAddedTime(): ?\DateTimeInterface
    {
        return $this->addedTime;
    }

    public function setAddedTime(\DateTimeInterface $addedTime): self
    {
        $this->addedTime = $addedTime;

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

    public function getWrittenBy(): ?User
    {
        return $this->writtenBy;
    }

    public function setWrittenBy(?User $writtenBy): self
    {
        $this->writtenBy = $writtenBy;

        return $this;
    }

    public function getToArticle(): ?Article
    {
        return $this->toArticle;
    }

    public function setToArticle(?Article $toArticle): self
    {
        $this->toArticle = $toArticle;

        return $this;
    }
}
