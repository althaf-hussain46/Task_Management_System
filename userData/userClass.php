<?php


class UserClass
{
    public $user_name;
    public $user_email;
    public $user_password;

    public function __construct()
    {
        $this->user_name;
        $this->user_email;
        $this->user_password;
    }

    public function setUserData($userName, $userEmail, $userPassword)
    {
        $this->user_name = $userName;
        $this->user_email = $userEmail;
        $this->user_password = $userPassword;
    }

    public function getUserName()
    {
        return $this->user_name;
    }

    public function getUserEmail()
    {
        return $this->user_email;
    }

    public function getUserPassword()
    {
        return $this->user_password;
    }
}