<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use \DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkshopRepository")
 */
class Workshop
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=120)
     */
    private $title;
    
    /**
     * @ORM\Column(type="text")
     */
    private $description;
    
    
    /**
     * @ORM\Column(type="datetime")
     *
     * @var DateTime
     */
    private $date;
    
    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    private $active = false;
    
    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    
    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }
    
    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }
    
    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
    
    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
    
    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }
    
    /**
     * @return null|DateTime
     */
    public function getDate(): ?DateTime
    {
        return $this->date;
    }
    
    /**
     * @param DateTime $date
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }
    
    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }
    
    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }
    
    
}
