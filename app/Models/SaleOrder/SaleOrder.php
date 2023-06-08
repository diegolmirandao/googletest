<?php

namespace App\Models\SaleOrder;

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
use Illuminate\Support\Facades\Log;

class SaleOrder extends Model
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
        'status_id',
        'ordered_at',
        'expires_at',
        'billed_at',
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
        'status',
        'products'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'ordered_at' => 'datetime',
        'expires_at' => 'datetime',
        'billed_at' => 'datetime',
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
        'ordered_at',
        'expires_at',
        'billed_at',
        'canceled_at',
        'comments',
        'created_at',
        'updated_at',
    ];

    public function setAmount()
    {
        $amount = 0;
        $saleorderCurrency = $this->currency_id;
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
                if ($currency->id == $saleorderCurrency) {
                    $exchangeRate = $exchangeRate / $currency->exchange_rate;
                }
            }
            $amount += $quantity * $price * $exchangeRate;
        }

        $this->amount = $amount;
    }

    public function setStatus() {
        $status = 1;//pending
        $productStatuses = [0, 0, 0, 0];//[pending, partially processed, billed, canceled]
        $productQuantity = count($this->products);

        foreach ($this->products as $product) {
            if ($product->quantity === $product->billed_quantity) {
                $productStatuses[2]++;
            } else if ($product->quantity === $product->canceled_quantity) {
                $productStatuses[3]++;
            } else if ($product->quantity < $product->billed_quantity && $product->canceled_quantity > 0) {
                $productStatuses[1]++;
            } else {
                $productStatuses[0]++;
            }
        }

        if ($productStatuses[2] === $productQuantity) {//all products billed
            $status = 3;
        } else if ($productStatuses[3] === $productQuantity) {//all products canceled
            $status = 4;
        } else if (($productStatuses[1] + $productStatuses[2] + $productStatuses[3]) > 0) {//partially processed
            $status = 2;
        } else {//all pending
            $status = 1;
        }
        
        $this->status_id = $status;
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    public function status() {
        return $this->belongsTo(SaleOrderStatus::class, 'status_id');
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


    public function saleOrderProducts(){
        return $this->hasMany(SaleOrderProduct::class);
    }

    public function products() {
        return $this->saleOrderProducts();
    }
}
