<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 * @package App\Entity
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"producer"="App\Entity\Producer", "customer"="App\Entity\Customer"})
 * @UniqueEntity("email")
 */
abstract class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id = null;

    /**
     * @ORM\Column
     * @Assert\NotBlank
     */
    protected string $firstname = "";

    /**
     * @ORM\Column
     * @Assert\NotBlank
     */
    protected string $lastname = "";

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank
     * @Assert\Email
     */
    protected string $email = "";

    /**
     * @ORM\Column
     */
    protected string $password = "";

    /**
    * @Assert\NotBlank
    * @Assert\Length(min=8)
    */
    protected ?string $plainPassword = null;

    /**
     * @ORM\Column(type="date_immutable")
     */
    protected DateTimeImmutable $registeredAt;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->registeredAt = new DateTimeImmutable();
    }

    /**
     * @return $id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstName
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param  string  $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @param string|null $plainPassword
     */
    public function setPlainPassword(?string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getRegisteredAt()
    {
        return $this->registeredAt;
    }

    /**
     * @param DateTimeImmutable $registeredAt
     */
    public function setRegisteredAt(string $registeredAt): void
    {
        $this->registeredAt = $registeredAt;
    }

    public function getSalt()
    {
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }
}
