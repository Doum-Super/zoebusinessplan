<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoleRepository::class)
 */
class Role
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="userRoles")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=BPModelRole::class, mappedBy="role")
     */
    private $bPModelRoles;

    public function __construct()
    {
        $this->variables = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->bPModelRoles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addUserRole($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeUserRole($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, BPModelRole>
     */
    public function getBPModelRoles(): Collection
    {
        return $this->bPModelRoles;
    }

    public function addBPModelRole(BPModelRole $bPModelRole): self
    {
        if (!$this->bPModelRoles->contains($bPModelRole)) {
            $this->bPModelRoles[] = $bPModelRole;
            $bPModelRole->setRole($this);
        }

        return $this;
    }

    public function removeBPModelRole(BPModelRole $bPModelRole): self
    {
        if ($this->bPModelRoles->removeElement($bPModelRole)) {
            // set the owning side to null (unless already changed)
            if ($bPModelRole->getRole() === $this) {
                $bPModelRole->setRole(null);
            }
        }

        return $this;
    }
}
