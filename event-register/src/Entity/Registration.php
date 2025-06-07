<?php

namespace App\Entity;

use App\Repository\RegistrationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RegistrationRepository::class)]
#[ORM\UniqueConstraint(name: 'email_unique', columns: ['email'])]
class Registration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull(message: 'This field cannot be null')]
    private ?string $name = null;

    #[ORM\Column]
    #[Assert\NotNull(message: 'This field cannot be null')]
    private ?bool $plus_one = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\NotNull(message: 'This field cannot be null')]
    private ?int $number_kids = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\NotNull(message: 'This field cannot be null')]
    private ?int $number_vegetarians = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull(message: 'This field cannot be null')]
    #[Assert\Email(message: 'This field needs to be an email')]
    private ?string $email = null;

    #[ORM\Column(length: 255 , nullable: false)]
    private ?string $department = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function isPlusOne(): ?bool
    {
        return $this->plus_one;
    }

    public function setPlusOne(bool $plus_one): static
    {
        $this->plus_one = $plus_one;

        return $this;
    }

    public function getNumberKids(): ?int
    {
        return $this->number_kids;
    }

    public function setNumberKids(int $number_kids): static
    {
        $this->number_kids = $number_kids;

        return $this;
    }

    public function getNumberVegetarians(): ?int
    {
        return $this->number_vegetarians;
    }

    public function setNumberVegetarians(int $number_vegetarians): static
    {
        $this->number_vegetarians = $number_vegetarians;

        return $this;
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

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment($department)
    {
        $this->department = $department;

        return $this;
    }
}
