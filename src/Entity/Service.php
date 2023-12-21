<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: ServiceRepository::class)]

#[ApiResource(
    normalizationContext: ['groups' => ['service:read']],
    denormalizationContext: ['groups' => ['service:write']]
)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['category:read'])]
    private ?int $id = null;

    #[Groups(['category:read'])]
    #[ORM\Column(type: 'string')]
    private ?string $name = null;

    #[Groups(['category:read'])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: CategoryArticle::class, inversedBy:'services')] 
    private Collection $categoryArticles;

    #[ORM\ManyToMany(targetEntity: Service::class, inversedBy: 'categoryArticles')]
    private Collection $categoryServices;

    #[ORM\Column]
    private ?int $price = null;



    public function __construct()
    {
        $this->categoryServices = new ArrayCollection();

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }


/**
     * @return Collection<int, CategoryService>
     */
    public function getCategoryServices(): Collection
    {
        return $this->categoryServices;
    }

    public function addCategoryService(CategoryService $categoryService): self
    {
        if (!$this->categoryServices->contains($categoryService)) {
            $this->categoryServices[] = $categoryService;
        }

        return $this;
    }

    public function removeCategoryService(CategoryService $categoryService): self
    {
        $this->categoryServices->removeElement($categoryService);

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getCategoriesArticles(): Collection
    {
        return $this->categoryArticles;
    }
    
}
