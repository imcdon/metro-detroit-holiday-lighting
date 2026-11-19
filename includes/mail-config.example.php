<?php
declare(strict_types=1);

/**
 * Server only: copy to includes/mail-config.php on Reclaim (never commit the real file).
 * Used by contact/submit.php when PHPMailer is available (vendor/ in this repo).
 */
return [
  // Reclaim: use cPanel “Secure SSL/TLS Settings” SMTP host, usually mail.metrodetroitholidaylighting.com
    'smtp_host' => 'mail.metrodetroitholidaylighting.com',
    'smtp_port' => 587,
    'smtp_secure' => 'tls',
    'smtp_user' => 'noreply@metrodetroitholidaylighting.com',
    'smtp_pass' => 'your-cpanel-mailbox-password',
    'mail_from' => 'noreply@metrodetroitholidaylighting.com',
    'mail_from_name' => 'Metro Detroit Holiday Lighting',
];