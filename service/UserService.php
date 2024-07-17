<?php

class UserService{

    private $conn;
    public function __construct() {
        $this->conn = new mysqli('localhost', 'user', 'test123','simple');
    }

    public function loginUser($email,$password) {

        $sql = "SELECT password FROM Users where email = '$email'";
        $result = $this->conn->query($sql);
        $result = $result->fetch_assoc();
        if($this->verifyPassword($password,$result['password'])){
            setcookie("user", $email);
            return true;
        }else{
            return false;
        }

    }

    public function getUser(){
        return $_COOKIE["user"];
    }

    public function unlogUser() {
        setcookie('user', '');
    }

    public function addUser($email,$password) {

        if($this->checkUser($email)){
            return false;
        }

        $stmt = $this->conn->prepare("INSERT INTO Users (email, password) VALUES (?, ?)");
        $password = $this->hashPassword($password);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        setcookie("user", $email);
        return true;
    }

    private function hashPassword($password) : string {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }

    private function checkUser($email) {

        $sql = "SELECT password FROM Users where email = '$email'";
        $result = $this->conn->query($sql);
        return $result->num_rows>0;

    }
}