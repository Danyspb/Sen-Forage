<?php

namespace App\Entity;

use App\Repository\ReglementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReglementRepository::class)
 */
class Reglement
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
    private $etatpaiement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etatcompteur;

    /**
     * @ORM\OneToOne(targetEntity=Factures::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $facture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtatpaiement(): ?string
    {
        return $this->etatpaiement;
    }

    public function setEtatpaiement(string $etatpaiement): self
    {
        $this->etatpaiement = $etatpaiement;

        return $this;
    }

    public function getEtatcompteur(): ?string
    {
        return $this->etatcompteur;
    }

    public function setEtatcompteur(string $etatcompteur): self
    {
        $this->etatcompteur = $etatcompteur;

        return $this;
    }

    public function getFacture(): ?Factures
    {
        return $this->facture;
    }

    public function setFacture(Factures $facture): self
    {
        $this->facture = $facture;

        return $this;
    }

}
