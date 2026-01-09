<?php
include "php_serial.class.php";
$serial = new phpSerial;
$serial->deviceSet("COM1");
$serial->confBaudRate(2400);
$serial->confParity("none");
$serial->confCharacterLength(8);
$serial->confStopBits(1);
$serial->confFlowControl("none");
$serial->deviceOpen();
$read = $serial->readPort();
$serial->deviceClose();
$serial->confBaudRate(2400); 
?>