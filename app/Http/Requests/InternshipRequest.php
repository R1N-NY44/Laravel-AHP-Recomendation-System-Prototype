<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InternshipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:20',
            'criteria.*.course' => 'required|integer|exists:courses,id_course',
            'criteria.*.weight' => [
                'required',        
                function ($attribute, $value, $fail) {

                    $criteria = collect($this->input("criteria"));                    
                    $parts = explode('.', $attribute);        
                    $currentIndex = (int) $parts[1];     
                    $lastindex = $criteria->keys()->last();                    
                    
                    $totalWeight = collect($this->input("criteria"))->sum('weight');                   

                    if ($totalWeight !== 100) {
                        if($currentIndex == $lastindex){
                            $fail("Total score must equal 100. Currently: $totalWeight.");
                        }
                    }
                }                       
            ],            
        ];
    }
}
