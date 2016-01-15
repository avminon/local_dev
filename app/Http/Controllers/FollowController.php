<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Follow;
use Redirect;

use Illuminate\Http\Request;

class FollowController extends Controller
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
}

