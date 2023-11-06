<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BasketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BasketRepository::class)]
#[ApiResource]
class Basket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?float $total_price = null;

    #[ORM\ManyToOne(inversedBy: 'selection_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Selection $selection = null;

    #[ORM\OneToMany(mappedBy: 'basket', targetEntity: Orders::class, orphanRemoval: true)]
    private Collection $basket_id;

    public function __construct()
    {
        $this->basket_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->total_price;
    }

    public function setTotalPrice(float $total_price): static
    {
        $this->total_price = $total_price;

        return $this;
    }

    public function getSelection(): ?Selection
    {
        return $this->selection;
    }

    public function setSelection(?Selection $selection): static
    {
        $this->selection = $selection;

        return $this;
    }

    /**
     * @return Collection<int, Orders>
     */
    public function getBasketId(): Collection
    {
        return $this->basket_id;
    }

    public function addBasketId(Orders $basketId): static
    {
        if (!$this->basket_id->contains($basketId)) {
            $this->basket_id->add($basketId);
            $basketId->setBasket($this);
        }

        return $this;
    }

    public function removeBasketId(Orders $basketId): static
    {
        if ($this->basket_id->removeElement($basketId)) {
            // set the owning side to null (unless already changed)
            if ($basketId->getBasket() === $this) {
                $basketId->setBasket(null);
            }
        }

        return $this;
    }
}
