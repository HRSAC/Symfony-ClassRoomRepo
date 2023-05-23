<?php

namespace App\Entity;

use DateTime;
use App\Entity\Absence;
use App\Entity\Inscrit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EleveRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Ambta\DoctrineEncryptBundle\Configuration\Encrypted;

#[ORM\Entity(repositoryClass: EleveRepository::class)]
class Eleve
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[\SpecShaper\EncryptBundle\Annotations\Encrypted]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    #[\SpecShaper\EncryptBundle\Annotations\Encrypted]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[\SpecShaper\EncryptBundle\Annotations\Encrypted]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?DateTime $date_naiss_eleve = null;

    #[ORM\Column]
    private ?string $sexe = null;

    #[ORM\Column(length: 10)]
    #[\SpecShaper\EncryptBundle\Annotations\Encrypted]
    private ?string $telephone_eleve = null;

    #[ORM\Column(length: 255)]
    #[\SpecShaper\EncryptBundle\Annotations\Encrypted]
    private ?string $adresse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profession = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $diplome = null;

    //#[ORM\Column(length: 255)]
    //private ?string $matricule = null;

    #[ORM\OneToMany(mappedBy: 'peut', targetEntity: Absence::class)]
    private Collection $absences;

    #[ORM\ManyToMany(targetEntity: Inscrit::class, mappedBy: 'etre')]
    private Collection $inscrits;

    public function __construct()
    {
        $this->absences = new ArrayCollection();
        $this->inscrits = new ArrayCollection();
    }

    public function __toString() {
        return $this->nom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissEleve(): ?DateTime
    {
        return $this->date_naiss_eleve;
    }

    public function setDateNaissEleve(DateTime $date_naiss_eleve): self
    {
        $this->date_naiss_eleve = $date_naiss_eleve;

        return $this;
    }

    public function isSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getTelephoneEleve(): ?string
    {
        return $this->telephone_eleve;
    }

    public function setTelephoneEleve(string $telephone_eleve): self
    {
        $this->telephone_eleve = $telephone_eleve;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(?string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getDiplome(): ?string
    {
        return $this->diplome;
    }

    public function setDiplome(?string $diplome): self
    {
        $this->diplome = $diplome;

        return $this;
    }
/*
    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * @return Collection<int, Absence>
     */
    public function getAbsences(): Collection
    {
        return $this->absences;
    }

    public function addAbsence(Absence $absence): self
    {
        if (!$this->absences->contains($absence)) {
            $this->absences->add($absence);
            $absence->setPeut($this);
        }

        return $this;
    }

    public function removeAbsence(Absence $absence): self
    {
        if ($this->absences->removeElement($absence)) {
            // set the owning side to null (unless already changed)
            if ($absence->getPeut() === $this) {
                $absence->setPeut(null);
            }
        }

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
            $inscrit->addEtre($this);
        }

        return $this;
    }

    public function removeInscrit(Inscrit $inscrit): self
    {
        if ($this->inscrits->removeElement($inscrit)) {
            $inscrit->removeEtre($this);
        }

        return $this;
    }
}
