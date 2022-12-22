<?php
    include 'connect.php';
    $course_ID = $_GET['course_ID']; 
    $class = $_GET['class'];
    $postData = json_decode(file_get_contents("php://input"),true);
    $query = ("insert into course_information values(?,?,?,?)");
    $stmt = $db->prepare($query);
    try{
        echo $postData['text'];
        $error = $stmt->execute(array($cours_ID,$class,$postData['text'],$hot));
    }catch(PDOException $e){
        Print "資料讀取失敗:" . $e->getMessage();
    }
?>