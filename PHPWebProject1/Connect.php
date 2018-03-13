<!DOCTYPE HTML>
<html>
<head></head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully cus u are awesome";
    echo "<br>";
    //$sql = "INSERT INTO myguests (firstname, lastname, email)
    //VALUES ('dusan', 'mraz', '1mrazik1@gmail.com')";

    //if ($conn->query($sql) === TRUE) {
    //    echo "New record created successfully";
    //} else {
    //    echo "Error: " . $sql . "<br>" . $conn->error;
    //}
    //$conn->close();
    $sql = "SELECT id, firstname, lastname FROM myguests";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='7'><tr><th>ID</th><th>Name</th></tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["id"]."</td><td>".$row["firstname"]." ".$row["lastname"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</body>
</html>
