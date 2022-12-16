<?php
    include 'connect.php';
    $postData = json_decode(file_get_contents("php://input"),true);
    $course_ID = $postData['course_ID'];
    $class = $postData['class'];
?>