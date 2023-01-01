<?php
    include 'connect.php';
    $postData = json_decode(file_get_contents("php://input"),true);
    $course_ID = $_GET['course_ID']; 
    $class = $_GET['class'];
    $query = ("select course_ID,class from course where name = ? and class = ?");
    $stmt = $db->prepare($query);
    try{
        $error = $stmt->execute(array($course_ID,$class));
        $course = $stmt->fetchAll();
    }catch(PDOException $e){
        Print "查詢course失敗:" . $e->getMessage();
    }

    $query = ("select mess_ID from message order by mess_ID DESC");
    $stmt = $db->prepare($query);
    try{
        $error = $stmt->execute();
        $message_cnt = $stmt->fetchAll();
    }catch(PDOException $e){
        Print "留言數查詢失敗:" . $e->getMessage();
    }
    
try{
    $input = ("insert into message values(?,?,?,?,?,?)");
    $stmt = $db->prepare($input);
    if(!empty($message_cnt)) $n = (int)$message_cnt[0]['mess_ID'] + 1;
    else $n=1;
    
        $error = $stmt->execute(array($n, $postData['text'], $postData['time'], $postData['hot'], $course_ID, $class));
        //$result = $stmt->fetchAll();
        //echo json_encode($result);
    }catch(PDOException $e){
        Print "資料新增失敗:" . $e->getMessage();
    }
?>