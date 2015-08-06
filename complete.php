<?php
session_start();
session_unset();
$name = '名前:' . htmlspecialchars($_POST['name']) . "\n";
$mail = 'メール:' . htmlspecialchars($_POST['mail']) . "\n";
$select = 'セレクト:' . htmlspecialchars($_POST['select']) . "\n";
$checks = $_POST['check'];
$checkData = 'チェック:';
foreach($checks as $check) {
	$checkData = $checkData . htmlspecialchars($check) . ', ';
}
$radio =  "\n" . 'ラジオ:' . htmlspecialchars($_POST['radio']) . "\n";
$textarea = 'テキストエリア:' . htmlspecialchars($_POST['textarea']) . "\n";

$file = 'data.txt';
$fileData = file_get_contents($file);
$fileData = $fileData . $name . $mail . $select . $checkData . $radio . $textarea . "\n";
file_put_contents($file, $fileData);

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