<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Offreemploi
 *
 * @ORM\Table(name="offreemploi")
 * @ORM\Entity
 */
class Offreemploi
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_offre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOffre;

    /**
     * @var string
     * @Assert\NotBlank(message=" nom offre doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer nom min 5 caracteres"
     *
     *     )
     * @ORM\Column(name="nomOffre", type="string", length=50, nullable=false)
     */
    private $nomoffre;

    /**
     * @var string
     * @Assert\NotBlank(message=" description doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer description min 20 caracteres"
     *
     *     )
     * @ORM\Column(name="description", type="string", length=50, nullable=false)
     */
    private $description;

    /**
     * @var string
     * @Assert\NotBlank(message=" skills doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer skills min 5 caracteres"
     *
     *     )
     * @ORM\Column(name="skills", type="string", length=50, nullable=false)
     */
    private $skills;

    /**
     * @var string
     * @Assert\NotBlank(message=" lien picture doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un lien picture au mini de 20 caracteres"
     *
     *     )
     * @ORM\Column(name="picture", type="string", length=50, nullable=false)
     */
    private $picture;

    public function getIdOffre(): ?int
    {
        return $this->idOffre;
    }

    public function getNomoffre(): ?string
    {
        return $this->nomoffre;
    }

    public function setNomoffre(string $nomoffre): self
    {
        $this->nomoffre = $nomoffre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSkills(): ?string
    {
        return $this->skills;
    }

    public function setSkills(string $skills): self
    {
        $this->skills = $skills;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }


}
