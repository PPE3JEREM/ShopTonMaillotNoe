<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PanierRepository::class)
 */
class Panier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $datePanier;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $moyenPaiement;

    /**
     * @ORM\ManyToOne(targetEntity=Acheter::class, inversedBy="panier")
     */
    private $acheter;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): ?int
    {
        $this->id = $id;

        return $this->id;
    }


    public function getDatePanier(): ?\DateTimeInterface
    {
        return $this->datePanier;
    }

    public function setDatePanier(\DateTimeInterface $datePanier): self
    {
        $this->datePanier = $datePanier;

        return $this;
    }

    public function getMoyenPaiement(): ?string
    {
        return $this->moyenPaiement;
    }

    public function setMoyenPaiement(string $moyenPaiement): self
    {
        $this->moyenPaiement = $moyenPaiement;

        return $this;
    }

    public function getAcheter(): ?Acheter
    {
        return $this->acheter;
    }

    public function setAcheter(?Acheter $acheter): self
    {
        $this->acheter = $acheter;

        return $this;
    }
}
