<?php

namespace App\Entity;

use App\Repository\KilometersRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KilometersRepository::class)]
class Kilometers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $userId = null;

    #[ORM\Column]
    private ?int $startKm = null;

    #[ORM\Column]
    private ?int $endKm = null;

    #[ORM\Column]
    private ?int $totalKm = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    // #[ORM\OneToOne(inversedBy: 'kilometers', cascade: ['persist', 'remove'])]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): static
    {
        $this->userId = $userId;

        return $this;
    }

    public function getStartKm(): ?int
    {
        return $this->startKm;
    }

    public function setStartKm(int $startKm): static
    {
        $this->startKm = $startKm;

        return $this;
    }

    public function getEndKm(): ?int
    {
        return $this->endKm;
    }

    public function setEndKm(int $endKm): static
    {
        $this->endKm = $endKm;

        return $this;
    }

    public function getTotalKm(): ?int
    {
        return $this->totalKm;
    }

    public function setTotalKm(int $totalKm): static
    {
        $this->totalKm = $totalKm;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    // public function getUser(): ?User
    // {
    //     return $this->user;
    // }

    // public function setUser(User $user): static
    // {
    //     $this->user = $user;

    //     return $this;
    // }
}
