<?php

namespace App\Http\Controllers;

use App\Repositories\AdminRepository;
use App\Repositories\PrExamDayRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct(
        protected AdminRepository $adminRepository,
        protected PrExamDayRepository $prExamDayRepository,
    )
    {
    }

    public function auth(Request $request){
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        $admin = $this->adminRepository->getAdminByUsername($request->username);
        if (!$admin){
            return back()->with('login_error', 1);
        }
        if (Hash::check($request->input('password'), $admin->password)) {
            session()->flush();
            session()->put('admin',1);
            session()->put('fullname',$admin->fullname);
            session()->put('id',$admin->id);
            session()->put('username',$admin->username);
            return redirect()->route('admin.home');
        }
        else{
            return back()->with('login_error', 1);
        }
    }

    public function home(){
        return view('admin.home');
    }





    public function pr_exam_days(){
        $days = $this->prExamDayRepository->getAllDays();
        return view('admin.pr_exam_days', ['days' => $days]);
    }
}
