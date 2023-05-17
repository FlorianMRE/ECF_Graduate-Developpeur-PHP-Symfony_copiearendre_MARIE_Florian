<?php

namespace App\Entity;

use App\Repository\OpeningHoursRepository;
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

    #[ORM\Column(length: 4,nullable: true)]
    private ?string $am_open = null;

    #[ORM\Column(nullable: true)]
    private ?int $am_close = null;

    #[ORM\Column(nullable: true)]
    private ?int $pm_open = null;

    #[ORM\Column(nullable: true)]
    private ?int $pm_close = null;

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

    public function getAmOpen(): ?string
    {
        return $this->am_open;
    }

    public function setAmOpen(?string $am_open): self
    {
        $this->am_open = $am_open;

        return $this;
    }

    public function getAmClose(): ?int
    {
        return $this->am_close;
    }

    public function setAmClose(?int $am_close): self
    {
        $this->am_close = $am_close;

        return $this;
    }

    public function getPmOpen(): ?int
    {
        return $this->pm_open;
    }

    public function setPmOpen(?int $pm_open): self
    {
        $this->pm_open = $pm_open;

        return $this;
    }

    public function getPmClose(): ?int
    {
        return $this->pm_close;
    }

    public function setPmClose(?int $pm_close): self
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
