<?php
    include 'connect.php';
    $course_ID = $_GET['course_ID']; 
    $class = $_GET['class'];
    $query = ("select avg(hot) as avg from message where course_ID = ? and class = ?");
    $stmt = $db->prepare($query);
    try{
        $error = $stmt->execute(array($course_ID,$class));
        $result = $stmt->fetchAll();
        echo json_encode($result);
    }catch(PDOException $e){
        Print "資料讀取失敗:" . $e->getMessage();
    }
    
    $update = ("update course_information set hot=? where course_ID=? and class=?");
    $stmt = $db->prepare($update);
    try{
        $error = $stmt->execute(array((float)$result[0]['avg'],$course_ID,$class));
        $result = $stmt->fetchAll();
    }catch(PDOException $e){
        Print "資料更新失敗:" . $e->getMessage();
    }
?>