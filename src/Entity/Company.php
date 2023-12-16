<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
#[ORM\Table(name: '`company`')]
#[UniqueEntity(fields: ['email'], message: 'Cet email est déjà utilisé.')]
class Company implements PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $logoUrl = null;

    #[ORM\Column(type: 'uuid')]
    private ?Uuid $uuid = null;

    #[ORM\Column(length: 255)]
    private ?string $employeeCountRange = null;

    #[ORM\Column]
    private array $status = [];

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bio = null;

    #[ORM\Column]
    private ?int $phoneNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $websiteUrl = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column]
    private ?int $siret = null;

    #[ORM\ManyToOne(inversedBy: 'companies')]
    private ?IndustryCategory $category = null;

    #[ORM\Column(length: 255)]
    private ?string $legalStructure = null;

    #[ORM\Column(length: 255)]
    private ?string $addressOne = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $addressTwo = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column]
    private ?int $postalCode = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    private ?string $contactFullName = null;

    #[ORM\Column(length: 255)]
    private ?string $contactEmail = null;

    #[ORM\Column]
    private ?int $contactPhoneNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contactJobTitle = null;

    #[ORM\Column]
    private array $roles = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    public function setLogoUrl(string $logoUrl): static
    {
        $this->logoUrl = $logoUrl;

        return $this;
    }

    public function getUuid(): ?Uuid
    {
        return $this->uuid;
    }

    public function setUuid(Uuid $uuid): static
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getEmployeeCountRange(): ?string
    {
        return $this->employeeCountRange;
    }

    public function setEmployeeCountRange(string $employeeCountRange): static
    {
        $this->employeeCountRange = $employeeCountRange;

        return $this;
    }

    public function getStatus(): array
    {
        return $this->status;
    }

    public function setStatus(array $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): static
    {
        $this->bio = $bio;

        return $this;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(int $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getWebsiteUrl(): ?string
    {
        return $this->websiteUrl;
    }

    public function setWebsiteUrl(?string $websiteUrl): static
    {
        $this->websiteUrl = $websiteUrl;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSiret(): ?int
    {
        return $this->siret;
    }

    public function setSiret(int $siret): static
    {
        $this->siret = $siret;

        return $this;
    }

    public function getCategory(): ?IndustryCategory
    {
        return $this->category;
    }

    public function setCategory(?IndustryCategory $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getLegalStructure(): ?string
    {
        return $this->legalStructure;
    }

    public function setLegalStructure(string $legalStructure): static
    {
        $this->legalStructure = $legalStructure;

        return $this;
    }

    public function getAddressOne(): ?string
    {
        return $this->addressOne;
    }

    public function setAddressOne(string $addressOne): static
    {
        $this->addressOne = $addressOne;

        return $this;
    }

    public function getAddressTwo(): ?string
    {
        return $this->addressTwo;
    }

    public function setAddressTwo(?string $addressTwo): static
    {
        $this->addressTwo = $addressTwo;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): static
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getContactFullName(): ?string
    {
        return $this->contactFullName;
    }

    public function setContactFullName(string $contactFullName): static
    {
        $this->contactFullName = $contactFullName;

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

    public function getContactPhoneNumber(): ?int
    {
        return $this->contactPhoneNumber;
    }

    public function setContactPhoneNumber(?int $contactPhoneNumber): static
    {
        $this->contactPhoneNumber = $contactPhoneNumber;

        return $this;
    }

    public function getContactJobTitle(): ?string
    {
        return $this->contactJobTitle;
    }

    public function setContactJobTitle(?string $contactJobTitle): static
    {
        $this->contactJobTitle = $contactJobTitle;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }
}
