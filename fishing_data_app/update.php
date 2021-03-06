<?php
session_start();
var_dump($_POST);

require_once "dbc.php";
loginCheck();
// exit();
$dbo = connectDB();

$sql='UPDATE fishing_db SET fish_name=:fish_name,fish_size=:fish_size,setsumei=:setsumei,op_flag=:op_flag WHERE id=:id';
$stmt=$dbo->prepare($sql);
$stmt->bindValue(':fish_name',$_POST["fish_name"],PDO::PARAM_STR);
$stmt->bindValue(':fish_size',$_POST['fish_size'],PDO::PARAM_STR);
$stmt->bindValue(':setsumei',$_POST['setsumei'],PDO::PARAM_STR);
$stmt->bindValue(':op_flag',$_POST['op_flag'],PDO::PARAM_INT);
$stmt->bindValue(':id',$_POST['id'],PDO::PARAM_INT);
$status=$stmt->execute();

if($status==false){
    $error=$stmt->errorInfo();
    exit("ErrQuery:".$error[2]);
}else{
    header("Location:data_base.php");
    exit;
}
?>