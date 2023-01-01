<?php
    include 'connect.php';
    try{
        $_POST = json_decode(file_get_contents("php://input"),true);
        $year = $_POST['year'];
        $month = $_POST['month'];
        $year = strval($year);
        $month = strval($month);
        $st = date("Y-m-d", strtotime($year."-".$month."-01"));
        $ed = date("Y-m-d", strtotime($year."-".$month."-31"));
        $query = "select * from calendar
                    where startDate between ? and ?";
        $stmt = $db->prepare($query);
        $error = $stmt->execute(array($st, $ed));
        $result = $stmt->fetchAll();    // $result is an array
        echo json_encode($result);      // echo the array in json format
    } catch (PDOException $e) {
        print "資料讀取失敗:" . $e->getMessage();
    }
?>