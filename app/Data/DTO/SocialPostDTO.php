<?php

namespace App\Data\DTO;

use Spatie\LaravelData\Data;

class SocialPostDTO extends Data
{

    public string $message;

    public ?string $link;

    public ?string $image;
}
