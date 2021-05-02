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
        return $this->getAllData("SELECT * FROM members");
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

        $sql = "INSERT INTO members (manager_id,name,email,phone,password) VALUES (?,?,?,?,?)";
        $statements = $this->db_connection->prepare($sql);
        $statements->bind_param("issss", $manager_id, $name, $email, $phone, $password);

        if ($statements->execute() == true) {
            session_start();
            $_SESSION['message'] = "Added successfully";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            //header("show.php?showId=$manager_id");
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
        return $this->getFindByIdData("SELECT * FROM members WHERE id = '$id'");
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
        if (!empty($id) && !empty($postData)) {
            $sql = "UPDATE members SET manager_id=?,name=?, email=?, phone=?, password=? WHERE id=?";
            $statements = $this->db_connection->prepare($sql);
            $statements->bind_param("issssi", $manager_id, $name, $email, $phone, $password, $id);
            if ($statements->execute() == true) {
                session_start();
                $_SESSION['message'] = "Updated successfully";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                //header("Location:show.php?showId=$manager_id");
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
        return $this->delete("members", $id);
    }
}