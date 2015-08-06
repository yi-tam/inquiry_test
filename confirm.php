<?php
session_start();
$post = $_SESSION['post'];
$name = htmlspecialchars($post['name']);
$mail = htmlspecialchars($post['mail']);
$select = htmlspecialchars($post['select']);
$checks = $post['check'];
$radio = htmlspecialchars($post['radio']);
$textarea = htmlspecialchars($post['textarea']);

//if($name == '' ||$mail == '') {
//	header('location: index.php');
//	exit();
//}
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
		<dd><?php echo $name; ?></dd>
	</dl>
	<dl class="form-item">
		<dt>メール</dt>
		<dd><?php echo $mail; ?></dd>
	</dl>
	<dl class="form-item">
		<dt>選択</dt>
		<dd><?php echo $select; ?></dd>
	</dl>
	<dl class="form-item">
		<dt>チェック</dt>
		<dd>
<?php
foreach($checks as $check) {
	echo htmlspecialchars($check) . ' ';
}
?>
		</dd>
	</dl>
	<dl class="form-item">
		<dt>ラジオ</dt>
		<dd><?php echo $radio; ?></dd>
	</dl>
	<dl class="form-item">
		<dt>テキストエリア</dt>
		<dd><?php echo $textarea; ?></dd>
	</dl>
	<div class="form-btn">
<input type="hidden" name="name" value="<?php echo $name; ?>">
<input type="hidden" name="mail" value="<?php echo $mail; ?>">
<input type="hidden" name="select" value="<?php echo $select; ?>">
<?php
$i = 0;
foreach($checks as $check) {
	if($check != '') {
		echo '<input type="hidden" name="check[' . $i . ']" value="' . htmlspecialchars($check) . '">';
		$i++;
	}
}
?>
<input type="hidden" name="radio" value="<?php echo $radio; ?>">
<input type="hidden" name="textarea" value="<?php echo $textarea; ?>">
		<button onClick="history.back(); return false;">戻る</button>
		<input type="submit" value="送信">
	</div>
</form>
</body>
</html>