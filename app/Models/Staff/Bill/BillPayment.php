<?php

namespace App\Models\Staff\Bill;

use App\Models\Staff\Currency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CreatedUpdatedBy;

class BillPayment extends Model
{
    use HasFactory, SoftDeletes, CreatedUpdatedBy;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'payment_method_id',
        'amount',
        'currency_id',
        'canceled_at',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'paymentMethod',
        'currency',
        'createdBy',
        'updatedBy'
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function isCanceled()
    {
        return $this->canceled_at != NULL;
    }

    public function setCanceledAt()
    {
        $this->canceled_at = now();
    }

    public function scopeNotCanceled($query)
    {
        return $query->whereNull('canceled_at');
    }
}
