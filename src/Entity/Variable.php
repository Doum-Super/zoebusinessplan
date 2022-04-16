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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $definition;

    /**
     * @ORM\ManyToOne(targetEntity=BPModel::class, inversedBy="variables")
     */
    private $bPModel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $value;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=VariableValues::class, mappedBy="variable")
     */
    private $variableValues;

    /**
     * @ORM\ManyToMany(targetEntity=CustomerBP::class, mappedBy="variables")
     */
    private $customerBPs;

    /**
     * @ORM\ManyToMany(targetEntity=Role::class, mappedBy="variables")
     */
    private $roles;

    public function __construct()
    {
        $this->variableValues = new ArrayCollection();
        $this->customerBPs = new ArrayCollection();
        $this->roles = new ArrayCollection();
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

    public function setDefinition(?string $definition): self
    {
        $this->definition = $definition;

        return $this;
    }

    public function getBPModel(): ?BPModel
    {
        return $this->bPModel;
    }

    public function setBPModel(?BPModel $bPModel): self
    {
        $this->bPModel = $bPModel;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, VariableValues>
     */
    public function getVariableValues(): Collection
    {
        return $this->variableValues;
    }

    public function addVariableValue(VariableValues $variableValue): self
    {
        if (!$this->variableValues->contains($variableValue)) {
            $this->variableValues[] = $variableValue;
            $variableValue->setVariable($this);
        }

        return $this;
    }

    public function removeVariableValue(VariableValues $variableValue): self
    {
        if ($this->variableValues->removeElement($variableValue)) {
            // set the owning side to null (unless already changed)
            if ($variableValue->getVariable() === $this) {
                $variableValue->setVariable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CustomerBP>
     */
    public function getCustomerBPs(): Collection
    {
        return $this->customerBPs;
    }

    public function addCustomerBP(CustomerBP $customerBP): self
    {
        if (!$this->customerBPs->contains($customerBP)) {
            $this->customerBPs[] = $customerBP;
            $customerBP->addVariable($this);
        }

        return $this;
    }

    public function removeCustomerBP(CustomerBP $customerBP): self
    {
        if ($this->customerBPs->removeElement($customerBP)) {
            $customerBP->removeVariable($this);
        }

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
}
