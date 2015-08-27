<?php
session_start();
if(!empty($_SESSION['post'])) {
	$post = $_SESSION['post'];
	$name = '名前:' . $post['name'] . "\n";
	$mail = 'メール:' . $post['mail'] . "\n";
	$select = 'セレクト:' . $post['select'] . "\n";
	$checks = $post['check'];
	$checkData = 'チェック:';
	foreach($checks as $check) {
		$checkData = $checkData . $check . ', ';
	}
	$radio = "\n" . 'ラジオ:' . $post['radio'] . "\n";
	$textarea = 'テキストエリア:' . $post['textarea'] . "\n";
	session_unset();

	// 保存内容の作成
	$fileData = $name . $mail . $select . $checkData . $radio . $textarea . "\n";
	// 入力内容の保存
	$fp = fopen('data.txt', 'a');
	if(flock($fp, LOCK_SH)){
		fwrite($fp, $fileData);
		flock($fp, LOCK_UN);
	}
	fclose($fp);
}
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>お問い合わせフォームテスト</title>
</head>
<body>
<p>送信しました。</p>
</body>
</html>