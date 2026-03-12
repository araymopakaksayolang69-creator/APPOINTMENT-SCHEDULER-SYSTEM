<?php

class MailService {
    private $mailer;

    public function __construct() {
        $this->setupMailer();
    }

    private function setupMailer() {
        $this->mailer = new PHPMailer\PHPMailer\PHPMailer();
        $this->mailer->isSMTP();
        $this->mailer->Host       = 'smtp.gmail.com';
        $this->mailer->SMTPAuth   = true;
        $this->mailer->Username   = 'your-email@gmail.com'; // Your Gmail address
        $this->mailer->Password   = 'your-email-password'; // Your Gmail password
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port       = 587;
    }

    public function sendBookingConfirmation($toEmail, $bookingDetails) {
        $this->mailer->setFrom('from-email@gmail.com', 'Booking Confirmation');
        $this->mailer->addAddress($toEmail);
        $this->mailer->Subject = 'Booking Confirmation';
        $this->mailer->Body    = 'Your booking details: ' . $bookingDetails;

        return $this->mailer->send();
    }

    public function sendReservationConfirmation($toEmail, $reservationDetails) {
        $this->mailer->setFrom('from-email@gmail.com', 'Reservation Confirmation');
        $this->mailer->addAddress($toEmail);
        $this->mailer->Subject = 'Reservation Confirmation';
        $this->mailer->Body    = 'Your reservation details: ' . $reservationDetails;

        return $this->mailer->send();
    }

    public function sendResortNotification($toEmail, $notification) {
        $this->mailer->setFrom('from-email@gmail.com', 'Resort Notification');
        $this->mailer->addAddress($toEmail);
        $this->mailer->Subject = 'Notification from Resort';
        $this->mailer->Body    = $notification;

        return $this->mailer->send();
    }
}

?>