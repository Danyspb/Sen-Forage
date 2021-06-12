<?php

namespace App\Entity;

use App\Repository\FacturesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FacturesRepository::class)
 */
class Factures
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
    private $consmensuelle;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datefacture;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datelimitepaye;

    /**
     * @ORM\OneToOne(targetEntity=Consommation::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $consommation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConsmensuelle(): ?float
    {
        return $this->consmensuelle;
    }

    public function setConsmensuelle(float $consmensuelle): self
    {
        $this->consmensuelle = $consmensuelle;

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

    public function getDatefacture(): ?\DateTimeInterface
    {
        return $this->datefacture;
    }

    public function setDatefacture(\DateTimeInterface $datefacture): self
    {
        $this->datefacture = $datefacture;

        return $this;
    }

    public function getDatelimitepaye(): ?\DateTimeInterface
    {
        return $this->datelimitepaye;
    }

    public function setDatelimitepaye(\DateTimeInterface $datelimitepaye): self
    {
        $this->datelimitepaye = $datelimitepaye;

        return $this;
    }

    public function getConsommation(): ?Consommation
    {
        return $this->consommation;
    }

    public function setConsommation(Consommation $consommation): self
    {
        $this->consommation = $consommation;

        return $this;
    }

    public function __toString()
    {
       return $this->getConsommation()->getCompteur()->getNumcompteur();
    }
}
