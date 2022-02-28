<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;

class EmailServiec
{
    protected $phpmailer;

    public function __construct()
    {
        $this->phpmailer= new PHPMailer();
        $this->phpmailer->isSMTP();
        $this->phpmailer->Host = env('MAIL_HOST');;
        $this->phpmailer->SMTPAuth = env('MAIL_SMTPAUTH');
        $this->phpmailer->Port = env('MAIL_PORT');
        $this->phpmailer->Username = env('MAIL_USERNAME');
        $this->phpmailer->Password = env('MAIL_PASSWORD');
        $this->phpmailer->setFrom = env('MAIL_FROM_ADDRESS');
    }

    public function sendEmail($email, $subject, $body)
    {
        $this->phpmailer->addAddress($email);
        $this->phpmailer->isHTML(true);
        $this->phpmailer->Subject = $subject;
        $this->phpmailer->Body = $body;
       return $this->phpmailer->send();
    }

}
