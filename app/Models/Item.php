<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    /**
     * ITEM ATTRIBUTES
     * $this->attributes['id'] - int - contains the item primary key (id)
     * $this->attributes['quantity'] - int - contains the number of units of the product
     * $this->attributes['unit_price'] - float - contains the product price at the moment of the purchase
     * $this->attributes['subtotal'] - float - contains quantity * unit price
     * $this->order - Order - contains the order the item belongs to
     * $this->product - Product - contains the product being purchased
     */
    protected $fillable = ['quantity', 'unit_price', 'subtotal', 'order_id', 'product_id'];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function getQuantity(): int
    {
        return (int) $this->attributes['quantity'];
    }

    public function setQuantity(int $quantity): void
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function getUnitPrice(): float
    {
        return (float) $this->attributes['unit_price'];
    }

    public function setUnitPrice(float $unitPrice): void
    {
        $this->attributes['unit_price'] = $unitPrice;
    }

    public function getSubtotal(): float
    {
        return (float) $this->attributes['subtotal'];
    }

    public function setSubtotal(float $subtotal): void
    {
        $this->attributes['subtotal'] = $subtotal;
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(Order $order): void
    {
        $this->order()->associate($order);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product()->associate($product);
    }

    /**
     * Calculates quantity * unit price, stores it in the subtotal and returns it.
     */
    public function calculateSubtotal(): float
    {
        $subtotal = $this->getQuantity() * $this->getUnitPrice();
        $this->setSubtotal($subtotal);

        return $subtotal;
    }
}
