<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

/**
 * CATEGORY ATTRIBUTES
 * $this->attributes['id'] - int - contains the category primary key (id)
 * $this->attributes['name'] - string - contains the category name
 * $this->attributes['description'] - string - contains the category description
 * $this->products - Product[] - contains the associated products
 * $this->attributes['created_at'] - datetime - contains the category creation date
 * $this->attributes['updated_at'] - datetime - contains the category last update date
 * $this->attributes['image'] - string|null - contains the category image path
 */


    protected $fillable = ['name', 'description', 'image'];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getProducts(): Collection
    {
            return $this->products;
    }

    public function setProducts(Collection $products): void
    {
        $this->products = $products;
    }
    public function getImage(): ?string
    {
        return $this->attributes['image'] ?? null;
    }

    public function setImage(?string $image): void
    {
        $this->attributes['image'] = $image;
    }

    public function getImageUrl(): ?string
    {
        if (!$this->getImage()) {
            return null;
        }

        return 'https://storage.googleapis.com/'. config('services.gcp.bucket'). '/' . $this->getImage();
}
}