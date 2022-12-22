<?php
    include 'connect.php';
    $course_ID = $_GET['course_ID']; 
    $class = $_GET['class'];
    $query = ("select * from message where course_ID = ? and class = ?
    order by time DESC");
    $stmt = $db->prepare($query);
    try{
        $error = $stmt->execute(array($course_ID,$class));
        $result = $stmt->fetchAll();
        echo json_encode($result);
    }catch(PDOException $e){
        Print "資料讀取失敗:" . $e->getMessage();
    }
?>