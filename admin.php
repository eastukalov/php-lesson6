<html>
<head>
	<title>Обработка форм</title>
</head>
<body>
	<form method='post' enctype='multipart/form-data'>
		Файл <input type='file' name='myfile'>
		<p><input type='submit' value='Отправить'></p>
	</form>
	   
	<p><a href='list.php'>Перейти к просмотру загруженных тестов</a></p>
</body>
</html>

<?php
		$dir='test/';
		
		if (isset($_FILES['myfile']['name']) && !empty($_FILES['myfile']['name']))	{
			
			if (is_dir($dir) && $_FILES['myfile']['error']==UPLOAD_ERR_OK && isset($_FILES['myfile']['type']) && $_FILES['myfile']['type']=='application/json' && 
				move_uploaded_file($_FILES['myfile']['tmp_name'], 'test/' . $_FILES['myfile']['name'])) {

				echo 'Файл с тестами загружен';
				?><style type="text/css"> .err { display: none;} </style><?php
			}
			else {
				echo 'Ошибка: Файл с тестами не загружен';
			}
		}
			
?>

