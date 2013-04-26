<?php
function nostr($str)
{
    $str=explode(" ",$str);
	for($i=0,$j=0;$i<count($str);$i++)
	{
	  
	   if($str[$i]!='	')
	   {
	    $stb[$j]=$str[$i];
		$j++;
		echo "sb";
	    }
	}
	
	return $stb;
}
?>