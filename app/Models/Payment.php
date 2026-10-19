<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    public const METHODS = ['Tarjeta', 'PSE', 'Transferencia', 'Efectivo'];

    public const STATUS_PENDING = 'Pendiente';

    public const STATUS_COMPLETED = 'Completado';

    public const STATUS_FAILED = 'Fallido';

    /**
     * PAYMENT ATTRIBUTES
     * $this->attributes['id'] - int - contains the payment primary key (id)
     * $this->attributes['method'] - string - contains the payment method chosen by the user
     * $this->attributes['amount'] - float - contains the amount paid (always the order total)
     * $this->attributes['date'] - date - contains the date the payment was registered
     * $this->attributes['status'] - string - contains the payment status ("Pendiente", "Completado" or "Fallido")
     * $this->order - Order - contains the order being paid
     * $this->user - User - contains the user who made the payment
     */
    protected $fillable = ['method', 'amount', 'date', 'status', 'order_id', 'user_id'];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function getMethod(): string
    {
        return $this->attributes['method'];
    }

    public function setMethod(string $method): void
    {
        $this->attributes['method'] = $method;
    }

    public function getAmount(): float
    {
        return (float) $this->attributes['amount'];
    }

    public function setAmount(float $amount): void
    {
        $this->attributes['amount'] = $amount;
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
}
