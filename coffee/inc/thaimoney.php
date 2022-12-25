<?php
$bahttext_reading=array(
	1=>array('','เอ็ด','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า'),
	2=>array('','สิบ','ยี่สิบ','สามสิบ','สี่สิบ','ห้าสิบ','หกสิบ','เจ็ดสิบ','แปดสิบ','เก้าสิบ'),
	3=>array('','หนึ่งร้อย','สองร้อย','สามร้อย','สี่ร้อย','ห้าร้อย','หกร้อย','เจ็ดร้อย','แปดร้อย','เก้าร้อย'),
	4=>array('','หนึ่งพัน','สองพัน','สามพัน','สี่พัน','ห้าพัน','หกพัน','เจ็ดพัน','แปดพัน','เก้าพัน'),
	5=>array('','หนึ่งหมื่น','สองหมื่น','สามหมื่น','สี่หมื่น','ห้าหมื่น','หกหมื่น','เจ็ดหมื่น','แปดหมื่น','เก้าหมื่น'),
	6=>array('','หนึ่งแสน','สองแสน','สามแสน','สี่แสน','ห้าแสน','หกแสน','เจ็ดแสน','แปดแสน','เก้าแสน')
);

function integerToThai($number) {
	//trail off all the zero at the beginning
	$number=ltrim($number,' 0');
	if($number=='') {   return 'ศูนย์';   }
	if($number=='1') {   return 'หนึ่ง';   }
	//it is easier to work in an inverted one
	$number=strrev($number);
	return millionToThaiHelper($number,'',true);
}

//a helper function that takes care of > million number
function millionToThaiHelper($rnumber,$sofar,$first) {
	if(strcmp($rnumber,'1')==0)
	{   
		if($first) {   return 'หนึ่ง'.$sofar;   }
		else {   return 'หนึ่งล้าน'.$sofar;   }
	}
	else
	{
		if(strlen($rnumber)>6)
		{
			if($first) {   return millionToThaiHelper(substr($rnumber,6),integerToThaiHelper($rnumber,1,'').$sofar,false);   }
			else {   	return millionToThaiHelper(substr($rnumber,6),integerToThaiHelper($rnumber,1,'').'ล้าน'.$sofar,false);   }
		}
		else 
		{
			if($first){   return integerToThaiHelper($rnumber,1,'').$sofar;   }
			else {   	return integerToThaiHelper($rnumber,1,'').'ล้าน'.$sofar;   } 
		}
	}
}

// the same as integer to Thai but this guy can do only up to 10^6-1
// this function takes in an reversed number that is
// one hundred is represented by 001
// digit represents current working digit.
// tail recursion implementation
// if the number is more than million it will return แค่หลักแสน
function integerToThaiHelper($rnumber,$digit,$sofar) {
	if($digit>6) {   return $sofar;   }
	if($rnumber=='') {   return '';   }
	else
	{
		global $bahttext_reading;
		//echo $rnumber.' '.$sofar.' '.substr($rnumber,0,1).' '.$reading[$digit][$rnumber[0]].'<br>';
		if(strlen($rnumber)==1) {   return $bahttext_reading[$digit][$rnumber].$sofar;   }
		else {   return integerToThaiHelper(substr($rnumber,1),($digit+1),$bahttext_reading[$digit][substr($rnumber,0,1)].$sofar);   }
	}
}

//convert numeric string to thai reading in baht
//warning bahtText('2345678234234273784723894.234324342') (with quotes)
//is not the same as bahtText(2345678234234273784723894.234324342) because
//php round the number.
//If you wish to use this function with a large number call it with quotes
function bahtText($number) {
	if(!is_numeric($number) || $number < 0) {   die('bahtText error: the argument is not a valid positive number');   }
	if(is_float($number))
	{//for weird formats such as 2E5
		//echo 'float';
		$whole = floor($number);
		$decimal = round(($number-$whole)*100);
	}
	else
	{
		$temp = explode('.',$number);
		if(count($temp)==1)
		{
			$whole=$temp[0];
			$decimal=0;
		}
		else
		{
			$whole=$temp[0];
			$length=strlen($temp[1]);
			if($length>2)
			{
				$decimal.='0';
				$decimal=substr($temp[1],0,3);
				$decimal=round($decimal/(10.0));
			}
			else if($length==2) {   $decimal=$temp[1];    }//0.5 ==> ห้าสิบสตางค์
			else {   $decimal=$temp[1].'0';   }
		}
	}
	if($decimal==0) {   return integerToThai($whole).'บาทถ้วน';   }
	else
	{
		if($whole!=0) {   return integerToThai($whole).'บาท'.integerToThai($decimal).'สตางค์'; }
		else {   return integerToThai($decimal).'สตางค์';   }
	}
}
?>