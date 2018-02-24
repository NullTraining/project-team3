<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Entity\UserTeam", inversedBy="users")
     * @ORM\JoinColumn(nullable=true)
     */
    private $team;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     *
     * @var bool
     */
    private $isEmailVisible;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @param mixed $team
     */
    public function setTeam($team): void
    {
        $this->team = $team;
    }

    /**
     * @return bool
     */
    public function isEmailVisible(): bool
    {
        return $this->isEmailVisible;
    }

    /**
     * @param bool $isEmailVisible
     */
    public function setIsEmailVisible(bool $isEmailVisible): void
    {
        $this->isEmailVisible = $isEmailVisible;
    }
}
