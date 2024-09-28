<?php
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
class User{

    private $db;
    private $fmt;
    public function __construct()
    {
        $this->db = new Database();
        $this->fmt = new Format();
    }

    public function getAdminData($data){
        $adminUserName = $this->fmt->validation($data['adminUser']);
        $adminPass = $this->fmt->validation($data['adminPass']);
        $adminUserName = mysqli_real_escape_string($this->db->link, $adminUserName);
        $adminPass = mysqli_real_escape_string($this->db->link, md5($adminPass));

        $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUserName' AND adminPass = '$adminPass'";
        $result = $this->db->select($query);

        if($result){
            $value = $result->fetch_assoc();
            Session::init();
            session::set('adminLogin', True);
            session::set('adminUser', $value['adminUser']);
            session::set('adminId', $value['id']);
            header("Location:index.php");
        }else{
            $msg = "<span class='error'>Given credentials didn't matched</span>";
            return $msg;
        }
    }

    public function getUsers(){
        $query = "SELECT * FROM tbl_user ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }
}
?>