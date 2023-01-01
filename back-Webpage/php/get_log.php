<?php
    include 'connect.php';
    $query = ("select * from log");
    $stmt = $db->prepare($query);
    try{
        $error = $stmt->execute();
        $result = $stmt->fetchAll();
        echo json_encode($result);
    }catch(PDOException $e){
        echo "window.alert('資料讀取失敗')";
    }
?>