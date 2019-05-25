<?php
// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "mycomputer@themigiserver", "pwd" => "@Kingston2019", "Database" => "Projects", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:themigiserver.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
