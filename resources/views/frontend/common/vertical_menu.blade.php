@php
    $categories = App\Models\Category::orderBy('category_name_en','ASC') -> get();

@endphp

<!-- ================================== TOP NAVIGATION ================================== -->
<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <nav class="yamm megamenu-horizontal">
      <ul class="nav">

        @foreach ($categories as $category)
        <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon {{ $category -> category_icon }}" aria-hidden="true"></i>
          @if(session() -> get('language') == 'urdu') {{ $category -> category_name_ur }} @else {{ $category -> category_name_en }} @endif
          </a>
          <ul class="dropdown-menu mega-menu">
            <li class="yamm-content">
              <div class="row">
                @php
                $subcategories = App\Models\SubCategory::where('category_id', $category -> id) -> orderBy('subcategory_name_en','ASC') -> get();
                @endphp
                
                @foreach ($subcategories as $subcategory)
                <div class="col-sm-12 col-md-3">
                  <h2 class="title">
                    @if(session() -> get('language') == 'urdu') {{ $subcategory -> subcategory_name_ur }} @else {{ $subcategory -> subcategory_name_en }} @endif
                  </h2>

                  @php
                  $childcategories = App\Models\ChildCategory::where('subcategory_id', $subcategory -> id) -> orderBy('childcategory_name_en','ASC') -> get();
                  @endphp

                  @foreach ($childcategories as $childcategory)
                  <ul class="links list-unstyled">
                    <li><a href="#">
                      @if(session() -> get('language') == 'urdu') {{ $childcategory -> childcategory_name_ur }} @else {{ $childcategory -> childcategory_name_en }} @endif
                    </a></li>
                  </ul>
                  @endforeach
                </div>
                @endforeach
              <!-- /.row --> 
            </li>
            <!-- /.yamm-content -->
          </ul>
          <!-- /.dropdown-menu --> </li>
        <!-- /.menu-item -->
        @endforeach
        
        

        
        
        <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-heartbeat"></i>Medical Supplies</a>
          <ul class="dropdown-menu mega-menu">
            <li class="yamm-content">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-4">
                  <ul>
                    <li><a href="#">Exam Room Supplies</a></li>
                    <li><a href="#">IV Products</a></li>
                    <li><a href="#">Needles and Syringes</a></li>
                    <li><a href="#">Safety and Emergency</a></li>
                  </ul>
                </div>
              </div>
              <!-- /.row --> 
            </li>
            <!-- /.yamm-content -->
          </ul>
          <!-- /.dropdown-menu --> </li>
        <!-- /.menu-item -->
      </ul>
      <!-- /.nav --> 
    </nav>
    <!-- /.megamenu-horizontal --> 
  </div>
  <!-- /.side-menu --> 
  <!-- ================================== TOP NAVIGATION : END ================================== --> 
  