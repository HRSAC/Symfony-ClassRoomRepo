<?php

namespace App\Entity;

use App\Repository\InscritRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscritRepository::class)]
class Inscrit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Eleve::class, inversedBy: 'inscrits')]
    private Collection $etre;

    #[ORM\ManyToMany(targetEntity: Cours::class, inversedBy: 'inscrits')]
    private Collection $avoir;

    public function __construct()
    {
        $this->etre = new ArrayCollection();
        $this->avoir = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Eleve>
     */
    public function getEtre(): Collection
    {
        return $this->etre;
    }

    public function addEtre(Eleve $etre): self
    {
        if (!$this->etre->contains($etre)) {
            $this->etre->add($etre);
        }

        return $this;
    }

    public function removeEtre(Eleve $etre): self
    {
        $this->etre->removeElement($etre);

        return $this;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getAvoir(): Collection
    {
        return $this->avoir;
    }

    public function addAvoir(Cours $avoir): self
    {
        if (!$this->avoir->contains($avoir)) {
            $this->avoir->add($avoir);
        }

        return $this;
    }

    public function removeAvoir(Cours $avoir): self
    {
        $this->avoir->removeElement($avoir);

        return $this;
    }
}
