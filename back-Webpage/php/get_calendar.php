<?php
    include 'connect.php';
    try{
    $_POST = json_decode(file_get_contents("php://input"),true);
    $year = $_POST['year'];
    $month = $_POST['month'];
    $query = 'select * from calendar
                where startDate between "?-?-01" and "?-?-31"';
    $stmt = $db->prepare($query);
    $error = $stmt->execute(array($year, $month, $year, $month));
    $result = $stmt->fetchAll();    // $result is an array
    echo json_encode($result);      // echo the array in json format
    } catch (PDOException $e) {
        print "資料讀取失敗:" . $e->getMessage();
    }
?>