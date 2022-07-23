<?php

namespace App\Entity;

use App\Repository\EtablissementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtablissementsRepository::class)]
class Etablissements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $designation = null;

    #[ORM\Column(length: 128)]
    private ?string $slug = null;

    #[ORM\Column(length: 100)]
    private ?string $forme = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 60)]
    private ?string $numDecisionCreation = null;

    #[ORM\Column(length: 60)]
    private ?string $numDecisionOuverture = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $dateOuverture = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $numSocial = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $numFiscal = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $cpteBancaire = null;

    #[ORM\Column(length: 30)]
    private ?string $telephone = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $telephoneMobile = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: 'etablissement', targetEntity: Enseignements::class)]
    private Collection $enseignements;

    #[ORM\OneToMany(mappedBy: 'etablissement', targetEntity: Users::class)]
    private Collection $users;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->enseignements = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->designation;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getForme(): ?string
    {
        return $this->forme;
    }

    public function setForme(string $forme): self
    {
        $this->forme = $forme;

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

    public function getNumDecisionCreation(): ?string
    {
        return $this->numDecisionCreation;
    }

    public function setNumDecisionCreation(string $numDecisionCreation): self
    {
        $this->numDecisionCreation = $numDecisionCreation;

        return $this;
    }

    public function getNumDecisionOuverture(): ?string
    {
        return $this->numDecisionOuverture;
    }

    public function setNumDecisionOuverture(string $numDecisionOuverture): self
    {
        $this->numDecisionOuverture = $numDecisionOuverture;

        return $this;
    }

    public function getDateOuverture(): ?\DateTimeImmutable
    {
        return $this->dateOuverture;
    }

    public function setDateOuverture(?\DateTimeImmutable $dateOuverture): self
    {
        $this->dateOuverture = $dateOuverture;

        return $this;
    }

    public function getNumSocial(): ?string
    {
        return $this->numSocial;
    }

    public function setNumSocial(?string $numSocial): self
    {
        $this->numSocial = $numSocial;

        return $this;
    }

    public function getNumFiscal(): ?string
    {
        return $this->numFiscal;
    }

    public function setNumFiscal(?string $numFiscal): self
    {
        $this->numFiscal = $numFiscal;

        return $this;
    }

    public function getCpteBancaire(): ?string
    {
        return $this->cpteBancaire;
    }

    public function setCpteBancaire(?string $cpteBancaire): self
    {
        $this->cpteBancaire = $cpteBancaire;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getTelephoneMobile(): ?string
    {
        return $this->telephoneMobile;
    }

    public function setTelephoneMobile(?string $telephoneMobile): self
    {
        $this->telephoneMobile = $telephoneMobile;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Enseignements>
     */
    public function getEnseignements(): Collection
    {
        return $this->enseignements;
    }

    public function addEnseignement(Enseignements $enseignement): self
    {
        if (!$this->enseignements->contains($enseignement)) {
            $this->enseignements[] = $enseignement;
            $enseignement->setEtablissement($this);
        }

        return $this;
    }

    public function removeEnseignement(Enseignements $enseignement): self
    {
        if ($this->enseignements->removeElement($enseignement)) {
            // set the owning side to null (unless already changed)
            if ($enseignement->getEtablissement() === $this) {
                $enseignement->setEtablissement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Users $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setEtablissement($this);
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getEtablissement() === $this) {
                $user->setEtablissement(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
