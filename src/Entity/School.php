<?php

namespace App\Entity;

use App\Repository\SchoolRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SchoolRepository::class)]
class School
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $schoolName = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column(length: 255)]
    private ?string $contactName = null;

    #[ORM\Column(length: 255)]
    private ?string $contactNumer = null;

    #[ORM\Column(length: 255)]
    private ?string $contactEmail = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $contactMessage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSchoolName(): ?string
    {
        return $this->schoolName;
    }

    public function setSchoolName(string $schoolName): static
    {
        $this->schoolName = $schoolName;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getContactName(): ?string
    {
        return $this->contactName;
    }

    public function setContactName(string $contactName): static
    {
        $this->contactName = $contactName;

        return $this;
    }

    public function getContactNumer(): ?string
    {
        return $this->contactNumer;
    }

    public function setContactNumer(string $contactNumer): static
    {
        $this->contactNumer = $contactNumer;

        return $this;
    }

    public function getContactEmail(): ?string
    {
        return $this->contactEmail;
    }

    public function setContactEmail(string $contactEmail): static
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    public function getContactMessage(): ?string
    {
        return $this->contactMessage;
    }

    public function setContactMessage(?string $contactMessage): static
    {
        $this->contactMessage = $contactMessage;

        return $this;
    }
}