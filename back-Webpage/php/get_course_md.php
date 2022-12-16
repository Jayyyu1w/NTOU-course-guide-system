<?php
    include 'connect.php';
    $postData = json_decode(file_get_contents("php://input"),true);
    $course_ID = $postData['course_ID'];
    $class = $postData['class'];
    $query = ("select information from course_information where course_ID = ? and class = ?");
    $stmt = $db->prepare($query);
    try{
        $error = $stmt->execute(array($cours_ID,$class));
    }catch(PDOException $e){
        Print "資料讀取失敗:" . $e->getMessage();
    }
?>