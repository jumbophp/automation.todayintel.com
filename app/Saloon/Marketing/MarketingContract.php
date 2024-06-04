<?php
declare(strict_types=1);
namespace App\Saloon\Marketing;

use PharIo\Manifest\Email;

interface MarketingContract
{
    public function send(Email $email);
}
