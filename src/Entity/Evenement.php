<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity
 */
class Evenement
{
    /**
     * @var int
     *
     * @ORM\Column(name="idEvent", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idevent;

    /**
     *@Assert\NotBlank(message="L'id doit etre non vide")
     * @var int
     *
     * @ORM\Column(name="idUser", type="integer", nullable=false)
     */
    private $iduser;

    /**
     *@Assert\NotBlank(message="L'id doit etre non vide")
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20, nullable=false)
     */
    private $type;

    /**
     *@Assert\NotBlank(message="La date doit etre non vide")
     *@Assert\Length(
     * min = 10,
     * max = 10,
     * minMessage="La date est incorrecte",
     * maxMessage="La date est incorrecte yyyy-mm-dd"
     *   )
     * @var string
     *
     * @ORM\Column(name="dateEvent", type="string", length=20, nullable=false)
     */
    private $dateevent;

    /**
     *@Assert\NotBlank(message="Le type de match doit etre non vide")
     *@Assert\Length(
     * min = 4,
     * max = 55,
     * minMessage="L'adresse doit etre >=4",
     * maxMessage="L'adresse doit etre <=55"
     *   )
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     */

    private $adresse;

    public function getIdevent(): ?int
    {
        return $this->idevent;
    }

    public function getIduser(): ?int
    {
        return $this->iduser;
    }

    public function setIduser(int $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDateevent(): ?string
    {
        return $this->dateevent;
    }

    public function setDateevent(string $dateevent): self
    {
        $this->dateevent = $dateevent;

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


}
