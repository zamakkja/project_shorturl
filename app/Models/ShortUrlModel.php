<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortUrlModel extends Model
{
    protected $table = 'short_url_table';
    protected $guarded = array();
}
