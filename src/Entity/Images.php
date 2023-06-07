<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImagesRepository::class)]
class Images
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?Products $products = null;

    #[ORM\Column(length: 255)]
    private ?string $original_name = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $FirstView = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductsId(): ?Products
    {
        return $this->products;
    }

    public function setProductsId(?Products $products): self
    {
        $this->products = $products;

        return $this;
    }

    public function getOriginalName(): ?string
    {
        return $this->original_name;
    }

    public function setOriginalName(string $original_name): self
    {
        $this->original_name = $original_name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function isFirstView(): ?bool
    {
        return $this->FirstView;
    }

    public function setFirstView(bool $FirstView): self
    {
        $this->FirstView = $FirstView;

        return $this;
    }
}
