<?php
// sessionに保存されている変数を取り出し，計算して表示しよう

//session宣言
session_start();
// session変数を+1する
$_SESSION['num'] += 1;
// 結果を出力
echo $_SESSION['num'];
