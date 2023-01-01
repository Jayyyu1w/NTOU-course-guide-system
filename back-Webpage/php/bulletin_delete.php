<?php
    include 'connect.php';
    $postData = json_decode(file_get_contents("php://input"),true);
    $delete = ("delete from bulletin where bulletin_ID = ?");
    $stmt = $db->prepare($delete);
    try{
        $error = $stmt->execute(array($postData['bulletin_ID']));
    }catch(PDOException $e){
        Print "公告刪除失敗:" . $e->getMessage();
    }
?>