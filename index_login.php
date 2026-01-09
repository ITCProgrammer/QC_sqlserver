<?php
session_start();
//require_once "waktu.php";
include"koneksi.php";
ini_set("error_reporting",1);
?>
<?PHP
if($_POST){ //login user
	extract($_POST);
	    /*$username = $con->real_escape_string($_POST['username']);    
		$password = $con->real_escape_string($_POST['password']);
		$level	  =	$con->real_escape_string($_POST['level']);*/
		$username = $_POST['username'];    
		$password = $_POST['password'];
		$level	  =	$_POST['level'];
	$sql=mysqli_query($con,"select * from user_login where user='$username' and password='$password' and level = '$level' limit 1");
	if(mysqli_num_rows($sql)>0)
	{
	$_SESSION['username']=$username;
	$_SESSION['password']=$password;
	$_SESSION['level']=$level;
	$r = mysqli_fetch_array($sql);
	$_SESSION['status']=$r['status'];
	//login_validate();
    echo "<script>alert('Login Success!! $username');window.location='index1.php';</script>";
    
	}else { echo "<script>alert('Login Gagal!! $username');window.location='index_login.php';</script>"; }
}else
if( $_GET['act']=="logout" ){ //logout user
unset($_SESSION['username']);
echo "<script>alert('You are Logged out!! Klik OK to redirect'); window.location='index_login.php';</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <!--
    Created by Artisteer v2.3.0.21098
    Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
    -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>web login</title>

    <script type="text/javascript" src="script.js"></script>
    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="style.ie7.css" type="text/css" media="screen" /><![endif]-->
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link rel="icon" type="image/png" href="images/icon.png">
</head>
<body>
<div id="art-page-background-simple-gradient">
    </div>
    <div id="art-page-background-glare">
        <div id="art-page-background-glare-image"></div>
    </div>
    <div id="art-main">
        <div class="art-Sheet">
            <div class="art-Sheet-tl"></div>
            <div class="art-Sheet-tr"></div>
            <div class="art-Sheet-bl"></div>
            <div class="art-Sheet-br"></div>
            <div class="art-Sheet-tc"></div>
            <div class="art-Sheet-bc"></div>
            <div class="art-Sheet-cl"></div>
            <div class="art-Sheet-cr"></div>
            <div class="art-Sheet-cc"></div>
            <div class="art-Sheet-body">
                <div class="art-contentLayout">
                    <div class="art-content">
                        <div class="art-Post">
                            <div class="art-Post-body">
							<style type="text/css">
<!--
.font_ctr {
	text-align: center;
}
.td_cnt {
	text-align: center;
}
-->
</style>
<form action="" method="post" enctype="multipart/form-data">
<table width="200" align="center">
  <tr >
    <td colspan="3" ><h1>WEB LOGIN</h1></td>
    </tr>
  
  <tr>
    <td width="84">USERNAME</td>
    <td width="7">:</td>
    <td width="87">
      <label>
        <input type="text" name="username" id="username" />
      </label>
      </td>
  </tr>
  <tr>
    <td>PASSWORD</td>
    <td>:</td>
    <td><input type="password" name="password" id="password" /></td>
  </tr>
  <tr>
    <td>LEVEL</td>
    <td>:</td>
    <td><label for="level"></label>
      <select name="level" id="level">
        <option value="PACKING">PACKING</option>
        <option value="KAIN">KAIN</option>
        <option value="KAIN BS">KAIN BS</option>
        <option value="PPC">PPC</option>
        <option value="MANAGER">MANAGER</option>
        <option value="EXIM">EXIM</option>
      </select></td>
  </tr>
  <tr>
    <td colspan="3" class="td_cnt"><label>
      <input type="submit" name="login" id="login" value="LOGIN" class="art-button-wrapper">
    </label></td>
    </tr>
  <tr>
    <td colspan="3" class="td_cnt">&nbsp;</td>
  </tr>
</table>

</form>

                            <br />
                           
                                                          <div class="cleared"></div>
                            </div>
                        </div>
                        <div class="art-Post"></div>
                    </div>
                </div>
                <div class="cleared"></div><div class="art-Footer">
                    <div class="art-Footer-inner">
                        <div class="art-Footer-text">
                          <p><br />
                              Copyright &copy; 2015 ---. All Rights Reserved.</p>
                        </div>
                    </div>
                    <div class="art-Footer-background"></div>
                </div>
        		<div class="cleared"></div>
            </div>
        </div>
        <div class="cleared"></div>
        <p class="art-page-footer">created with Artisteer by usman_as</p>
    </div>

</body>
</html>
