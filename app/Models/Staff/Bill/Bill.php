<?php

namespace App\Models\Staff\Bill;

use App\Models\Staff\Business\Business;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CreatedUpdatedBy;
use Carbon\Carbon;
use App\Scopes\Staff\BillScope;
use App\Models\Staff\Currency;

class Bill extends Model
{
    use HasFactory, SoftDeletes, CreatedUpdatedBy;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'business_id',
        'bill_status_id',
        'currency_id',
        'billed_at',
        'expires_at',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'billStatus',
        'currency',
        'business',
        'services',
        'payments',
        'createdBy',
        'updatedBy'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'billed_at' => 'datetime',
        'expires_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new BillScope);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function billStatus()
    {
        return $this->belongsTo(BillStatus::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function billServices() {
        return $this->hasMany(BillService::class);
    }

    public function services() {
        return $this->billServices();
    }

    public function payments()
    {
        return $this->hasMany(BillPayment::class);
    }

    public function setAmount()
    {
        $amount = 0;
        $billCurrency = $this->currency_id;
        $currencies = Currency::all();

        foreach ($this->services as $service) {
            $quantity = $service->quantity;
            $price = $service->businessServicePrice->servicePrice->amount;
            $serviceCurrency = $service->businessServicePrice->servicePrice->currency_id;
            $exchangeRate = 1;
            foreach ($currencies as $currency) {
                if ($currency->id == $serviceCurrency) {
                    $exchangeRate = $exchangeRate * $currency->exchange_rate;
                }
                if ($currency->id == $billCurrency) {
                    $exchangeRate = $exchangeRate / $currency->exchange_rate;
                }
            }
            $amount += $quantity * $price * $exchangeRate;
        }

        $this->amount = $amount;
    }

    public function setPaidAmount()
    {
        $paidAmount = 0;
        foreach ($this->payments()->notCanceled()->get() as $payment) {
            $paidAmount += $payment->amount;
        }

        $this->paid_amount = $paidAmount;
    }

    public function isCanceled()
    {
        return $this->bill_status_id == 4;
    }

    public function scopePaid($query)
    {
        return $query->where('bill_status_id', 3);
    }

    public function scopeNotCanceled($query)
    {
        return $query->where('bill_status_id', '<>', 4);
    }

    public function scopeBusiness($query, $id)
    {
        return $query->where('business_id', $id);
    }

    public function setBillStatusId()
    {
        $this->bill_status_id = $this->amount <= $this->paid_amount ? 3 : ($this->paid_amount > 0 ? 2 : 1);
    }

    public function setPaidAt()
    {
        $this->paid_at = $this->amount <= $this->paid_amount ? now() : NULL;
    }

    public function setCanceledAt()
    {
        $this->canceled_at = $this->bill_status_id == 4 ? now() : NULL;
    }

    public function setCanceledBillStatusId()
    {
        $this->bill_status_id = 4;
    }

    public function setReturnedPaymentBillStatusId()
    {
        $this->bill_status_id = 6;
    }

    public function setExpiratesAt()
    {
        $date = Carbon::parse($this->services[0]->covers_to);
        foreach ($this->services as $service) {
            if ($date->gt(Carbon::parse($service->covers_to))) {
                $date = Carbon::parse($service->covers_to);
            }
        }
        $this->expires_at = $date;
    }
}
