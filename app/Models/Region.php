<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    public function districts() {
        return $this->hasMany(District::class, 'region_id');
    }

    public function users() {
        return $this->hasMany(User::class, 'region_id');
    }
}
