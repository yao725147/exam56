<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('建立測驗');
        //return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'topic' => 'required|max:191',
            'opt1'  => 'required|max:191',
            'opt2'  => 'required|max:191',
            'ans'   => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'topic' => '題目',
            'opt1'  => '選項1',
            'opt2'  => '選項2',
            'ans'   => '答案',
        ];
    }
}
