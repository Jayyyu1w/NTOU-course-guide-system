<?php
    include 'connect.php';
    $query = ("select * from course");
    $stmt = $db->prepare($query);
    try{
        $error = $stmt->execute(array($course_ID,$class));
        $result = $stmt->fetchAll();
        echo json_encode($result);
    }catch(PDOException $e){
        Print "資料讀取失敗:" . $e->getMessage();
    }
?>