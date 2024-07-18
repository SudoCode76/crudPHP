<?php
class Model {
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "login";
    private $conn;

    public function __construct(){
        try {
            $this->conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function login($username, $password){
        $sql = "SELECT * FROM user WHERE usuario = :username AND contrasenia = :password";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['username' => $username, 'password' => $password]);
        $user = $stmt->fetch();
        return $user;
    }

}
?>
