@extends('admin.admin_master')
@section('admin')

<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Content Header (Page header) -->
    {{-- <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Data Tables</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Tables</li>
                            <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Main content -->
    <section class="content">
    <div class="row">



        {{-- Add Category Page --}}
        <div class="col-12">

            <div class="box">
                <div class="box-header with-border">
                <h3 class="box-title">Add Category</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <form method="post" action="{{ route('category.update', $category -> id) }}">
                            @csrf
                             
                                <div class="form-group">
                                    <h5>Category English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="category_name_en" class="form-control" value="{{ $category -> category_name_en }}"> </div>
                                    @error('category_name_en')
                                    <span class="text-danger">{{ $message }}</span>

                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Category Urdu<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="category_name_ur" class="form-control" value="{{ $category -> category_name_ur }}"> </div>
                                    @error('category_name_ur')
                                    <span class="text-danger">{{ $message }}</span>

                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5><i class="fa-solid fa-pills"></i>Category Icon<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="category_icon" class="form-control" value="{{ $category -> category_icon }}"> </div>
                                    @error('category_icon')
                                    <span class="text-danger">{{ $message }}</span>

                                    @enderror
                                </div>

                                  
                                   
                               <div class="text-xs-right">
                                   <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
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


@endsection