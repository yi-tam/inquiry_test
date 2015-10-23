<?php
mb_internal_encoding('UTF-8');

session_start();

// セッションが空ではないとき
if(!empty($_SESSION['post'])) {
	$post = $_SESSION['post'];

	// CSVに格納するデータ
	$postDatas = array();
	$postDatas['name'] = $post['name'];
	$postDatas['mail'] = $post['mail'];
	$postDatas['select'] = $post['select'];
	for ($i = 0; $i < 5; $i++) {
		if(!empty($post['check'][$i])) {
			$postDatas['check' . $i] = $post['check'][$i];
		} else {
			$postDatas['check' . $i] = '';
		}
	};
	$postDatas['radio'] = $post['radio'];
	$postDatas['textarea'] = $post['textarea'];

	// 文字コード変換
	foreach($postDatas as $key => $postData){
		$array[$key] = mb_convert_encoding($postData, "SJIS", "UTF-8");
	}

	$fp = fopen('./data.csv', 'a');
	if(flock($fp, LOCK_SH)){
		// 書き込みはできるが文字化けする
		$csvwrite = fputcsv($fp, $postDatas);
		flock($fp, LOCK_UN);
	}
	fclose($fp);


	// メールの送信
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
	$fileData = $name . $mail . $select . $checkData . $radio . $textarea;

	$from = "メールアドレス";
	$sendmail = mb_send_mail($post['mail'], 'お問い合わせテスト送信', $fileData, "From:" . $from);

	session_unset();
}
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>お問い合わせフォームテスト</title>
</head>
<body>
<?php
if($csvwrite) {
	echo '<p>CSVへの書き込み成功</p>';
} else {
	echo '<p>CSVへの書き込み失敗</p>';
}
if($sendmail) {
	echo '<p>メールの送信成功</p>';
} else {
	echo '<p>メールの送信失敗</p>';
}
?>
<p><a href="./data.csv">data.csv</a></p>
</body>
</html>