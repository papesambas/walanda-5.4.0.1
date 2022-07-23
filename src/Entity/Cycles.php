<?php

namespace App\Entity;

use App\Repository\CyclesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CyclesRepository::class)]
class Cycles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $designation = null;

    #[ORM\ManyToOne(inversedBy: 'cycles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Enseignements $enseignement = null;

    #[ORM\OneToMany(mappedBy: 'cycle', targetEntity: Niveaux::class)]
    private Collection $niveauxes;

    public function __construct()
    {
        $this->niveauxes = new ArrayCollection();
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

    public function getEnseignement(): ?Enseignements
    {
        return $this->enseignement;
    }

    public function setEnseignement(?Enseignements $enseignement): self
    {
        $this->enseignement = $enseignement;

        return $this;
    }

    /**
     * @return Collection<int, Niveaux>
     */
    public function getNiveauxes(): Collection
    {
        return $this->niveauxes;
    }

    public function addNiveaux(Niveaux $niveaux): self
    {
        if (!$this->niveauxes->contains($niveaux)) {
            $this->niveauxes[] = $niveaux;
            $niveaux->setCycle($this);
        }

        return $this;
    }

    public function removeNiveaux(Niveaux $niveaux): self
    {
        if ($this->niveauxes->removeElement($niveaux)) {
            // set the owning side to null (unless already changed)
            if ($niveaux->getCycle() === $this) {
                $niveaux->setCycle(null);
            }
        }

        return $this;
    }
}