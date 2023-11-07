<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategoryServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryServiceRepository::class)]
#[ApiResource]
class CategoryService
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'categoryservice', targetEntity: ServiceHasCategoryService::class, orphanRemoval: true)]
    private Collection $category_service_id;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Information = null;

    #[ORM\OneToMany(mappedBy: 'CategoryService', targetEntity: CategoryArticle::class, orphanRemoval: true)]
    private Collection $ategoryService_id;

    public function __construct()
    {
        $this->category_service_id = new ArrayCollection();
        $this->ategoryService_id = new ArrayCollection();
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

    /**
     * @return Collection<int, ServiceHasCategoryService>
     */
    public function getCategoryServiceId(): Collection
    {
        return $this->category_service_id;
    }

    public function addCategoryServiceId(ServiceHasCategoryService $categoryServiceId): static
    {
        if (!$this->category_service_id->contains($categoryServiceId)) {
            $this->category_service_id->add($categoryServiceId);
            $categoryServiceId->setCategoryservice($this);
        }

        return $this;
    }

    public function removeCategoryServiceId(ServiceHasCategoryService $categoryServiceId): static
    {
        if ($this->category_service_id->removeElement($categoryServiceId)) {
            // set the owning side to null (unless already changed)
            if ($categoryServiceId->getCategoryservice() === $this) {
                $categoryServiceId->setCategoryservice(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getInformation(): ?string
    {
        return $this->Information;
    }

    public function setInformation(string $Information): static
    {
        $this->Information = $Information;

        return $this;
    }

    
}
