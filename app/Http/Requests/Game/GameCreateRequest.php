<?php

namespace App\Http\Requests\Game;

use App\Rules\LinkUserRule;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property string link_code
 */
class GameCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['link_code' => "array"])]
    public function rules(): array
    {
        return [
            'link_code' => [
                'required',
                Rule::exists('links', 'link_code')->where(function (Builder $query) {
                    $query->whereDate('created_at', '>', Carbon::now()->subDays(7));
                }),
                new LinkUserRule()
            ],
        ];
    }

    public function getLinkCode(): string
    {
        return $this->link_code;
    }
}
