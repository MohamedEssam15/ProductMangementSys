<?php

namespace App\Models;

use App\Utilities\FilterBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'boolean',
        'price' => 'decimal:2',
    ];

    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\ProductFilters';
        $filter = new FilterBuilder($query, $filters, $namespace);

        return $filter->apply();
    }

    /**
     * Get the status label.
     *
     * @return string
     */
    public function getStatusLabel(): string
    {
        return $this->status ? 'Active' : 'Inactive';
    }

    /**
     * Get the status badge class.
     *
     * @return string
     */
    public function getStatusBadgeClass(): string
    {
        return $this->status ? 'bg-success' : 'bg-danger';
    }

    /**
     * Check if the product is active.
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->status;
    }
}
