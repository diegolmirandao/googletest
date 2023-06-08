<?php

namespace App\Models\Sale;

use App\Models\Currency;
use App\Models\Customer\Customer;
use App\Models\DocumentType;
use App\Models\Establishment;
use App\Models\PaymentTerm;
use App\Models\PointOfSale;
use App\Models\User\User;
use App\Models\Warehouse;
use App\Traits\CreatedUpdatedBy;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'customer_id',
        'currency_id',
        'point_of_sale_id',
        'warehouse_id',
        'seller_id',
        'document_type_id',
        'payment_term_id',
        'billed_at',
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
        'customer',
        'currency',
        'establishment',
        'pointOfSale',
        'warehouse',
        'seller',
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
        'billed_at' => 'datetime',
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
        'point_of_sale_id',
        'warehouse_id',
        'seller_id',
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
        $saleCurrency = $this->currency_id;
        $currencies = Currency::all();

        foreach ($this->products as $product) {
            $quantity = $product->quantity;
            $price = $product->price->amount - $product->discount * $product->price->amount;
            $productCurrency = $product->price->currency_id;
            $exchangeRate = 1;
            foreach ($currencies as $currency) {
                if ($currency->id == $productCurrency) {
                    $exchangeRate = $exchangeRate * $currency->exchange_rate;
                }
                if ($currency->id == $saleCurrency) {
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

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    public function establishment() {
        return $this->hasOneThrough(Establishment::class, PointOfSale::class, 'id', 'id', 'point_of_sale_id', 'establishment_id');
    }

    public function pointOfSale() {
        return $this->belongsTo(PointOfSale::class);
    }

    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }

    public function seller() {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function documentType() {
        return $this->belongsTo(DocumentType::class);
    }

    public function paymentTerm() {
        return $this->belongsTo(PaymentTerm::class);
    }

    public function saleProducts(){
        return $this->hasMany(SaleProduct::class);
    }

    public function products() {
        return $this->saleProducts();
    }

    public function salePayments(){
        return $this->hasMany(SalePayment::class);
    }

    public function payments() {
        return $this->salePayments();
    }

    public function saleInstalments(){
        return $this->hasMany(SaleInstalment::class);
    }

    public function instalments() {
        return $this->saleInstalments();
    }

    public function scopeOutstandingBalance($query) {
        return $query->whereNull('paid_at');
    }
}
