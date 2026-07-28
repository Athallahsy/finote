<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')->where(function ($query) {
                    $query->where('user_id', Auth::id());
                }),
            ],
            'jumlah'     => 'required|numeric|gt:0',
            'judul'      => 'required|string|max:255',
            'jenis'      => 'required|in:income,expense',
            'keterangan' => 'nullable|string',
            'tanggal'    => 'required|date',
        ];
    }
}
