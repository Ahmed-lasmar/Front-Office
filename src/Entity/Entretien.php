<?php

namespace App\Entity;

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
    private $idEntretien;

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
     * @ORM\OneToOne(targetEntity=Candidat::class, cascade={"persist", "remove"}, inversedBy="entretien")
     */
    protected $candidat;




    /**
     * @ORM\OneToOne(targetEntity=Evaluation::class, mappedBy="entretien")
     */
    protected $evaluationn;

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


}
