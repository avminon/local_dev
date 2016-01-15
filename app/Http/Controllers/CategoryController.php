<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use Redirect;

use Illuminate\Http\Request;

class CategoryController extends Controller
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
	   return view('categories.home', ['categories' => Category::all()]);
    }


    public function addCategory()
    {
        return view('categories.add');
    }

    public function editCategory($id)
    {
        $category = Category::find(intval($id));
        return view('categories.edit', ['category' => $category]);
    }

    public function newCategory(Request $request)
    {
        $category = new Category;
        $this->assignValues($category, $request);
        return redirect('/categories');
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::find(intval($id));
        $this->assignValues($category, $request);
        return redirect('/categories');
    }

    private function assignValues($category, $values)
    {
        if($values->input('category_id') !== null) {
            $category->id = $values->input('categoryId');
        }
        $category->name = $values->input('categoryName');
        $category->description = $values->input('categoryDesc');
        if(!empty($values->input('categoryImage')) || ($values->input('categoryImage')) == null) {
            $category->image = $values->input('categoryImage');
        }
        $category->save();
    }
}

