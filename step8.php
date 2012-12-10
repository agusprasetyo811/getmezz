<html>
<head>
  <script type="text/javascript">
  
  function ajax() 
  {
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
     xmlhttp=new XMLHttpRequest();
  }
  else
  {// code for IE6, IE5
     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("sms").innerHTML = xmlhttp.responseText;
    }
  }
  
  xmlhttp.open("GET","run2.php",true);
  xmlhttp.send();
  setTimeout("ajax()", 1000);
  }  
  </script>
</head>

<body onload="ajax()">
<?php include "menu2.php"; ?>

<h2>Langkah 8 - Test Menerima SMS</h2>

<p>Silakan kirim SMS ke nomor HP SMS Center Anda. Jika SMS sukses diterima oleh GAMMU akan muncul di bawah ini</p>

<div id="sms">
</div>

</body>
</html>