<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ServiceHasCategoryServiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceHasCategoryServiceRepository::class)]
#[ApiResource]
class ServiceHasCategoryService
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'service_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Service $service = null;

    #[ORM\ManyToOne(inversedBy: 'category_service_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategoryService $categoryservice = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): static
    {
        $this->service = $service;

        return $this;
    }

    public function getCategoryservice(): ?CategoryService
    {
        return $this->categoryservice;
    }

    public function setCategoryservice(?CategoryService $categoryservice): static
    {
        $this->categoryservice = $categoryservice;

        return $this;
    }
}
