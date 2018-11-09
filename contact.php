<?php
    if (isset($_POST['submit'])) {
        echo "send email";
        return;
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

</head>
<body>
    <div class="contact">
        <div class="contact__text">
            <p>J. Dolan Stories provides unique engaging musical programs and/or welcoming ambient background music for events, parties and other occasions. We can make your gathering special!</p>
        </div>        
        
        <div class="contact__form">
            <form action="contact.php" name='submit' type="post">
                <div class="contact__form--title">
                    <p>Contact Us</p>
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
                    <textarea rows="5"></textarea><br>
                    <!-- NOT YET IMPLEMENTED ADD reCaptcha -->
                    <br>
                    <br>
                    <br>
                    <br>
                    <button type="submit">Submit</button>
                    
                </div>
            </form>
        </div>
       
        <div class="contact__phone">
            <p>
                Or contact Ron<br>at 503-240-7144
            </p>
        </div>
            
    </div>

</body>
</html>