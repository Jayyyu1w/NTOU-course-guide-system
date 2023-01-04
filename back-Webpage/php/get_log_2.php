<html>

<head>
    <title>php</title>
    <style>
        body {
            text -align: center;
            font -family: Helvetica;
        }

        table {
            text -align: center;
            width: 60%;
            background-color: antiquewhite;
            border-color: white;
            border-style: solid;
            border-width: thin;
            padding: 4px;
            border-collapse: collapse;
        }

        tbody th {
            background-color: lightcoral;
            border-color: white;
            border-style: solid;
            border-width: thin;
        }

        tbody td {
            border-color: white;
            border-style: solid;
            border-width: thin;
        }

        .time{
            text-align: center;
        }

        tbody td:hover {
            background-color: white;
        }

        tbody tr {
            border-color: white;
            border-style: solid;
            border-width: thin;
        }

        div {
            font -size: 10cm;
        }
    </style>
</head>

<body>
    <?php $user = 'root';
    include 'connect.php';
    $query = ("select * from log");
    $stmt = $db->prepare($query);
    $error = $stmt->execute();
    $result = $stmt->fetchAll();
    echo "<table><tr><th>time</th><th>content</th></tr>";
    $sum = 0;
    foreach ($result as $row) {
        echo "<tr>";
        echo "<td class='time'>" . $row['time'] . "</td>";
        echo "<td>" . $row['content'] . "</td>";
        echo "</tr>";
        $sum++;
    }
    echo "</table>";
    echo "<br><div>Total record of the log is " . $sum . "</div>";
    ?>
</body>

</html>