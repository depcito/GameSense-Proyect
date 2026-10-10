<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    /**
     * PRODUCT ATTRIBUTES
     * $this->attributes['id'] - int - contains the product primary key (id)
     * $this->attributes['title'] - string - contains the product title
     * $this->attributes['description'] - string - contains the product description
     * $this->attributes['price'] - float - contains the product price
     * $this->attributes['stock'] - int - contains the available product stock
     * $this->attributes['format'] - string - contains the product format
     * $this->attributes['type'] - string - contains the product type
     * $this->attributes['platform'] - string - contains the product platform
     * $this->category - Category - contains the category associated with the product
     */

    protected $fillable = ['title','description','price','stock','format','type','platform','category_id',];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function getTitle(): string
    {
        return $this->attributes['title'];
    }

    public function setTitle(string $title): void
    {
        $this->attributes['title'] = $title;
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function getPrice(): float
    {
        return (float) $this->attributes['price'];
    }

    public function setPrice(float $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function getStock(): int
    {
        return $this->attributes['stock'];
    }

    public function setStock(int $stock): void
    {
        $this->attributes['stock'] = $stock;
    }

    public function getFormat(): string
    {
        return $this->attributes['format'];
    }

    public function setFormat(string $format): void
    {
        $this->attributes['format'] = $format;
    }

    public function getType(): string
    {
        return $this->attributes['type'];
    }

    public function setType(string $type): void
    {
        $this->attributes['type'] = $type;
    }

    public function getPlatform(): string
    {
        return $this->attributes['platform'];
    }

    public function setPlatform(string $platform): void
    {
        $this->attributes['platform'] = $platform;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): void
    {
        $this->category()->associate($category);
    }
}
