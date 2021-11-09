<?php
// セッション開始
session_start();
// idの取得
$old_session_id = session_id();
// id再生成&旧idを破棄
session_regenerate_id(true);
// 新idの取得
$new_session_id = session_id();
// idの確認
echo '<p>旧id：' . $old_session_id . '</p>';
echo '<p>新id：' . $new_session_id . '</p>';
