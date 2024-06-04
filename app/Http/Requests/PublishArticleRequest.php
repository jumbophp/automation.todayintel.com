<?php
declare(strict_types=1);
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $link
 */
class PublishArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required',
            'link' => 'required',
            'banner' => 'required',
            'summary' => 'required',
            'markdown' => 'required',
            'answer' => 'required',
            'workflow' => 'required',
        ];

    }
}
