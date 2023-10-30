<?php

namespace App\Repositories;

use App\Models\Admin;

class AdminRepository
{
    public function getAdminByUsername($username){
        $admin = Admin::where('username', $username)->first();
        return $admin;
    }
}
