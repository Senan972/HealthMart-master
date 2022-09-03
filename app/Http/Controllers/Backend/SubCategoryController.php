<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function SubCategoryView() {
        $categories = Category::orderBy('Category_name_en', 'ASC') -> get();
        $subcategory = SubCategory::latest() -> get();
        return view('backend.category.subcategory_view', compact('subcategory', 'categories'));
    }
    public function SubCategoryStore(Request $request) {
        $request -> validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
            'subcategory_name_ur' => 'required',
        ],[
            'category_id.required' => 'You must select one option',
            'subcategory_name_en.required' => 'Input sub category name in English',

        ]);
        

        SubCategory::insert([
            'category_id' => $request -> category_id,
            'subcategory_name_en' => $request -> subcategory_name_en,
            'subcategory_name_ur' => $request -> subcategory_name_ur,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request -> subcategory_name_en)),
            'subcategory_slug_ur' => str_replace(' ', '-', $request -> subcategory_name_ur),

        ]);
        $notification = array(
            'message' => 'Sub Category Added Successfully',
            'alert-type' => 'success'
        );

        return redirect() -> back() -> with($notification);
    }

    public function SubCategoryEdit($id) {
        $categories = Category::orderBy('Category_name_en', 'ASC') -> get();
        $subcategory = SubCategory::findOrFail($id);
        return view('backend.category.subcategory_edit', compact('subcategory', 'categories'));

    }
    public function SubCategoryUpdate(Request $request) {
        $subcat_id = $request -> id;

        SubCategory::findOrFail($subcat_id) -> update([
            'category_id' => $request -> category_id,
            'subcategory_name_en' => $request -> subcategory_name_en,
            'subcategory_name_ur' => $request -> subcategory_name_ur,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request -> subcategory_name_en)),
            'subcategory_slug_ur' => str_replace(' ', '-', $request -> subcategory_name_ur),

        ]);
        $notification = array(
            'message' => 'Sub Category Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect() -> route('all.subcategory') -> with($notification);
    }
    public function SubCategoryDelete($id) {
        SubCategory::findOrFail($id) -> delete();

        $notification = array(
            'message' => 'Sub Category Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect() -> back() -> with($notification);

    }
}
