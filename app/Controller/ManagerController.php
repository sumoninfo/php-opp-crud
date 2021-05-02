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
        return $this->getAllData("SELECT * FROM managers");
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

        $sql = "INSERT INTO managers (name,email,phone,password) VALUES (?,?,?,?)";
        $statements = $this->db_connection->prepare($sql);
        $statements->bind_param("ssss", $name, $email, $phone, $password);

        if ($statements->execute() == true) {
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
        return $this->getFindByIdData("SELECT * FROM managers WHERE id = '$id'");
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
            $sql = "UPDATE managers SET name=?, email=?, phone=?, password=? WHERE id=?";
            $statements = $this->db_connection->prepare($sql);
            $statements->bind_param("ssssi", $name, $email, $phone, $password, $id);
            if ($statements->execute() == true) {
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
        return $this->delete("managers", $id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function managerByMembers($id)
    {
        return $this->getAllData("SELECT * FROM members where manager_id = $id");
    }
}