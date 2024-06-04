<?php

namespace App\View;

use App\Data\DTO\Article;

class Template extends Article
{
    public function render(Article $article)
    {

        $title = $article->title;

        $content = $article->markdown;

        return view('template', [
            'title' => $title,
            "summary" => $article->summary,
            "image" => $article->banner,
            'content' => $content,
            'author' => $article->author,
            'tags' => $this->renderTags($article),
        ]);

    }


    private function renderTags(Article $article):string
    {
        $tags = $article->keywords;
        return implode(', ', $tags);
    }
}
