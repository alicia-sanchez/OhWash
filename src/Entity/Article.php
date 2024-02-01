<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ApiResource]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: 'float')]
    private $price;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: true)]
    private ?CategoryArticle $categoryArticle = null;

    #[ORM\OneToMany(mappedBy: 'articles', targetEntity: CategoryArticle::class)]
    private Collection $services;

    public function __construct()
    {
        $this->services = new ArrayCollection();
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

    public function getPrice(): ?float {
        return $this->price;
    }

    public function setPrice(float $price): self {
        $this->price = $price;
        return $this;
    }

    public function getCategoryArticle(): ?CategoryArticle
    {
        return $this->categoryArticle;
    }

    public function setCategoryArticle(?CategoryArticle $categoryArticle): self
    {
        $this->categoryArticle = $categoryArticle;

        return $this;
    }

    /**
     * @return Collection<int, CategoryArticleV2>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(CategoryArticle $service): static
    {
        if (!$this->services->contains($service)) {
            $this->services->add($service);
            $service->setArticles($this);
        }

        return $this;
    }

    public function removeService(CategoryArticle $service): static
    {
        if ($this->services->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getArticles() === $this) {
                $service->setArticles(null);
            }
        }

        return $this;
    }
}
