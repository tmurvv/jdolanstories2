<?php
    include 'config.php';
    
    if (isset($_POST['submit'])) {
        $result = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['g-recaptcha-response'])) {
                
            // Build POST request:
            $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptchaSecretKey = "6LeoRpMUAAAAADkbw8MI_ihoZX4akfg6twRiSD6I";
            $recaptcha_response = $_POST['g-recaptcha-response'];
        
            // Make and decode POST request: $recaptchaSecretKey from config.php file
            $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptchaSecretKey . '&response=' . $recaptcha_response);
            $recaptcha = json_decode($recaptcha);

            // Take action based on the score returned:
            if (isset($recaptcha->score) && $recaptcha->score >= 0.5) {
                // Verified - send email
                
                $inputName = $_POST['name'];
                $inputEmail = $_POST['email'];
                $inputPhone = $_POST['phone'];
                $inputMessage = $_POST['message'];
        
                $mail_body = '<html>
                <body style="font-family: Arial, Helvetica, sans-serif;
                                    line-height:1.8em;">
                <p>Hello '.$siteEmailRecipient.', <br> A message with the following information was sent via the contact form on the J.Dolan Stories website:</p>
                <p>Name: '.$inputName.'<br>
                Email: '.$inputEmail.'<br>
                Phone: '.$inputPhone.'<br>
                Message: '.$inputMessage.'<br>
                <br>
                Have a nice day!<br>
                J.Dolan Stories
                </p>
                </body>
                </html>';
            
                $subject = "Message from jdolanstories.com contact form";
                $headers = "From: jdolanstories.com" . "\r\n";
                $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                
                //Error Handling for PHPMailer
                if(!mail($email, $subject, $mail_body, $headers)){
                    $result = "Email failed to send.";
                }
                else{
                    $result = "Email sent!";
                }
                       
            } else {
                // Not verified - show form error
                $result = 'Form failed to send. Please call or message Ron at 503-240-7144.';
            }      
        }
    }    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google reCaptcha -->
    <script src="https://www.google.com/recaptcha/api.js?render=6LeoRpMUAAAAAEGwl3c_kDlGgFl9t1LzOm4ECVe0"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LeoRpMUAAAAAEGwl3c_kDlGgFl9t1LzOm4ECVe0', {action: 'homepage'}).then(function(token) {
                // pass the token to the backend script for verification

                // add token value to form for PHP verification
                document.getElementById('g-recaptcha-response').value = token;
            });
        });
    </script>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Tangerine:100,300,300i,400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:100,300,300i,400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <title>J--Dolan-Stories-Contact</title>
</head>
<body>
    <div class="contact">
        <div class="contact__image">
            <img class="hardImage" src="img/JDolanStories__guitarNeckStylish.jpg" alt="Stylish man with guitar">
            <div class="homeButton"><a href="index.html">&larr;Back</a></div>           
            <div class="contact__text">
                <p>J. Dolan Stories provides unique engaging musical programs and/or welcoming ambient background music for events, parties and other occasions. We can make your gathering special!</p>
            </div>                    
            <div class="contact__form">
                <form action="contact.php" name='submit' method="post" id='recaptchaForm'>
                    <div class="contact__form--title">
                        <?php if(isset($result)) {echo $result.'<br>'; unset($result);} else {echo '<p>Contact Us</p>';} ?> 
                    </div>
                    
                    <div class="contact__form--userInputs">
                        <div class="contact__form--userInputs-item">
                            <label for="name">Name:</label>
                            <input type="text" name='name'>
                        </div>
                        <div class="contact__form--userInputs-item">
                            <label for="email">Email:</label>
                            <input type="email" name='email'>
                        </div>
                        <div class="contact__form--userInputs-item">
                            <label for="phone">Phone:</label>
                            <input type="text" name='phone' placeholder='optional'><br>
                        </div>
                        <label for="message">Message:</label>
                        <textarea rows="6" name="message"></textarea><br>
                        <!-- reCaptcha fields -->
                        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                        <input type="hidden" name="action" value="validate_captcha">
                        <!-- end reCaptcha fields -->
                        <button type='submit' name='submit'>Submit</button>
                    </div>
                </form>
            </div>        
            <div class="contact__phone">
                <p>
                    Or contact Ron<br>at 503-240-7144
                </p> 
            </div>
        </div>           
    </div>
</body>
</html>