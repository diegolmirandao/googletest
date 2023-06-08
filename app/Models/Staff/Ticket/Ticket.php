<?php

namespace App\Models\Staff\Ticket;

use App\Models\Staff\Business\Business;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CreatedUpdatedBy;
use App\Scopes\Staff\TicketScope;

class Ticket extends Model
{
    use HasFactory, SoftDeletes, CreatedUpdatedBy;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'business_id',
        'ticket_department_id',
        'ticket_status_id',
        'generated_at',
        'message',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'generated_at' => 'datetime',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'department',
        'status',
        'business',
        'replies',
        'createdBy',
        'updatedBy'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new TicketScope);
    }

    public function department() {
        return $this->ticketDepartment();
    }

    public function ticketDepartment() {
        return $this->belongsTo(TicketDepartment::class);
    }
    public function status() {
        return $this->ticketStatus();
    }

    public function ticketStatus() {
        return $this->belongsTo(TicketStatus::class);
    }

    public function business() {
        return $this->belongsTo(Business::class);
    }

    public function replies() {
        return $this->hasMany(TicketReply::class);
    }
}
