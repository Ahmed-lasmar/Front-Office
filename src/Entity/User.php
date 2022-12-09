<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(name="idUser", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iduser;

    /**
     * @var string
     * @Assert\NotBlank(message=" Nom doit etre non vide")
     * @Assert\Length(
     *      min = 3,
     *      minMessage=" Entrer un nom au mini de 3 caracteres"
     *
     *     )
     * @ORM\Column(name="Nom", type="string", length=255, nullable=true,unique=false)
     */
    private $nom;

    /**
     * @var string
     * @Assert\NotBlank(message=" titre doit etre non vide")
     * @Assert\Length(
     *      min = 3,
     *      minMessage=" Entrer un Prenom au mini de 3 caracteres"
     *
     *     )
     * @ORM\Column(name="Prenom", type="string", length=255, nullable=true,unique=false)
     */
    private $prenom;

    /**
     * @var string
     * @Assert\NotBlank(message=" Email doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un email au mini de 5 caracteres"
     *
     *     )
     * @ORM\Column(name="Email", type="string", length=255, nullable=true,unique=false)
     */
    private $email;

    /**
     * @var string
     * @Assert\NotBlank(message="CIN  doit etre non vide")
     * @Assert\Length(
     *      min = 7,
     *      max = 9,
     *      minMessage = "doit etre 8 ",
     *      maxMessage = "doit etre 8" )
     * @ORM\Column(name="Cin", type="string", length=255, nullable=true,unique=false)
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
     * @Assert\NotBlank(message="Date_de_naissance  doit etre non vide")
     * @ORM\Column(name="Date_de_naissance", type="date", nullable=true,unique=false)
     *
     */
    private $dateDeNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="Num_Tel", type="string", length=255, nullable=true,unique=false)
     * @Assert\NotBlank(message="Num Tel  doit etre non vide")
     * @Assert\Length(
     *      min = 8,
     *      max = 13,
     *      minMessage = "doit etre min 8 ",
     *      maxMessage = "doit etre max 13" )
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
     * @ORM\Column(type="string", length=180, nullable=true,unique=false )
     */
    private $reset_token;

    #[ORM\OneToMany(targetEntity: Conge::class, mappedBy: 'user')]
    private $conges;

    /**
     * @ORM\OneToMany(targetEntity=Rate::class, mappedBy="user",cascade={"persist"})
     */
    private $rate;

    public function __construct()
    {
        $this->rate = new ArrayCollection();
    }

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

    /**
     * @return mixed
     */
    public function getResetToken()
    {
        return $this->reset_token;
    }
    /**
     * @param mixed $reset_token
     */
    public function setResetToken($reset_token): void
    {
        $this->reset_token = $reset_token;
    }

    /**
     * @return Collection<int, Rate>
     */
    public function getRate(): Collection
    {
        return $this->rate;
    }

    public function addRate(Rate $rate): self
    {
        if (!$this->rate->contains($rate)) {
            $this->rate[] = $rate;
            $rate->setUser($this);
        }

        return $this;
    }

    public function removeRate(Rate $rate): self
    {
        if ($this->rate->removeElement($rate)) {
            // set the owning side to null (unless already changed)
            if ($rate->getUser() === $this) {
                $rate->setUser(null);
            }
        }

        return $this;
    }
}



