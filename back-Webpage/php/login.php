<?php session_start(); ?>
<?php
    include 'connect.php';
    $_POST = json_decode(file_get_contents("php://input"),true);
    $account = $_POST['account'];
    $password = $_POST['password'];
    $query = "select * from user where account = ?";
    $stmt = $db->prepare($query);
    try {
        $error = $stmt->execute(array($account));
    } catch (PDOException $e) {
        print "資料讀取失敗:" . $e->getMessage();
    }
    $result = $stmt->fetchAll();
    
    if ($account != null && $password != null && $result[0]['account'] == $account && $result[0]['password'] == $password) {
        $_SESSION['user_ID'] = $result[0]['user_name'];
        echo json_encode($result[0]);
    } else {
        echo '登入失敗!';
    }
?>