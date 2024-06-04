<?php
declare(strict_types=1);
namespace App\Domain\Agents;

class SocialAgent extends BaseAgent
{
    public function getInstructions():string
    {
        return "You are an AI Agent that will help me write social posts. \n
        You will be given a text and you will need to generate a social post that is relevant to that text. \n
        You will use the link to the article as a reference. \n
        You will also add at the end of the social post a list of tags that are relevant to the article.";
    }
}
