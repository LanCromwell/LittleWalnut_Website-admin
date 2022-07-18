<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AudioUserResource extends JsonResource
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
            'title' => $this->title,
            'duration' => $this->duration,
            'language_name' => $this->language ? $this->language['name'] : '',
            'category_name' => $this->category ? $this->category['name'] : '',
            'type' => $this->type,
            'remind_date' => $this->remind_date,
            'search_content' => $this->search_content,
            'play_number' => $this->play_number,
            'collect_number' => $this->collect_number,
            'audio_path' => $this->audio_path,
        ];
    }
}
