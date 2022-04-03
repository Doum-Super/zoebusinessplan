<?php

namespace App\Entity;

use App\Repository\BPModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BPModelRepository::class)
 */
class BPModel extends BaseEntity
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
     * @ORM\Column(type="integer")
     */
    private $variableNumber;

    /**
     * @ORM\OneToOne(targetEntity=Variable::class, cascade={"persist", "remove"})
     */
    private $variable;

    /**
     * @ORM\OneToOne(targetEntity=FileManager::class, cascade={"persist", "remove"})
     */
    private $modelFile;

    /**
     * @ORM\OneToMany(targetEntity=BPModelRole::class, mappedBy="bpModel")
     */
    private $bPModelRoles;

    public function __construct()
    {
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

    public function getVariableNumber(): ?int
    {
        return $this->variableNumber;
    }

    public function setVariableNumber(int $variableNumber): self
    {
        $this->variableNumber = $variableNumber;

        return $this;
    }

    public function getVariable(): ?Variable
    {
        return $this->variable;
    }

    public function setVariable(?Variable $variable): self
    {
        $this->variable = $variable;

        return $this;
    }

    public function getModelFile(): ?FileManager
    {
        return $this->modelFile;
    }

    public function setModelFile(?FileManager $modelFile): self
    {
        $this->modelFile = $modelFile;

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
            $bPModelRole->setBpModel($this);
        }

        return $this;
    }

    public function removeBPModelRole(BPModelRole $bPModelRole): self
    {
        if ($this->bPModelRoles->removeElement($bPModelRole)) {
            // set the owning side to null (unless already changed)
            if ($bPModelRole->getBpModel() === $this) {
                $bPModelRole->setBpModel(null);
            }
        }

        return $this;
    }
}
