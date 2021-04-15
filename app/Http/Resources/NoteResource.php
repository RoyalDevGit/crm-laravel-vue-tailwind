<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'file' => $this->file,
            'user' => new UserResource($this->user),
            'storage' => $this->storage,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
        ];
    }
}
