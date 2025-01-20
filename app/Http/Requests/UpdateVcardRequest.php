<?php

namespace App\Http\Requests;

use App\Models\Vcard;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVcardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = Vcard::$rules;
        $rules['url_alias'] = $rules['url_alias'] . ',' . $this->route('vcard')->id;
        $rules['current_password'] = 'nullable|min:6';
        $rules['profile_img'] = 'mimes:jpg,bmp,png,apng,avif,jpeg,';
        $rules['cover_img'] = 'mimes:jpg,bmp,png,apng,avif,jpeg,mp4,mpeg,ogg,webm,3gp,mov,flv,avi,wmv,ts|max:10240';
        $rules['qr_code_download_size'] = ['numeric', 'in:100,200,300,400,500'];

        if ($this->input('location_type') == 0) {
            $rules['location_url'] =  'nullable|url';
        } else {
            $rules['iframe_content'] = 'nullable|string';
        }
        return $rules;
    }

    public function messages(): array
    {
        return [
            'url_alias.string' => __('messages.vcard.alias_url_required'),
            'name.string' => __('messages.vcard.vcard_name_required'),
            'url_alias.min' => __('messages.vcard.alias_url_min'),
            'url_alias.max' => __('messages.vcard.alias_url_max'),
            'url_alias.unique' => __('messages.vcard.alias_url_unique'),
            'occupation.string' => 'The occupation field is required.',
            'description.string' => ' The description field is required.',
            'first_name.string' => ('messages.vcard.first_name_required'),
            'last_name.string' => ('messages.vcard.last_name_required'),
            'is_paid' => __('messages.vcard.is_paid'),
            'cover_img.max' => __('messages.vcard.cover_img_max'),
        ];
    }
}
