<?php

namespace App\Entity;

use App\Repository\EnseignementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnseignementsRepository::class)]
class Enseignements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'enseignements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Etablissements $etablissement = null;

    #[ORM\OneToMany(mappedBy: 'enseignement', targetEntity: Cycles::class)]
    private Collection $cycles;

    public function __construct()
    {
        $this->cycles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getEtablissement(): ?Etablissements
    {
        return $this->etablissement;
    }

    public function setEtablissement(?Etablissements $etablissement): self
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * @return Collection<int, Cycles>
     */
    public function getCycles(): Collection
    {
        return $this->cycles;
    }

    public function addCycle(Cycles $cycle): self
    {
        if (!$this->cycles->contains($cycle)) {
            $this->cycles[] = $cycle;
            $cycle->setEnseignement($this);
        }

        return $this;
    }

    public function removeCycle(Cycles $cycle): self
    {
        if ($this->cycles->removeElement($cycle)) {
            // set the owning side to null (unless already changed)
            if ($cycle->getEnseignement() === $this) {
                $cycle->setEnseignement(null);
            }
        }

        return $this;
    }
}
