<?php

namespace App\Repositories;

use App\Models\PrAnswers;
use App\Models\PrQuizzes;

class PrExamQuizzesRepository
{

    public function save_pr_quiz(
        $quiz, $photo, $a_answer,
        $b_answer,$c_answer,$d_answer,
        $a_photo, $b_photo,$c_photo,
        $d_photo, $ball, $exam_day_id
    ){
        $q = new PrQuizzes;
        $q->quiz = $quiz;
        $q->photo = $photo;
        $q->exam_day_id = $exam_day_id;
        $q->ball = $ball;
        $q->save();
        $id = $q->id;
        $this->save_answer($a_answer,$a_photo,$id,$ball,1);
        $this->save_answer($b_answer,$b_photo,$id,$ball,0);
        $this->save_answer($c_answer,$c_photo,$id,$ball,0);
        $this->save_answer($d_answer,$d_photo,$id,$ball,0);
        return $id;
    }

    protected function save_answer($answer, $photo,$quiz_id, $ball,$correct){
        $ans = new PrAnswers;
        $ans->answer = $answer;
        $ans->photo = $photo;
        $ans->quiz_id = $quiz_id;
        $ans->ball = $ball;
        $ans->correct = $correct;
        $ans->save();
    }

    public function pr_quiz_delete($quiz_id){
        $quiz = PrQuizzes::find($quiz_id);
        if ($quiz->photo != "no_photo"){
            unlink("img/quiz/".$quiz->photo);
        }
        $this->delete_quiz_answers($quiz_id);
        PrQuizzes::where('id',$quiz_id)->delete();
    }

    protected function delete_quiz_answers($quiz_id){
        $answers = PrAnswers::where('quiz_id',$quiz_id)->get();
        foreach ($answers as $answer){
            if ($answer->photo != "no_photo"){
                unlink("img/quiz/".$answer->photo);
            }
        }
        PrAnswers::where('quiz_id',$quiz_id)->delete();
    }
}
