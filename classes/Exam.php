<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/Session.php');
include_once($filepath . '/../lib/Database.php');
include_once($filepath . '/../helpers/Format.php');
class Exam
{

    private $db;
    private $fmt;
    public function __construct()
    {
        $this->db = new Database();
        $this->fmt = new Format();
    }

    public function getQuesByOrder()
    {
        $query = "SELECT * FROM tbl_ques ORDER BY quesNo";
        $result = $this->db->select($query);
        return $result;
    }

    public function deleteQuestion($id)
    {
        $tables = array('tbl_ques', 'tbl_ans');//indexed array where values are the tables
        foreach($tables as $table){
            $query = "DELETE FROM $table WHERE quesNo='$id'";
            $removeData = $this->db->delete($query);
        }

        if($removeData){
            $msg = "<span class='success'>Question Removed</span>";
        }else{
            $msg = "<span class='error'>Question could not be Removed</span>";
        }

        return $msg;
    }

    public function addQuestion($data)
    {
        $quesNo = mysqli_real_escape_string($this->db->link, $data['quesNo']);
        $ques = mysqli_real_escape_string($this->db->link, $data['ques']);
        $ans = array();
        $ans['1'] = mysqli_real_escape_string($this->db->link, $data['ans1']);
        $ans['2'] = mysqli_real_escape_string($this->db->link, $data['ans2']);
        $ans['3'] = mysqli_real_escape_string($this->db->link, $data['ans3']);
        $ans['4'] = mysqli_real_escape_string($this->db->link, $data['ans4']);
        $rightAns = mysqli_real_escape_string($this->db->link, $data['rightAns']);

        $quesQuery = "INSERT INTO tbl_ques(quesNo, ques) VALUES('$quesNo', '$ques')";
        $insertQues = $this->db->insert($quesQuery);
        if($insertQues){
            foreach($ans as $key => $value){
                if($key == $rightAns){
                    $data = 1;
                }else{
                    $data = 0;
                }
                $ansQuery = "INSERT INTO tbl_ans(quesNo, ans, rightAns) VALUES('$quesNo', '$value', '$data')";
                $insertAns = $this->db->insert($ansQuery);
            }
        }

        if($insertAns){
            $msg = "<span class='success'>Question Added Successfully</span>";
        }else{
            $msg = "<span class='error'>Question could not be Added</span>";
        }
        return $msg;
    }

    public function getLastQuesNo()
    {
        $query = "SELECT quesNo FROM tbl_ques ORDER BY quesNo DESC LIMIT 1";
        $result = $this->db->select($query);
        $row = $result->fetch_assoc();
        $maxNum = $row['quesNo'];
        return $maxNum;
    }
}
