<?php
	
	require('geraCodigoBarra.php');
	
	echo "<img src='data:image/gif;base64,".geraCodigoBarra('12345678909')."'>";