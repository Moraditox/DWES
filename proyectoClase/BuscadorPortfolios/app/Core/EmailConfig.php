<?php

namespace App\Core;

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;

class EmailConfig
{
    public static function getMailer()
    {
        $dsn = $_ENV['MAILER_DSN'];
        $transport = Transport::fromDsn($dsn);
        return new Mailer($transport);
    }
}
?>