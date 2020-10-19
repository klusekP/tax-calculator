<?php


namespace App\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use JMS\Serializer\Annotation as Serializer;

class Users
{
    /**
     * @MongoDB\Id
     * @Serializer\Type("string")
     */
    protected $id;
    /**
     * @MongoDB\Field(type="string")
     * @Serializer\Type("string")
     */
    protected $username;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

}