<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=mydb", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }



// class Banco{
//     private $pdo;
//     private $numDeLinhas;
//     private $array;

//     public function __construct($host, $dbname, $dbuser, $dbpassword){
//         try{
//             $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$dbuser,$dbpassword);
//             $this->pdo->exec("set names utf8");
//             $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         } catch(PDOException $e){
//             echo 'Falhou : '.$e->getMessage();
//         }
//     }

//     public function query($sql){
//         $query = $this->pdo->query($sql);
//         $this->numDeLinhas=$query->rowCount();
//         if(strpos($sql, "SELECT") !== false) {
//             $this->array = $query->fetchAll(PDO::FETCH_ASSOC);
//         }

//         if(strpos($sql, "INSERT") !== false) {
//             $this->lastIndex = $this->pdo->lastInsertId();
//         }
//     }

//     public function getLastIndex() {
//         return $this->lastIndex;
//     }
    
//     public function result(){
//         return $this->array;
//     }

//     public function resultJSON(){
//         return json_encode($this->array);
//     }

//     public function getRows(){
//         return $this->numDeLinhas;
//     }
// }
// ?>
