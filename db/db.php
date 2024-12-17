<?php
    // Load environment variables from db.env
    $env = parse_ini_file('db.env');

    $servername = $env['DB_HOST'];
    $username = $env['DB_USER'];
    $password = $env['DB_PASSWORD'];
    $dbname = $env['DB_NAME'];

    //Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
?>