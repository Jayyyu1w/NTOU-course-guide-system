<html>
<head>
    <title>test_json</title>
    <style>
        body {
            text-align: center;
            font-family: Helvetica;
        }
    </style>
    </head>
    <body>
        <?php
            $user = 'root';
            $password = "0101";
            try{
                $db = new PDO('mysql:host=localhost;dbname=dbproject;charset=utf8',$user,$password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
            }catch(PDOException $e){
                print "ERROR!:" . $e->getMessage();
                die();
            }

            $query = ("select * from bulletin");
            $stmt = $db->prepare($query);
            try{
                $error = $stmt->execute();
                $result = $stmt->fetchAll();
                echo json_encode($result);
            }catch(PDOException $e){
                echo "window.alert('資料讀取失敗')";
            }
            echo "<br><br><br>";
            foreach($result as $row){
                echo $row['bulletin_ID']."<br>";
                echo $row['content']."<br>";
                echo $row['course_ID']."<br>";
                echo $row['class']."<br>";
            }
        ?>
    </body>
</html>