<?php

include "header.php"; 
error_reporting(E_ALL); // Enable error reporting for development
ini_set('display_errors', 1);
session_start();

$attachment = $_GET['attachment'];

header("Content-type: application/pdf");
header("Content-Disposition: inline; filename=$attachment");
@readfile("Document-Management-System/files/$attachment");

function getAttachment() {
    $get=UPLOAD::connect()->prepare("SELECT attachment FROM resolution");
    $get->execute();
    $result=$get->get_result();
    while($row=$result->fetch_assoc()) {
        $data[]=$row;
    }
    if(!empty($data)) {
        return $data;
    }
}


?>