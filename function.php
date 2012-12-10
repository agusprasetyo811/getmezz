<?php

function service3($x)
{
   $string = "<select name='phoneid'>";
   $handle = @fopen($path."smsdrc1", "r");
   while (!feof($handle)) 
   {
        $buffer = fgets($handle);
        if (substr_count($buffer, 'phoneid = ') > 0)
		{
		   $split = explode("phoneid = ", $buffer);
		   $id1 = str_replace("\r\n", "", $split[1]);
		}
   }	
   if ($id1 != '') {
   $string .= "<option value='smsdrc1'>".$id1."</option>";
   }
   fclose($handle);
   
   $handle = @fopen($path."smsdrc2", "r");
   while (!feof($handle)) 
   {
        $buffer = fgets($handle);
        if (substr_count($buffer, 'phoneid = ') > 0)
		{
		   $split = explode("phoneid = ", $buffer);
		   $id2 = str_replace("\r\n", "", $split[1]);
		}
   }	
   if ($id2 != '') {
   $string .= "<option value='smsdrc2'>".$id2."</option>";   
   }
   fclose($handle);
   
   $handle = @fopen($path."smsdrc3", "r");
   while (!feof($handle)) 
   {
        $buffer = fgets($handle);
        if (substr_count($buffer, 'phoneid = ') > 0)
		{
		   $split = explode("phoneid = ", $buffer);
		   $id3 = str_replace("\r\n", "", $split[1]);
		}
   }	
   if ($id3 != '') {
   $string .= "<option value='smsdrc3'>".$id3."</option>";
   }
   fclose($handle);
   
   $handle = @fopen($path."smsdrc4", "r");
   while (!feof($handle)) 
   {
        $buffer = fgets($handle);
        if (substr_count($buffer, 'phoneid = ') > 0)
		{
		   $split = explode("phoneid = ", $buffer);
		   $id4 = str_replace("\r\n", "", $split[1]);
		}
   }	
   if ($id4 != '') {
   $string .= "<option value='smsdrc4'>".$id4."</option>";
   }
   fclose($handle);
   
   $string .= "</select>";
   return $string;
}

?>