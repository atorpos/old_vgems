<?php
/*
Template Name: Contact
*/
if(isset($_POST['submitted'])) {
		//Check to make sure that the name field is not empty
		if(trim($_POST['contactName']) === '') {
			$nameError = __("You forgot to enter your name.", "site5framework");
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}

		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['email']) === '')  {
			$emailError = __("You forgot to enter your email address.", "site5framework");
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = __("You entered an invalid email address.", "site5framework");
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}

		//Check to make sure comments were entered
		if(trim($_POST['comments']) === '') {
			$commentError = __("You forgot to enter your comments.", "site5framework");
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}

		//If there is no error, send the email
		if(!isset($hasError)) {
			$msg .= "------------User informations------------ \r\n"; //Title
			$msg .= "User IP : ".$_SERVER["REMOTE_ADDR"]."\r\n"; //Sender's IP
			$msg .= "Browser Info : ".$_SERVER["HTTP_USER_AGENT"]."\r\n"; //User agent
			$msg .= "User Come From : ".$_SERVER["HTTP_REFERER"]; //Referrer
			
			$emailTo = ''.get_option('diary_contact_email').'';
			$subject = 'Contact Form Submission from '.$name;
			$body = "Name: $name \n\nEmail: $email \n\nMessage: $comments \n\n $msg";
			$headers = 'From: '.get_bloginfo('name').' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

			if(mail($emailTo, $subject, $body, $headers)) $emailSent = true;

	}
	 
}
 get_header(); 
 ?>

<!-- Begin Main Content ( left col ) -->

	<section id="main-content">

		<article class="page">

			<header class="pageHeader">

				<h2><?php echo get_the_title(get_option('diary_contact_page')); ?></h2>

			</header>

				<section class="pageText">

					<p><?php echo stripslashes(stripslashes(get_option('diary_contact_text')))?></p>

					<?php if(isset($emailSent) && $emailSent == true) { ?>
					<p id="success" class="successmsg"><?php _e("Your email has been sent! Thank you!", "site5framework"); ?></p>
				    <?php } else { ?>
                    <?php 
                        if(!isset($hasError) and isset($emailSent)) {
                    ?>
                        <p id="badserver" class="errormsg"><?php _e("Your email failed. Try again later.", "site5framework"); ?></p>
                    <?php } elseif(isset($hasError) and !isset($emailSent)) { ?>
						<p id="bademail" class="errormsg" ><?php _e("Please enter your name, a message and a valid email address.", "site5framework"); ?></p>
					<?php } ?>

					<form id="contact" action="<?php the_permalink(); ?>" method="POST">
					<label for="nameinput">Your name: *</label>
						<input type="text" id="nameinput" name="contactName" value=""/>
					<label for="emailinput">Your email: *</label>
			
						<input type="text" id="emailinput" name="email" value=""/>
					<label for="commentinput">Your message: *</label>
						<textarea cols="20" rows="7" id="commentinput" name="comments"></textarea><br />
					<input type="submit" id="submit" name="submitted" class="submit" value="SEND MESSAGE"/>
               
					</form>
                    <?php } ?>

				</section>

			<div class="sidebadge"></div>

		</article>

	</section>

		<!-- End Main Content ( left col ) -->

		

		

<?php get_sidebar();?>

<?php get_footer();?>





