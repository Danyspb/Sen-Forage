<?php

namespace App\Entity;



use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AbonnesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=AbonnesRepository::class)
 * @UniqueEntity(
 *     fields={"numero"},
 *     message="le numero est deja attribuer a un client !!"
 * )
 * @ApiResource()
 */
class Abonnes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity=Clients::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     *
     *
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

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

    public function getClient(): ?Clients
    {
        return $this->client;
    }

    public function setClient(Clients $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function __toString()
    {
        return $this->getClient()->getNom();
    }
}
