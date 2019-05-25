<?php
$connectionInfo = array("UID" => "mycomputer@themigiserver", "pwd" => "{your_password_here}", "Database" => "Projects", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:themigiserver.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
