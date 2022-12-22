<?php
    include 'connect.php';
    $postData = json_decode(file_get_contents("php://input"),true);
    $query = ("select course_ID,class from course where name = ? and class = ?");
    $stmt = $db->prepare($query);
    try{
        $error = $stmt->execute(array($postData['class_name'],$postData['class']));
        $course = $stmt->fetchAll();
    }catch(PDOException $e){
        Print "查詢course失敗:" . $e->getMessage();
    }

    $query = ("select bulletin_ID from bulletin order by bulletin_ID DESC");
    $stmt = $db->prepare($query);
    try{
        $error = $stmt->execute();
        $bulletin_cnt = $stmt->fetchAll();
    }catch(PDOException $e){
        Print "查詢公告數失敗:" . $e->getMessage();
    }
    
    $input = ("insert into bulletin values(?,?,?,?,?,?,?,?)");
    $stmt = $db->prepare($input);
    $n = (int)$bulletin_cnt[0]['bulletin_ID'] + 1;
    try{
        $error = $stmt->execute(array((string)$n, $postData['title'], $postData['content'], 
        $postData['time'], $postData['sender'], $postData['receiver'], $course[0]['course_ID'], $postData['class']));
        //$result = $stmt->fetchAll();
        //echo json_encode($result);
    }catch(PDOException $e){
        Print "資料新增失敗:" . $e->getMessage();
    }
?>