<?php
    include 'connect.php';
    $postData = $_POST["text"];
    echo $postData;
    /*
    $query = ("insert into student values()
    ");
    $stmt = $db->prepare($query);
    try{
        $error = $stmt->execute();
        $result = $stmt->fetchAll();
        echo json_encode($result);
    }catch(PDOException $e){
        echo "window.alert('資料讀取失敗')";
    }*/
?>