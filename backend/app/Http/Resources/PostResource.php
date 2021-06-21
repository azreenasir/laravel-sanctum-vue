<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'category' => $this->category->name,
            'body' => $this->body,
            'id' => $this->id,
            'categoryId' => $this->category->id,
            'published' => $this->created_at->format('d F, Y'),
            'link' => route('post.show', $this->slug)
        ];
    }
}
