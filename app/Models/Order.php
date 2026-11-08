<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /**
     * ORDER ATTRIBUTES
     * $this->attributes['id'] - int - contains the order primary key (id)
     * $this->attributes['code'] - string - contains the unique order code
     * $this->attributes['date'] - date - contains the date the order was placed
     * $this->attributes['status'] - string - contains the order status ("Pendiente" or "Pagado")
     * $this->attributes['total'] - float - contains the total amount of the order
     * $this->user - User - contains the user who placed the order
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
}
