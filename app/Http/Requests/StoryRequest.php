<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoryRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $story_id = $this->route('story.id');
        return [
            'title' => [ 'required','min:10','max:50','unique:stories,title,'.$story_id,function($attribute,$value,$fail){
                if($value == "Dummy Title"){
                    $fail($attribute." is not valid");
                }
            }],
            'body' => ['required','min:50'],
            'type' => 'required',
            'status' => 'required',
        ];

    }
    public function withValidator($v){
        $v->sometimes('body','max:200',function($input){
            return  'short' == $input->type;
        });
    }
    public function messages()
{
    return [
        'title.required' => 'Please Enter Title',
        'required' => 'Please Enter something for :attribute',
    ];
}
}
