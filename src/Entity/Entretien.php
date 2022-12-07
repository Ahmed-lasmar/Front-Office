<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Entretien
 *
 * @ORM\Table(name="entretien", indexes={@ORM\Index(name="id_entretien", columns={"id_entretien"})})
 * @ORM\Entity
 */
class Entretien
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_entretien", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected int $idEntretien;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_candidat", type="integer", nullable=true)
     */
    private $idCandidat;

    /**
     * @Assert\NotBlank(message="Please fill Firstname label")
     * @Assert\Length(
     *     min = 2,
     *     minMessage="Firstname must have at least 2 character"
     * )
     * @var string
     *
     * @ORM\Column(name="firstname_candidat", type="string", length=200, nullable=false)
     */
    private $firstnameCandidat;

    /**
     * @Assert\NotBlank(message="Please fill Name label")
     * @Assert\Length(
     *     min = 2,
     *     minMessage="Name must have at least 2 character"
     * )
     * @var string
     *
     * @ORM\Column(name="name_candidat", type="string", length=200, nullable=false)
     */
    private $nameCandidat;

    /**
     * @Assert\NotBlank(message="Please fill Date label")
     *
     * @var string
     *
     * @ORM\Column(name="heure", type="string", length=200, nullable=false)
     */
    private $heure;

    /**
     * @Assert\NotBlank(message="Connot be Blanc")
     * @Assert\Length(
     *     min = 2,
     *     minMessage="Name must have at least 2 character"
     * )
     * @var string
     *
     * @ORM\Column(name="person_present", type="string", length=200, nullable=false)
     */
    private $personPresent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_entretien", type="date", nullable=false)
     */
    private $dateEntretien;

    /**
     * @ORM\OneToOne(targetEntity=Evaluation::class, mappedBy="entretien",cascade={"persist"})
     * @ORM\JoinColumn(name="evaluation", referencedColumnName="id_evaluation")
     */
    private $evaluation;



    /**
     * @return mixed
     */
    public function getEvaluationn()
    {
        return $this->evaluationn;
    }

    /**
     * @param mixed $evaluationn
     */
    public function setEvaluationn($evaluationn): void
    {
        $this->evaluationn = $evaluationn;
    }



    /**
     * @return mixed
     */
    public function getCandidat()
    {
        return $this->candidat;
    }

    /**
     * @param mixed $candidat
     */
    public function setCandidat($candidat): void
    {
        $this->candidat = $candidat;
    }



    public function getIdEntretien(): ?int
    {
        return $this->idEntretien;
    }

    public function getIdCandidat(): ?int
    {
        return $this->idCandidat;
    }

    public function setIdCandidat(?int $idCandidat): self
    {
        $this->idCandidat = $idCandidat;

        return $this;
    }

    public function getFirstnameCandidat(): ?string
    {
        return $this->firstnameCandidat;
    }

    public function setFirstnameCandidat(string $firstnameCandidat): self
    {
        $this->firstnameCandidat = $firstnameCandidat;

        return $this;
    }

    public function getNameCandidat(): ?string
    {
        return $this->nameCandidat;
    }

    public function setNameCandidat(string $nameCandidat): self
    {
        $this->nameCandidat = $nameCandidat;

        return $this;
    }

    public function getHeure(): ?string
    {
        return $this->heure;
    }

    public function setHeure(string $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getPersonPresent(): ?string
    {
        return $this->personPresent;
    }

    public function setPersonPresent(string $personPresent): self
    {
        $this->personPresent = $personPresent;

        return $this;
    }

    public function getDateEntretien(): ?\DateTimeInterface
    {
        return $this->dateEntretien;
    }

    public function setDateEntretien(\DateTimeInterface $dateEntretien): self
    {
        $this->dateEntretien = $dateEntretien;

        return $this;
    }

    public function getEvaluation(): ?Evaluation
    {
        return $this->evaluation;
    }

    public function setEvaluation(?Evaluation $evaluation): self
    {
        $this->evaluation = $evaluation;

        return $this;
    }

    public function getEntretien(): ?self
    {
        return $this->entretien;
    }

    public function setEntretien(?self $entretien): self
    {
        $this->entretien = $entretien;

        return $this;
    }

    public function addEvaluation(Evaluation $evaluation): self
    {
        if (!$this->evaluation->contains($evaluation)) {
            $this->evaluation[] = $evaluation;
            $evaluation->setEntretien($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): self
    {
        if ($this->evaluation->removeElement($evaluation)) {
            // set the owning side to null (unless already changed)
            if ($evaluation->getEntretien() === $this) {
                $evaluation->setEntretien(null);
            }
        }

        return $this;
    }


}
