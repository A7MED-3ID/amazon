<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src={{asset('backend_admin/assets/images/logo-icon.png')}} class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">A7MED_3ID</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li>
            <a href={{route('admin.dashboard')}}>
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        @if(Auth::user()->can('brand.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Brands</div>
            </a>
            <ul>
        @if(Auth::user()->can('brand.list'))

                <li> <a href={{route('all.brand')}}><i class="bx bx-right-arrow-alt"></i>All Brands</a>
                </li>
                @endif
        @if(Auth::user()->can('brand.add'))

                <li> <a href={{route('add.brand')}}><i class="bx bx-right-arrow-alt"></i>Add Brand</a>
                </li>
                @endif
              
           
            </ul>
        </li>

        @endif

        @if(Auth::user()->can('cat.menu'))

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Categories</div>
            </a>
            <ul>
        @if(Auth::user()->can('category.list'))

                <li> <a href={{route('category.all')}}><i class="bx bx-right-arrow-alt"></i>All Categories</a>
                </li>
        @endif

        @if(Auth::user()->can('category.add'))

                <li> <a href={{route('category.add')}}><i class="bx bx-right-arrow-alt"></i>Add Category</a>
                </li>
        @endif

                
            </ul>
        </li>
        @endif



        

        @if(Auth::user()->can('subcategory.menu'))

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Sub Categories</div>
            </a>
            <ul>
        @if(Auth::user()->can('subcategory.list'))

                <li> <a href={{route('subcategory.all')}}><i class="bx bx-right-arrow-alt"></i>All Sub Categories</a>
                </li>
        @endif

        @if(Auth::user()->can('subcategory.add'))

                <li> <a href={{route('subcategory.add')}}><i class="bx bx-right-arrow-alt"></i>Add Sub Category</a>
                </li>
        @endif

                
            </ul>
        </li>
        @endif


        

        @if(Auth::user()->can('product.menu'))



        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Product</div>
            </a>
            <ul>
        @if(Auth::user()->can('product.list'))

                <li> <a href={{route('product.all')}}><i class="bx bx-right-arrow-alt"></i>All Products</a>
                </li>
        @endif

        @if(Auth::user()->can('product.add'))

                <li> <a href={{route('product.add')}}><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                </li>
        @endif

                
            </ul>
        </li>

        @endif


        @if(Auth::user()->can('coupon.menu'))

        
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Coupon System</div>
            </a>
            <ul>
          @if(Auth::user()->can('coupon.list'))

                <li> <a href={{route('coupon.all')}}><i class="bx bx-right-arrow-alt"></i>All Coupons</a>
                </li>
        @endif

        @if(Auth::user()->can('coupon.add'))

                <li> <a href={{route('coupon.add')}}><i class="bx bx-right-arrow-alt"></i>Add Coupon</a>
                </li>
        @endif

                
            </ul>
        </li>
        @endif






        
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Shipping Area</div>
            </a>
            <ul>
                <li> <a href={{route('all.division')}}><i class="bx bx-right-arrow-alt"></i>All Division</a>
                </li>
                <li> <a href={{route('all.district')}}><i class="bx bx-right-arrow-alt"></i>All District</a>
                </li>

                
                <li> <a href={{route('all.state')}}><i class="bx bx-right-arrow-alt"></i>All State</a>
                </li>
                
            </ul>
        </li>



        @if(Auth::user()->can('slider.menu'))



        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Slider</div>
            </a>
            <ul>
        @if(Auth::user()->can('slider.list'))

                <li> <a href={{route('slider.all')}}><i class="bx bx-right-arrow-alt"></i>All Sliders</a>
                </li>
        @endif

        @if(Auth::user()->can('slider.add'))

                <li> <a href={{route('slider.add')}}><i class="bx bx-right-arrow-alt"></i>Add Slider</a>
                </li>
        @endif

                
            </ul>
        </li>

        @endif


        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Banner</div>
            </a>
            <ul>
                <li> <a href={{route('banner.all')}}><i class="bx bx-right-arrow-alt"></i>All Banners</a>
                </li>
                <li> <a href={{route('banner.add')}}><i class="bx bx-right-arrow-alt"></i>Add Banner</a>
                </li>
                
            </ul>
        </li>



        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Vendor</div>
            </a>
            <ul>
                <li> <a href={{route('inactive.vendor')}}><i class="bx bx-right-arrow-alt"></i>Inactive Vendor</a>
                </li>
                <li> <a href={{route('active.vendor')}}><i class="bx bx-right-arrow-alt"></i>Active Vendor</a>
                </li>
                
            </ul>
        </li>




        @if(Auth::user()->can('order.menu'))


        <li>
            
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Order</div>
            </a>
            <ul>
                
                <li> <a href={{route('admin.pending.order')}}><i class="bx bx-right-arrow-alt"></i>Pending Order</a>
                </li>

                <li> <a href={{route('admin.confirmed.order')}}><i class="bx bx-right-arrow-alt"></i>Confirmed Order</a>
                </li>

                <li> <a href={{route('admin.processing.order')}}><i class="bx bx-right-arrow-alt"></i>Processing Order</a>
                </li>

                <li> <a href={{route('admin.delivered.order')}}><i class="bx bx-right-arrow-alt"></i>Deliverd Order</a>
                </li>
              
                
            </ul>
        </li>

        @endif



        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Return Orders</div>
            </a>
            <ul>
                <li> <a href={{route('return.request')}}><i class="bx bx-right-arrow-alt"></i>Return Request</a>
                </li>

                <li> <a href={{route('return.request.complete')}}><i class="bx bx-right-arrow-alt"></i>Complete Request </a>
                </li>

              
                
            </ul>
        </li>


        
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Reports</div>
            </a>
            <ul>
                <li> <a href={{route('all.reports')}}><i class="bx bx-right-arrow-alt"></i> Report View</a>
                </li>

                <li> <a href={{route('order.by.user')}}><i class="bx bx-right-arrow-alt"></i>Order By User</a>
                </li>

                

              
                
            </ul>
        </li>


        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Users</div>
            </a>
            <ul>
                <li> <a href={{route('all.users')}}><i class="bx bx-right-arrow-alt"></i> All Users</a>
                </li>

                <li> <a href={{route('all.vendors')}}><i class="bx bx-right-arrow-alt"></i> All Vendors</a>
                </li>

                

              
                
            </ul>
        </li>



        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Blog</div>
            </a>
            <ul>
                <li> <a href={{route('admin.blog.category')}}><i class="bx bx-right-arrow-alt"></i> All Blog Category</a>
                </li>

                <li> <a href={{route('admin.blog.post')}}><i class="bx bx-right-arrow-alt"></i> All Blog Post</a>
                </li>

                

              
                
            </ul>
        </li>


        
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Review</div>
            </a>
            <ul>
                <li> <a href={{route('pending.review')}}><i class="bx bx-right-arrow-alt"></i> Pending Reviews</a>
                </li>

                <li> <a href={{route('publish.review')}}><i class="bx bx-right-arrow-alt"></i>Publish Reviews</a>
                </li>

                

              
                
            </ul>
        </li>



        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Setting</div>
            </a>
            <ul>
                <li> <a href={{route('site.setting')}}><i class="bx bx-right-arrow-alt"></i> Site Setting</a>
                </li>

                <li> <a href={{route('seo.setting')}}><i class="bx bx-right-arrow-alt"></i> Seo Setting</a>
                </li>

                

                

              
                
            </ul>
        </li>


        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Stock</div>
            </a>
            <ul>
                <li> <a href={{route('product.stock')}}><i class="bx bx-right-arrow-alt"></i> Stock </a>
                </li>

              

                

                

              
                
            </ul>
        </li>
      
      
      
      
       
      
        
       
        <li class="menu-label">Roles & Permissions</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-line-chart"></i>
                </div>
                <div class="menu-title">Roles & Permissions</div>
            </a>
            <ul>
                <li> <a href={{route('all.permission')}}><i class="bx bx-right-arrow-alt"></i>All Permissions</a>
                </li>
                <li> <a href={{route('all.role')}}><i class="bx bx-right-arrow-alt"></i>All Roles</a>
                </li>

                <li> <a href={{route('add.role.permission')}}><i class="bx bx-right-arrow-alt"></i>Roles In Permission </a>
                </li>


                <li> <a href={{route('all.roles.permission')}}><i class="bx bx-right-arrow-alt"></i>All Roles In Permission </a>
                </li>
                
            </ul>
        </li>




        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-line-chart"></i>
                </div>
                <div class="menu-title">Admin Manage</div>
            </a>
            <ul>
                <li> <a href={{route('all.admin')}}><i class="bx bx-right-arrow-alt"></i>All Admins</a>
                </li>
                <li> <a href={{route('add.admin')}}><i class="bx bx-right-arrow-alt"></i>Add Admin</a>
                </li>

              
                
            </ul>
        </li>
       
       
      
        <li>
            <a href="https://themeforest.net/user/codervent" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>