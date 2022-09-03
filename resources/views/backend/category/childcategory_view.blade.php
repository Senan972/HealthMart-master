@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Content Wrapper. Contains page content -->

<div class="container-full">
   

    <!-- Main content -->
    <section class="content">
    <div class="row">

        <div class="col-8">

        <div class="box">
            <div class="box-header with-border">
            <h3 class="box-title">Child Category List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Sub Category Name</th>
                            <th>Child Category English</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($childcategory as $item)
                        <tr>
                            <td>{{ $item['category']['category_name_en'] }}</td>
                            <td>{{ $item['subcategory']['subcategory_name_en'] }}</td>
                            <td>{{ $item -> childcategory_name_en }}</td>
                            
                            <td><a href="{{ route('subcategory.edit', $item -> id) }}" class="btn btn-info" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="{{ route('subcategory.delete', $item -> id) }}" class="btn btn-danger" id="delete" title="Delete"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
  
        </div>
        <!-- /.col -->


        {{-- Add Category Page --}}
        <div class="col-4">

            <div class="box">
                <div class="box-header with-border">
                <h3 class="box-title">Add Child Category</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <form method="post" action="{{ route('subcategory.store') }}">
                            @csrf
                             
                                <div class="form-group">
                                    <h5>Category Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" class="form-control">
                                            <option value="" selected="" disabled="">Select Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category -> id }}">{{ $category -> category_name_en }}</option>
                                            @endforeach
                                            
                                        </select>
                                        @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>

                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Sub Category Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="subcategory_id" class="form-control">
                                            <option value="" selected="" disabled="">Select Sub Category</option>
                                            

                                            
                                        </select>
                                        @error('subcategory_id')
                                        <span class="text-danger">{{ $message }}</span>

                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Child Category English<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="childcategory_name_en" class="form-control"> </div>
                                    @error('childcategory_name_en')
                                    <span class="text-danger">{{ $message }}</span>

                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5></i>Child Category Urdu<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="childcategory_name_ur" class="form-control"> </div>
                                    @error('childcategory_name_ur')
                                    <span class="text-danger">{{ $message }}</span>

                                    @enderror
                                </div>

                                  
                                   
                               <div class="text-xs-right">
                                   <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add">
                               </div>
                           </form>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
      
            </div>
    </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->

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
  });
  </script>

@endsection