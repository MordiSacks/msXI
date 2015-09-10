<?php
session_start();
//$_SESSION['msXI'] = null;
//die();

require_once('msXI.php');
msXI::request();
var_dump($_POST);
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<form action="" method="post">
	<table>
		<tr>
			<td>
				Number:
			</td>
			<td>
				<input type="text" name="<?php msXI::make('number', 'tickets'); ?>">
			</td>
		</tr>
		<tr>
			<td>
				Name:
			</td>
			<td>
				<input type="text" name="<?php msXI::make('alpha', 'first_name'); ?>">
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit">
			</td>
		</tr>
	</table>
</form>
</body>
</html>