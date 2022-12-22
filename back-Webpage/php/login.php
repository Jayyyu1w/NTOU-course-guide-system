<?php session_start(); ?>
<?php
    include 'connect.php';
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
    if ($account != null && $pw != null && $result[2] == $account && $result[3] == $password) {
        $_SESSION['user_ID'] = $result[0];
        echo '登入成功!';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=index.html>';
    } else {
        echo '登入失敗!';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=login.html>';
    }
?>