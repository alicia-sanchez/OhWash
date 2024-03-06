<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Order;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ApiResource]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: 'integer')]
    private ?int $price = null;

    #[ORM\ManyToMany(targetEntity: CategoryArticle::class, mappedBy: 'articles')]
    private Collection $categoryArticles;

    #[ORM\ManyToMany(targetEntity: Order::class, mappedBy: 'articles')]
    private Collection $order;

    public function __construct()
    {
        $this->categoryArticles = new ArrayCollection();
        $this->order = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, CategoryArticle>
     */
    public function getCategoryArticles(): Collection
    {
        return $this->categoryArticles;
    }

    public function addCategoryArticle(CategoryArticle $categoryArticle): self
    {
        if (!$this->categoryArticles->contains($categoryArticle)) {
            $this->categoryArticles[] = $categoryArticle;
            $categoryArticle->addArticle($this);
        }

        return $this;
    }

    public function removeCategoryArticle(CategoryArticle $categoryArticle): self
    {
        if ($this->categoryArticles->removeElement($categoryArticle)) {
            $categoryArticle->removeArticle($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrder(): Collection
    {
        return $this->order;
    }

    public function addOrder(Order $order): static
    {
        if (!$this->order->contains($order)) {
            $this->order->add($order);
            $order->addArticle($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): static
    {
        if ($this->order->removeElement($order)) {
            $order->removeArticle($this);
        }

        return $this;
    }
}
