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
	   $phone = $this->db_connection->real_escape_string($_POST['phone']);
	   $password = $this->db_connection->real_escape_string(md5($_POST['password']));
	   $query = "INSERT INTO managers(name,email,phone,password) VALUES('$name','$email','$phone','$password')";
	   $sql = $this->db_connection->query($query);
	   if ($sql == true) {
		  session_start();
		  $_SESSION['message'] = "Added successfully";
		  header("Location:index.php");
	   } else {
		  echo "Save failed try again!";
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
		  echo "Not found";
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
	   $phone = $this->db_connection->real_escape_string($_POST['upname']);
	   $id = $this->db_connection->real_escape_string($_POST['id']);
	   if (!empty($id) && !empty($postData)) {
		  $query = "UPDATE managers SET name = '$name', email = '$email', phone = '$phone' WHERE id = '$id'";
		  $sql = $this->db_connection->query($query);
		  if ($sql == true) {
			 session_start();
			 $_SESSION['message'] = "Updated successfully";
			 header("Location:index.php");
		  } else {
			 echo "Updated failed try again!";
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
		  $_SESSION['message'] = "Deleted successfully";
		  header("Location:index.php");
	   } else {
		  echo "Not found!";
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