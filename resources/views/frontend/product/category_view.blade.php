@extends('frontend.master_dashboard')

@section('title')

{{$current_cat->name}} Category
    
@endsection

@section('main')


    <div class="page-header mt-30 mb-50">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h3 class="mb-15">{{$current_cat->name}}</h3>
                        <div class="breadcrumb">
                            <a href={{url('/')}} rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                             <span></span>{{$current_cat->name}} 
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row flex-row-reverse">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand">{{count($products)}}</strong> items for you!</p>
                    </div>
                    <div class="sort-by-product-area">
                        <div class="sort-by-cover mr-10">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps"></i>Show:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">50</a></li>
                                    <li><a href="#">100</a></li>
                                    <li><a href="#">150</a></li>
                                    <li><a href="#">200</a></li>
                                    <li><a href="#">All</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sort-by-cover">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">Featured</a></li>
                                    <li><a href="#">Price: Low to High</a></li>
                                    <li><a href="#">Price: High to Low</a></li>
                                    <li><a href="#">Release Date</a></li>
                                    <li><a href="#">Avg. Rating</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row product-grid">

                       @foreach ($products as $product )
                    
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href={{url("product/details/$product->id/$product->slug")}}>
                                        <img class="default-img" 
                        src= {{asset("storage/$product->product_thambnail")}} alt="" />
                                      
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a id={{$product->id}} onclick="addToWishList(this.id)" aria-label="Add To Wishlist" class="action-btn" ><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn"  id={{$product->id}} onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"id={{$product->id}} onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                </div>

                                @php
                                $amount =$product->selling_price- $product->discount_price;
                                $discount = ($amount/$product->selling_price) * 100;
    
                             @endphp
                                <div class="product-badges product-badges-position product-badges-mrg">
          
                        @if($product->discount_price == 0)
                        <span class="new">New</span>
                        @else
                         <span class="hot">{{ round($discount) }}%</span>
                        @endif
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">{{$product['category']['name']}}</a>
                                </div>
                                <h2><a href={{url("product/details/$product->id/$product->slug")}}>{{$product->name}}</a></h2>
                                <div class="product-rate-cover">
                               
            @php
            $avgRating = App\Models\Review::where("product_id",$product->id)->where("status","!=",0)->avg('rating');

            $reviews = App\Models\Review::where("product_id",$product->id)->where("status","!=",0)->get();
            
        @endphp
                                    <div class="product-rate d-inline-block">

                        @if($avgRating == 0)

                        @elseif($avgRating ==1 || $avgRating < 2 )
                            <div class="product-rating" style="width: 20%"></div>
                        @elseif($avgRating ==2 || $avgRating < 3 )
                        <div class="product-rating" style="width: 40%"></div>
                        @elseif($avgRating ==3 || $avgRating < 4 )
                        <div class="product-rating" style="width: 60%"></div>
                        @elseif($avgRating ==4 || $avgRating < 5 )
                        <div class="product-rating" style="width: 80%"></div>
                        @elseif($avgRating ==5 || $avgRating < 5 )

                        <div class="product-rating" style="width: 100%"></div>

                        @endif
        


                                    </div>
                                    <span class="font-small ml-5 text-muted"> ( {{count($reviews)}} Reviews )</span>

                                </div>
                                <div>

                                @if ($product->vendor_id==null)
                                <span class="font-small text-muted">By <a href="#">Owner</a></span>

                                @else
                                <span class="font-small text-muted">By <a href="{{route('vendor.details',$product['vendor']['id'])}}">
                                    {{$product['vendor']['name']}}</a></span>
                                    
                                @endif
                                   
                                </div>
                                <div class="product-card-bottom">

                        @if($product->discount_price == 0)

                        <div class="product-price">
                            <span>${{$product->selling_price}}</span>
                        </div>

                         

                        @else
                        <div class="product-price">
                            <span>${{$product->discount_price}}</span>
                            <span class="old-price">${{$product->selling_price}}</span>
                        </div>
                        @endif
                                
                                  
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
                    <!--end product card-->




                    <!--end product card-->
                </div>
                <!--product grid-->
                <div class="pagination-area mt-20 mb-20">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-start">
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">6</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
                
                <!--End Deals-->

                
            </div>
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <div class="sidebar-widget widget-category-2 mb-30">
                    <h5 class="section-title style-1 mb-30">Category</h5>
                    <ul>

                        @foreach ($categories as $category)

                        @php
                            $num_products =App\Models\Product::where("category_id",$category->id)->get();
                        @endphp
                            
                        <li>
                            <a href={{route('category.products',[$category->id,$category->slug])}}> <img src={{asset("storage/$category->image")}} alt="" />{{$category->name}}</a><span class="count">{{count($num_products)}}</span>
                        </li>

                        @endforeach

                      
                    </ul>
                </div>
              
                <!-- Product sidebar Widget -->
                <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                    <h5 class="section-title style-1 mb-30">New products</h5>

                    @foreach ($new_products as $new_product )
                        
                    <div class="single-post clearfix">
                        <div class="image">
                            <img src={{
                            asset("storage/$new_product->product_thambnail")}} alt="#" />
                        </div>
                        <div class="content pt-10">
                            <p><a href={{url("product/details/$new_product->id/$new_product->slug")}}>{{$new_product->name}}</p>


                            
                        @if($new_product->discount_price == 0)
                            <p class="price mb-0 mt-5">${{$new_product->selling_price}}</p>
                                @else
                                 <span class="hot">${{$new_product->discount_price }}</span>
                                @endif
                            <div class="product-rate">
                                <div class="product-rating" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>

                    @endforeach

                   
                </div>
              
            </div>
        </div>
    </div>


@endsection