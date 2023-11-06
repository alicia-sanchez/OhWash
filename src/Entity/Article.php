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

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Selection::class, orphanRemoval: true)]
    private Collection $article_id;

    #[ORM\ManyToOne(inversedBy: 'category_article_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategoryArticle $categoryArticle = null;

    public function __construct()
    {
        $this->article_id = new ArrayCollection();
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
     * @return Collection<int, Selection>
     */
    public function getArticleId(): Collection
    {
        return $this->article_id;
    }

    public function addArticleId(Selection $articleId): static
    {
        if (!$this->article_id->contains($articleId)) {
            $this->article_id->add($articleId);
            $articleId->setArticle($this);
        }

        return $this;
    }

    public function removeArticleId(Selection $articleId): static
    {
        if ($this->article_id->removeElement($articleId)) {
            // set the owning side to null (unless already changed)
            if ($articleId->getArticle() === $this) {
                $articleId->setArticle(null);
            }
        }

        return $this;
    }

    public function getCategoryArticle(): ?CategoryArticle
    {
        return $this->categoryArticle;
    }

    public function setCategoryArticle(?CategoryArticle $categoryArticle): static
    {
        $this->categoryArticle = $categoryArticle;

        return $this;
    }
}
