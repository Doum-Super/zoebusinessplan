<?php

namespace App\Entity;

use App\Repository\CustomerBPRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CustomerBPRepository::class)
 */
class CustomerBP extends BaseEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=ImageManager::class, cascade={"persist", "remove"})
     */
    private $cover;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $businessName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $projectDescription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $beneficiaryFirstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $beneficiaryLastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $beneficiarySex;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $beneficiaryMaritalStatus;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $beneficiaryPhoneNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $beneficiaryAddress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $beneficiaryStudyLevel;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $marketDescription;

    /**
     * @ORM\ManyToOne(targetEntity=BPModel::class, inversedBy="customerBPs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bpModel;

    /**
     * @ORM\ManyToMany(targetEntity=Variable::class, inversedBy="customerBPs")
     */
    private $variables;

    /**
     * @ORM\OneToMany(targetEntity=CustomerVariable::class, mappedBy="customerBp", cascade={"persist", "remove"})
     */
    private $customerVariables;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $projectSummary;

    public function __construct()
    {
        $this->variables = new ArrayCollection();
        $this->customerVariables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCover(): ?ImageManager
    {
        return $this->cover;
    }

    public function setCover(?ImageManager $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getBusinessName(): ?string
    {
        return $this->businessName;
    }

    public function setBusinessName(?string $businessName): self
    {
        $this->businessName = $businessName;

        return $this;
    }

    public function getProjectDescription(): ?string
    {
        return $this->projectDescription;
    }

    public function setProjectDescription(?string $projectDescription): self
    {
        $this->projectDescription = $projectDescription;

        return $this;
    }

    public function getBeneficiaryFirstName(): ?string
    {
        return $this->beneficiaryFirstName;
    }

    public function setBeneficiaryFirstName(?string $beneficiaryFirstName): self
    {
        $this->beneficiaryFirstName = $beneficiaryFirstName;

        return $this;
    }

    public function getBeneficiaryLastName(): ?string
    {
        return $this->beneficiaryLastName;
    }

    public function setBeneficiaryLastName(?string $beneficiaryLastName): self
    {
        $this->beneficiaryLastName = $beneficiaryLastName;

        return $this;
    }

    public function getBeneficiarySex(): ?string
    {
        return $this->beneficiarySex;
    }

    public function setBeneficiarySex(?string $beneficiarySex): self
    {
        $this->beneficiarySex = $beneficiarySex;

        return $this;
    }

    public function getBeneficiaryMaritalStatus(): ?string
    {
        return $this->beneficiaryMaritalStatus;
    }

    public function setBeneficiaryMaritalStatus(?string $beneficiaryMaritalStatus): self
    {
        $this->beneficiaryMaritalStatus = $beneficiaryMaritalStatus;

        return $this;
    }

    public function getBeneficiaryPhoneNumber(): ?string
    {
        return $this->beneficiaryPhoneNumber;
    }

    public function setBeneficiaryPhoneNumber(?string $beneficiaryPhoneNumber): self
    {
        $this->beneficiaryPhoneNumber = $beneficiaryPhoneNumber;

        return $this;
    }

    public function getBeneficiaryAddress(): ?string
    {
        return $this->beneficiaryAddress;
    }

    public function setBeneficiaryAddress(?string $beneficiaryAddress): self
    {
        $this->beneficiaryAddress = $beneficiaryAddress;

        return $this;
    }

    public function getBeneficiaryStudyLevel(): ?string
    {
        return $this->beneficiaryStudyLevel;
    }

    public function setBeneficiaryStudyLevel(?string $beneficiaryStudyLevel): self
    {
        $this->beneficiaryStudyLevel = $beneficiaryStudyLevel;

        return $this;
    }

    public function getMarketDescription(): ?string
    {
        return $this->marketDescription;
    }

    public function setMarketDescription(?string $marketDescription): self
    {
        $this->marketDescription = $marketDescription;

        return $this;
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

    /**
     * @return Collection<int, CustomerVariable>
     */
    public function getCustomerVariables(): Collection
    {
        return $this->customerVariables;
    }

    public function addCustomerVariable(CustomerVariable $customerVariable): self
    {
        if (!$this->customerVariables->contains($customerVariable)) {
            $this->customerVariables[] = $customerVariable;
            $customerVariable->setCustomerBp($this);
        }

        return $this;
    }

    public function removeCustomerVariable(CustomerVariable $customerVariable): self
    {
        if ($this->customerVariables->removeElement($customerVariable)) {
            // set the owning side to null (unless already changed)
            if ($customerVariable->getCustomerBp() === $this) {
                $customerVariable->setCustomerBp(null);
            }
        }

        return $this;
    }

    public function getProjectSummary(): ?string
    {
        return $this->projectSummary;
    }

    public function setProjectSummary(?string $projectSummary): self
    {
        $this->projectSummary = $projectSummary;

        return $this;
    }
}
