

<html>
<head>
	<title>Обработка форм</title>
</head>
<body>
	<form method='post' enctype='multipart/form-data'>
		Файл <input type='file' name='myfile'></br>
		<input type='submit' value='Отправить'>
	</form>
	
	<?php
		$dir='test/';
		
		if (isset($_FILES['myfile']['name']) && !empty($_FILES['myfile']['name']))	{
			
			if (is_dir($dir) && $_FILES['myfile']['error']==UPLOAD_ERR_OK && move_uploaded_file($_FILES['myfile']['tmp_name'], 'test/' . $_FILES['myfile']['name']) && isset($_FILES['myfile']['type']) && ($_FILES['myfile']['type']=='application/json')) {
				echo 'Файл с тестами загружен';
				?><style type="text/css"> .err { display: none;} </style><?
			}
			else {
				echo 'Ошибка: Файл с тестами не загружен';
			}
		}
			
			

		if (count($_GET)!=0) {
		
			if ($_GET['err']==0) {
				?><p class='err'>Нельза открыть список тестов, пока они не загружены</p><?
			}	
			
		}
	?>
    
	<p><a href='list.php'>Перейти к просмотру загруженных тестов</a></p>
</body>
</html>

