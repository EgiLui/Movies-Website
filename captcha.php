<?php
session_start();

// Generate a random string of characters for the captcha
$captchaText = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

// Store the captcha text in a session variable
$_SESSION["captcha"] = $captchaText;

// Generate an image of the captcha
$image = imagecreatefromjpeg("captcha-background.jpg");
$color = imagecolorallocate($image, 0, 0, 0);
imagettftext($image, 20, 0, 10, 30, $color, "captcha-font.ttf", $captchaText);
header("Content-Type: image/jpeg");
imagejpeg($image);
imagedestroy($image);
?>