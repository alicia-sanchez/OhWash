<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategoryArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryArticleRepository::class)]
#[ApiResource]
class CategoryArticle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'categoryArticle', targetEntity: Article::class, orphanRemoval: true)]
    private Collection $category_article_id;

    #[ORM\ManyToOne(targetEntity: CategoryService::class, inversedBy: 'categoryArticles')]
#[ORM\JoinColumn(nullable: false)]
private ?CategoryService $categoryService = null;


    public function __construct()
    {
        $this->category_article_id = new ArrayCollection();
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
     * @return Collection<int, Article>
     */
    public function getCategoryArticleId(): Collection
    {
        return $this->category_article_id;
    }

    public function addCategoryArticleId(Article $categoryArticleId): static
    {
        if (!$this->category_article_id->contains($categoryArticleId)) {
            $this->category_article_id->add($categoryArticleId);
            $categoryArticleId->setCategoryArticle($this);
        }

        return $this;
    }

    public function removeCategoryArticleId(Article $categoryArticleId): static
    {
        if ($this->category_article_id->removeElement($categoryArticleId)) {
            // set the owning side to null (unless already changed)
            if ($categoryArticleId->getCategoryArticle() === $this) {
                $categoryArticleId->setCategoryArticle(null);
            }
        }

        return $this;
    }

    public function getCategoryService(): ?CategoryService
{
    return $this->categoryService;
}

public function setCategoryService(?CategoryService $categoryService): self
{
    $this->categoryService = $categoryService;

    return $this;
}
}
