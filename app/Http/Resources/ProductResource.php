<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'price' => $this->getPrice(),
            'stock' => $this->getStock(),
            'format' => $this->getFormat(),
            'type' => $this->getType(),
            'platform' => $this->getPlatform(),
            'category' => $this->getCategory()?->getName(),
            'url' => route('product.show', ['id' => $this->getId()]),
        ];
    }
}
