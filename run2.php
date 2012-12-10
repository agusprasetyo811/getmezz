<?php
$handle = @fopen("smsdrc1", "r");
if ($handle) {
    while (!feof($handle)) {
        $buffer = fgets($handle);

		if (substr_count($buffer, 'user = ') > 0)
		{
		   $split = explode("user = ", $buffer);
		   $user = str_replace("\r\n", "", $split[1]);
		}

		if (substr_count($buffer, 'password = ') > 0)
		{
		   $split = explode("password = ", $buffer);
		   $pass = str_replace("\r\n", "", $split[1]);
		}

		if (substr_count($buffer, 'database = ') > 0)
		{
		   $split = explode("database = ", $buffer);
		   $db = str_replace("\n", "", $split[1]);
		}
		
    }
    fclose($handle);
}

mysql_connect('localhost', $user, $pass);
mysql_select_db($db);

$query = "SELECT * FROM inbox ORDER BY ID DESC";
$hasil = mysql_query($query) or die(mysql_error());
echo "<table border='1'>";
echo "<tr><th>ReceivingDateTime</th><th>SenderNumber</th><th>TextDecoded</th><th>Phone ID</th></tr>";
while ($data = mysql_fetch_array($hasil))
{
   echo "<tr><td>".$data['ReceivingDateTime']."</td><td>".$data['SenderNumber']."</td><td>".$data['TextDecoded']."</td><td>".$data['RecipientID']."</td></tr>";
}

echo "</table>";

?>