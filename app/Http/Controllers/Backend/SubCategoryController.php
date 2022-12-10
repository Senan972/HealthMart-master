<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\ChildCategory;

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

    //Child Categories from Sub Categories

    public function ChildCategoryView() {
        $categories = Category::orderBy('Category_name_en', 'ASC') -> get();
        $childcategory = ChildCategory::latest() -> get();
        return view('backend.category.childcategory_view', compact('childcategory', 'categories'));
    
    }

    public function GetSubCategory($category_id) {
        $subcat = SubCategory::where('category_id', $category_id) -> orderBy('subcategory_name_en', 'ASC') -> get();
        return json_encode($subcat);

    }

    public function GetChildCategory($subcategory_id) {
        $childcat = ChildCategory::where('subcategory_id', $subcategory_id) -> orderBy('childcategory_name_en', 'ASC') -> get();
        return json_encode($childcat);

    }
    
    public function ChildCategoryStore(Request $request) {
        $request -> validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'childcategory_name_en' => 'required',
            'childcategory_name_ur' => 'required',
        ],[
            'category_id.required' => 'You must select one option',
            'childcategory_name_en.required' => 'Input sub category name in English',

        ]);
        

        ChildCategory::insert([
            'category_id' => $request -> category_id,
            'subcategory_id' => $request -> subcategory_id,
            'childcategory_name_en' => $request -> childcategory_name_en,
            'childcategory_name_ur' => $request -> childcategory_name_ur,
            'childcategory_slug_en' => strtolower(str_replace(' ', '-', $request -> childcategory_name_en)),
            'childcategory_slug_ur' => str_replace(' ', '-', $request -> childcategory_name_ur),

        ]);
        $notification = array(
            'message' => 'Child Category Added Successfully',
            'alert-type' => 'success'
        );

        return redirect() -> back() -> with($notification);
    }

    public function ChildCategoryEdit($id) {
        $categories = Category::orderBy('category_name_en', 'ASC') -> get();
        $subcategories = SubCategory::orderBy('subcategory_name_en', 'ASC') -> get();
        $childcategories = ChildCategory::findOrFail($id);
        return view('backend.category.childcategory_edit', compact('categories', 'subcategories', 'childcategories'));

    }
    public function ChildCategoryUpdate(Request $request) {
        $childcat_id = $request -> id;

        ChildCategory::findOrFail($childcat_id) -> update([
            'category_id' => $request -> category_id,
            'subcategory_id' => $request -> subcategory_id,
            'childcategory_name_en' => $request -> childcategory_name_en,
            'childcategory_name_ur' => $request -> childcategory_name_ur,
            'childcategory_slug_en' => strtolower(str_replace(' ', '-', $request -> childcategory_name_en)),
            'childcategory_slug_ur' => str_replace(' ', '-', $request -> childcategory_name_ur),

        ]);
        $notification = array(
            'message' => 'Child Category Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect() -> route('all.childcategory') -> with($notification);

    }

    public function ChildCategoryDelete($id) {
        ChildCategory::findOrFail($id) -> delete();

        $notification = array(
            'message' => 'Child Category Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect() -> back() -> with($notification);

    }

}
