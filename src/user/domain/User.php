<?php

namespace user\domain;

use DateTime;

class User
{
    private ?string $id;
    private ?string $email;
    private ?string $phoneNumber;
    private ?string $firstName;
    private ?string $lastName;
    private ?string $postalCode;
    private State $state;
    private ?DateTime $publishedAt;
    private DateTime $createdAt;
    private DateTime $updatedAt;
    private int $version;

    public function __construct(
        ?string $id = null, string $email = null,
        ?string $phoneNumber = null,
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $postalCode = null)
    {
        $this->id = $id;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->postalCode = $postalCode;
        $this->state = State::DRAFT;
        $this->publishedAt = null;
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
        $this->version = 0;
    }

    public static function toUser(
        string $id,
        string $email,
        string $phoneNumber,
        string $firstName,
        string $lastName,
        string $postalCode,
        State $state,
        ?DateTime $publishedAt,
        DateTime $createdAt,
        DateTime $updatedAt,
        int $version
    ): User {

        $user = new self($id, $email, $phoneNumber,$firstName, $lastName,$postalCode);

        $user->setState($state);
        $user->setPublishedAt($publishedAt);
        $user->setCreatedAt($createdAt);
        $user->setUpdatedAt($updatedAt);
        $user->setVersion($version);

        return $user;
    }

    public static function publish(User $self): User
    {
        $self->setState(State::PUBLISHED);
        $self->setPublishedAt(new DateTime());
        return $self;
    }

    public static function markAsDeleted(User $self): User
    {
        $self->setState(State::DELETED);
        return $self;
    }

    public static function changeEmail(User $self, string $email): User
    {
        $self->setEmail($email);
        return $self;
    }

    public static function changePhoneNumber(User $self, string $phoneNumber): User
    {
        $self->setPhoneNumber($phoneNumber);
        return $self;
    }

    public static function isPublished(User $self): bool
    {
        if ($self->getState() === State::PUBLISHED) {
            return true;
        }

        return false;
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        return $this->id = $id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        return $this->email = $email;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber)
    {
        return $this->phoneNumber = $phoneNumber;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState(State $state)
    {
        return $this->state = $state;
    }

    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(?DateTime $publishedAt)
    {
        return $this->publishedAt = $publishedAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt)
    {
        return $this->createdAt = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt)
    {
        return $this->updatedAt = $updatedAt;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function setVersion($version)
    {
        return $this->version = $version;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        return $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        return $this->lastName = $lastName;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function setPostalCode($postalCode)
    {
        return $this->postalCode = $postalCode;
    }
}

enum State: string
{
    case DRAFT = 'DRAFT';
    case PUBLISHED = 'PUBLISHED';
    case ARCHIVED = 'ARCHIVED';
    case DELETED = 'DELETED';
}

class CreateUserProps
{
    public string $email;
    public string $phoneNumber;

    public function __construct(string $email, string $phoneNumber)
    {
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }
}