php-spam-mail-honeypot
======================

Foil bots with simple hashing of values, and spews that will make them wish they had a heart!


Usage:

contact-form.php

	<?php
	require_once('honeypot.php');
	$honeypot = new honeypot(); 
	?>
	<form action="mailer.php" method="post">
		<input type="text" name="<?=$honeypot->encode('name');?>">
		<input type="text" name="<?=$honeypot->encode('email');?>">
		<input type="text" name="<?=$honeypot->encode('message');?>">
		<?=$honeypot->spew();?>
		<input name="<?=$honeypot->encode('submit')?>" type="submit">
	</form>

mail-script.php

	<?php
	require_once('honeypot.php');
	$honeypot = new honeypot(); 
	
    if(isset($_POST[$honeypot->encode('submit')])) {
        if($honeypot->verify()) {
            $name    = $_POST[$honeypot->encode('name')];
            $email   = $_POST[$honeypot->encode('email')];
            $message = $_POST[$honeypot->encode('message')];
            
            $to      = 'someone@somewebsite.com';
            $subject = 'some subject';
            $headers = 'From: ' . $email . "\r\n" .
                'Reply-To: ' . $email . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
        
            mail($to, $subject, $message, $headers);
        }
	}
	?>
