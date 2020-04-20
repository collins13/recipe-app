<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Recipe;
use Carbon\Carbon;

class PagesController extends Controller
{
    public function menu(Request $request)
    {
      $categories = Category::all();
      $latest = Recipe::orderby('created_at', 'desc')->limit(6)->get();
      $all_recipes = Recipe::paginate(10);
      return view('welcome',compact('categories', 'latest','all_recipes'));
    }
    public function index(Request $request)
    {
      $categories = Category::all();
      $latest = Recipe::orderby('created_at', 'desc')->limit(6)->get();
      $all_recipes = Recipe::paginate(9);
      return view('index',compact('categories', 'latest','all_recipes'));
    }


    public function get_recipes(Request $request, $id){
      $categories = Category::all();
      $cat = Recipe::where('category_id', $id)->get();
      return view('pages.category', compact('cat','categories'));
    }

    public function single_recipe(Request $request, $id){
      $categories = Category::all();

      $s_cat = Recipe::where('id', $id)->first();
      return view('pages.single_recipe', compact('s_cat','categories'));
    }
}
