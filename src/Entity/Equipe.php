<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipeRepository::class)
 */
class Equipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Sport::class, inversedBy="equipes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Sport;

    /**
     * @ORM\OneToMany(targetEntity=Maillot::class, mappedBy="equipe")
     */
    private $maillots;

    public function __construct()
    {
        $this->maillots = new ArrayCollection();
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


    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSport(): ?Sport
    {
        return $this->Sport;
    }

    public function setSport(?Sport $Sport): self
    {
        $this->Sport = $Sport;

        return $this;
    }

    /**
     * @return Collection<int, Maillot>
     */
    public function getMaillots(): Collection
    {
        return $this->maillots;
    }

    public function addMaillot(Maillot $maillot): self
    {
        if (!$this->maillots->contains($maillot)) {
            $this->maillots[] = $maillot;
            $maillot->setEquipe($this);
        }

        return $this;
    }

    public function removeMaillot(Maillot $maillot): self
    {
        if ($this->maillots->removeElement($maillot)) {
            // set the owning side to null (unless already changed)
            if ($maillot->getEquipe() === $this) {
                $maillot->setEquipe(null);
            }
        }

        return $this;
    }
}
