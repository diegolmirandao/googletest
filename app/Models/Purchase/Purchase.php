<?php

namespace App\Models\Purchase;

use App\Models\Currency;
use App\Models\Supplier\Supplier;
use App\Models\DocumentType;
use App\Models\Establishment;
use App\Models\PaymentTerm;
use App\Models\Warehouse;
use App\Traits\CreatedUpdatedBy;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'supplier_id',
        'currency_id',
        'establishment_id',
        'warehouse_id',
        'document_type_id',
        'payment_term_id',
        'purchased_at',
        'expires_at',
        'paid_at',
        'name',
        'identification_document',
        'phone',
        'email',
        'address',
        'comments',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'supplier',
        'currency',
        'establishment',
        'warehouse',
        'documentType',
        'paymentTerm',
        'products',
        'payments',
        'instalments'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'purchased_at' => 'datetime',
        'expires_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    /**
     * Fields that can be filtered
     *
     * @var array
     */
    private static $whiteListFilter = [
        'name',
        'identification_document',
        'phone',
        'email',
        'address',
        'currency_id',
        'establishment_id',
        'warehouse_id',
        'document_type_id',
        'payment_term_id',
        'billed_at',
        'expires_at',
        'paid_at',
        'comments',
        'created_at',
        'updated_at',
    ];

    public function setAmount()
    {
        $amount = 0;
        $purchaseCurrency = $this->currency_id;
        $currencies = Currency::all();

        foreach ($this->products as $product) {
            $quantity = $product->quantity;
            $cost = $product->cost->amount - $product->discount * $product->cost->amount;
            $productCurrency = $product->cost->currency_id;
            $exchangeRate = 1;
            foreach ($currencies as $currency) {
                if ($currency->id == $productCurrency) {
                    $exchangeRate = $exchangeRate * $currency->exchange_rate;
                }
                if ($currency->id == $purchaseCurrency) {
                    $exchangeRate = $exchangeRate / $currency->exchange_rate;
                }
            }
            $amount += $quantity * $cost * $exchangeRate;
        }

        $this->amount = $amount;
    }

    public function setPaidAmount()
    {
        $paidAmount = 0;
        foreach ($this->payments as $payment) {
            $paidAmount += $payment->amount;
        }
        $this->paid_amount = $paidAmount;
    }

    public function setPaidAt()
    {
        $paidAmount = 0;
        foreach ($this->payments as $payment) {
            $paidAmount += $payment->amount;
        }
        $this->paid_at = $this->amount <= $paidAmount ? now() : NULL;
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    public function establishment() {
        return $this->belongsTo(Establishment::class);
    }

    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }

    public function documentType() {
        return $this->belongsTo(DocumentType::class);
    }

    public function paymentTerm() {
        return $this->belongsTo(PaymentTerm::class);
    }

    public function purchaseProducts(){
        return $this->hasMany(PurchaseProduct::class);
    }

    public function products() {
        return $this->purchaseProducts();
    }

    public function purchasePayments(){
        return $this->hasMany(PurchasePayment::class);
    }

    public function payments() {
        return $this->purchasePayments();
    }

    public function purchaseInstalments(){
        return $this->hasMany(PurchaseInstalment::class);
    }

    public function instalments() {
        return $this->purchaseInstalments();
    }

    public function scopeOutstandingBalance($query) {
        return $query->whereNull('paid_at');
    }
}
