<?php

namespace App\Entity;

use App\Repository\TareaRepository;
use App\Validator as AppAssert;
use DateTime;
use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @AppAssert\TareaUnica
 * @ORM\Entity(repositoryClass=TareaRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Tarea
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="El campo descripción no puede estar vacío")
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $finalizada;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creadoEn;

    /**
     *@ORM\PrePersist
     */
    public function setValorCreadoEn()
    {
        $this->creadoEn = new DateTime();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getFinalizada(): ?bool
    {
        return $this->finalizada;
    }

    public function setFinalizada(bool $finalizada): self
    {
        $this->finalizada = $finalizada;

        return $this;
    }

    public function getCreadoEn(): ?DateTimeInterface
    {
        return $this->creadoEn;
    }

    public function setCreadoEn(DateTimeInterface $creadoEn): self
    {
        $this->creadoEn = $creadoEn;

        return $this;
    }
}
