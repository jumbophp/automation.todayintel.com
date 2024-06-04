<?php
declare(strict_types=1);
namespace App\Domain\Automation;

use App\Domain\Agents\BaseAgent;
use Spatie\LaravelData\Data;


interface GumboAI
{
    public function getAnswer(BaseAgent $agent):Data;
}
