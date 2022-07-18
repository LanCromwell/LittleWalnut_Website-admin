<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FrontUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'phone' => $this->phone,
            'child_birthday' => date('Y-m-d H:m:s', $this->child_birthday),
            'is_receive_vip' => $this->is_receive_vip ? '是' : '否',
            'detailed_location' => $this->detailed_location,
            'invitation_code' => $this->invitation_code,
            'phone_model' => $this->phone_model,
            'operator' => $this->operator,
            'add_time' => date('Y-m-d H:m:s', $this->add_time),
            'search_list' => implode(',', $this->UserSearchLogs->pluck('content')->unique()->all()),
            'listen_list' => implode(',', $this->UserListenAudioLogs->pluck('id')->unique()->all()),
            'collection_list' => implode(',', $this->userCollections->pluck('id')->unique()->all()),
            'role_name' => ($this->roles && isset($this->roles['name'])) ? $this->roles['name'] : '',
            'language_name' => $this->language ? $this->language['name'] : '',
        ];
    }
}
