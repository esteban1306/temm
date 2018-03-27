<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;
    protected $table = 'tickets';
    protected $primaryKey='ticket_id';
    protected $dates = ['deleted_at'];
}
