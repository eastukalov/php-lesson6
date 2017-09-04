<html>
<head>
	<title>Выбор теста</title>
</head>
<body>
<?php
   $dir = 'test/';
   $check = false;
   $files = [];


		if (is_dir($dir)) {
   			if ($dh = opendir($dir)) {
   				
       			while (($file = readdir($dh)) !== false) {
	           		
	           		if (end(explode(".", $file))=='json') {
	           			$check=true;
	           			$files[]=$dir . $file;
	           		}
       			} 

       		closedir($dh);
   			}
   		}	
  		
   		if (!$check) {
          ?> <style type="text/css"> h2, input {display:none;}</style><?php
   			  echo "<p>Ошибка: не загружен список тестов</p>";
   		}

  ?>
  <h2>Выберите тест</h2>

  <form method='GET' action='test.php'>
    <?php foreach ($files as $value) : ?>
        <p><input type='radio' name='rb' value=<?=$value?>><?=$value?></p>
    <?php endforeach; ?>
  
  <input type='submit' value='Отправить'>
  </form>

  <p><a href='admin.php'>возврат к загрузке тестов</a></p>
</body>
</html>