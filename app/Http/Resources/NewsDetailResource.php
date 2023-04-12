<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'image' => $this->image,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'writer' => $this->whenLoaded('writer'),
            'kategori' => $this->whenLoaded('kategori'),
        ];
    }
}
