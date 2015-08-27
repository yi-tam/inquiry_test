<?php
session_start();
$post = $_SESSION['post'];
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>お問い合わせフォームテスト</title>
</head>
<body>
<form action="complete.php" method="post">
	<dl class="form-item">
		<dt>名前</dt>
		<dd><?php echo htmlspecialchars($post['name']); ?></dd>
	</dl>
	<dl class="form-item">
		<dt>メール</dt>
		<dd><?php echo htmlspecialchars($post['mail']); ?></dd>
	</dl>
	<dl class="form-item">
		<dt>選択</dt>
		<dd><?php echo htmlspecialchars($post['select']); ?></dd>
	</dl>
	<dl class="form-item">
		<dt>チェック</dt>
		<dd>
<?php
foreach($post['check'] as $check) {
	echo htmlspecialchars($check) . ' ';
}
?>
		</dd>
	</dl>
	<dl class="form-item">
		<dt>ラジオ</dt>
		<dd><?php echo htmlspecialchars($post['radio']); ?></dd>
	</dl>
	<dl class="form-item">
		<dt>テキストエリア</dt>
		<dd><?php echo htmlspecialchars($post['textarea']); ?></dd>
	</dl>
	<div class="form-btn">
		<button onClick="location.href = './index.php'; return false;">戻る</button>
		<input type="submit" value="送信">
	</div>
</form>
</body>
</html>