<?php

namespace App\DTO;

class ContactDTO
{
    private $firstName;
    private $lastName;
    private $email;
    private $phoneNumber;
    private $subject;
    private $msg;


    public function getFirstName()
    {
        return $this->firstName;
    }


    public function setFirstName($firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }


    public function getLastName()
    {
        return $this->lastName;
    }


    public function setLastName($lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }


    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getMsg()
    {
        return $this->msg;
    }

    public function setMsg($msg): self
    {
        $this->msg = $msg;

        return $this;
    }
}
