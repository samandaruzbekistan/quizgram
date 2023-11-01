<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function region() {
        return $this->belongsTo(Region::class);
    }

    public function district() {
        return $this->belongsTo(District::class);
    }

    public function quarter() {
        return $this->belongsTo(Quarter::class);
    }

    public function exams() {
        return $this->hasMany(PrExam::class);
    }
}
