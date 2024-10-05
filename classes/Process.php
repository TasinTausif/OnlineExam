<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/Session.php');
include_once($filepath . '/../lib/Database.php');
include_once($filepath . '/../helpers/Format.php');
class Process
{
    private $db;
    private $fmt;

    public function __construct()
    {
        $this->db = new Database();
        $this->fmt = new Format();
    }

    public function processData($data)
    {
        var_dump($data);
        $selectedAns = $this->fmt->validation($data['ans']);
        $quesNo = $this->fmt->validation($data['number']);
        $selectedAns = mysqli_real_escape_string($this->db->link, $selectedAns);
        $quesNo = mysqli_real_escape_string($this->db->link, $quesNo);

        $nextQues = $quesNo + 1;

        if(!isset($_SESSION['score'])){
            $_SESSION['score'] = '0';
        }

        $total = $this->getTotal();
        $rightAns = $this->getRightAns($quesNo);

        if ($selectedAns == $rightAns) {
            $_SESSION['score']++;
        }

        if ($quesNo == $total) {
            header("Location:final.php");
        } else {
            header("Location:test.php?q=".$nextQues);
        }
    }

    private function getTotal()
    {
        $query = "SELECT * FROM tbl_ques";
        $result = $this->db->select($query);
        return $result->num_rows;
    }

    private function getRightAns($quesNo)
    {
        $query = "SELECT * FROM tbl_ans WHERE quesNo = '$quesNo' AND rightAns = '1'";
        $data = $this->db->select($query)->fetch_assoc();
        $result = $data['id'];
        return $result;
    }
}
