<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserTeamRepository")
 * @ORM\Table(name="user_team",uniqueConstraints={@UniqueConstraint(name="team_name_idx", columns={"title"})})
 */
class UserTeam
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @param int $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
    
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * @param string $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('%s', $this->getTitle());
    }
}
