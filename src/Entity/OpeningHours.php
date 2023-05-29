<?php

namespace App\Entity;

use App\Repository\OpeningHoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpeningHoursRepository::class)]
class OpeningHours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 15)]
    private ?string $week_day = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $am_open = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $am_close = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $pm_open = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $pm_close = null;

    #[ORM\Column]
    private ?bool $close_day = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWeekDay(): ?string
    {
        return $this->week_day;
    }

    public function setWeekDay(string $week_day): self
    {
        $this->week_day = $week_day;

        return $this;
    }

    public function getAmOpen(): ?\DateTimeInterface
    {
        return $this->am_open;
    }

    public function setAmOpen(?\DateTimeInterface $am_open): self
    {
        $this->am_open = $am_open;

        return $this;
    }

    public function getAmClose(): ?\DateTimeInterface
    {
        return $this->am_close;
    }

    public function setAmClose(?\DateTimeInterface $am_close): self
    {
        $this->am_close = $am_close;

        return $this;
    }

    public function getPmOpen(): ?\DateTimeInterface
    {
        return $this->pm_open;
    }

    public function setPmOpen(?\DateTimeInterface $pm_open): self
    {
        $this->pm_open = $pm_open;

        return $this;
    }

    public function getPmClose(): ?\DateTimeInterface
    {
        return $this->pm_close;
    }

    public function setPmClose(?\DateTimeInterface $pm_close): self
    {
        $this->pm_close = $pm_close;

        return $this;
    }

    public function isCloseDay(): ?bool
    {
        return $this->close_day;
    }

    public function setCloseDay(bool $close_day): self
    {
        $this->close_day = $close_day;

        return $this;
    }
}
