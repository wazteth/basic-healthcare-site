<?php
// contact.php
$pageTitle = "Contact Us - HPB";
include('nav.php');
?>
<body class="body">

<div class="main-container" style="display: block">
    <h1>Contact Health Promotion Board</h1>
    
    <div class="contact-section">
        <form id="contactForm" class="contact-form">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required 
                       minlength="2" maxlength="50">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" required
                       minlength="5" maxlength="100">
            </div>

            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="6" required
                          minlength="10" maxlength="500"></textarea>
            </div>

            <button type="submit" class="submit-btn">Send Message</button>
        </form>

        <div class="contact-info">
            <h2>Other Contact Methods</h2>
            <p>Health Promotion Board</p>
            <p>Email: contact@hpb.gov.sg</p>
            <p>Phone: +65 1234 5678</p>
            <p>Address: 3 Second Hospital Avenue, Singapore 168937</p>
        </div>
    </div>
</div>
</body>
<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (validateForm()) {
        // Simulate successful submission
        window.location.href = 'thank-you.html';
    }
});

function validateForm() {
    const email = document.getElementById('email');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (!emailRegex.test(email.value)) {
        alert('Please enter a valid email address');
        return false;
    }
    
    return true;
}
</script>
<?php include('footer.php'); ?>