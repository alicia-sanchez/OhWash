<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
#[ApiResource]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'service_id', targetEntity: Selection::class, orphanRemoval: true)]
    private Collection $selection;

    #[ORM\OneToMany(mappedBy: 'service', targetEntity: ServiceHasCategoryService::class, orphanRemoval: true)]
    private Collection $service_id;

    #[ORM\Column]
    private ?int $price_id = null;

    #[ORM\Column]
    private ?int $price = null;

    public function __construct()
    {
        $this->selection = new ArrayCollection();
        $this->service_id = new ArrayCollection();
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
    public function getSelection(): Collection
    {
        return $this->selection;
    }

    public function addSelection(Selection $selection): static
    {
        if (!$this->selection->contains($selection)) {
            $this->selection->add($selection);
            $selection->setServiceId($this);
        }

        return $this;
    }

    public function removeSelection(Selection $selection): static
    {
        if ($this->selection->removeElement($selection)) {
            // set the owning side to null (unless already changed)
            if ($selection->getServiceId() === $this) {
                $selection->setServiceId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ServiceHasCategoryService>
     */
    public function getServiceId(): Collection
    {
        return $this->service_id;
    }

    public function addServiceId(ServiceHasCategoryService $serviceId): static
    {
        if (!$this->service_id->contains($serviceId)) {
            $this->service_id->add($serviceId);
            $serviceId->setService($this);
        }

        return $this;
    }

    public function removeServiceId(ServiceHasCategoryService $serviceId): static
    {
        if ($this->service_id->removeElement($serviceId)) {
            // set the owning side to null (unless already changed)
            if ($serviceId->getService() === $this) {
                $serviceId->setService(null);
            }
        }

        return $this;
    }

    public function getPriceId(): ?int
    {
        return $this->price_id;
    }

    public function setPriceId(int $price_id): static
    {
        $this->price_id = $price_id;

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
}