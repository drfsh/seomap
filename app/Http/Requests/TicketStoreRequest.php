<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['string', 'max:255','min:5'],
            'dep' => ['string', 'max:255'],
            'text' => ['string', 'max:5000'],
            'file' => ['file','nullable','max:100000'],
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'عنوان را وارد نمایید.',
            'title.string' => 'عنوان را وارد نمایید.',
            'title.min' => 'حداقل 5 کاراکتر!',
            'title.max' => 'حداکثر 255 کاراکتر!',
            'dep.required' => 'دپارتمان را انتخاب کنید',
            'dep.string' => 'دپارتمان را انتخاب کنید',
            'text.required' => 'متن تیکت را وارد کنید',
            'text.string' => 'متن تیکت را وارد کنید',
            'text.max' => 'حداکثر 5000 کاراکتر!',
            'file.max' => 'حداقل حجم فایل ۱۰۰ مگابایت',
        ];
    }
}
