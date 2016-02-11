<?php
namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use App\Set;
use App\Term;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TermController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->categories = Category::lists('name', 'id');
        $this->sets = Set::lists('name', 'id');
    }

    public function index()
    {
        return view('terms.index', [
            'terms' => Term::all(),
            'user' => $this->user,
            'title' => 'Terms',
        ]);
    }

    public function listTerms($id)
    {
        $set = Set::findOrFail($id);

        return view('terms.list', [
            'set' => $set,
            'terms' => Term::where('set_id', $set->id)->get(),
            'user' => $this->user,
            'title' => 'Terms from Set',
        ]);
    }

    public function create($id)
    {
        $set = Set::findOrFail($id);

        return view('terms.create', [
            'user' => $this->user,
            'setId' => $id,
            'title' => 'Create Term',
            'categories' => $this->categories,
            'set' => $set,
        ]);
    }

    public function edit($id)
    {
        try {
            $term = Term::findOrFail($id);
            return view('terms.edit', [
                'term' => $term,
                'title' => 'Edit term',
                'user' => $this->user,
                'categories' => $this->categories,
            ]);
        } catch (ModelNotFoundException $e) {
            \Session::flash('flash_error', 'Edit failed. The term cannot be found.');
        }
        return redirect('/terms');
    }

    public function show($id)
    {
        try {
            $term = Term::findOrFail($id);
            return view('terms.show', [
                'term' => $term,
                'title' => 'Show term',
                'user' => $this->user,
                'categories' => $this->categories,
            ]);
        } catch (ModelNotFoundException $e) {
            \Session::flash('flash_error', 'Show failed. The term cannot be found.');
        }
        return redirect('/terms');
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'term_question' => 'required|max:255',
                'term_answer' => 'required',
            ]);
            $term = new Term;
            $term->assign($request);
            \Session::flash('flash_success', 'Term creation successful!');
        } catch (Exception $e) {
            \Session::flash('flash_error', 'Term creation failed.');
        }

        if ($request->input('submit') == 'Add Term and Continue') {
            return redirect('/sets/' . $request->input('set_id') . '/terms/create');
        }

        return redirect('/sets');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'term_name' => 'required|max:255',
            'term_desc' => 'required',
            'term_image' => 'mimes:jpg,jpeg,gif,png',
        ]);
        $term = Term::find(intval($id));
        $term->assign($request);
        return redirect('/terms');
    }

    public function destroy(Request $request, $id)
    {
        try {
            $term = Term::findOrFail($id);
            $term->delete();
            \Session::flash('flash_success', 'Delete successful!');
        } catch (ModelNotFoundException $e) {
            \Session::flash('flash_error', 'Delete failed. The term cannot be found.');
        }
        return redirect('/terms');
    }
}
