<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Redirect;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
   	 * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


	/*
	 * Display the posts of a particular user
	 *
	 * @param int $id
	 * @return Response
	 */
	public function index()
	{
		$title = 'Title';
		return view('home')->withTitle($title)->with('activities', \Auth::user()->id);
	}

	public function profile(Request $request, $id)
	{
		$data['user'] = User::find($id);
		return view('admin.profile', $data);
	}


    public function update(Request $request)
	{
		//
		$this->validate($request, [
            'name' => 'required|max:255',
        ]);
		$user_id = $request->input('user_id');
		$new_name = $request->input('name');

		$user = Users::find($user_id);
		$user->name = $new_name;
		$user_>save();

		return redirect('user/{id}');
	}
}

