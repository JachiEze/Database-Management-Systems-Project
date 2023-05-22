<?php
$password = '';
$conn = mysqli_connect('localhost','root', $password,'shop_db') or die('connection failed');
$real_conn = mysqli_connect('localhost','root',$password,'gameservice') or die('connection failed');

?>