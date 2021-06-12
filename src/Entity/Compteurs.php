<?php

namespace App\Entity;

use App\Repository\CompteursRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CompteursRepository::class)
 * @UniqueEntity(
 *     fields={"numcompteur"},
 *     message="le numero de compteur est deja attribuer a un Abonnes !!"
 * )
 */
class Compteurs
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numcompteur;

    /**
     * @ORM\OneToOne(targetEntity=Abonnes::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $abonnes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumcompteur(): ?string
    {
        return $this->numcompteur;
    }

    public function setNumcompteur(string $numcompteur): self
    {
        $this->numcompteur = $numcompteur;

        return $this;
    }

    public function getAbonnes(): ?Abonnes
    {
        return $this->abonnes;
    }

    public function setAbonnes(Abonnes $abonnes): self
    {
        $this->abonnes = $abonnes;

        return $this;
    }

    public function __toString()
    {
       return $this->getNumcompteur();
    }
}
