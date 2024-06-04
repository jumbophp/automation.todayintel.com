<?php

namespace App\Data\DTO;

use Spatie\LaravelData\Data;

class Email extends Data
{
    public string $subject;
    public string $message;
}
