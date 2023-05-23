<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heure_debut = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heure_fin = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $periode_debut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $periode_fin = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $matiere = null;

    #[ORM\Column]
    private ?int $eleve_max = null;

    #[ORM\ManyToOne(inversedBy: 'enseigner')]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Inscrit::class, mappedBy: 'avoir')]
    private Collection $inscrits;

    public function __construct()
    {
        $this->inscrits = new ArrayCollection();
    }

    public function __toString() {
        return $this->matiere;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heure_debut;
    }

    public function setHeureDebut(\DateTimeInterface $heure_debut): self
    {
        $this->heure_debut = $heure_debut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heure_fin;
    }

    public function setHeureFin(\DateTimeInterface $heure_fin): self
    {
        $this->heure_fin = $heure_fin;

        return $this;
    }

    public function getPeriodeDebut(): ?\DateTimeInterface
    {
        return $this->periode_debut;
    }

    public function setPeriodeDebut(\DateTimeInterface $periode_debut): self
    {
        $this->periode_debut = $periode_debut;

        return $this;
    }

    public function getPeriodeFin(): ?\DateTimeInterface
    {
        return $this->periode_fin;
    }

    public function setPeriodeFin(\DateTimeInterface $periode_fin): self
    {
        $this->periode_fin = $periode_fin;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMatiere(): ?string
    {
        return $this->matiere;
    }

    public function setMatiere(string $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getEleveMax(): ?int
    {
        return $this->eleve_max;
    }

    public function setEleveMax(int $eleve_max): self
    {
        $this->eleve_max = $eleve_max;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Inscrit>
     */
    public function getInscrits(): Collection
    {
        return $this->inscrits;
    }

    public function addInscrit(Inscrit $inscrit): self
    {
        if (!$this->inscrits->contains($inscrit)) {
            $this->inscrits->add($inscrit);
            $inscrit->addAvoir($this);
        }

        return $this;
    }

    public function removeInscrit(Inscrit $inscrit): self
    {
        if ($this->inscrits->removeElement($inscrit)) {
            $inscrit->removeAvoir($this);
        }

        return $this;
    }
}
