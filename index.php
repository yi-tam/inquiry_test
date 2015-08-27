<?php
session_start();

// 選択項目の内容
$selectItems = array('セレクト1', 'セレクト2', 'セレクト3', 'セレクト4', 'セレクト5');
$checkItems = array('チェック1', 'チェック2', 'チェック3', 'チェック4', 'チェック5');
$radioItems = array('ラジオ1', 'ラジオ2', 'ラジオ3', 'ラジオ4', 'ラジオ5');

// エラー確認用
$error = array(
	'name' => '',
	'mail' => ''
);

// ポスト後のとき
if(!empty($_POST)) {
	$post = $_POST;

	// 名前が入力されているか
	if($post['name'] == '') {
		$error['name'] = 'empty';
	}
	// メールが入力されているか
	if($post['mail'] == '') {
		$error['mail'] = 'empty';
	}

	// 必須項目が入力されている場合
	if($error['name'] == '' && $error['mail'] == '') {
		// ポストの内容をセッションに保存
		$_SESSION['post'] = $post;
		// 確認画面にリダイレクト
		header('location: confirm.php');
		exit();
	}

// セッションがあるとき(確認画面から戻ってきたとき)
} else if(!empty($_SESSION['post'])) {
	$post = $_SESSION['post'];
}
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>お問い合わせフォームテスト</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<form action="index.php" method="post">
	<dl class="form-item">
		<dt>名前<span class="required">必須</span></dt>
		<dd>
			<input type="text" name="name" value="<?php if(!empty($post)) { echo htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8'); } ?>">
<?php
if($error['name'] == 'empty') {
	echo '<p class="error">入力してください。</p>';
}
?>
		</dd>
	</dl>
	<dl class="form-item">
		<dt>メール<span class="required">必須</span></dt>
		<dd>
			<input type="text" name="mail" value="<?php if(!empty($post)) { echo htmlspecialchars($post['mail'], ENT_QUOTES, 'UTF-8'); } ?>">
<?php
if($error['mail'] == 'empty') {
	echo '<p class="error">入力してください。</p>';
}
?>
		</dd>
	</dl>
	<dl class="form-item">
		<dt>選択</dt>
		<dd>
			<select name="select">
				<option value="">選択</option>
<?php
foreach($selectItems as $selectItem) {
	if(!empty($post)) {
		if($post['select'] == $selectItem) {
			echo '<option value="' . $selectItem . '" selected>' . $selectItem . '</option>';
			continue;
		}
	}
	echo '<option value="' . $selectItem . '">' . $selectItem . '</option>';
}
?>
			</select>
		</dd>
	</dl>
	<dl class="form-item">
		<dt>チェック</dt>
		<dd>
			<input type="hidden" name="check[]" value="">
<?php
for($i = 0; $i < count($checkItems); $i++) {
	if(!empty($post)) {
		if(!empty($post['check'][$i])) {
			if($post['check'][$i] != null) {
				echo '<label><input type="checkbox" name="check[' . $i . ']" value="' . $checkItems[$i] . '" checked>' . $checkItems[$i] . '</label>';
				continue;
			}
		}
	}
	echo '<label><input type="checkbox" name="check[' . $i . ']" value="' . $checkItems[$i] . '">' . $checkItems[$i] . '</label>';
}
?>
		</dd>
	</dl>
	<dl class="form-item">
		<dt>ラジオ</dt>
		<dd>
			<input type="hidden" name="radio" value="">
<?php
foreach($radioItems as $radioItem) {
	if(!empty($post)) {
		if($post['radio'] == $radioItem) {
			echo '<label><input type="radio" name="radio" value="' . $radioItem . '" checked>' . $radioItem . '</label>';
			continue;
		}
	}
	echo '<label><input type="radio" name="radio" value="' . $radioItem . '">' . $radioItem . '</label>';
}
?>
		</dd>
	</dl>
	<dl class="form-item">
		<dt>テキストエリア</dt>
		<dd>
			<textarea name="textarea"><?php if(!empty($post)) { echo htmlspecialchars($post['textarea'], ENT_QUOTES, 'UTF-8'); } ?></textarea>
		</dd>
	</dl>
	<div class="form-btn">
		<input type="submit" value="確認画面">
	</div>
</form>
</body>
</html>