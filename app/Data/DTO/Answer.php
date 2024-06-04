<?php
declare(strict_types=1);
namespace App\DTO;

namespace App\Data\DTO;

use Spatie\LaravelData\Data;

class Answer extends Data
{
    public string $response;
    public bool $success;
    public array $errors;
    public array $messages;
}
