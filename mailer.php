<?php

if(!defined('check')){exit;}

class Mailer
{
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
        if(is_null(self::$instance)){
            self::$instance=new Mailer();
        }

        return self::$instance;
    }


    //send mail
    public function sendMail($sendTo, $subject, $from='', $message, $cc=false, $files=false)
    {
        require_once 'Mailer/PHPMailer.php';
        require_once 'Mailer/Smtp.php';

        $email = new PHPMailer();

        $email->IsSMTP();

        $email->SMTPAuth = false;
        $email->SMTPAutoTLS = false; 

        /*
        $email->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true)
        );
        */



        $email->Host = SMTP_HOST;
        $email->Port = SMTP_PORT;
        $email->SMTPDebug = 4;
        //$email->SMTPSecure = SMTP_SECURE;
        $email->Username = SMTP_USERNAME;
        $email->Password = SMTP_PASS;
        $email->SetFrom($email->Username, SMTP_TITLE);

        if (is_array($sendTo) && !empty((array)$sendTo)) {
            foreach($sendTo as $to){
                $email->AddAddress($to, '');
            }
        }elseif(!empty($sendTo)){
            $email->AddAddress($sendTo, '');
        }

        if (is_array($cc) && !empty((array)$cc)) {
            foreach($cc as $c){
                $email->addCC($c, '');
            }
        }elseif(!empty($cc)){
            $email->addCC($cc, '');
        }

        if(is_array($files) && !empty((array)$files)){
            foreach($files as $file){
                $email->addAttachment($file);
            }
        }

        $email->CharSet = 'UTF-8';

        $email->Subject = $subject;

        $email_content =$message;

        $email->MsgHTML($email_content);


        return (!$email->Send()) ? (DEBUG) ? $email->ErrorInfo : false : true;
    }



    private static function getSrc(){
        return (defined('SITE_URL')) ? SITE_URL : BASE_URL;
    }
}