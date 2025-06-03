<?php
require_once '../public/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Contact Us</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.png">
    <link rel="stylesheet" href="../css/style.css">
    <link href='../css/boxicons/boxicons.css' rel='stylesheet'>
    <link href='../css/fonts/boxicons.ttf' rel='stylesheet'>
    <link href='../css/fonts/boxicons.woff' rel='stylesheet'>
    <link href='../css/fonts/boxicons.woff2' rel='stylesheet'>

    <!-- Email Js Message -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script type="text/javascript">
        (function(){
            emailjs.init("eiO0nlVyEDy1_OzEx"); // Initialize EmailJS with your public key
        })();
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        .contact-container {
            background-color: #fff;
            border-radius: 12px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            padding: 40px 30px;
            box-sizing: border-box;
            margin: auto;
            margin-top: 50px; /* Space from the top */
            margin-bottom: 20px; /* Added margin at the bottom */
            animation: fadeInScale 0.6s ease forwards;
        }

        @keyframes fadeInScale {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .contact-container h2 {
            margin: 0 0 20px 0;
            font-weight: 700;
            font-size: 2.5rem;
            color: #D10024;
            text-align: center;
            letter-spacing: 1.5px;
        }

        .contact-container p.description {
            text-align: center;
            margin-bottom: 35px;
            color: black;
            font-weight: 500;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        textarea {
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 14px 18px;
            font-size: 1rem;
            resize: none;
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        textarea:focus {
            outline: none;
            border-color: #764ba2;
            box-shadow: 0 0 6px rgba(118, 75, 162, 0.6);
        }

        textarea {
            min-height: 140px;
        }

        button {
            background: #D10024;
            color: #fff;
            font-weight: 700;
            padding: 15px;
            border: none;
            border-radius: 10px;
            font-size: 1.15rem;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1.4px;
            transition: background 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        button:hover {
            background: #5a3676;
        }

        .success-message, .error-message {
            text-align: center;
            font-weight: 600;
            margin-top: 10px;
            border-radius: 8px;
            padding: 10px;
            display: none;
        }

        .success-message {
            background: #daf5d7;
            color: #2b7a2b;
            border: 1.5px solid #2b7a2b;
        }

        .error-message {
            background: #f9d6d5;
            color: #b83b3b;
            border: 1.5px solid #b83b3b;
        }

        footer {
            background-color: #4a3f94;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto; /* Push footer to the bottom */
        }
    </style>
</head>
<body>
    <section class="contact-container" aria-label="Contact form">
        <h2>Contact Us</h2>
        <p class="description">Have questions or want to work together? Send us a message!</p>
        <form id="contactForm" novalidate>
            <input type="text" id="name" name="name" placeholder="Your Name" required aria-required="true" />
            <input type="email" id="email" name="email" placeholder="Your Email" required aria-required="true" />
            <input type="tel" id="phone" name="phone" placeholder="Your Phone Number" required aria-required="true" />
            <input type="text" id="subject" name="subject" placeholder="Subject" required aria-required="true" />
            <textarea id="message" name="message" placeholder="Your Message" required aria-required="true"></textarea>
            <button type="submit" aria-label="Send message">Send Message <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg></button>
        </form>
        <div class="success-message" role="alert" aria-live="polite"></div>
        <div class="error-message" role="alert" aria-live="polite"></div>
    </section>
</body>
</html>

<?php
require_once '../public/footer.php';
?>
