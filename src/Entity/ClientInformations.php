<?php

namespace App\Entity;

use App\Repository\ClientInformationsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientInformationsRepository::class)]
class ClientInformations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $tel = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $history = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 10)]
    private ?string $address_number = null;

    #[ORM\Column(length: 255)]
    private ?string $address_street = null;

    #[ORM\Column(length: 100)]
    private ?string $address_zipcode = null;

    #[ORM\Column(length: 255)]
    private ?string $address_city = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $client_firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $client_lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $entreprise_name = null;

    #[ORM\Column(length: 255)]
    private ?string $siret_number = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getHistory(): ?string
    {
        return $this->history;
    }

    public function setHistory(?string $history): self
    {
        $this->history = $history;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAddressNumber(): ?string
    {
        return $this->address_number;
    }

    public function setAddressNumber(string $address_number): self
    {
        $this->address_number = $address_number;

        return $this;
    }

    public function getAddressStreet(): ?string
    {
        return $this->address_street;
    }

    public function setAddressStreet(string $address_street): self
    {
        $this->address_street = $address_street;

        return $this;
    }

    public function getAddressZipcode(): ?string
    {
        return $this->address_zipcode;
    }

    public function setAddressZipcode(string $address_zipcode): self
    {
        $this->address_zipcode = $address_zipcode;

        return $this;
    }

    public function getAddressCity(): ?string
    {
        return $this->address_city;
    }

    public function setAddressCity(string $address_city): self
    {
        $this->address_city = $address_city;

        return $this;
    }

    public function getClientFirstname(): ?string
    {
        return $this->client_firstname;
    }

    public function setClientFirstname(?string $client_firstname): self
    {
        $this->client_firstname = $client_firstname;

        return $this;
    }

    public function getClientLastname(): ?string
    {
        return $this->client_lastname;
    }

    public function setClientLastname(string $client_lastname): self
    {
        $this->client_lastname = $client_lastname;

        return $this;
    }

    public function getEntrepriseName(): ?string
    {
        return $this->entreprise_name;
    }

    public function setEntrepriseName(string $entreprise_name): self
    {
        $this->entreprise_name = $entreprise_name;

        return $this;
    }

    public function getSiretNumber(): ?string
    {
        return $this->siret_number;
    }

    public function setSiretNumber(string $siret_number): self
    {
        $this->siret_number = $siret_number;

        return $this;
    }
}
