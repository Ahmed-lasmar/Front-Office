<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User implements \Symfony\Component\Security\Core\User\UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="idUser", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iduser;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=255, nullable=false,unique=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom", type="string", length=255, nullable=true,unique=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Cin", type="string", length=255, nullable=true)
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="URL_Photo", type="string", length=255, nullable=true)
     */
    private $urlPhoto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_de_naissance", type="date", nullable=true,unique=false)
     */
    private $dateDeNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="Num_Tel", type="string", length=255, nullable=true)
     */
    private $numTel;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_embauche", type="date", nullable=true,unique=false)
     */
    private $dateEmbauche;

    /**
     * @var string
     *
     * @ORM\Column(name="Grade", type="string", length=255, nullable=true,unique=false)
     */
    private $grade;

    /**
     * @var string
     *
     * @ORM\Column(name="Equipe", type="string", length=255, nullable=true,unique=false)
     */
    private $equipe;

    /**
     * @var string
     *
     * @ORM\Column(name="Role", type="string", length=255, nullable=true,unique=false)
     */
    private $role;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=255, nullable=true,unique=false)
     */
    private $mdp;

    /**
     * @param int $iduser
     */
    public function setIduser(int $iduser): void
    {
        $this->iduser = $iduser;
    }
    public function getUserIdentifier(): ?string
    {
        return $this->iduser;
    }

    public function getIduser(): ?int
    {
        return $this->iduser;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getUrlPhoto(): ?string
    {
        return $this->urlPhoto;
    }

    public function setUrlPhoto(string $urlPhoto): self
    {
        $this->urlPhoto = $urlPhoto;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->dateDeNaissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $dateDeNaissance): self
    {
        $this->dateDeNaissance = $dateDeNaissance;

        return $this;
    }




    public function getNumTel(): ?string
    {
        return $this->numTel;
    }

    public function setNumTel(string $numTel): self
    {
        $this->numTel = $numTel;

        return $this;
    }

    public function getDateEmbauche(): ?\DateTimeInterface
    {
        return $this->dateEmbauche;
    }

    public function setDateEmbauche(\DateTimeInterface $dateEmbauche): self
    {
        $this->dateEmbauche = $dateEmbauche;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getEquipe(): ?string
    {
        return $this->equipe;
    }

    public function setEquipe(string $equipe): self
    {
        $this->equipe = $equipe;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }


    public function getPassword(): string
    {
        return (string)$this->mdp;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {

        // guarantee every user at least has ROLE_USER
        $roles =[];
        $roles = $this->role;

        return array_unique((array)$roles);
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUsername()
    {
        return $this->nom;
    }

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }
}