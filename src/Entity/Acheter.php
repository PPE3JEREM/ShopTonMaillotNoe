<?php

namespace App\Entity;

use App\Repository\AcheterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AcheterRepository::class)
 */
class Acheter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\OneToMany(targetEntity=Maillot::class, mappedBy="acheter")
     */
    private $maillot;

    /**
     * @ORM\OneToMany(targetEntity=Panier::class, mappedBy="acheter")
     */
    private $panier;

    public function __construct()
    {
        $this->maillot = new ArrayCollection();
        $this->panier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): ?int
    {
        $this->id = $id;

        return $this->id;
    }


    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * @return Collection<int, Maillot>
     */
    public function getMaillot(): Collection
    {
        return $this->maillot;
    }

    public function addMaillot(Maillot $maillot): self
    {
        if (!$this->maillot->contains($maillot)) {
            $this->maillot[] = $maillot;
            $maillot->setAcheter($this);
        }

        return $this;
    }

    public function removeMaillot(Maillot $maillot): self
    {
        if ($this->maillot->removeElement($maillot)) {
            // set the owning side to null (unless already changed)
            if ($maillot->getAcheter() === $this) {
                $maillot->setAcheter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Panier>
     */
    public function getPanier(): Collection
    {
        return $this->panier;
    }

    public function addPanier(Panier $panier): self
    {
        if (!$this->panier->contains($panier)) {
            $this->panier[] = $panier;
            $panier->setAcheter($this);
        }

        return $this;
    }

    public function removePanier(Panier $panier): self
    {
        if ($this->panier->removeElement($panier)) {
            // set the owning side to null (unless already changed)
            if ($panier->getAcheter() === $this) {
                $panier->setAcheter(null);
            }
        }

        return $this;
    }
}
