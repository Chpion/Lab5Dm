<?php
/**
*Функия Valid совершает проверку на валидацию. 
*@param matrix
*@return valid
*/
	function Valid($matrix)
	{
		$hight = count($matrix);
		$valid = 0;
		for ($i = 0; $i < $hight; $i++)
		{
			for ($j = 0; $j < count($matrix[$i]); $j++)
			{
				if ($matrix[$i][$j] != 0 && $matrix[$i][$j] != 1)
				{
					$valid = 1;
				}
			}
			if ($hight != count($matrix[$i]))
			{
				$valid = 2;
			}
		}
		return $valid;
	}
/**
*Функия multiplication совершает перемножение матриц. 
*@param matrix2
*@param matrix
*@return string
*/
	function multiplication($matrix2,$matrix)//Перемножение двух матриц
	{
		$n = 0;
		for ($i = 0; $i < count($matrix); $i++)
		{
			for ($j = 0; $j < count($matrix[$i]); $j++)
			{
				for ($a = 0; $a < count($matrix[$i]); $a++)
				{
					$n += ($matrix2[$i][$a]*$matrix[$a][$j]);
				}
				if ($n > 1)
				{
					$matrix3[$i][$j] = 1;
				}
				else
				{
					$matrix3[$i][$j] = $n;
				}
				$n = 0;
			}			
		}
		return $matrix3;		
	}
/**
*Функия degree совершает возведение матрицы в степень n. 
*@param matrix
*@param n
*@return string
*/
	function degree($matrix,$n)//Возведение матрицы в степень
	{
		$matrix3 = $matrix;
		while ($n > 1)
		{
			$matrix3 = multiplication($matrix3,$matrix);
			$n--;
		}
		return $matrix3;		
	}
/**
*Функия sum находит сумму двух матриц. 
*@param matrix2
*@param matrix
*@return string
*/
	function sum($matrix2,$matrix)//Сумма матриц
	{
		for ($i = 0; $i < count($matrix); $i++)
		{
			for ($j = 0; $j < count($matrix); $j++)
			{
				$matrix3[$i][$j] = $matrix2[$i][$j] + $matrix[$i][$j];
				if ($matrix3[$i][$j] > 1)
				{
					$matrix3[$i][$j] = 1;
				}
			}
		}
		return $matrix3;		
	}
/**
*Функия CreateMatrixDos высчитывает матрицу достижимости и выводит ее на экран. 
*@param matrix
*/
	function CreateMatrixDos($matrix)//Создание и вывод матрицы достижимости
	{
		$count = count($matrix);
		$n = 2;
		for ($i = 0; $i < count($matrix); $i++)
		{
			for ($j = 0; $j < count($matrix[$i]); $j++)
			{
				$matrixE[$i][$j] = 0;
				if ($i == $j)
				{
					$matrixE[$i][$j] = 1;
				}
			}
		}
		$matrix2 = sum($matrixE,$matrix);
		while ($n < $count)
		{
			$matrix3 = degree($matrix,$n);
			$matrix4 = sum($matrix2,$matrix3);
			$n++;
			$matrix2 = $matrix4;
		}	
		echo "<h1 align = 'center'>";
		for ($i = 0; $i < count($matrix); $i++)
		{
			echo "<br>";
			for ($j = 0; $j < count($matrix[$i]); $j++)
			{
				echo $matrix2[$i][$j];
				echo " ";
			}
		}
		echo "</h1>";
	}
	$matrix = strval($_POST['matrix']); //Возвращает строковое значение переменной
    $matrix = explode("\n", $matrix); //Разбивает строку с помощью разделителя
    for ($i = 0; $i < count($matrix); $i++) 
	{
        $matrix[$i] = explode(" ", $matrix[$i]);
    }
		if (Valid($matrix) == 0)
		{
			echo "<br><h1 align = 'center'>Матрица достижимости:<h1><br>";
			echo CreateMatrixDos($matrix);
		
		}
		else if(Valid($matrix) == 1)
		{
			echo "<br><h1 align = 'center'>Матрица должна состоять только 0 и 1!<h1><br>";
		}
		else if(Valid($matrix) == 2)
		{
			echo "<br><h1 align = 'center'>Матрица должна быть квадратной!<h1><br>";
		}
		else 
		{
			echo "<br><h1 align = 'center'>Матрица не была введена:<h1><br>";
		}
?>