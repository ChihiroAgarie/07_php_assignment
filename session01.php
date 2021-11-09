<?php
// sessionを宣言
session_start();
// session変数の宣言
$_SESSION['num'] = 100;
echo $_SESSION['num'];
