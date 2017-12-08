<?php
	if (isset($_POST["submit"])) {
		$name = $_POST['budget'];
        $email = $_POST['email'];
		$message = $_POST['message'];
		$from = 'User'; 
		$to = 'eric_ha@outlook.com';            //you must change email address to specified mail address you need
        $subject = 'Message from User ';
		
		$body ="From: $name\n E-Mail: $email\n Message:\n $message";

		// Check if name has been entered
		if (!$_POST['budget']) {
			$errName = 'Please enter your budget';
		}
		
		// Check if email has been entered and is valid
		if ( !$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errEmail = 'Please enter a valid email address';
		}
		
		//Check if message has been entered
		if (!$_POST['message']) {
			$errMessage = 'Please enter your message';
		}
		
// If there are no errors, send the email
if (!$errName && !$errEmail && !$errMessage) {
	if (mail ($to, $subject, $body, $from)) {
		$result='<div class="alert alert-success">Thank You! I will be in touch</div>';
	} else {
		$result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
	}
}
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Her's Job</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
  </head>
  <body>
  	<div class="container">
  		<div class="row">
  			<div class="col-md-6 col-md-offset-3">
  				<h1 class="page-header text-center">Herr's Job</h1>
				<form class="form-horizontal" role="form" method="post" action="index.php">
					<div class="form-group">
						<label for="budget" class="col-sm-2 control-label">Budget</label>
						<div class="col-sm-10">              
							<div class="col-sm-8">
                                <input type="text" class="form-control text-right" id="budget" name="budget" placeholder="Budget" value="<?php echo htmlspecialchars($_POST['budget']); ?>">
                                <?php echo "<p class='text-danger'>$errName</p>";?><span id="errmsg" class="text-danger"></span>
                            </div>         
                                <select class="selectpicker  col-sm-4" data-mobile="true">
                                    <option>Euro(€)</option>
                                    <option>Dollar($)</option>
                                    <option>other..</option>
                                </select>                    
						</div>
					</div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <div class="col-md-12">
                                <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($_POST['email']); ?>">
                                <?php echo "<p class='text-danger'>$errEmail</p>";?>
                            </div>
                        </div>
                    </div>
					<div class="form-group">
						<label for="message" class="col-sm-2 control-label">Message</label>
						<div class="col-sm-10">
                            <div class="col-md-12">
							    <textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($_POST['message']);?></textarea>
                                <?php echo "<p class='text-danger'>$errMessage</p>";?>
                            </div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
                            <div class="col-md-12">
							    <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
                            </div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<?php echo $result; ?>	
						</div>
					</div>
				</form> 
			</div>
		</div>
	</div>   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script type="text/javascript">
    $(document).ready(function () {
      //called when key is pressed in textbox
      $("#budget").keypress(function (e) {
         //if the letter is not digit then display error and don't type anything
         if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            $("#errmsg").html("Digits Only").show().fadeOut("slow");
                   return false;
        }
       });
       
       $('.selectpicker').selectpicker(); 
       $('.selectpicker').selectpicker({
          style: 'btn-info',
          size: 4
       });
    });
    </script>
  </body>
</html>
