<?php
//// database abstraction
session_start();
Class DBHelper{
    	//properties
		private $hostname='localhost'; //127.0.0.1
		private $username='root';
		private $password='';
		private $database='locker_db';
		private $conn;
// Constructor
function __construct(){
    try{
        $this->conn=new PDO("mysql:host=$this->hostname;dbname=$this->database",$this->username,$this->password);
    }catch(PDOException $e){ echo $e->getMessage();}
}
// Login
    function logginUser($data,$user,$pass){
        $sql = "SELECT * FROM tbl_student WHERE $user = ? AND $pass = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0){
            $_SESSION['student'] = $row['stud_fname'].' '.$row['stud_lname'];
            $_SESSION['stud_id'] = $row['stud_id'];
            echo "<script> window.location='home.php?$_SESSION[student]'; </script>";
        }else{
            $sql2 = "SELECT * FROM tbl_admin WHERE $user = ? AND $pass = ?";
            $stmt2 = $this->conn->prepare($sql2);
            $stmt2->execute($data);
            $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
            if($stmt2->rowCount() > 0){
                $_SESSION['admin'] = $row2['firstname'].' '.$row2['lastname'];
                $_SESSION['admin_id'] = $row2['admin_id'];
                echo "<script> window.location='home.php?$_SESSION[admin]'; </script>";
            }else{
               echo "<script> alert('Error'); </script>";
            }
        }
        $this->conn = null;
    }
// Create
    function insertRecord($data,$fields,$table){
        $ok;
        $fld=implode(",",$fields);
        $q=array();
        foreach($data as $d) $q[]="?";
        $plc=implode(",",$q);
        $sql="INSERT INTO $table($fld) VALUES($plc)";
        try{
            $stmt=$this->conn->prepare($sql);
            $ok=$stmt->execute($data);				
        }catch(PDOException $e){ echo $e->getMessage();}
        return $ok;
    }
// Retrieve
function getAllRecord($table){
        $rows;
        $sql="SELECT * FROM $table";
        try{
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){ echo $e->getMessage();}
        return $rows;
    }
    //-----
    function getRecordById($table,$field_id,$ref_id){
        $sql = "SELECT * FROM $table WHERE $field_id = ?";
        try{
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array($ref_id));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e){ echo $e->getMessage();}
        return $row;
       // $this->conn = null;
    }
    //---
function getRecord($table,$field_id,$ref_id){
    $row;
    $sql="SELECT * FROM $table WHERE $field_id=?";
    try{
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(array($ref_id));
        $row=$stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){ echo $e->getMessage();}
    return $row;
}

// Update
function updateRecord($table,$fields,$data,$field_id,$ref_id){
            $ok;
            $flds=implode("=?,",$fields)."=?";
            $sql="UPDATE $table SET $flds WHERE $field_id=$ref_id";
            try{
                $stmt=$this->conn->prepare($sql);
                $ok=$stmt->execute($data);
            }catch(PDOException $e){ echo $e->getMessage();}
            return $ok;
        }
// Delete
function deleteRecord($table,$field_id,$ref_id){
    $ok;
    $sql="DELETE FROM $table WHERE $field_id=?";
    try{
        $stmt=$this->conn->prepare($sql);
        $ok=$stmt->execute(array($ref_id));				
    }catch(PDOException $e){ echo $e->getMessage();}
    return $ok;
}
  
// Some functions
    function countRecord($field,$table){
        $sql = "SELECT count($field) FROM $table";
        try{
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetchColumn();
    }catch(PDOException $e){ echo $e->getMessage();}
        return $row;
       // $this->conn = null;
    }
    //
    function destroy(){
        $this->conn=null;
    }
    function getByRelation($table,$fields_id,$ref_id,$data){
        // $tables = implode(",",$table);
        $sql = "SELECT * FROM $table WHERE $fields_id = $ref_id AND $fields_id  = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

}