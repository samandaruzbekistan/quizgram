<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Repositories\AdminRepository;
use App\Repositories\PrExamDayRepository;
use App\Repositories\PrExamQuizzesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct(
        protected AdminRepository $adminRepository,
        protected PrExamDayRepository $prExamDayRepository,
        protected PrExamQuizzesRepository $prExamQuizzesRepository,
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

    public function logout(){
        session()->flush();
        return redirect()->route('admin.login');
    }

    public function home(){
        return view('admin.home');
    }





    public function pr_exam_days(){
        $days = $this->prExamDayRepository->getAllDays();
        return view('admin.pr.pr_exam_days', ['days' => $days]);
    }

    public function new_pr_exam(Request $request){
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|string',
        ]);
        $amountString = str_replace([' ', ','], '', $request->input('amount'));
        $amount = (float) $amountString;
        $day = $this->prExamDayRepository->getLatestDay();
        if ((!$day) or ($day->status == 1)){
            $this->prExamDayRepository->new_day($request->date, $amount);
            return redirect()->back()->with('success',1);
        }
        else{
            return redirect()->back()->with('day_error',1);
        }
    }

    public function pr_exam($id){
        $day = $this->prExamDayRepository->getDayById($id);
        if (!$day) return redirect()->back();
        return view('admin.pr.exam_day', ['day' => $day]);
    }

    public function pr_exam_english($id){
        $day = $this->prExamDayRepository->getDayById($id);
        if (!$day) return redirect()->back();
        return view('admin.pr.exam_day_english', ['day' => $day]);
    }




    public function new_quiz_pr(Request $request){
        $request->validate([
            'quiz' => 'required|string',
            'a_answer' => 'required|string',
            'b_answer' => 'required|string',
            'c_answer' => 'required|string',
            'd_answer' => 'required|string',
            'exam_day_id' => 'required|numeric',
            'ball' => 'required|numeric',
            'photo' => 'image|max:2048',
            'a_photo' => 'image|max:2048',
            'b_photo' => 'image|max:2048',
            'c_photo' => 'image|max:2048',
            'd_photo' => 'image|max:2048',
        ]);
        $photo_name = "no_photo";
        $a_photo_name = "no_photo";
        $b_photo_name = "no_photo";
        $c_photo_name = "no_photo";
        $d_photo_name = "no_photo";
        if ($request->hasFile('photo')){
            $file = $request->file('photo')->extension();
            $name = md5(microtime());
            $photo_name = $name.".".$file;
            $path = $request->file('photo')->move('img/quiz/',$photo_name);
        }
        if ($request->hasFile('a_photo')){
            $file = $request->file('a_photo')->extension();
            $name = md5(microtime());
            $a_photo_name = "a".$name.".".$file;
            $path = $request->file('a_photo')->move('img/quiz/',$a_photo_name);
        }
        if ($request->hasFile('b_photo')){
            $file = $request->file('b_photo')->extension();
            $name = md5(microtime());
            $b_photo_name = "b".$name.".".$file;
            $path = $request->file('b_photo')->move('img/quiz/',$b_photo_name);
        }
        if ($request->hasFile('c_photo')){
            $file = $request->file('c_photo')->extension();
            $name = md5(microtime());
            $c_photo_name = "c".$name.".".$file;
            $path = $request->file('c_photo')->move('img/quiz/',$c_photo_name);
        }
        if ($request->hasFile('d_photo')){
            $file = $request->file('d_photo')->extension();
            $name = md5(microtime());
            $d_photo_name = "d".$name.".".$file;
            $path = $request->file('d_photo')->move('img/quiz/',$d_photo_name);
        }
        $saved_id = $this->prExamQuizzesRepository->save_pr_quiz(
            $request->quiz,
            $photo_name,
            $request->a_answer,
            $request->b_answer,
            $request->c_answer,
            $request->d_answer,
            $a_photo_name,
            $b_photo_name,
            $c_photo_name,
            $d_photo_name,
            $request->ball,
            $request->exam_day_id
        );
        if (!$saved_id){
            return back()->with('error',1);
        }
        else{
            $this->prExamDayRepository->incrementQuizCount($request->exam_day_id);
            return back()->with('quiz_save',1);
        }
    }

    public function delete_pr_quiz(Request $request){
        $request->validate([
            'quiz_id' => 'required|numeric',
            'exam_day_id' => 'required|numeric',
        ]);
        $this->prExamQuizzesRepository->pr_quiz_delete($request->quiz_id);
        $this->prExamDayRepository->decrementQuizCount($request->exam_day_id);
        return back();
    }

}
