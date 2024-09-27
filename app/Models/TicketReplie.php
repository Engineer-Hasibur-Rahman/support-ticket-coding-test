<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketReplie extends Model
{
    use HasFactory;

    protected $fillable = ['ticket_id','user_id','reply'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
