<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/Session.php');
include_once($filepath . '/../lib/Database.php');
include_once($filepath . '/../helpers/Format.php');
class User
{

    private $db;
    private $fmt;
    public function __construct()
    {
        $this->db = new Database();
        $this->fmt = new Format();
    }

    public function getAdminData($data)
    {
        $adminUserName = $this->fmt->validation($data['adminUser']);
        $adminPass = $this->fmt->validation($data['adminPass']);
        $adminUserName = mysqli_real_escape_string($this->db->link, $adminUserName);
        $adminPass = mysqli_real_escape_string($this->db->link, md5($adminPass));

        $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUserName' AND adminPass = '$adminPass'";
        $result = $this->db->select($query);

        if ($result) {
            $value = $result->fetch_assoc();
            Session::init();
            session::set('adminLogin', True);
            session::set('adminUser', $value['adminUser']);
            session::set('adminId', $value['id']);
            header("Location:index.php");
        } else {
            $msg = "<span class='error'>Given credentials didn't matched</span>";
            return $msg;
        }
    }

    public function getUsers()
    {
        $query = "SELECT * FROM tbl_user ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function disableUser($id)
    {
        $query = "UPDATE tbl_user SET status = 1 WHERE id = '$id'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span class='success'>User Disabled</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>User Not Disabled</span>";
            return $msg;
        }
    }

    public function enableUser($id)
    {
        $query = "UPDATE tbl_user SET status = 0 WHERE id = '$id'";
        $result = $this->db->update($query);

        if ($result) {
            $msg = "<span class='success'>User Enabled</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>User Not Enabled</span>";
            return $msg;
        }
    }
    public function deleteUser($id)
    {
        $query = "DELETE FROM tbl_user WHERE id = '$id'";
        $result = $this->db->delete($query);

        if ($result) {
            $msg = "<span class='success'>User Removed</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>User Not Removed</span>";
            return $msg;
        }
    }

    public function userRegistration($name, $username, $email, $password)
    {
        $name = $this->fmt->validation($name);
        $username = $this->fmt->validation($username);
        $email = $this->fmt->validation($email);
        $password = $this->fmt->validation($password);

        $name = mysqli_real_escape_string($this->db->link, $name);
        $username = mysqli_real_escape_string($this->db->link, $username);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $password = mysqli_real_escape_string($this->db->link, md5($password));

        if ($name == "" || $username == '' || $email == '' || $password == '') {
            $msg = "<span class='error'>Field must not be empty</span>";
            echo $msg;
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $msg = "<span class='error'>Invalid email address</span>";
            echo $msg;
        } else {
            $chkQuery = "SELECT email FROM tbl_user WHERE email = '$email'";
            $result = $this->db->select($chkQuery);
            if ($result) {
                $msg = "<span class='error'>Email already exists</span>";
                echo $msg;
            } else {
                $query = "INSERT INTO tbl_user(name, username, email, password) VALUES('$name', '$username', '$email', '$password')";
                $insert_row = $this->db->insert($query);
                if ($insert_row) {
                    Session::set('userId', $insert_row['id']);
                    Session::set('userName', $insert_row['username']);
                    $msg = "<span class='success'>Registration Successful</span>";
                    echo $msg;
                } else {
                    $msg = "<span class='error'>Registration Not Successful</span>";
                    echo $msg;
                }
            }
        }
    }

    public function userLogin($email, $password)
    {
        $email = $this->fmt->validation($email);
        $password = $this->fmt->validation($password);

        $email = mysqli_real_escape_string($this->db->link, $email);
        $password = mysqli_real_escape_string($this->db->link, $password);

        if ($email == '' || $password == '') {
            echo "empty";
            exit();
        }elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            echo "invalid";
            exit();
        }else {
            $chkQuery = "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$password'";
            $result = $this->db->select($chkQuery);

            if ($result) {
                $row = $result->fetch_assoc();

                if ($row['status'] == 1) {
                    echo "disable";
                    exit();
                }else{
                    Session::init();
                    Session::set('login', true);
                    Session::set('userId', $row['id']);
                    Session::set('userName', $row['username']);
                    Session::set('name', $row['name']);
                }
            }else{
                echo "error";
                exit();
            }
        }
    }

    public function getUserData($id)
    {
        $query = "SELECT * FROM tbl_user WHERE id='$id' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateUserData($id, $data)
    {
        $name = $this->fmt->validation($data['name']);
        $username = $this->fmt->validation($data['username']);
        $email = $this->fmt->validation($data['email']);

        $name = mysqli_real_escape_string($this->db->link, $name);
        $username = mysqli_real_escape_string($this->db->link, $username);
        $email = mysqli_real_escape_string($this->db->link, $email);

        $query = "UPDATE tbl_user SET name = '$name', username = '$username', email = '$email' WHERE id = '$id'";
        $result = $this->db->update($query);

        if ($result) {
            $msg = "<span class='success'>Data Updated Successfully</span>";
            return $msg;
        }else {
            $msg = "<span class='error'>Data Not Updated</span>";
            return $msg;
        }
    }
}
