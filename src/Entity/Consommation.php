<?php

namespace App\Entity;

use App\Repository\ConsommationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ConsommationRepository::class)
 */
class Consommation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $litreconsomme;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Compteurs::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $compteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLitreconsomme(): ?float
    {
        return $this->litreconsomme;
    }

    public function setLitreconsomme(float $litreconsomme): self
    {
        $this->litreconsomme = $litreconsomme;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCompteur(): ?Compteurs
    {
        return $this->compteur;
    }

    public function setCompteur(?Compteurs $compteur): self
    {
        $this->compteur = $compteur;

        return $this;
    }

    public function __toString()
    {
        return $this->getCompteur()->getNumcompteur();
    }
}
