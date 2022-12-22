<?php
    include 'connect.php';
    // 從網址抓取目前所在課程
    $course_ID = $_GET['course_ID']; 
    $class = $_GET['class'];
    $query = ("select * 
               from course_information join course
               on course_information.course_ID = ? and course.course_ID = course_information.course_ID
               and  course_information.class = ? and course_information.class = course.class");
    $stmt = $db->prepare($query);
    try{
        $error = $stmt->execute(array($course_ID,$class));
        $result = $stmt->fetchAll();
        echo json_encode($result);
    }catch(PDOException $e){
        Print "資料讀取失敗:" . $e->getMessage();
    }
?>