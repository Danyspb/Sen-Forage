<?php

namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VillageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * @ORM\Entity(repositoryClass=VillageRepository::class)
 * @UniqueEntity(
 *     fields={"nom"},
 *     message="le nom existe deja !!!"
 * )
 * @ApiResource()
 */
class Village
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @ORM\Column(type="string", length=255)
     *
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $chefvillage;

    /**
     * @ORM\OneToMany(targetEntity=Clients::class, mappedBy="villages")
     */
    private $client;

    public function __construct()
    {
        $this->client = new ArrayCollection();
    }

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

    public function getChefvillage(): ?string
    {
        return $this->chefvillage;
    }

    public function setChefvillage(string $chefvillage): self
    {
        $this->chefvillage = $chefvillage;

        return $this;
    }

    /**
     * @return Collection|Clients[]
     */
    public function getClient(): Collection
    {
        return $this->client;
    }

    public function addClient(Clients $client): self
    {
        if (!$this->client->contains($client)) {
            $this->client[] = $client;
            $client->setVillages($this);
        }

        return $this;
    }

    public function removeClient(Clients $client): self
    {
        if ($this->client->contains($client)) {
            $this->client->removeElement($client);
            // set the owning side to null (unless already changed)
            if ($client->getVillages() === $this) {
                $client->setVillages(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }



}
