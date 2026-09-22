<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * User model.
 *
 * Attributes:
 * - id: int
 * - name: string
 * - email: string
 * - password: string
 * - address: string
 */
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user identifier.
     */
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    /**
     * Set the user identifier.
     */
    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    /**
     * Get the user name.
     */
    public function getName(): string
    {
        return $this->attributes['name'];
    }

    /**
     * Set the user name.
     */
    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    /**
     * Get the user email.
     */
    public function getEmail(): string
    {
        return $this->attributes['email'];
    }

    /**
     * Set the user email.
     */
    public function setEmail(string $email): void
    {
        $this->attributes['email'] = $email;
    }

    /**
     * Get the user password (hashed).
     */
    public function getPassword(): string
    {
        return $this->attributes['password'];
    }

    /**
     * Set the user password.
     */
    public function setPassword(string $password): void
    {
        $this->attributes['password'] = $password;
    }

    /**
     * Get the user address.
     */
    public function getAddress(): ?string
    {
        return $this->attributes['address'] ?? null;
    }

    /**
     * Set the user address.
     */
    public function setAddress(?string $address): void
    {
        $this->attributes['address'] = $address;
    }
}
