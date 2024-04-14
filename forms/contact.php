<?php
// Periksa jika formulir telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah semua input telah diisi
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
        // Ambil nilai dari formulir
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $subject = htmlspecialchars($_POST['subject']);
        $message = htmlspecialchars($_POST['message']);

        // Sesuaikan alamat email tujuan penerima formulir
        $to_email = "ditakurnia857@email.com";

        // Buat pesan email
        $email_message = "Nama: $name\n";
        $email_message .= "Email: $email\n";
        $email_message .= "Subjek: $subject\n";
        $email_message .= "Pesan:\n$message\n";

        // Set header email
        $headers = "From: $email" . "\r\n" .
                   "Reply-To: $email" . "\r\n" .
                   "X-Mailer: PHP/" . phpversion();

        // Kirim email
        if (mail($to_email, $subject, $email_message, $headers)) {
            echo '<div class="alert alert-success">Pesan kamu telah terkirim. Terima Kasih</div>';
        } else {
            echo '<div class="alert alert-danger">Maaf, ada kesalahan. Silakan coba lagi nanti.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Mohon lengkapi semua bidang formulir.</div>';
    }
}
?>
