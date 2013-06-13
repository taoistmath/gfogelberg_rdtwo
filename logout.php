<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gfogelberg
 * Date: 6/12/13
 * Time: 9:48 PM
 * To change this template use File | Settings | File Templates.
 */
session_start();

//Clear username session variable
unset($_SESSION['username']);

header("Location: http://pherret.local/login.php");
?>