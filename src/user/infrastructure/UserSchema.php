<?php


namespace user\infrastructure;

use DateTime;

class userSchema
{
    private ?string $id;
    private ?string $email;
    private ?string $phoneNumber;
    private ?string $firstName;
    private ?string $lastName;
    private ?string $postalCode;
    private ?DateTime $publishedAt;
    private string $status;
    private bool $deleted;
    private DateTime $createdAt;
    private DateTime $updatedAt;
    private int $version;

    public function __construct(
        ?string $id =null,
        ?string $email =null,
        ?string $phoneNumber =null,
        ?string $firstName =null,
        ?string $lastName =null,
        ?string $postalCode =null,
        ?DateTime $publishedAt,
        string $status,
        bool $deleted,
        DateTime $createdAt,
        DateTime $updatedAt,
        int $version
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->postalCode = $postalCode;
        $this->publishedAt = $publishedAt;
        $this->status = $status;
        $this->deleted = $deleted;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->version = $version;
    }

    public static function toSchema(
        ?string $id =null,
        ?string $email =null,
        ?string $phoneNumber =null,
        ?string $firstName =null,
        ?string $lastName =null,
        ?string $postalCode =null,
        ?DateTime $publishedAt,
        string $status,
        bool $deleted,
        DateTime $createdAt,
        DateTime $updatedAt,
        int $version
    ) {

        return new self($id, $email, $phoneNumber, $firstName, $lastName, $postalCode, $publishedAt, $status, $deleted, $createdAt, $updatedAt, $version);
    }

    public function get()
    {
        if($this->deleted) {
            $deleted = 1;
        } else {
            $deleted = 0;
        }
        return [
            "id" => $this->id,
            "email" =>$this->email,
            "content" => $this->email,
            "published_at" => $this->publishedAt,
            "status" => $this->status,
            "deleted" =>$deleted,
            "created_at" => $this->createdAt,
            "updated_at" => $this->updatedAt,
            "version" => $this->version,
        ];
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of version
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set the value of version
     *
     * @return  self
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get the value of updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     *
     * @return  self
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get the value of createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @return  self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of deleted
     */
    public function getDeleted()
    {
        if($this->deleted) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Set the value of deleted
     *
     * @return  self
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of publishedAt
     */
    public function getPublishedAt()
    {
        return isset($this->publishedAt)? $this->publishedAt->format('Y-m-d H:i:s T') : null;
    }

    /**
     * Set the value of publishedAt
     *
     * @return  self
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get the value of firstName
     */
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
