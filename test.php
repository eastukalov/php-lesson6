<?php

	if (isset($_GET['rb']) && !empty($_GET['rb'])) {
		
		if (is_readable($_GET['rb'])) {
			$tests=htmlspecialchars(file_get_contents($_GET['rb']));
			$tests=json_decode(file_get_contents($_GET['rb']),true);
			$check = false;

			if (count($tests)==0) {
				$check = true;
			}	
			else {
				
						
				foreach ($tests as $value) {
					//переиндексирование массива
					$value=array_values($value);

					
					foreach ($value as $key=>$test) {
							
						switch ($key) {
							case 0:
								if (!is_string($test)) {
									$check=true;
									break(3);
								}
								break;
							case 1:
								if (!is_array($test) || count($test)==0) {
									$check=true;
									break(3);
								}

								if (array_sum(array_count_values($test))!=count(array_count_values($test))) {
									$check=true;
									break(3);
								}
								
								break;
							case 2:
								if (!is_array($test) || count($test)==0) {
									$check=true;
									break(3);
								}	

								if (array_sum(array_count_values($test))!=count(array_count_values($test))) {
									$check=true;
									break(3);
								}
								
								break;
							default:
								$check=true;
								break(3);
						}

						if (count($value[1]) < count($value[2])) {
							$check=true;
							break(2);
						}
					}
				}	

			}

			if ($check) {
				echo 'Ошибка: неправильная структура файла';
			}

		}
		else {
			$check=true;
			echo 'Ошибка: указанный тест не найден';
		}
	}	
	else {
		$check=true;
		echo 'Ошибка: не задан тест';
	}

	if (!$check) {
		
	
		?><form method='POST'><?php

		foreach ($tests as $key_test=>$value) :
			
			foreach ($value as $key=>$test) :
				
				switch ($key) {
					case 0:
						echo "<h3>Вопрос: $test</h3>";
						break;
					
					case 1:
						foreach ($test as $key_variant => $variant) :
							?> <input type='checkbox' name=<?='res['.$key_test.']['.$key_variant.']' ?> value=<?='"'.str_replace('"', "&#34", $variant) .'"'?>><?=$variant?> <?php
						endforeach;
						break;
					case 2:
						$ansvers[]=$test;
						break;	
				}
							
			endforeach;
			
		endforeach;

		?> <p><input type='submit' value='Отправить'></p> <?php


		?> </form> <?php
		
	}	
	
	if (isset($_POST['res']) && !empty($_POST['res'])) {	
		
		if (count($_POST['res'])!=3) {
			$check=true;
		}
	}
	else {
		$check=true;
	}	

	if ($check) {
		echo '<p>Вы пока еще не выполнили тест полностью</p>';
	}

	if (!$check) {
		echo "<h4>Вы дали ответы :</h4>";
		foreach ($_POST['res'] as $key=>$result) {
			$ans=implode(" - , - ", $ansvers[$key]);
			$res=implode(" - , - ", $result);
			echo '<p>'.implode(" - , - ", $result).'</p>';

			if ($ans==$res) {
				echo '<p style="color:green">Ответ правильный</p>';
			}
			else {
				echo '<p style="color:red">Правильный ответ: '.$ans.'</p>';
			}
					
		}

	}

	echo "<p><a href='admin.php'>возврат к загрузке тестов</a></p>";
	echo "<p><a href='list.php'>возврат к выбору теста</a></p>";
?>

