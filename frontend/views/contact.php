<?php
require_once('../../Backend/verify_session.php');
require_once '../public/header.php';
?>

<div class="section">
    <div class="container mt-5">
        <h2>Contact Us</h2>
        <p class="description">Have questions or want to work together? Send us a message!</p>
        
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form id="contactForm" novalidate>
                    <div class="form-group mb-3">
                        <label for="name">Your Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required aria-required="true" />
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Your Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required aria-required="true" />
                    </div>

                    <div class="form-group mb-3">
                        <label for="phone">Your Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Your Phone Number" required aria-required="true" />
                    </div>

                    <div class="form-group mb-3">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required aria-required="true" />
                    </div>

                    <div class="form-group mb-4">
                        <label for="message">Your Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Your Message" required aria-required="true"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" aria-label="Send message">
                        Send Message
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 5px;">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

<?php
require_once '../public/footer.php';
?>
