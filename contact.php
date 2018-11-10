<?php
    include 'config.php';
    
    if (isset($_POST['submit'])) {
        $result = '';
        $recaptchaArray = ['secret' => $recaptchaSecretKey,
        'response' => $_POST['g-recaptcha-response']
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($recaptchaArray));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($curl));
        curl_close($curl);
      
        if (isset($response->success) && !$response->success == true) {
            $result = 'ReCaptcha validation failed.';
        }

        if (isset($result) && !$result == 'ReCaptcha validation failed.') {
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
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <title>J--Dolan-Stories-Contact</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
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
                        <textarea rows="4" name="message"></textarea><br>
                        <div class="g-recaptcha" data-sitekey="6Lf1y3kUAAAAACBVkJy0qvEDExyorBtUyurg4yga"></div>
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