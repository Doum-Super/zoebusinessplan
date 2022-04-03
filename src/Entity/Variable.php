<?php

namespace App\Entity;

use App\Repository\VariableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VariableRepository::class)
 */
class Variable extends BaseEntity
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
     * @ORM\Column(type="string", length=255)
     */
    private $definition;

    /**
     * @ORM\ManyToMany(targetEntity=Role::class, mappedBy="variables")
     */
    private $roles;

    /**
     * @ORM\ManyToMany(targetEntity=BPModelRole::class, mappedBy="variables")
     */
    private $bPModelRoles;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
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

    public function getDefinition(): ?string
    {
        return $this->definition;
    }

    public function setDefinition(string $definition): self
    {
        $this->definition = $definition;

        return $this;
    }

    /**
     * @return Collection<int, Role>
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(Role $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles[] = $role;
            $role->addVariable($this);
        }

        return $this;
    }

    public function removeRole(Role $role): self
    {
        if ($this->roles->removeElement($role)) {
            $role->removeVariable($this);
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
            $bPModelRole->addVariable($this);
        }

        return $this;
    }

    public function removeBPModelRole(BPModelRole $bPModelRole): self
    {
        if ($this->bPModelRoles->removeElement($bPModelRole)) {
            $bPModelRole->removeVariable($this);
        }

        return $this;
    }
}
