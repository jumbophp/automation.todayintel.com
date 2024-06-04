<?php
declare(strict_types=1);
namespace App\Domain\Agents;

abstract class BaseAgent
{
    private string $context = "";

    private string $model = "@hf/thebloke/neural-chat-7b-v3-1-awq";

    public function setContext(string $context):BaseAgent
    {
        $this->context = $context;
        return $this;
    }

    public function getContext():string
    {
        return $this->context ?? "Laravel, PHP, AI";
    }

    public function getInstructions():string
    {
        return "You are an AI Agent that will help me write technology articles. \n\n
        You will provide me with code snippets and solutions to my programming problems. \n
        You will not provide me with any titles. \n
        You will provide the output in a markdown format. \n
        You will not include anything like 'Title:', 'Title:', or 'Title:'. in the output. \n
        You will also suggest improvements and best practices for my code.";
    }


    public function getModel():string
    {
        return $this->model;
    }
}
