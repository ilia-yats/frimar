<?php
//$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$url = parse_url('mysql://b7ee9265ff7168:5242f847@eu-cdbr-west-01.cleardb.com/heroku_e1662f136f375fb?reconnect=true');

$conn_params = [
    'host'    => $url["host"],
    'user'    => $url["user"],
    'pass'    => $url["pass"],
    'db_name' => substr($url["path"], 1),
];

print_r($conn_params);
