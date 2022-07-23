<?php

namespace App\Entity;

use App\Repository\NiveauxRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NiveauxRepository::class)]
class Niveaux
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $designation = null;

    #[ORM\ManyToOne(inversedBy: 'niveauxes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cycles $cycle = null;

    #[ORM\OneToMany(mappedBy: 'niveau', targetEntity: Classes::class)]
    private Collection $classes;

    #[ORM\Column(length: 128)]
    private ?string $slug = null;

    #[ORM\ManyToMany(targetEntity: Categories::class, mappedBy: 'niveau')]
    private Collection $categories;

    public function __construct()
    {
        $this->classes = new ArrayCollection();
        $this->categories = new ArrayCollection();
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

    public function getCycle(): ?Cycles
    {
        return $this->cycle;
    }

    public function setCycle(?Cycles $cycle): self
    {
        $this->cycle = $cycle;

        return $this;
    }

    /**
     * @return Collection<int, Classes>
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classes $class): self
    {
        if (!$this->classes->contains($class)) {
            $this->classes[] = $class;
            $class->setNiveau($this);
        }

        return $this;
    }

    public function removeClass(Classes $class): self
    {
        if ($this->classes->removeElement($class)) {
            // set the owning side to null (unless already changed)
            if ($class->getNiveau() === $this) {
                $class->setNiveau(null);
            }
        }

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

    /**
     * @return Collection<int, Categories>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categories $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addNiveau($this);
        }

        return $this;
    }

    public function removeCategory(Categories $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeNiveau($this);
        }

        return $this;
    }
}
