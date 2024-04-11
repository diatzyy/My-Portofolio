<?php
// Validasi input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi bahwa semua input yang dibutuhkan telah diterima
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
        // Replace contact@example.com with your real receiving email address
        $receiving_email_address = 'ditakurnia857@gmail.com';

        // Memeriksa apakah file library PHP Email Form tersedia
        $php_email_form = '../assets/vendor/php-email-form/php-email-form.php';
        if (file_exists($php_email_form)) {
            include($php_email_form);
        } else {
            die('Unable to load the "PHP Email Form" Library!');
        }

        // Membuat instance dari PHP_Email_Form
        $contact = new PHP_Email_Form;
        $contact->ajax = true;

        $contact->to = $receiving_email_address;
        $contact->from_name = $_POST['name'];
        $contact->from_email = $_POST['email'];
        $contact->subject = $_POST['subject'];

        // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
        /*
        $contact->smtp = array(
            'host' => 'example.com',
            'username' => 'example',
            'password' => 'pass',
            'port' => '587'
        );
        */

        // Menambahkan pesan
        $contact->add_message($_POST['name'], 'From');
        $contact->add_message($_POST['email'], 'Email');
        $contact->add_message($_POST['message'], 'Message', 10);

        // Mengirim email dan menampilkan hasilnya
        if ($contact->send()) {
            echo "Email has been sent successfully.";
        } else {
            echo "Failed to send email. Please try again later.";
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method.";
}
?>
