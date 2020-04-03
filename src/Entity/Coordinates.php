<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CoordinatesRepository")
 */
class Coordinates
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=9, scale=6)
     */
    private $longitude;

    /**
     * @ORM\Column(type="decimal", precision=9, scale=6)
     */
    private $Latitude;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PointOfInterest", inversedBy="coordinates")
     */
    private $pointOfInterest;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->Latitude;
    }

    public function setLatitude(string $Latitude): self
    {
        $this->Latitude = $Latitude;

        return $this;
    }

    public function getPointOfInterest(): ?PointOfInterest
    {
        return $this->pointOfInterest;
    }

    public function setPointOfInterest(?PointOfInterest $pointOfInterest): self
    {
        $this->pointOfInterest = $pointOfInterest;

        return $this;
    }

}
