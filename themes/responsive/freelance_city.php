<?php

if(isset($_GET['countryid'])){   
    $cid = $_GET['countryid'];
    $selectBox2  = '';
if ($cid == '[:en]Other[:vi]Khác[:ja]Other')
echo "<input type='text' size=20>";
else {
	if ($cid == 'Vietnam')
    $city_file="city_list_vn.ini" ;
	if ($cid == 'Japan')
	$city_file="city_list_jp.ini" ;
	if (file_exists($city_file) && is_readable($city_file))
		{
		if($cid != 'noselect'){         
			$citys=parse_ini_file($city_file,true);
			$selectBox2 .= '<select name="city">';
			$selectBox2 .= '<option value="noselect" selected>City</option>';
			foreach ($citys as $city) {
				
				$selectBox2 .= '<option value="'.$city['name'].'">'.$city['name'].'</option>';
			}
			$selectBox2 .= '</select>';    
			}
		else{
			$selectBox2 .= '<select name="city">';
			$selectBox2 .= '    <option>City</option>';
			$selectBox2 .= '</select>';
			}		
			echo $selectBox2;
		}
	else
		{
		// If the configuration file does not exist or is not readable, DIE php DIE!
		die("Sorry, the $city_file file doesnt seem to exist or is not readable!");
		}
	}
}
?>