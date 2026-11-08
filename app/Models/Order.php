<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    public const STATUS_PENDING = 'Pendiente';

    public const STATUS_PAID = 'Pagado';

    public const STATUS_CANCELLED = 'Cancelado';

    /**
     * ORDER ATTRIBUTES
     * $this->attributes['id'] - int - contains the order primary key (id)
     * $this->attributes['code'] - string - contains the unique order code
     * $this->attributes['date'] - date - contains the date the order was placed
     * $this->attributes['status'] - string - contains the order status ("Pendiente", "Pagado" or "Cancelado")
     * $this->attributes['total'] - float - contains the total amount of the order
     * $this->user - User - contains the user who placed the order
     * $this->items - Item[] - contains the products included in the order
     * $this->payments - Payment[] - contains the payments registered for the order
     */
    protected $fillable = ['code', 'date', 'status', 'total', 'user_id'];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function getCode(): string
    {
        return $this->attributes['code'];
    }

    public function setCode(string $code): void
    {
        $this->attributes['code'] = $code;
    }

    public function getDate(): Carbon
    {
        return Carbon::parse($this->attributes['date']);
    }

    public function setDate(string $date): void
    {
        $this->attributes['date'] = $date;
    }

    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function setStatus(string $status): void
    {
        $this->attributes['status'] = $status;
    }

    public function getTotal(): float
    {
        return (float) $this->attributes['total'];
    }

    public function setTotal(float $total): void
    {
        $this->attributes['total'] = $total;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user()->associate($user);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function getItems(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->items;
    }

    /**
     * An order can be cancelled while it is pending and has no payment in progress or completed.
     */
    public function canBeCancelled(): bool
    {
        return $this->getStatus() === self::STATUS_PENDING
            && ! $this->payments()
                ->whereIn('status', [Payment::STATUS_PENDING, Payment::STATUS_COMPLETED])
                ->exists();
    }

    /**
     * Cancel the order and give the reserved stock back to the products.
     */
    public function cancel(): bool
    {
        return DB::transaction(function () {
            $order = self::lockForUpdate()->findOrFail($this->getId());

            if (! $order->canBeCancelled()) {
                return false;
            }

            foreach ($order->items()->get() as $item) {
                if ($item->product_id !== null) {
                    Product::where('id', $item->product_id)->increment('stock', $item->getQuantity());
                }
            }

            $order->setStatus(self::STATUS_CANCELLED);
            $order->save();

            return true;
        });
    }
}
