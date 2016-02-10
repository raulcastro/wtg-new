<?php
	
	/*	Caracteres, números y guiones										*/
	function validateUserName($string, $max = 250, $min = 0)
	{
		$pattern = "/^[a-zA-Z0-9_-]{".$min.",".$max."}$/";
		if(preg_match($pattern, $string))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/*	Solo letras y espacios												*/
	function validateAlpha($string, $max = 250, $min = 0)
	{
		$pattern = "/^[a-zA-ZáéíóúÁÉÍÓÚ\s]{".$min.",".$max."}$/";
		if(preg_match($pattern, $string))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/*	Solo dígitos y puntos decimales											*/
	function validateNumber($string, $max = 250, $min = 0)
	{
		$pattern = "/^[0-9\.]{".$min.",".$max."}$/";
		if(preg_match($pattern, $string))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/*	Solo dígitos															*/
	function validateDigits($string, $max = 250, $min = 0)
	{
		$pattern = "/^[0-9]{".$min.",".$max."}$/";
		if(preg_match($pattern, $string))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/*	E-mail																*/
	function validateEmail($string)
	{
		$string = trim($string);
		$pattern = "/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/";
		if(preg_match($pattern, $string))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/*	caracteres de texto sin tags										*/
	function validateText($string, $max = 2000, $min = 0)
	{
		$pattern = "/^[áéíóúÁÉÍÓÚñÑ-\w\s\.\,\?\¿\!\¡\:\;\@]{".$min.",".$max."}$/";
		if(preg_match($pattern, $string))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
?>
