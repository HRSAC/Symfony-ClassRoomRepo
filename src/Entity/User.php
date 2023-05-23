<?php

namespace App\Entity;

use App\Entity\Cours;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use phpDocumentor\Reflection\Types\Null_;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Ambta\DoctrineEncryptBundle\Configuration\Encrypted;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\EntityListeners(['App\EntityListener\UserListener'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private array $role = [];

    /**
     * @var string the hashed password
     */

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[\SpecShaper\EncryptBundle\Annotations\Encrypted]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[\SpecShaper\EncryptBundle\Annotations\Encrypted]    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_naiss_user = null;

    #[ORM\Column(length: 255)]

    private ?string $mail = null;
    private ?string $plainPassword = null ;

    #[ORM\Column]
    private ?int $sexe = null;

    #[ORM\Column(length: 255)]
    #[\SpecShaper\EncryptBundle\Annotations\Encrypted]
    private ?string $adresse = null;

    #[ORM\Column(length: 10)]
    #[\SpecShaper\EncryptBundle\Annotations\Encrypted]
    private ?string $telephone = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Cours::class)]
    private Collection $enseigner;

    public function __toString() {
        return $this->nom;
    }

    public function __construct()
    {
        $this->enseigner = new ArrayCollection();
    } 

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->id;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->role;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->role = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNomUser(): ?string
    {
        return $this->nom;
    }

    public function setNomUser(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenomUser(): ?string
    {
        return $this->prenom;
    }

    public function setPrenomUser(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissUser(): ?\DateTimeInterface
    {
        return $this->date_naiss_user;
    }

    public function setDateNaissUser(\DateTimeInterface $date_naiss_user): self
    {
        $this->date_naiss_user = $date_naiss_user;

        return $this;
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

    /**
     * Get the value of plainPassword
     */ 
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Set the value of plainPassword
     *
     * @return  self
     */ 
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getEnseigner(): Collection
    {
        return $this->enseigner;
    }

    public function addEnseigner(Cours $enseigner): self
    {
        if (!$this->enseigner->contains($enseigner)) {
            $this->enseigner->add($enseigner);
            $enseigner->setUser($this);
        }

        return $this;
    }

    public function removeEnseigner(Cours $enseigner): self
    {
        if ($this->enseigner->removeElement($enseigner)) {
            // set the owning side to null (unless already changed)
            if ($enseigner->getUser() === $this) {
                $enseigner->setUser(null);
            }
        }

        return $this;
    }

    /**
     * Get the value of sexe
     */ 
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set the value of sexe
     *
     * @return  self
     */ 
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get the value of adresse
     */ 
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     *
     * @return  self
     */ 
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get the value of telephone
     */ 
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set the value of telephone
     *
     * @return  self
     */ 
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }
}
