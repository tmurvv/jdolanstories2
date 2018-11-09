<?php
    include 'config.php';
    if (isset($_POST['submit'])) {
        $inputName = $_POST['name'];
        $inputEmail = $_POST['email'];
        $inputPhone = $_POST['phone'];
        $inputMessage = $_POST['message'];

        $mail_body = '<html>
        <body style="font-family: Arial, Helvetica, sans-serif;
                            line-height:1.8em;">
        <p>Hello '.$siteEmailRecipient.', <br> A message was sent with the contact form on the J.Dolan Stories website with the following information:</p>
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
    }
?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Tangerine:100,300,300i,400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:100,300,300i,400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab" rel="stylesheet">
    <!-- <link rel="shortcut icon" type="image/png" href="img/favicon.png"> -->
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js\jquery.waypoints.min.js"></script>
    <script type="text/javascript" src="js\script.js"></script> -->

    <title>J--Dolan-Stories-Contact</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
    function onSubmit(token) {
        document.getElementById("recaptchaForm").submit();
    }
    </script>

</head>
<body>
    <div class="contact">
        <div class="contact__image">
            <img src="img/JDolanStories__guitarNeckStylish.jpg" alt="Stylish man with guitar">
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
                        <textarea rows="5" name="message"></textarea><br>
                        <!-- NOT YET IMPLEMENTED ADD reCaptcha -->
                        <br>
                        <br>
                        <button type='submit' name='submit'>Submit</button>
                        <!-- <button class="g-recapcha" data-sitekey="6LehxnkUAAAAAGiCqV1QGyupkGG6bufS3xi7aB5S" data-callback='onSubmit'>Submit</button>                         -->
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