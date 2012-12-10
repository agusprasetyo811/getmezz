<?php 

if (isset($_GET['sent'])) {
	// Get Parameter
	$phone_id = $_GET['phone_id'];
	$no = $_GET['hp_no'];
	$messege = $_GET['messege'];
	// Sent Messege
	 passthru('gammu-smsd-inject -c smsdrc1 TEXT '.$no.' -text "'.$messege.'"');
}
if (isset($_GET['check_conn'])) {
	passthru("gammu identify");
}
?>

<h1>Test Messege<hr></h1>
<form>
	<table>
		<tr>
			<td>Phone ID</td>
			<td><input type="text" name="phone_id" value="<?=@$id1?>"/></td>
		</tr>
		<tr>
			<td>No</td>
			<td><input type="text" name="hp_no"/></td>
		</tr>
		<tr>
			<td>Messege :</td>
			<td><textarea name="messege"></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" name="sent" value="Sent"/>
				<input type="submit" name="check_conn" value="Check Connection"/>
			</td>
		</tr>
	</table>
</form>