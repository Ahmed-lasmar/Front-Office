<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Formateur
 *
 * @ORM\Table(name="formateur")
 * @ORM\Entity
 */
class Formateur
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_Formateur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFormateur;

    /**
     * @var string
     * @Assert\NotBlank(message="nom doit etre non vide")
     * @Assert\Length (
     *     min=3,
     *     max=20,
     *     minMessage="doit etre >=3",
     *     maxMessage="doit etre<=20" )

     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @Assert\NotBlank(message="prenom doit etre non vide")
     * @Assert\Length (
     *     min=3,
     *     max=20,
     *     minMessage="doit etre >=3",
     *     maxMessage="doit etre<=20" )
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     * @Assert\NotBlank(message="nom doit etre non vide")
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     */
    private $adresse;

    /**
     * @var string
     * @Assert\NotBlank(message="nom doit etre non vide")
     * @Assert\Email
     *
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @Assert\NotBlank(message="nom doit etre non vide")
     * @var int
     * @Assert\Length (
     *     min=7,
     *     max=7,
     *     minMessage="doit etre >=7",
     *     maxMessage="doit etre<=7" )
     * @ORM\Column(name="tel", type="integer", nullable=false)
     */
    private $tel;

    /**
     * @var int
     * @Assert\NotBlank(message="nom doit etre non vide")
     *
     * @ORM\Column(name="codeP", type="integer", nullable=false)
     */
    private $codep;

    /**
     * @var string
     * @Assert\NotBlank(message="nom doit etre non vide")
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=false)
     */
    private $ville;

    /**
     * @var string
     * @Assert\NotBlank(message="nom doit etre non vide")
     *
     * @ORM\Column(name="pays", type="string", length=255, nullable=false)
     */
    private $pays;

    /**
     * @var string
     * @Assert\NotBlank(message="nom doit etre non vide")
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    private $status;

    /**
     * @var int
     * @Assert\NotBlank(message="nom doit etre non vide")
     *
     * @ORM\Column(name="tarif", type="integer", nullable=false)
     */
    private $tarif;

    /**
     * @var int
     * @Assert\NotBlank(message="nom doit etre non vide")
     *
     * @ORM\Column(name="tva", type="integer", nullable=false)
     */
    private $tva;

    /**
     * @var string
     *@Assert\NotBlank(message="nom doit etre non vide")
     * @ORM\Column(name="bio", type="string", length=255, nullable=false)
     */
    private $bio;

    /**
     * @var string
     *@Assert\NotBlank(message="nom doit etre non vide")
     * @ORM\Column(name="diplome", type="string", length=255, nullable=false)
     */
    private $diplome;

    public function getIdFormateur(): ?int
    {
        return $this->idFormateur;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getCodep(): ?int
    {
        return $this->codep;
    }

    public function setCodep(int $codep): self
    {
        $this->codep = $codep;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTarif(): ?int
    {
        return $this->tarif;
    }

    public function setTarif(int $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getTva(): ?int
    {
        return $this->tva;
    }

    public function setTva(int $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function getDiplome(): ?string
    {
        return $this->diplome;
    }

    public function setDiplome(string $diplome): self
    {
        $this->diplome = $diplome;

        return $this;
    }


}
