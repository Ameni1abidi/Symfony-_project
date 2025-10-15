<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Ref = null;

    #[ORM\Column(length: 255)]
    private ?string $Title = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $PublicationDate = null;

    #[ORM\Column]
    private ?bool $Published = null;

    #[ORM\Column(length: 255)]
    private ?string $Category = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    private ?Author $Author = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRef(): ?string
    {
        return $this->Ref;
    }

    public function setRef(string $Ref): static
    {
        $this->Ref = $Ref;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): static
    {
        $this->Title = $Title;

        return $this;
    }

    public function getPublicationDate(): ?\DateTime
    {
        return $this->PublicationDate;
    }

    public function setPublicationDate(\DateTime $PublicationDate): static
    {
        $this->PublicationDate = $PublicationDate;

        return $this;
    }

    public function isPublished(): ?bool
    {
        return $this->Published;
    }

    public function setPublished(bool $Published): static
    {
        $this->Published = $Published;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->Category;
    }

    public function setCategory(string $Category): static
    {
        $this->Category = $Category;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->Author;
    }

    public function setAuthor(?Author $Author): static
    {
        $this->Author = $Author;

        return $this;
    }
}
