<?php
    include 'connect.php';
    $course_ID = $_GET['course_ID']; 
    $class = $_GET['class'];
    $postData = json_decode(file_get_contents("php://input"),true);
    $query = ("update course_information set information=? where course_ID=? and class=?");
    $stmt = $db->prepare($query);
    try{
        $error = $stmt->execute(array($postData['text'],$course_ID,$class));
    }catch(PDOException $e){
        Print "資料讀取失敗:" . $e->getMessage();
    }
?>