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

        <div class="col-8">

        <div class="box">
            <div class="box-header with-border">
            <h3 class="box-title">Coupon List <span class="badge badge-pill badge-danger"> {{ count($coupons) }} </span></h3>
				
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Coupon Name</th>
                            <th>Coupon Discount</th>
                            <th>Validity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($coupons as $item)
                        <tr>
                            <td>{{ $item -> coupon_name }}</td>
                            <td>{{ $item -> coupon_discount }}%</td>
                            <td width="25%">
       {{ Carbon\Carbon::parse($item->coupon_validity)->format('D, d F Y') }}
			 </td>
             
             @if($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
		 	<span class="badge badge-pill badge-success"> Valid </span>
		 	@else
             <span class="badge badge-pill badge-danger"> Invalid </span>
		 	@endif
                                </td>
                            
                                <td width="25%">
                                <a href="{{ route('coupon.edit',$item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i> </a>
 <a href="{{ route('coupon.delete',$item->id) }}" class="btn btn-danger" title="Delete Data" id="delete">
 <i class="fa fa-trash"></i></a>
		</td>
                            <a href="{{ route('category.delete', $item -> id) }}" class="btn btn-danger" id="delete" title="Delete"><i class="fa fa-trash"></i></a></td>
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
                <h3 class="box-title">Add Coupon</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <form method="post" action="{{ route('coupon.store') }}">
                            @csrf
                             
                                <div class="form-group">
                                    <h5>Coupon Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="coupon_name" class="form-control"> </div>
                                    @error('coupon_name')
                                    <span class="text-danger">{{ $message }}</span>

                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Coupon Discount(%)<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="coupon_discount" class="form-control"> </div>
                                    @error('coupon_discount')
                                    <span class="text-danger">{{ $message }}</span>

                                    @enderror
                                </div>

                                <div class="form-group">
		<h5>Coupon Validity Date  <span class="text-danger">*</span></h5>
		<div class="controls">
        <input type="date" name="coupon_validity" class="form-control" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
    
        @error('coupon_validity') 
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


@endsection