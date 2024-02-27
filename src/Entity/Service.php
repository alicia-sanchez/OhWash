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
    normalizationContext: ['groups' => ['category:read']],
)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['category:read'])]
    private ?int $id = null;

    #[Groups(['category:read'])]
    #[ORM\Column(length: 100, nullable: true)]
    private ?string $name = null;

    #[Groups(['category:read'])]
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $description = null;

    #[Groups(['category:read'])]
    #[ORM\Column(nullable: true)]
    private ?int $price = null;

    #[Groups(['category:read'])]
    #[ORM\ManyToMany(targetEntity: CategoryService::class, inversedBy: 'services')]
    private Collection $category_service;

    #[Groups(['category:read'])]
    #[ORM\ManyToMany(targetEntity: CategoryArticle::class, inversedBy: 'services')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Collection $category_article = null;

    #[ORM\ManyToMany(targetEntity: Orders::class, mappedBy: 'Service')]
    private Collection $orders;
    

    public function __construct()
    {
        $this->category_service = new ArrayCollection();
        $this->category_article = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): static
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

    // Méthode pour ajouter une catégorie de service
    public function addCategoryService(CategoryService $categoryService): self
    {
        if (!$this->category_service->contains($categoryService)) {
            $this->category_service->add($categoryService);
        }

        return $this;
    }

    // Méthode pour supprimer une catégorie de service
    public function removeCategoryService(CategoryService $categoryService): self
    {
        $this->category_service->removeElement($categoryService);

        return $this;
    }

    /**
     * @return Collection<int, CategoryArticle>
     */
    public function getCategoryArticle(): Collection
    {
        return $this->category_article;
    }

    public function addCategoryArticle(CategoryArticle $categoryArticle): self
    {
        if ($this->category_article === null) {
            $this->category_article = new ArrayCollection();
        }
    
        if (!$this->category_article->contains($categoryArticle)) {
            $this->category_article->add($categoryArticle);
            $categoryArticle->addService($this); // Assurez-vous d'ajouter cette ligne
        }
    
        return $this;
    }
    
    
    

    public function removeCategoryArticle(CategoryArticle $categoryArticle): static
    {
        $this->category_article->removeElement($categoryArticle);

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @return Collection<int, Orders>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Orders $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->addService($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): static
    {
        if ($this->orders->removeElement($order)) {
            $order->removeService($this);
        }

        return $this;
    }
}
