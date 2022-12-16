<?php
    include 'connect.php';
    include 'get_course.php';
    $postData = json_decode(file_get_contents("php://input"),true);
    $query = ("insert into course_information values(?,?,?,?)");
    $stmt = $db->prepare($query);
    try{
        echo $postData['text'];
        $error = $stmt->execute(array($cours_ID,$class,$postData['text'],));
    }catch(PDOException $e){
        Print "資料讀取失敗:" . $e->getMessage();
    }
?>