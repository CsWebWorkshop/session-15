<?php

class Products
{
    private $Conn;

    public function __construct($msqlserver, $msqluser, $msqlpass, $msqldb)
    {
        $conn = new mysqli($msqlserver, $msqluser, $msqlpass, $msqldb);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $this->Conn = $conn;
    }

    public function getProduct($id) {
        $sql = "SELECT * FROM products WHERE id='$id'";
        $result = $this->Conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }

    public function ProductList($where = '') {
        $sql = "SELECT * FROM products ".$where;
        $result = $this->Conn->query($sql);

        if ($result->num_rows > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    }
}

?>