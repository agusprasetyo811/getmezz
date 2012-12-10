<?php include "menu2.php"; ?>

<h2>Langkah 9 - Menghentikan Service GAMMU</h2>

<p>Klik tombol di bawah ini untuk menghentikan GAMMU Service!</p>

<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<input type="submit" name="submit" value="HENTIKAN SERVICE GAMMU"></td></tr>
</form>

<?php
  if ($_POST['submit']) 
  {
   echo "<b>Status :</b><br>";
   echo "<pre>";
   passthru("gammu-smsd -n phone1 -k");
   passthru("gammu-smsd -n phone2 -k");
   passthru("gammu-smsd -n phone3 -k");
   passthru("gammu-smsd -n phone4 -k");   
   echo "</pre>";
  }
?> 
