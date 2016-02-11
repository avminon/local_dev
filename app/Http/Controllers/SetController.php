<?php
namespace App\Http\Controllers;

use App\Category;
use App\Follow;
use App\Http\Controllers\Controller;
use App\Set;
use App\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Session;

class SetController extends Controller
{

    protected $categories;

    public function __construct()
    {
        parent::__construct();
        $this->categories = Category::lists('name', 'id');
        session()->keep('setId');
        session()->keep('maxQuestions');
        session()->keep('questionIndex');
        session()->keep('termCount');
        session()->keep('setName');
    }

    public function listCustom($id)
    {

        if ($id == 'new') {
            $sets = Set::orderBy('id', 'DESC')->take(2)->get();
        } else {
            $sets = Set::where('user_id', $id)->get();
        }

        return view('sets.index', [
            'sets' => $sets,
            'user' => $this->user,
            'title' => 'Sets You Created',
        ]);
    }

    public function index()
    {
        $sets = Set::all();

        $includeArray = [];

        foreach ($sets as $key => $set) {
            $isFollower = Follow::where('follower_id', $this->user->id)
                ->where('followee_id', $set->user_id)
                ->first();
            $isFollowee = Follow::where('followee_id', $this->user->id)
                ->where('follower_id', $set->user_id)
                ->first();
            switch ($set->availability) {
                case Set::AVAILABILITY_0:
                    break;
                case Set::AVAILABILITY_1:
                    if ($set->user_id != $this->user->id) {
                        $sets = $sets->forget($key);
                    }
                    break;
                case Set::AVAILABILITY_2:
                    if (($set->user_id != $this->user->id) && (is_null($isFollower))) {
                        $sets = $sets->forget($key);
                    }
                    break;
                case Set::AVAILABILITY_3:
                    if (($set->user_id != $this->user->id) && (is_null($isFollowee))) {
                        $sets = $sets->forget($key);
                    }
                    break;
                case Set::AVAILABILITY_4:
                    if ($set->user_id != $this->user->id) {
                        if ((is_null($isFollowee)) && (is_null($isFollower))) {
                            $sets = $sets->forget($key);
                        }
                    }
                    break;
            }
        }
        return view('sets.index', [
            'sets' => $sets,
            'user' => $this->user,
            'title' => 'Sets',
        ]);
    }

    public function create()
    {
        return view('sets.create', [
            'user' => $this->user,
            'title' => 'Create Set',
            'categories' => $this->categories,
        ]);
    }

    public function edit($id)
    {
        try {
            $set = Set::findOrFail($id);
            return view('sets.edit', [
                'set' => $set,
                'title' => 'Edit set',
                'user' => $this->user,
                'categories' => $this->categories,
            ]);
        } catch (ModelNotFoundException $e) {
            \Session::flash('flash_error', 'Edit failed. The set cannot be found.');
        }
        return redirect('/sets');
    }

    public function show($id)
    {
        try {
            $set = Set::findOrFail($id);
            return view('sets.show', [
                'set' => $set,
                'title' => 'Show set',
                'user' => $this->user,
                'categories' => $this->categories,
            ]);
        } catch (ModelNotFoundException $e) {
            \Session::flash('flash_error', 'Show failed. The set cannot be found.');
        }
        return redirect('/sets');
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'set_name' => 'required|max:255',
                'set_desc' => 'required',
                'set_image' => 'required|mimes:jpg,jpeg,gif,png',
            ]);
            $set = new Set;
            $set->assign($request);
            \Session::flash('flash_success', 'Set creation successful!');
        } catch (Exception $e) {
            \Session::flash('flash_error', 'Set creation failed.');
        }
        return redirect('/sets');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'set_name' => 'required|max:255',
            'set_desc' => 'required',
            'set_image' => 'mimes:jpg,jpeg,gif,png',
        ]);
        $set = Set::find(intval($id));
        $set->assign($request);
        return redirect('/sets');
    }

    public function destroy(Request $request, $id)
    {
        try {
            $set = Set::findOrFail($id);
            $set->delete();
            \Session::flash('flash_success', 'Delete successful!');
        } catch (ModelNotFoundException $e) {
            \Session::flash('flash_error', 'Delete failed. The set cannot be found.');
        }
        return redirect('/sets');
    }

    public function take(Request $request)
    {
        try {
            session()->flash('setId', 0);
            session()->flash('questionIndex', 0);
            session()->flash('maxQuestions', 0);
            session()->flash('setName', $request->setName);
            session()->flash('termCount', $request->termCount);
            $set = Set::findOrFail($request->setId);
            if ($set->getTerms($request->setId, $this->user->id)) {
                session()->flash('setId', $set->id);
                return redirect('/quiz');
            }
        } catch (Exception $e) {
            dd('CATCH ERROR');
            session()->flash('flash_error', 'Set quiz failed. Please try again.');
            return redirect()->back();
        }
        dd('SET ERROR');
        return redirect('sets');

    }
}
