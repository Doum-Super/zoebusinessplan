<?php

namespace App\Entity;

use App\Repository\BPModelRoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BPModelRoleRepository::class)
 */
class BPModelRole
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=BPModel::class, inversedBy="bPModelRoles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bpModel;

    /**
     * @ORM\ManyToOne(targetEntity=Role::class, inversedBy="bPModelRoles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $role;

    /**
     * @ORM\ManyToMany(targetEntity=Variable::class, inversedBy="bPModelRoles")
     */
    private $variables;

    public function __construct()
    {
        $this->variables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBpModel(): ?BPModel
    {
        return $this->bpModel;
    }

    public function setBpModel(?BPModel $bpModel): self
    {
        $this->bpModel = $bpModel;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection<int, Variable>
     */
    public function getVariables(): Collection
    {
        return $this->variables;
    }

    public function addVariable(Variable $variable): self
    {
        if (!$this->variables->contains($variable)) {
            $this->variables[] = $variable;
        }

        return $this;
    }

    public function removeVariable(Variable $variable): self
    {
        $this->variables->removeElement($variable);

        return $this;
    }
}
