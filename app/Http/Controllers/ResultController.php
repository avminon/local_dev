<?php
namespace App\Http\Controllers;

use App\Events\ActivityEvent;
use App\Http\Controllers\Controller;
use App\Result;
use App\Set;
use App\Term;
use App\User;
use Illuminate\Http\Request;
use Session;

class ResultController extends Controller
{
    protected $table = 'results';

    public function __construct()
    {
        parent::__construct();
        session()->keep('setId');
        session()->keep('maxQuestions');
        session()->keep('questionIndex');
        session()->keep('termCount');
        session()->keep('setName');
    }

    public function index(Request $request)
    {
        $setId = session()->get('setId');
        if (empty($setId)) {
            return redirect('sets');
        }

        $questions = Result::with('term')->where('set_id', $setId)->get();
        dd($questions);
        // $questions = LessonWord::with('word')->where('lesson_id', $lessonId)->get();
        // session()->flash('maxQuestions', count($questions));

        // if (empty(session()->get('questionIndex'))) {
        //     session()->flash('questionIndex', 0);
        // } else {
        //     session()->keep('questionIndex');
        // }
        $optionArray = [];
        shuffle($optionArray);

        return view('sets.quiz', [
            'user' => $this->user,
            // 'questions' => $questions,
            'title' => 'Exam',
            'options' => $optionArray,
        ]);
    }

    public function update(Request $request)
    {

    }

    public function show($id)
    {

    }
}
