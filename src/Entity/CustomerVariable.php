<?php

namespace App\Entity;

use App\Repository\CustomerVariableRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CustomerVariableRepository::class)
 */
class CustomerVariable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CustomerBP::class, inversedBy="customerVariables")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customerBp;

    /**
     * @ORM\ManyToOne(targetEntity=Variable::class, inversedBy="customerVariables")
     * @ORM\JoinColumn(nullable=false)
     */
    private $variable;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomerBp(): ?CustomerBP
    {
        return $this->customerBp;
    }

    public function setCustomerBp(?CustomerBP $customerBp): self
    {
        $this->customerBp = $customerBp;

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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
