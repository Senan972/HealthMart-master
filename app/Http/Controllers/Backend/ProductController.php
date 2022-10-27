<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\Brand;
use App\Models\Product;
use App\Models\MultiImg;
use Image;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function AddProduct() {
        $categories = Category::latest() -> get();
        $brands = Brand::latest() -> get();
        return view('backend.product.product_add', compact('categories', 'brands'));

    }
    public function StoreProduct(Request $request) {

        $image = $request -> file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image -> getClientOriginalExtension();
        Image::make($image) -> resize(917,1000) -> save('upload/products/thumbnail/'.$name_gen);
        $save_url = 'upload/products/thumbnail/'.$name_gen;

        $product_id = Product::insertGetId([
            'brand_id' => $request -> brand_id,
            'category_id' => $request -> category_id,
            'subcategory_id' => $request -> subcategory_id,
            'childcategory_id' => $request -> childcategory_id,
            'product_name_en' => $request -> product_name_en,
            'product_name_ur' => $request -> product_name_ur,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request -> product_name_en)),
            'product_slug_ur' => str_replace(' ', '-', $request -> product_name_ur),

            'product_code' => $request -> product_code,
            'product_qty' => $request -> product_qty,
            'product_tags_en' => $request -> product_tags_en,
            'product_tags_ur' => $request -> product_tags_ur,
            'product_size_en' => $request -> product_size_en,
            'product_size_ur' => $request -> product_size_ur,
            'selling_price' => $request -> selling_price,
            'discount_price' => $request -> discount_price,

            'short_desc_en' => $request -> short_desc_en,
            'short_desc_ur' => $request -> short_desc_ur,
            'long_desc_en' => $request -> long_desc_en,
            'long_desc_ur' => $request -> long_desc_ur,
            'hot_deals' => $request -> hot_deals,
            'featured' => $request -> featured,
            'special_offer' => $request -> special_offer,
            'special_deals' => $request -> special_deals,

            'product_thumbnail' => $save_url,
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);

        $images = $request -> file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()).'.'.$img -> getClientOriginalExtension();
            Image::make($img) -> resize(917,1000) -> save('upload/products/multi-image/'.$make_name);
            $uploadPath = 'upload/products/multi-image/'.$make_name;

            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),

            ]);
        }

        $notification = array(
            'message' => 'Product Added Successfully',
            'alert-type' => 'success'
        );

        return redirect() -> route('manage-product') -> with($notification);
    }

    public function ManageProduct() {
        $products = Product::latest() -> get();
        return view('backend.product.product_view', compact('products'));
    }
}
