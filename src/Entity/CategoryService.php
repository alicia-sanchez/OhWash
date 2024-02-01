<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategoryServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: CategoryServiceRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['category:read']],
)]
class CategoryService
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['category:read'])]
    private ?int $id = null;
        
    #[Groups(['category:read'])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;
    
    #[Groups(['category:read'])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $Information = null;
    

    
    
    #[Groups(['category:read'])]
    #[ORM\Column(type: Types::STRING)]
    private ?string $name = null;

    #[Groups(['category:read'])]
    #[ORM\ManyToMany(targetEntity: Service::class, mappedBy: 'category_service')]
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getInformation(): ?string
    {
        return $this->Information;
    }

    public function setInformation(string $Information): static
    {
        $this->Information = $Information;

        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): static
    {
        if (!$this->services->contains($service)) {
            $this->services->add($service);
            $service->addCategoryService($this);
        }

        return $this;
    }

    public function removeService(Service $service): static
    {
        if ($this->services->removeElement($service)) {
            $service->removeCategoryService($this);
        }

        return $this;
    }




}
