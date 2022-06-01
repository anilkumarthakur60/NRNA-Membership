<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'street_address' => $this->street_address,
            'apartment' => $this->apartment,
            'city' => $this->city,
            'provience' => $this->provience,
            'zip_code' => $this->zip_code,
            'country' => $this->country,
            'status' => $this->status,
            'total' => $this->total,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'profession' => $this->profession,
            'dob' => $this->dob?date('jS F Y',(int)$this->dob):null,
            'highest_degree' => $this->highest_degree,
            'area_of_expertise' => $this->area_of_expertise,
            'year_of_experience' => $this->year_of_experience,
            'referal_code' => $this->referal_code,
            'created_at'=>date('Y-m-d , H:m', strtotime($this->created_at)),
            'image'=>$this->image?asset('/storage/'.$this->image):null,
            'skills'=>$this->skills
        ];
    }
}
