<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ClientsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ClientsRepository::class)
 * @UniqueEntity(
 *     fields={"telephone"},
 *     message="le numero est deja enregistrer !!"
 * )
 * @ApiResource()
 */
class Clients
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;


    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\ManyToOne(targetEntity=Village::class, inversedBy="client")
     * @ORM\JoinColumn(nullable=false)
     */
    private $villages;


    public function getId(): ?int
    {
        return $this->id;
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


    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getVillages(): ?Village
    {
        return $this->villages;
    }

    public function setVillages(?Village $villages): self
    {
        $this->villages = $villages;

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }

}
