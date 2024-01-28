<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    #[Groups(['category:read', 'service:read', 'category-article:read'])]
    private ?int $id = null;

    #[Groups(['category:read', 'service:read'])]
    #[ORM\Column(type: 'string')]
    private ?string $name = null;

    #[Groups(['category:read', 'service:read'])]
    #[ORM\Column(type: 'text')]
    private ?string $description = null;

    #[Groups(['category:read', 'service:read'])]
    #[ORM\Column]
    private ?int $price = null;

    #[Groups(['category:read', 'service:read'])]
    #[ORM\ManyToMany(targetEntity: CategoryService::class, inversedBy: 'services')]
    private Collection $category_service;

    #[ORM\ManyToMany(targetEntity: CategoryArticle::class, inversedBy: 'services')]
    private Collection $categoryarticle;
    
    
    



    public function __construct()
    {
        $this->category_service = new ArrayCollection();
        $this->categoryarticle = new ArrayCollection();

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





    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }



    /**
     * @return Collection<int, CategoryService>
     */
    public function getCategoryService(): Collection
    {
        return $this->category_service;
    }

    public function addCategoryService(CategoryService $categoryService): static
    {
        if (!$this->category_service->contains($categoryService)) {
            $this->category_service->add($categoryService);
        }

        return $this;
    }

    public function removeCategoryService(CategoryService $categoryService): static
    {
        $this->category_service->removeElement($categoryService);

        return $this;
    }

    /**
     * @return Collection<int, CategoryArticle>
     */
    public function getCategoryarticle(): Collection
    {
        return $this->categoryarticle;
    }

    public function addCategoryarticle(CategoryArticle $categoryarticle): static
    {
        if (!$this->categoryarticle->contains($categoryarticle)) {
            $this->categoryarticle[] = $categoryarticle;
            $categoryarticle->addService($this);
        }

        return $this;
    }

    public function removeCategoryarticle(CategoryArticle $categoryarticle): static
    {
        $this->categoryarticle->removeElement($categoryarticle);

        return $this;
    }


    
}

