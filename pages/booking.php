<?php
// booking.php

// Start session
session_start();

// Include database connection
include('db_connection.php');

// Function to validate form data
function validateInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Initialize variables
$guestName = '';
$guestEmail = '';
$error = '';
$paymentMethod = '';

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $guestName = validateInput($_POST['guest_name']);
    $guestEmail = validateInput($_POST['guest_email']);
    $paymentMethod = validateInput($_POST['payment_method']);

    // Basic form validation
    if (empty($guestName) || empty($guestEmail) || empty($paymentMethod)) {
        $error = 'All fields are required.';
    } elseif (!filter_var($guestEmail, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format.';
    } else {
        // Assume successful booking process
        // Implement payment processing logic here
        $_SESSION['success'] = 'Booking successful!';
        header('Location: confirmation.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
</head>
<body>
    <h1>Booking Form</h1>
    <?php if ($error) echo '<p style="color:red;">'.$error.'</p>'; ?>
    <form action="" method="post">
        <label for="guest_name">Full Name:</label><br>
        <input type="text" id="guest_name" name="guest_name" value="<?php echo $guestName; ?>" required><br><br>
        <label for="guest_email">Email:</label><br>
        <input type="email" id="guest_email" name="guest_email" value="<?php echo $guestEmail; ?>" required><br><br>
        <label>Payment Method:</label><br>
        <input type="radio" id="credit_card" name="payment_method" value="Credit Card" required>
        <label for="credit_card">Credit Card</label><br>
        <input type="radio" id="debit_card" name="payment_method" value="Debit Card">
        <label for="debit_card">Debit Card</label><br>
        <input type="radio" id="bank_transfer" name="payment_method" value="Bank Transfer">
        <label for="bank_transfer">Bank Transfer</label><br><br>
        <input type="submit" value="Book Now">
    </form>
</body>
</html>