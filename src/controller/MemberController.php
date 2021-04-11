<?php

namespace App\Controller;

use App\Config\Database;

class MemberController extends Database
{
    /**
	* Display a listing of the resource.
	*
	* @return array
	*/
    public function index()
    {
	   $query = "SELECT * FROM members";
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
	   $manager_id = $this->db_connection->real_escape_string($_POST['manager_id']);
	   $name = $this->db_connection->real_escape_string($_POST['name']);
	   $email = $this->db_connection->real_escape_string($_POST['email']);
	   $phone = $this->db_connection->real_escape_string($_POST['phone']);
	   $password = $this->db_connection->real_escape_string(md5($_POST['password']));
	   $query = "INSERT INTO members(manager_id,name,email,phone,password) VALUES('$manager_id','$name','$email','$phone','$password')";
	   $sql = $this->db_connection->query($query);
	   if ($sql == true) {
		  session_start();
		  $_SESSION['message'] = "Added successfully";
		  header("Location:show.php?showId=$manager_id");
	   } else {
		  echo "Failed try again!";
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
	   $query = "SELECT * FROM members WHERE id = '$id'";
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
	   $manager_id = $this->db_connection->real_escape_string($_POST['umanager_id']);
	   $name = $this->db_connection->real_escape_string($_POST['uname']);
	   $email = $this->db_connection->real_escape_string($_POST['uemail']);
	   $phone = $this->db_connection->real_escape_string($_POST['upname']);
	   $id = $this->db_connection->real_escape_string($_POST['id']);
	   //$id = $this->db_connection->real_escape_string($_POST['id']);
	   if (!empty($id) && !empty($postData)) {
		  $query = "UPDATE members SET manager_id = '$manager_id',name = '$name', email = '$email', phone = '$phone' WHERE id = '$id'";
		  $sql = $this->db_connection->query($query);
		  if ($sql == true) {
			 session_start();
			 $_SESSION['message'] = "Updated successfully";
			 header("Location:show.php?showId=$manager_id");
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
    public function destroy($id, $manager_id)
    {
	   $query = "DELETE FROM members WHERE id = '$id'";
	   $sql = $this->db_connection->query($query);
	   if ($sql == true) {
		  $_SESSION['message'] = "Deleted successfully";
		  header("Location:show.php?showId=$manager_id");
	   } else {
		  echo "Not found!";
	   }
    }
}