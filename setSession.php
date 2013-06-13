<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gfogelberg
 * Date: 6/12/13
 * Time: 10:22 PM
 * To change this template use File | Settings | File Templates.
 */
session_start();

//Set username session variable
$_SESSION['username'] = $_POST['username'];

header("Location: http://pherret.local/gfogelberg.php");
?>