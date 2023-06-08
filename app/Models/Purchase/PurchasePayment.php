<?php

namespace App\Models\Purchase;

use App\Models\Currency;
use App\Models\PaymentMethod;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasePayment extends Model
{
    use HasFactory, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'currency_id',
        'payment_method_id',
        'paid_at',
        'amount',
        'comments',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'currency',
        'method'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'paid_at' => 'datetime',
    ];

    /**
     * Fields that can be filtered
     *
     * @var array
     */
    private static $whiteListFilter = [
        'currency_id',
        'payment_method_id',
        'paid_at',
        'amount',
        'comments',
        'created_at',
        'updated_at',
    ];

    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    public function paymentMethod() {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function method() {
        return $this->paymentMethod();
    }
}
