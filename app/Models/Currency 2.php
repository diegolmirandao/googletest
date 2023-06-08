<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'name',
        'code',
        'abbreviation',
    ];

    /**
     * The attributes to be appended to the model.
     *
     * @var array
     */
    protected $appends = [
        'exchange_rate'
    ];

    public function currencyExchangeRates() {
        return $this->hasMany(CurrencyExchangeRate::class);
    }

    public function exchangeRates() {
        return $this->currencyExchangeRates();
    }

    public function getExchangeRateAttribute() {
        return $this->exchangeRates()->latest()->first()->exchange_rate;
    }
}
