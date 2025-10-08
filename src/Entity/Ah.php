<?php

namespace App\Entity;

use App\Repository\AhRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AhRepository::class)]
class Ah
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
