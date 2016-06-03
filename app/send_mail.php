<?php
// the message
$msg = "Hi Prabha,\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("prabagar.mk@gmail.com","My subject",$msg);
?>