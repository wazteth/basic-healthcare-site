<?php
$pageTitle = "Events and Activities";
include('nav.php');
// PHP Form Processing
$formFeedback = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $event = htmlspecialchars(trim($_POST['event']));

    if (empty($name) || empty($email) || empty($event)) {
        $formFeedback = '<p class="error">Please fill all required fields</p>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $formFeedback = '<p class="error">Invalid email format</p>';
    } else {
        // Process registration (simulated)
        $formFeedback = '<p class="success">Registration successful! Check your email for confirmation</p>';
    }
}
?>
<body class="body">
<div class="events-container">
    <h1 class="page-title">Weekly Health & Wellness Events</h1>

    <!-- Interactive Calendar Table -->
    <div class="calendar-table" role="region" aria-labelledby="calendarCaption">
        <table class="responsive-table">
            <caption id="calendarCaption" class="sr-only">Monthly Event Calendar</caption>
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Event</th>
                    <th scope="col">Venue</th>
                </tr>
            </thead>
            <tbody class="tbody">
                <tr data-event="mindfulness">
                    <td>March 15</td>
                    <td>10:00 AM</td>
                    <td><a href="#mindfulness-details" class="event-link">Mindfulness Workshop</a></td>
                    <td>HPB Auditorium</td>
                </tr>
                <tr data-event="yoga">
                    <td>March 18</td>
                    <td>3:00 PM</td>
                    <td><a href="#yoga-details" class="event-link">Office Yoga Session</a></td>
                    <td>Community Center</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Event Details Sections -->
    <section class="event-details" id="mindfulness-details" style="padding: 10px;">
        <h2>Mindfulness Workshop Details</h2>
        <div class="detail-card">
            <p><strong>Date:</strong> March 15 | <strong>Time:</strong> 10:00 AM - 12:00 PM</p>
            <p>Learn practical stress management techniques from certified professionals...</p>
        </div>
    </section>

    <section class="event-details" id="yoga-details" style="padding: 10px;margin-bottom: 18vh;">
        <h2>Office Yoga Session Details</h2>
        <div class="detail-card">
            <p><strong>Date:</strong> March 18 | <strong>Time:</strong> 3:00 PM - 4:30 PM</p>
            <p>Guided stretching and relaxation exercises specifically for desk workers...</p>
        </div>
    </section>

    <!-- Enhanced RSVP Form -->
    
</div>
<script>
// Enhanced Validation & Smooth Scroll
document.addEventListener('DOMContentLoaded', () => {
    // Form Validation
    const form = document.getElementById('eventRegistration');
    form.addEventListener('submit', (e) => {
        const email = form.querySelector('#email');
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
            e.preventDefault();
            alert('Please enter a valid email address');
            email.focus();
        }
    });

    // Smooth Scroll to Event Details
    document.querySelectorAll('.event-link').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const target = document.querySelector(link.getAttribute('href'));
            target.scrollIntoView({ behavior: 'smooth' });
            target.classList.add('highlight');
            setTimeout(() => target.classList.remove('highlight'), 2000);
        });
    });
});
</script>

<?php
include('footer.php');
?>

