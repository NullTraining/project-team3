<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkshopApplicantRepository")
 */
class WorkshopApplicant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $contactEmailAddress;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $contactPhoneNumber;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     *
     * @var bool
     */
    private $isApproved = false;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $interestedIn;

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
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getContactEmailAddress()
    {
        return $this->contactEmailAddress;
    }

    /**
     * @param string $contactEmailAddress
     */
    public function setContactEmailAddress(string $contactEmailAddress)
    {
        $this->contactEmailAddress = $contactEmailAddress;
    }

    /**
     * @return string
     */
    public function getContactPhoneNumber(): ?string
    {
        return $this->contactPhoneNumber;
    }

    /**
     * @param string $contactPhoneNumber
     */
    public function setContactPhoneNumber(string $contactPhoneNumber)
    {
        $this->contactPhoneNumber = $contactPhoneNumber;
    }

    /**
     * @return bool
     */
    public function isApproved(): bool
    {
        return true === $this->isApproved;
    }

    /**
     * @param bool $isApproved
     */
    public function setIsApproved(bool $isApproved = false): void
    {
        $this->isApproved = $isApproved;
    }

    /**
     * @return mixed
     */
    public function getInterestedIn()
    {
        return $this->interestedIn;
    }

    /**
     * @param int $interestedIn
     */
    public function setInterestedIn(int $interestedIn = null): void
    {
        $this->interestedIn = $interestedIn;
    }
}
