<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quarter extends Model
{
    use HasFactory;

    public function district() {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function users() {
        return $this->hasMany(User::class, 'quarter_id');
    }
}
