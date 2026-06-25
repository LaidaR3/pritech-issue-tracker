<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateIssueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'project_id' => ['required', 'exists:projects,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['required'],
            'priority' => ['required'],
            'due_date' => ['nullable', 'date'],

            'tags' => ['nullable', 'array'],
            'tags.*' => ['exists:tags,id'],

            'users' => ['nullable', 'array'],
            'users.*' => ['exists:users,id'],
        ];
    }
}
