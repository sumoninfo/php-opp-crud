<?php

namespace App\Controller;

use App\Config\Database;

class ManagerController extends Database
{
    /**
	* Display a listing of the resource.
	*
	* @return array
	*/
    public function index()
    {
	   $query = "SELECT * FROM managers";
	   $result = $this->db_connection->query($query);
	   if ($result->num_rows > 0) {
		  $data = array();
		  while ($row = $result->fetch_assoc()) {
			 $data[] = $row;
		  }
		  return $data;
	   } else {
		  echo "No found records";
	   }
    }

    /**
	* Store a newly created resource in storage.
	*
	* @param $post
	*/
    public function store($post)
    {
	   $name = $this->db_connection->real_escape_string($_POST['name']);
	   $email = $this->db_connection->real_escape_string($_POST['email']);
	   $username = $this->db_connection->real_escape_string($_POST['username']);
	   $password = $this->db_connection->real_escape_string(md5($_POST['password']));
	   $query = "INSERT INTO managers(name,email,username,password) VALUES('$name','$email','$username','$password')";
	   $sql = $this->db_connection->query($query);
	   if ($sql == true) {
		  header("Location:index.php?msg1=insert");
	   } else {
		  echo "Registration failed try again!";
	   }
    }


    /**
	* Display the specified resource.
	*
	* @param $id
	* @return array|null
	*/
    public function show($id)
    {
	   $query = "SELECT * FROM managers WHERE id = '$id'";
	   $result = $this->db_connection->query($query);
	   if ($result->num_rows > 0) {
		  $row = $result->fetch_assoc();
		  return $row;
	   } else {
		  echo "Record not found";
	   }
    }

    /**
	*Update the specified resource in storage.
	*
	* @param $postData
	*/
    public function update($postData)
    {
	   $name = $this->db_connection->real_escape_string($_POST['uname']);
	   $email = $this->db_connection->real_escape_string($_POST['uemail']);
	   $username = $this->db_connection->real_escape_string($_POST['upname']);
	   $id = $this->db_connection->real_escape_string($_POST['id']);
	   if (!empty($id) && !empty($postData)) {
		  $query = "UPDATE managers SET name = '$name', email = '$email', username = '$username' WHERE id = '$id'";
		  $sql = $this->db_connection->query($query);
		  if ($sql == true) {
			 header("Location:index.php?msg2=update");
		  } else {
			 echo "Registration updated failed try again!";
		  }
	   }

    }

    /**
	* Remove the specified resource from storage.
	*
	* @param $id
	*/
    public function destroy($id)
    {
	   $query = "DELETE FROM managers WHERE id = '$id'";
	   $sql = $this->db_connection->query($query);
	   if ($sql == true) {
		  header("Location:index.php?msg3=delete");
	   } else {
		  echo "Record does not delete try again";
	   }
    }

    /**
	* Display a listing of the resource.
	*
	* @return array
	*/
    public function managerByMembers($id)
    {

	   $query = "SELECT * FROM members where manager_id = $id";
//	   $query = "SELECT * FROM managers";
	   $result = $this->db_connection->query($query);
	   if ($result->num_rows > 0) {
		  $data = array();
		  while ($row = $result->fetch_assoc()) {
			 $data[] = $row;
		  }
		  return $data;
	   }
    }
}