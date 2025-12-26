<?php
session_start();
$pageTitle = "Health Program Registration | HPB";
include('dbconnect.php');
include('nav.php'); 
$errors = [];
$success = false;
$events = [
    'mindfulness' => [
        'title' => 'Mindfulness Workshop',
        'date' => 'March 15'
    ],
    'yoga' => [
        'title' => 'Office Yoga Session',
        'date' => 'March 18'
    ]
];
// Initialize CSRF token if not exists
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
// Server-Side Validation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF Protection
    if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token'])) {
        die("CSRF token missing");
    }
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("CSRF token validation failed");
    }

    // Sanitize Inputs
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = preg_replace('/[^0-9]/', '', $_POST['phone']);
    $event = htmlspecialchars($_POST['event']);
    $newsletter = isset($_POST['newsletter']) ? 1 : 0;

    // Validation
    if (empty($name)) $errors[] = "Name is required";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format";
    if (!preg_match('/^\d{8,}$/', $phone)) $errors[] = "Invalid phone number";
    if (empty($event)) $errors[] = "Event selection is required";

    else {
        // Insert into database
        $stmt = $con->prepare("INSERT INTO users 
            (name, email, phone, event_id) 
            VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $event]);
        $success = true;
    }
}

// Generate CSRF Token
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>

<body class="body">
<div class="registration-container">
        <h1>Health Program Enrollment</h1>

        <?php if ($success): ?>
            <div class="success-message">
                ✅ Registration successful! Confirmation sent to <?= htmlspecialchars($email) ?>
            </div>
        <?php else: ?>
            <form id="registrationForm" method="POST" novalidate>
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                <!-- Personal Details Section -->
                <fieldset id="personal-details">
                    <legend>Personal Information</legend>
                    <div class="form-group">
                        <label for="name">Full Name:</label>
                        <input type="text" id="name" name="name" required
                               value="<?= htmlspecialchars($name ?? '') ?>">
                        <span class="error"></span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required
                               value="<?= htmlspecialchars($email ?? '') ?>">
                        <span class="error"></span>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="tel" id="phone" name="phone" required
                               pattern="[\d\s+]{8,}" 
                               value="<?= htmlspecialchars($phone ?? '') ?>">
                        <span class="error"></span>
                    </div>
                </fieldset>

                <!-- Event Selection Section -->
                <fieldset id="event-selection">
                    <legend>Program Selection</legend>
                    <div class="form-group checkbox-group">
                        <?php foreach ($events as $id => $event): ?>
                            <label>
                                <input type="radio" name="event" value="<?= $id ?>" 
                                       <?= ($_POST['event'] ?? '') == $id ? 'checked' : '' ?>>
                                <?= htmlspecialchars($event['title']) ?>
                                <span class="event-date"><?= $event['date'] ?></span>
                            </label>
                        <?php endforeach; ?>
                        <span class="error"></span>
                    </div>
                </fieldset>

                <!-- Preferences Section -->
                <fieldset id="preferences">
                    <legend>Preferences</legend>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="newsletter"
                                <?= isset($_POST['newsletter']) ? 'checked' : '' ?>>
                            Subscribe to Health Newsletter
                        </label>
                    </div>
                </fieldset>

                <?php if (!empty($errors)): ?>
                    <div class="error-list">
                        <?php foreach ($errors as $error): ?>
                            <div class="error">⚠️ <?= htmlspecialchars($error) ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <button type="submit" class="submit-btn">Complete Enrollment</button>
            </form>
        <?php endif; ?>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('registrationForm');
    const fields = {
        name: document.getElementById('name'),
        email: document.getElementById('email'),
        phone: document.getElementById('phone'),
        event: document.querySelectorAll('input[name="event"]')
    };

    // Real-time Validation
    Object.entries(fields).forEach(([name, element]) => {
        if (element instanceof NodeList) return;
        
        element.addEventListener('input', () => {
            validateField(element);
        });
    });

    // Form Submission Handler
    form.addEventListener('submit', (e) => {
        let isValid = true;
        
        // Validate Individual Fields
        isValid &= validateField(fields.name);
        isValid &= validateField(fields.email);
        isValid &= validateField(fields.phone);
        isValid &= validateEvents();

        if (!isValid) {
            e.preventDefault();
            showGlobalError('Please correct the highlighted errors');
        }
    });

    function validateField(field) {
        const error = field.parentElement.querySelector('.error');
        error.textContent = '';
        error.style.display = 'none';

        if (field.validity.valid) return true;

        if (field.validity.valueMissing) {
            error.textContent = 'This field is required';
        } else if (field.type === 'email') {
            error.textContent = 'Please enter a valid email address';
        } else if (field.id === 'phone') {
            error.textContent = 'Please enter at least 8 digits';
        }

        error.style.display = 'block';
        return false;
    }

    function validateEvents() {
        const error = document.querySelector('#event-selection .error');
        const checked = [...fields.event].some(radio => radio.checked);
        
        error.textContent = checked ? '' : 'Please select an event';
        error.style.display = checked ? 'none' : 'block';
        return checked;
    }
});
    </script>
</body>
<?php
include('footer.php');
?>