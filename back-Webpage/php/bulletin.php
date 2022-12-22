<?php
    include 'connect.php';
    $query = ("select * from bulletin as b, course as c
    where 
        b.course_ID = c.course_ID AND 
        b.class = c.class
    order by time DESC");
    $stmt = $db->prepare($query);
    try{
        $error = $stmt->execute();
        $result = $stmt->fetchAll();
        echo json_encode($result);
    }catch(PDOException $e){
        echo "window.alert('資料讀取失敗')";
    }
?>