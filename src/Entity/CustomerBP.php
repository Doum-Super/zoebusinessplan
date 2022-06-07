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
     * @ORM\OneToMany(targetEntity=CustomerVariable::class, mappedBy="customerBp", cascade={"persist", "remove"})
     */
    private $customerVariables;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $projectSummary;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $customerDateOfBirth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $customerPlaceOfBirth;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $humanResource;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $realizationProgram;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $materialResource;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $workingCapitalComment;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $financingNeedsComment;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $revenueForecastComment;

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

    public function getCustomerDateOfBirth(): ?\DateTimeInterface
    {
        return $this->customerDateOfBirth;
    }

    public function setCustomerDateOfBirth(?\DateTimeInterface $customerDateOfBirth): self
    {
        $this->customerDateOfBirth = $customerDateOfBirth;

        return $this;
    }

    public function getCustomerPlaceOfBirth(): ?string
    {
        return $this->customerPlaceOfBirth;
    }

    public function setCustomerPlaceOfBirth(?string $customerPlaceOfBirth): self
    {
        $this->customerPlaceOfBirth = $customerPlaceOfBirth;

        return $this;
    }

    public function getHumanResource(): ?string
    {
        return $this->humanResource;
    }

    public function setHumanResource(?string $humanResource): self
    {
        $this->humanResource = $humanResource;

        return $this;
    }

    public function getRealizationProgram(): ?string
    {
        return $this->realizationProgram;
    }

    public function setRealizationProgram(?string $realizationProgram): self
    {
        $this->realizationProgram = $realizationProgram;

        return $this;
    }

    public function getMaterialResource(): ?string
    {
        return $this->materialResource;
    }

    public function setMaterialResource(?string $materialResource): self
    {
        $this->materialResource = $materialResource;

        return $this;
    }

    public function getWorkingCapitalComment(): ?string
    {
        return $this->workingCapitalComment;
    }

    public function setWorkingCapitalComment(?string $workingCapitalComment): self
    {
        $this->workingCapitalComment = $workingCapitalComment;

        return $this;
    }

    public function getFinancingNeedsComment(): ?string
    {
        return $this->financingNeedsComment;
    }

    public function setFinancingNeedsComment(?string $financingNeedsComment): self
    {
        $this->financingNeedsComment = $financingNeedsComment;

        return $this;
    }

    public function getRevenueForecastComment(): ?string
    {
        return $this->revenueForecastComment;
    }

    public function setRevenueForecastComment(?string $revenueForecastComment): self
    {
        $this->revenueForecastComment = $revenueForecastComment;

        return $this;
    }
}
