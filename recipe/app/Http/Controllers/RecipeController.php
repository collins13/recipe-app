<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Category;
use App\Recipe;
use Carbon\Carbon;

class RecipeController extends Controller
{
    public function categories(Request $request)
    {
        $categories = Category::all();
        return view('admin.categories',compact('categories'));
    }

    public function add_category(Request $request)
    {
        foreach ($request->addmore as $key => $value) {

            Category::create(['name'=>$value['category']]);
        }
        return response()->json(['status'=>1]);
    }
    public function edit_cat(Request $request)
    {
        $cat = Category::where('id', $request->id)->first();
        return response()->json(['cat'=>$cat]);
    }
    public function update_cat(Request $request)
    {
        $cat = Category::where('id', $request->id)->update(['name'=>$request->editCategory]);
        return response()->json(['status'=>1]);
    }

    public function delete_cat(Request $request, $id)
    {
        $cat = Category::find($id);
        $cat->delete($id);
        return response()->json(['status'=>1]);
    }


    public function recipe(Request $request)
    {

        $categories = Category::all();
        $recipes = Recipe::all();
        return view('admin.index',compact('categories', 'recipes'));
    }
public function add_recipe(Request $request)
{
    dd($request->all());
    if ($request->hasFile('image')) {
        $fileNameWithExt = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        $path = $request->file('image')->storeAs('public/img', $fileNameToStore);
    } else {
        $fileNameToStore = 'no_image.jpg';
    }
 $recipe = new Recipe();
 $recipe->category_id = $request->category;
 $recipe->name = $request->name;
 $recipe->image = $fileNameToStore;
 $recipe->ingredients = ($request->ing);
 $recipe->method = strip_tags($request->meth);
 $recipe->description = strip_tags($request->desc);
 $recipe->date_created =  Carbon::now();
 $recipe->created_by =  "admin";
 $recipe->save();

 return response()->json(['status'=>1]);
}

public function edit_rec(Request $request)
{
    $cat = Recipe::where('id', $request->id)->first();
    return response()->json(['cat'=>$cat]);
}
public function update_rec(Request $request)
{

     Recipe::where('id', $request->id)->update([
        'name'=>$request->editname,
        'category_id'=>$request->editcategory,
        'ingredients'=>$request->editing,
        'method'=>$request->editmeth,
        'description'=>$request->editdesc,
        ]);
        return response()->json(['status'=>1]);
}
public function delete_rec(Request $request, $id)
    {
        $cat = Recipe::find($id);
        $cat->delete($id);
        return response()->json(['status'=>1]);
    }

}
