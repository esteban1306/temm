<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Abono extends Model
{
    protected $table = 'abonos';
    protected $primaryKey='id_abono';

}
