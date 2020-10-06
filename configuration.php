<?php
	session_start();
	$connection = mysqli_connect('localhost', 'Itachi', 'Uchiha', 'inotes');
	
	if(!$connection){
?><p class="myClass"><?php echo 'Connection error:'. mysqli_connect_error() ?></p>
<?php }?>