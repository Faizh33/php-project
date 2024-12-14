<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    /**
     * @var Collection<int, PhpFunction>
     */
    #[ORM\OneToMany(targetEntity: PhpFunction::class, mappedBy: 'category')]
    private Collection $phpFunction;

    public function __construct()
    {
        $this->phpFunction = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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
     * @return Collection<int, PhpFunction>
     */
    public function getPhpFunction(): Collection
    {
        return $this->phpFunction;
    }

    public function addPhpFunction(PhpFunction $phpFunction): static
    {
        if (!$this->phpFunction->contains($phpFunction)) {
            $this->phpFunction->add($phpFunction);
            $phpFunction->setCategory($this);
        }

        return $this;
    }

    public function removePhpFunction(PhpFunction $phpFunction): static
    {
        if ($this->phpFunction->removeElement($phpFunction)) {
            // set the owning side to null (unless already changed)
            if ($phpFunction->getCategory() === $this) {
                $phpFunction->setCategory(null);
            }
        }

        return $this;
    }
}
