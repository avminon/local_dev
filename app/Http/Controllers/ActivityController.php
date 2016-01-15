<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Activity;
use Redirect;

use Illuminate\Http\Request;

class ActivityController extends Controller
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

