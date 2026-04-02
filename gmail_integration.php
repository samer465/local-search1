<?php

class GmailIntegration {
    private $smtpHost;
    private $smtpPort;
    private $username;
    private $password;

    public function __construct($host, $port, $username, $password) {
        $this->smtpHost = $host;
        $this->smtpPort = $port;
        $this->username = $username;
        $this->password = $password;
    }

    public function sendEmail($to, $subject, $body) {
        // Code to send email using SMTP configuration
        // Use PHPMailer or similar library
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $this->smtpHost;
        $mail->Port = $this->smtpPort;
        $mail->Username = $this->username;
        $mail->Password = $this->password;
        $mail->setFrom($this->username);
        $mail->addAddress($to);

        $mail->Subject = $subject;
        $mail->Body    = $body;

        if(!$mail->send()) {
            return false; // Email sending failed
        }
        return true; // Email sent successfully
    }

    public function verifyEmail($email) {
        // Regex for email verification
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function sendTemplatedEmail($to, $templateVars, $templatePath) {
        // Load template and replace variables
        $template = file_get_contents($templatePath);
        foreach ($templateVars as $key => $value) {
            $template = str_replace("{{{$key}}}", $value, $template);
        }

        return $this->sendEmail($to, 'Subject Here', $template);
    }
}
?>