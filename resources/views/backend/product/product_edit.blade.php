@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="container-full">

    <!-- Main content -->
    <section class="content">

    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
        <h4 class="box-title">Edit Product</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <div class="row">
            <div class="col">

                <form method="POST" action="{{ route('product-update') }}">
                @csrf
                <input type="hidden" name="id" id="" value="{{ $products -> id }}">

                <div class="row">
                    <div class="col-12">						
                        {{-- first row --}}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Brand Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="brand_id" class="form-control" required="">
                                            <option value="" selected="" disabled="">Select Brand</option>
                                            @foreach($brands as $brand)
                                            <option value="{{ $brand -> id }}" {{ $brand -> id == $products -> brand_id ? 'selected' : '' }} >{{ $brand -> brand_name_en }}</option>
                                            @endforeach
                                            
                                        </select>
                                        @error('brand_id')
                                        <span class="text-danger">{{ $message }}</span>

                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Category Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" class="form-control" required="">
                                            <option value="" selected="" disabled="">Select Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category -> id }}" {{ $category -> id == $products -> category_id ? 'selected' : '' }} >{{ $category -> category_name_en }}</option>
                                            @endforeach
                                            
                                        </select>
                                        @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>

                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Sub Category Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="subcategory_id" class="form-control" required="">
                                            <option value="" selected="" disabled="">Select Sub Category</option>
                                            @foreach($subcategory as $sub)
                                            <option value="{{ $sub -> id }}" {{ $sub -> id == $products -> subcategory_id ? 'selected' : '' }} >{{ $sub -> subcategory_name_en }}</option>
                                            @endforeach
                                            
                                        </select>
                                        @error('subcategory_id')
                                        <span class="text-danger">{{ $message }}</span>

                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- second row --}}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Child Category Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="childcategory_id" class="form-control" required="">
                                            <option value="" selected="" disabled="">Select Child Category</option>
                                            @foreach($childcategory as $child)
                                            <option value="{{ $child -> id }}" {{ $child -> id == $products -> childcategory_id ? 'selected' : '' }} >{{ $child -> childcategory_name_en }}</option>
                                            @endforeach
                                            
                                        </select>
                                        @error('childcategory_id')
                                        <span class="text-danger">{{ $message }}</span>

                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Name English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_name_en" class="form-control" required="" value="{{ $products -> product_name_en }}"> </div>
                                        @error('product_name_en')
                                        <span class="text-danger">{{ $message }}</span>

                                        @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Name Urdu <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_name_ur" class="form-control" required="" value="{{ $products -> product_name_ur }}"> </div>
                                        @error('product_name_ur')
                                        <span class="text-danger">{{ $message }}</span>

                                        @enderror
                                </div>
                            </div>
                        </div>

                        {{-- third row --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Code <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_code" class="form-control" required="" value="{{ $products -> product_code }}"> </div>
                                        @error('product_code')
                                        <span class="text-danger">{{ $message }}</span>

                                        @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Quantity <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_qty" class="form-control" required="" value="{{ $products -> product_qty }}"> </div>
                                        @error('product_qty')
                                        <span class="text-danger">{{ $message }}</span>

                                        @enderror
                                </div>
                            </div>

                            
                        </div>

                        {{-- fourth row --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Tags English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_tags_en" class="form-control" required="" value="{{ $products -> product_tags_en }}" data-role="tagsinput" placeholder="add tags"> </div>
                                        @error('product_tags_en')
                                        <span class="text-danger">{{ $message }}</span>

                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Tags Urdu <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_tags_ur" class="form-control" required="" value="{{ $products -> product_tags_ur }}" data-role="tagsinput" placeholder="add tags"> </div>
                                        @error('product_tags_ur')
                                        <span class="text-danger">{{ $message }}</span>

                                        @enderror
                                </div>
                            </div>
                            
                            
                        </div>

                        {{-- fifth row --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Size English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_size_en" class="form-control" value="{{ $products -> product_size_en }}" data-role="tagsinput" placeholder="add tags"> </div>
                                        @error('product_size_en')
                                        <span class="text-danger">{{ $message }}</span>

                                        @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Size Urdu <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_size_ur" class="form-control" value="{{ $products -> product_size_ur }}" data-role="tagsinput" placeholder="add tags"> </div>
                                        @error('product_size_ur')
                                        <span class="text-danger">{{ $message }}</span>

                                        @enderror
                                </div>
                            </div>

                            

                        </div>

                        {{-- extra row --}}
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Selling Price <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="selling_price" class="form-control" required="" value="{{ $products -> selling_price }}"> </div>
                                        @error('selling_price')
                                        <span class="text-danger">{{ $message }}</span>

                                        @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Discount Price <span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="discount_price" class="form-control" value="{{ $products -> discount_price }}"> </div>
                                        @error('discount_price')
                                        <span class="text-danger">{{ $message }}</span>

                                        @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                
                            </div>

                        </div>

                        
                        {{-- sixth row --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Short Description English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="short_desc_en" id="textarea" class="form-control" required placeholder="Textarea text">
                                            {!! $products -> short_desc_en !!}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Short Description Urdu <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="short_desc_ur" id="textarea" class="form-control" required placeholder="Textarea text">
                                            {!! $products -> short_desc_ur !!}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- seventh row --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Long Description English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea id="editor1" name="long_desc_en" rows="10" cols="80">
                                            {!! $products -> long_desc_en !!}

                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Long Description Urdu <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea id="editor2" name="long_desc_ur" rows="10" cols="80">
                                            {!! $products -> long_desc_ur !!}

                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>

                <hr>
                
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                
                                <div class="controls">
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_2" name="hot_deals" value="1"  {{ $products -> hot_deals == 1 ? 'checked' : '' }}>
                                        <label for="checkbox_2">Hot Deals</label>
                                    </fieldset>
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_3" name="featured" value="1" {{ $products -> featured == 1 ? 'checked' : '' }}>
                                        <label for="checkbox_3">Featured</label>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                
                                <div class="controls">
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_4" name="special_offer" value="1" {{ $products -> special_offer == 1 ? 'checked' : '' }}>
                                        <label for="checkbox_4">Special Offer</label>
                                    </fieldset>
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_5" name="special_deals" value="1" {{ $products -> special_deals == 1 ? 'checked' : '' }}>
                                        <label for="checkbox_5">Special Deal</label>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-xs-right">
                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Product">
                    </div>
                </form>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    </section>
    <!-- /.content -->

    {{-- ////////Multi Img update area////////// --}}
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Product Multiple Images <strong>Update</strong></h4>
                    </div>
                    <form action="{{ route('update-product-image') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="row row-sm">
                            @foreach($multiImgs as $img)
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="{{ asset($img -> photo_name) }}" class="card-img-top" style="height: 130px; width: 280px;">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ route('product.multiimg.delete', $img -> id) }}" class="btn-sm btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i></a>
                                        </h5>
                                        <p class="card-text">
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Change Image <span class="txt-danger">*</span></label>
                                                <input type="file" class="form-control" name="multi_img[{{ $img -> id }}]">
                                            </div>
                                        </p>
                                        
                                    </div>
                                </div>

                            </div>
                            @endforeach
                        </div>

                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
                        </div>
                        <br>
                    </form>

                </div>
            </div>
        </div>

    </section>

    {{-- ////////Thumbnail Img update area////////// --}}
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Product Thumbnail Images <strong>Update</strong></h4>
                    </div>
                    <form action="{{ route('update-product-thumbnail') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $products -> id }}">
                    <input type="hidden" name="old_img" value="{{ $products -> product_thumbnail }}" id="">
                        <div class="row row-sm">
                            
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="{{ asset($products -> product_thumbnail) }}" class="card-img-top" style="height: 130px; width: 280px;">
                                    <div class="card-body">
                                        
                                        <p class="card-text">
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Change Image <span class="txt-danger">*</span></label>
                                                <input type="file" name="product_thumbnail" class="form-control" onchange="mainThumbUrl(this)" > <img src="" id="mainThumb" alt=""> </div>

                                            </div>
                                        </p>
                                        
                                    </div>
                                </div>

                            </div>
                            
                        </div>

                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
                        </div>
                        <br>
                    </form>

                </div>
            </div>
        </div>

    </section>

</div>




<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id) {
                $.ajax({
                    url: "{{  url('/category/subcategory/ajax') }}/"+category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        $('select[name="childcategory_id"]').html('');
                        var d =$('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                            });
                    },
                });
            } else {
                alert('danger');
            }
        });
        $('select[name="subcategory_id"]').on('change', function(){
            var subcategory_id = $(this).val();
            if(subcategory_id) {
                $.ajax({
                    url: "{{  url('/category/childcategory/ajax') }}/"+subcategory_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        var d =$('select[name="childcategory_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="childcategory_id"]').append('<option value="'+ value.id +'">' + value.childcategory_name_en + '</option>');
                            });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>

<script>
    function mainThumbUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#mainThumb').attr('src',e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script>
$(document).ready(function(){
    $('#multiImg').on('change', function(){ //on file input change
    if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
    {
        var data = $(this)[0].files; //this file data
            
        $.each(data, function(index, file){ //loop though each file
            if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                var fRead = new FileReader(); //new filereader
                fRead.onload = (function(file){ //trigger function on successful read
                return function(e) {
                    var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                .height(80); //create image element 
                    $('#preview_img').append(img); //append image to output element
                };
                })(file);
                fRead.readAsDataURL(file); //URL representing the file's data.
            }
        });
            
    }else{
        alert("Your browser doesn't support File API!"); //if File API is absent
    }
    });
});
</script>

@endsection