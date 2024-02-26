<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['user:read']],
    denormalizationContext: ['groups' => ['user:write']]
)]
#[ORM\EntityListeners(['App\EntityListener\UserListener'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["user:read"])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(["user:read", "user:write"])]
    private ?string $firstname = null;

    #[ORM\Column(length: 100)]
    #[Groups(["user:read", "user:write"])]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    #[Groups(["user:read", "user:write"])]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Groups(["user:read", "user:write"])]
    private ?string $password = null;


    private ?string $plainPassword ;



    #[ORM\Column(length: 100)]
    #[Groups(["user:read", "user:write"])]
    private array $role = [];

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(["user:read", "user:write"])]
    private ?string $gender = null;

    #[ORM\Column(length: 255)]
    #[Groups(["user:read", "user:write"])]
    private ?string $city = null;

    #[ORM\Column]
    #[Groups(["user:read", "user:write"])]
    private ?int $zipCode = null;

    #[ORM\Column(length: 255)]
    #[Groups(["user:read", "user:write"])]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    #[Groups(["user:read", "user:write"])]
    private ?string $adress = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Orders::class)]
    #[Groups(["user:read", "user:write"])]
    private Collection $orders;

    #[ORM\OneToMany(mappedBy: 'assignedEmployee', targetEntity: Orders::class)]
    private Collection $assignedEmployee;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->assignedEmployee = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->getId() ? $this->getFirstname() . ' ' . $this->getLastname() : 'New User';
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
    
        return $this;
    }

    public function getSalt()
    {
        // La plupart des algorithmes de hachage n'ont pas besoin de sel.
        return null;
    }


    public function getRoles(): array
    {
        $roles = $this->role;
        // garantit que chaque utilisateur a au moins le rôle USER
        $roles[] = 'ROLE_USER';
    
        return array_unique($roles);
    }
    

    public function setRoles(array $roles): self
    {
        $this->role = $roles;
      
        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getZipCode(): ?int
    {
        return $this->zipCode;
    }

    public function setZipCode(int $zipCode): static
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): static
    {
        $this->adress = $adress;

        return $this;
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
            $order->setUser($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getUser() === $this) {
                $order->setUser(null);
            }
        }

        return $this;
    }

    public function getPlainPassword(): ?string
{
    return $this->plainPassword;
}

public function setPlainPassword(string $plainPassword): self
{
    $this->plainPassword = $plainPassword;
    // Note: Ne pas persister le plainPassword, il sert uniquement à la création ou à la mise à jour du mot de passe haché
    return $this;
}

public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }

/**
 * @return Collection<int, Orders>
 */
public function getAssignedEmployee(): Collection
{
    return $this->assignedEmployee;
}

public function addAssignedEmployee(Orders $assignedEmployee): static
{
    if (!$this->assignedEmployee->contains($assignedEmployee)) {
        $this->assignedEmployee->add($assignedEmployee);
        $assignedEmployee->setAssignedEmployee($this);
    }

    return $this;
}

public function removeAssignedEmployee(Orders $assignedEmployee): static
{
    if ($this->assignedEmployee->removeElement($assignedEmployee)) {
        // set the owning side to null (unless already changed)
        if ($assignedEmployee->getAssignedEmployee() === $this) {
            $assignedEmployee->setAssignedEmployee(null);
        }
    }

    return $this;
}


}
