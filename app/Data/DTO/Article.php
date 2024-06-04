<?php
declare(strict_types=1);
namespace App\Data\DTO;

use Spatie\LaravelData\Data;

class Article extends Data
{
    public ?string $title;
    public ?string $link;
    public ?string $text;
    public ?string $summary;
    public ?string $markdown;
    public ?string $banner;
    public ?array $keywords;
    public ?array $sentiment;
}
