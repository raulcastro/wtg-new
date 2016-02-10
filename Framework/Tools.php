<?php
/**
 * Created on Jun 30, 2014
 *
 *All these little tiny shitty functions we use around the code
 */
 
class Tools
{
    public function __construct()
    {
    
    }
    
   /** Converts all accent characters to ASCII characters.
	*
	* If there are no accent characters, then the string given is just returned.
	*
	* @param string $string Text that might have accent characters
	* @return string Filtered string with replaced "nice" characters.
	*/
	
	public static function remove_accents($string)
	{
		if (!preg_match('/[\x80-\xff]/', $string))
			return $string;
	
		if (Tools::seems_utf8($string))
		{
			$chars = array(
	
			// Decompositions for Latin-1 Supplement
			chr(195).chr(128) => 'A', chr(195).chr(129) => 'A',
			chr(195).chr(130) => 'A', chr(195).chr(131) => 'A',
			chr(195).chr(132) => 'A', chr(195).chr(133) => 'A',
			chr(195).chr(135) => 'C', chr(195).chr(136) => 'E',
			chr(195).chr(137) => 'E', chr(195).chr(138) => 'E',
			chr(195).chr(139) => 'E', chr(195).chr(140) => 'I',
			chr(195).chr(141) => 'I', chr(195).chr(142) => 'I',
			chr(195).chr(143) => 'I', chr(195).chr(145) => 'N',
			chr(195).chr(146) => 'O', chr(195).chr(147) => 'O',
			chr(195).chr(148) => 'O', chr(195).chr(149) => 'O',
			chr(195).chr(150) => 'O', chr(195).chr(153) => 'U',
			chr(195).chr(154) => 'U', chr(195).chr(155) => 'U',
			chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y',
			chr(195).chr(159) => 's', chr(195).chr(160) => 'a',
			chr(195).chr(161) => 'a', chr(195).chr(162) => 'a',
			chr(195).chr(163) => 'a', chr(195).chr(164) => 'a',
			chr(195).chr(165) => 'a', chr(195).chr(167) => 'c',
			chr(195).chr(168) => 'e', chr(195).chr(169) => 'e',
			chr(195).chr(170) => 'e', chr(195).chr(171) => 'e',
			chr(195).chr(172) => 'i', chr(195).chr(173) => 'i',
			chr(195).chr(174) => 'i', chr(195).chr(175) => 'i',
			chr(195).chr(177) => 'n', chr(195).chr(178) => 'o',
			chr(195).chr(179) => 'o', chr(195).chr(180) => 'o',
			chr(195).chr(181) => 'o', chr(195).chr(182) => 'o',
			chr(195).chr(182) => 'o', chr(195).chr(185) => 'u',
			chr(195).chr(186) => 'u', chr(195).chr(187) => 'u',
			chr(195).chr(188) => 'u', chr(195).chr(189) => 'y',
			chr(195).chr(191) => 'y',
			// Decompositions for Latin Extended-A
			chr(196).chr(128) => 'A', chr(196).chr(129) => 'a',
			chr(196).chr(130) => 'A', chr(196).chr(131) => 'a',
			chr(196).chr(132) => 'A', chr(196).chr(133) => 'a',
			chr(196).chr(134) => 'C', chr(196).chr(135) => 'c',
			chr(196).chr(136) => 'C', chr(196).chr(137) => 'c',
			chr(196).chr(138) => 'C', chr(196).chr(139) => 'c',
			chr(196).chr(140) => 'C', chr(196).chr(141) => 'c',
			chr(196).chr(142) => 'D', chr(196).chr(143) => 'd',
			chr(196).chr(144) => 'D', chr(196).chr(145) => 'd',
			chr(196).chr(146) => 'E', chr(196).chr(147) => 'e',
			chr(196).chr(148) => 'E', chr(196).chr(149) => 'e',
			chr(196).chr(150) => 'E', chr(196).chr(151) => 'e',
			chr(196).chr(152) => 'E', chr(196).chr(153) => 'e',
			chr(196).chr(154) => 'E', chr(196).chr(155) => 'e',
			chr(196).chr(156) => 'G', chr(196).chr(157) => 'g',
			chr(196).chr(158) => 'G', chr(196).chr(159) => 'g',
			chr(196).chr(160) => 'G', chr(196).chr(161) => 'g',
			chr(196).chr(162) => 'G', chr(196).chr(163) => 'g',
			chr(196).chr(164) => 'H', chr(196).chr(165) => 'h',
			chr(196).chr(166) => 'H', chr(196).chr(167) => 'h',
			chr(196).chr(168) => 'I', chr(196).chr(169) => 'i',
			chr(196).chr(170) => 'I', chr(196).chr(171) => 'i',
			chr(196).chr(172) => 'I', chr(196).chr(173) => 'i',
			chr(196).chr(174) => 'I', chr(196).chr(175) => 'i',
			chr(196).chr(176) => 'I', chr(196).chr(177) => 'i',
			chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij',
			chr(196).chr(180) => 'J', chr(196).chr(181) => 'j',
			chr(196).chr(182) => 'K', chr(196).chr(183) => 'k',
			chr(196).chr(184) => 'k', chr(196).chr(185) => 'L',
			chr(196).chr(186) => 'l', chr(196).chr(187) => 'L',
			chr(196).chr(188) => 'l', chr(196).chr(189) => 'L',
			chr(196).chr(190) => 'l', chr(196).chr(191) => 'L',
			chr(197).chr(128) => 'l', chr(197).chr(129) => 'L',
			chr(197).chr(130) => 'l', chr(197).chr(131) => 'N',
			chr(197).chr(132) => 'n', chr(197).chr(133) => 'N',
			chr(197).chr(134) => 'n', chr(197).chr(135) => 'N',
			chr(197).chr(136) => 'n', chr(197).chr(137) => 'N',
			chr(197).chr(138) => 'n', chr(197).chr(139) => 'N',
			chr(197).chr(140) => 'O', chr(197).chr(141) => 'o',
			chr(197).chr(142) => 'O', chr(197).chr(143) => 'o',
			chr(197).chr(144) => 'O', chr(197).chr(145) => 'o',
			chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe',
			chr(197).chr(148) => 'R',chr(197).chr(149) => 'r',
			chr(197).chr(150) => 'R',chr(197).chr(151) => 'r',
			chr(197).chr(152) => 'R',chr(197).chr(153) => 'r',
			chr(197).chr(154) => 'S',chr(197).chr(155) => 's',
			chr(197).chr(156) => 'S',chr(197).chr(157) => 's',
			chr(197).chr(158) => 'S',chr(197).chr(159) => 's',
			chr(197).chr(160) => 'S', chr(197).chr(161) => 's',
			chr(197).chr(162) => 'T', chr(197).chr(163) => 't',
			chr(197).chr(164) => 'T', chr(197).chr(165) => 't',
			chr(197).chr(166) => 'T', chr(197).chr(167) => 't',
			chr(197).chr(168) => 'U', chr(197).chr(169) => 'u',
			chr(197).chr(170) => 'U', chr(197).chr(171) => 'u',
			chr(197).chr(172) => 'U', chr(197).chr(173) => 'u',
			chr(197).chr(174) => 'U', chr(197).chr(175) => 'u',
			chr(197).chr(176) => 'U', chr(197).chr(177) => 'u',
			chr(197).chr(178) => 'U', chr(197).chr(179) => 'u',
			chr(197).chr(180) => 'W', chr(197).chr(181) => 'w',
			chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y',
			chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z',
			chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z',
			chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z',
			chr(197).chr(190) => 'z', chr(197).chr(191) => 's',
			// Euro Sign
			chr(226).chr(130).chr(172) => 'E',
			// GBP (Pound) Sign
			chr(194).chr(163) => '');
			$string = strtr($string, $chars);
		}
		else
		{
			// Assume ISO-8859-1 if not UTF-8
			$chars['in'] = chr(128).chr(131).chr(138).chr(142).chr(154).chr(158)
			.chr(159).chr(162).chr(165).chr(181).chr(192).chr(193).chr(194)
			.chr(195).chr(196).chr(197).chr(199).chr(200).chr(201).chr(202)
			.chr(203).chr(204).chr(205).chr(206).chr(207).chr(209).chr(210)
			.chr(211).chr(212).chr(213).chr(214).chr(216).chr(217).chr(218)
			.chr(219).chr(220).chr(221).chr(224).chr(225).chr(226).chr(227)
			.chr(228).chr(229).chr(231).chr(232).chr(233).chr(234).chr(235)
			.chr(236).chr(237).chr(238).chr(239).chr(241).chr(242).chr(243)
			.chr(244).chr(245).chr(246).chr(248).chr(249).chr(250).chr(251)
			.chr(252).chr(253).chr(255);
			
			$chars['out']			= "EfSZszYcYuAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy";
			$string 				= strtr($string, $chars['in'], $chars['out']);
			$double_chars['in'] 	= array(chr(140), chr(156), chr(198), chr(208), chr(222), chr(223), chr(230), chr(240), chr(254));
			$double_chars['out'] 	= array('OE', 'oe', 'AE', 'DH', 'TH', 'ss', 'ae', 'dh', 'th');
			$string 				= str_replace($double_chars['in'], $double_chars['out'], $string);
		}
	
		return $string;
	}
	
	/**
	* Checks to see if a string is utf8 encoded.
	*
	* @author bmorel at ssi dot fr
	*
	* @param string $Str The string to be checked
	* @return bool True if $Str fits a UTF-8 model, false otherwise.
	*/
	public static function seems_utf8($Str)
	{ # by bmorel at ssi dot fr
		$length = strlen($Str);
		for ($i = 0; $i < $length; $i++)
		{
			if (ord($Str[$i]) < 0x80) continue; # 0bbbbbbb
			elseif ((ord($Str[$i]) & 0xE0) == 0xC0) $n = 1; # 110bbbbb
			elseif ((ord($Str[$i]) & 0xF0) == 0xE0) $n = 2; # 1110bbbb
			elseif ((ord($Str[$i]) & 0xF8) == 0xF0) $n = 3; # 11110bbb
			elseif ((ord($Str[$i]) & 0xFC) == 0xF8) $n = 4; # 111110bb
			elseif ((ord($Str[$i]) & 0xFE) == 0xFC) $n = 5; # 1111110b
			else return false; # Does not match any model
		
			for ($j = 0; $j < $n; $j++)
			{ # n bytes matching 10bbbbbb follow ?
				if ((++$i == $length) || ((ord($Str[$i]) & 0xC0) != 0x80))
				return false;
			}
		}
		
		return true;
	}
	
	public static function utf8_uri_encode($utf8_string, $length = 0)
	{
		$unicode 			= '';
		$values 			= array();
		$num_octets 		= 1;
		$unicode_length 	= 0;
		$string_length 		= strlen($utf8_string);
		
		for ($i = 0; $i < $string_length; $i++)
		{
			$value 	= ord($utf8_string[$i]);
			if ($value < 128)
			{
				if ($length && ($unicode_length >= $length))
				break;
			
				$unicode .= chr($value);
				$unicode_length++;
			}
			else
			{
				if (count($values) == 0) $num_octets = ($value < 224) ? 2 : 3;
				
				$values[]	= $value;
				
				if ($length && ($unicode_length + ($num_octets * 3)) > $length)
				break;
				
				if (count( $values ) == $num_octets)
				{
					if ($num_octets == 3)
					{
						$unicode 		.= '%' . dechex($values[0]) . '%' . dechex($values[1]) . '%' . dechex($values[2]);
						$unicode_length += 9;
					}
					else
					{
						$unicode 		.= '%' . dechex($values[0]) . '%' . dechex($values[1]);
						$unicode_length += 6;
					}
					
					$values 	= array();
					$num_octets = 1;
				}
			}
		}
		return $unicode;
	}
	
	/**
	* Sanitizes title, replacing whitespace with dashes.
	*
	* Limits the output to alphanumeric characters, underscore (_) and dash (-).
	* Whitespace becomes a dash.
	*
	* @param string $title The title to be sanitized.
	* @return string The sanitized title.
	*/
	public static function slugify($title)
	{
		$title = strip_tags($title);
		// Preserve escaped octets.
		
		$title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
		// Remove percent signs that are not part of an octet.
		
		$title = str_replace('%', '', $title);
		// Restore octets.
		
		$title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);
		
		$title = Tools::remove_accents($title);
		
		if (Tools::seems_utf8($title))
		{
			if (function_exists('mb_strtolower'))
			{
				$title = mb_strtolower($title, 'UTF-8');
			}
			
			$title = Tools::utf8_uri_encode($title, 200);
		}
		
		$title = strtolower($title);
		$title = preg_replace('/&.+?;/', '', $title); // kill entities
		$title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
		$title = preg_replace('/\s+/', '-', $title);
		$title = preg_replace('|-+|', '-', $title);
		$title = trim($title, '-');
		
		return $title;
	}
	
	/**
	 * This shitty thing returns a random string with the length of @param size
	 */
	
	public static function getRandom($size = '')
    {
        if (!$size)
        {
            $size = 8;
        }
        
        $rand = 0;
        
        for ($i = 1; $i < $size; $i++) 
        {
            $d = rand(1, 30) % 2;
            $rand .= $d ? chr(rand(65, 90)) : chr(rand(48, 57));
        }
         
        return strtolower($rand);
    }
    
	/**
	 * Clean the string for security reasons
	 * 
	 * @param unknown $string
	 * @return mixed
	 */     
	public static function cleanString($string)
	{
		return preg_replace('/[^\w\._]+/', '_', $string);
	}
     
	/**
	 * Return a date ready for use on an mysql query
	 * @param unknown $date
	 * @return string
	 */
    public static function formatToMYSQL($date)
    {
        if ($date)
        {
            $date = explode('/', $date);
            $date = $date[2].'-'.$date[0].'-'.$date[1];
            return $date;
        }
    }
    
    /**
     * Format a date from mysql ready for the front end
     * @param unknown $date
     */
    public static function formatMYSQLToFront($date)
    {
		return @date('d-M-Y', strtotime($date));
    }
    
    /**
     * Format a hour from mysql ready for the front end
     * @param unknown $hour
     */
    public static  function formatHourMYSQLToFront($hour)
    {
    		return @date('h:i A', strtotime($hour));
    }
    
    public static function clean($string)
    {
		while(strchr($string,'\\')) 
		{ 
		    $string = stripslashes($string); 
		}
		
		return $string;
    }
	
    /**
     * Chars, numbers and midle sings
     * @param string $string
     * @param number $max
     * @param number $min
     * @return boolean
     */
    public static function validateUserName($string, $max = 250, $min = 0)
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
    
    /**
     * Just chars and spaces
     * @param string $string
     * @param number $max
     * @param number $min
     * @return boolean
     */
    public static function validateAlpha($string, $max = 250, $min = 0)
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
    
    /**
     * Just digits and decimal points
     * @param string $string
     * @param number $max
     * @param number $min
     * @return boolean
     */
    public static function validateNumber($string, $max = 250, $min = 0)
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
    
    /**
     * Just digits
     * @param string $string
     * @param number $max
     * @param number $min
     * @return boolean
     */
    public static function validateDigits($string, $max = 250, $min = 0)
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
    
    /**
     * Emails
     * @param string $string
     * @return boolean
     */
    public static function validateEmail($string)
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
    
    /**
     * Chars without tags
     * @param string $string
     * @param number $max
     * @param number $min
     * @return boolean
     */
    public static function validateText($string, $max = 2000, $min = 0)
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
    
    public static function shortString($string, $length)
    {
    	if (strlen($string) > $length)
    	{
    		$string = strip_tags($string);
    		$string = substr($string, 0, $length);
    		return $string.' ...';
    	} else {
    		return $string;
    	}
    }
    
    public static function curPageURL()
    {
    	$pageURL = 'http';
    
    	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    	$pageURL .= "://";
    	if ($_SERVER["SERVER_PORT"] != "80")
    	{
    		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    	}
    	else
    	{
    		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    	}
    
    	return $pageURL;
    }
    
    public function getThumb($name, $from, $to,  $value, $prop, $pre = '', $quality = 100)
	{
		$original = $from.$name;
		$to       = $to.$pre.$name;
		
		$info     = getimagesize($original);  

		$width    = $info[0];  
		$height   = $info[1];  
		$type     = $info[2]; 

		switch ($type)
		{          
			case IMAGETYPE_JPEG:  
				$image = imagecreatefromjpeg($original);  
				break;          
			
			case IMAGETYPE_GIF:  
				$image = imagecreatefromgif($original);  
				break;          
			
			case IMAGETYPE_PNG:  
				$image = imagecreatefrompng($original);  
				break;          
		}
		    
		//---Determinar la propiedad a redimensionar y la propiedad opuesta  
		$prop_value 	= ($prop == 'width') ? $width : $height;  
		$prop_versus 	= ($prop == 'width') ? $height : $width;  

		//---Determinar el valor opuesto a la propiedad a redimensionar  
		$pcent 			= $value / $prop_value;        
		$value_versus 	= $prop_versus * $pcent;  

		//---Crear la imagen dependiendo de la propiedad a variar  
		$image_p 		= ($prop == 'width') ? imagecreatetruecolor($value, $value_versus) : imagecreatetruecolor($value_versus, $value);  

		//---Hacer una copia de la imagen dependiendo de la propiedad a variar  
		switch ($prop)
		{  
			case 'width':  
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $value, $value_versus, $width, $height);  
				break;  

			case 'height':  
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $value_versus, $value, $width, $height);  
				break;  
		}

		switch ($type)
		{          
			case IMAGETYPE_JPEG:  
				imagejpeg($image_p, $to, $quality);  
				break;          
			
			case IMAGETYPE_GIF:  
				imagegif($image_p, $to);  
				break;          
			
			case IMAGETYPE_PNG:  
				$pngquality = floor(($quality - 10) / 10);  
				imagepng($image_p, $to, $pngquality);
				break;          
		} 
		
		imagedestroy($image);
		
		$newDatas = getimagesize($to);
		
		$width    = $newDatas[0];  
		$height   = $newDatas[1];  
		$type     = $newDatas[2];

		if ($newDatas)
		{
		    chmod($to, 0777);
			return true;
		}
		else
		{
			return false;
		}

	#     echo $to.'|'.$width.'|'.$height;
	}
}
?>
