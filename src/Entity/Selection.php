<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SelectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SelectionRepository::class)]
#[ApiResource]
class Selection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\ManyToOne(inversedBy: 'selection')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Service $service_id = null;

    #[ORM\ManyToOne(inversedBy: 'article_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Article $article_id = null;

    #[ORM\OneToMany(mappedBy: 'selection', targetEntity: Basket::class, orphanRemoval: true)]
    private Collection $selection_id;

    public function __construct()
    {
        $this->selection_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getServiceId(): ?Service
    {
        return $this->service_id;
    }

    public function setServiceId(?Service $service_id): static
    {
        $this->service_id = $service_id;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article_id;
    }

    public function setArticle(?Article $article_id): static
    {
        $this->article_id = $article_id;

        return $this;
    }

    /**
     * @return Collection<int, Basket>
     */
    public function getSelectionId(): Collection
    {
        return $this->selection_id;
    }

    public function addSelectionId(Basket $selectionId): static
    {
        if (!$this->selection_id->contains($selectionId)) {
            $this->selection_id->add($selectionId);
            $selectionId->setSelection($this);
        }

        return $this;
    }

    public function removeSelectionId(Basket $selectionId): static
    {
        if ($this->selection_id->removeElement($selectionId)) {
            // set the owning side to null (unless already changed)
            if ($selectionId->getSelection() === $this) {
                $selectionId->setSelection(null);
            }
        }

        return $this;
    }
}
