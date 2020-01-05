@extends('backEnd.layouts.master')
@section('title','detailorder')
@section('content')
    <!--breadcrumbs-->

    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
    </div>

        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Detail Order</h5>
            </div>
            <br>
            <h2>Detail Order </h2>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>ID User</th>
                        <th>Name</th>
                        <th>address</th>
                        <th>order_status</th>
                        <th>Phone Number</th>
                       

                    </tr>
                    </thead>

                    <tbody>
                    @foreach($orders as $order)
                        <?php $i++; ?>
                        <tr class="gradeC">
                            <td>{{$i}}</td>
                            <td style="vertical-align: middle;">{{$order->users_id}}</td>
                            <td style="vertical-align: middle;">{{$order->name}}</td>
                            <td style="vertical-align: middle;">{{$order->address}},{{$order->city}},{{$order->state}},{{$order->country}}</td>
                            <td style="vertical-align: middle;">{{$order->order_status}}</td>
                            <td style="vertical-align: middle;">{{$order->mobile}}</td>
                            
                            <td style="text-align: center; vertical-align: middle;">                                     
                            </td>
                            

                        </tr>
                        
                    @endforeach
                    </tbody>

                </table>
            </div>
            </div>
                    <section id="cart_items">
                        <div class="review-payment">
                            <br>
                            <br>
                            
                        </div>
                        <div class="table-responsive cart_info">
                            <table class="table table-condensed">
                                <thead>
                                <tr class="cart_menu">
                                    <td class="image">Item</td>
                                    <td class="description"></td>
                                    <td class="price">Price</td>
                                    <td class="quantity">Quantity</td>
                                    <td class="total">Total</td>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($cart_datas as $cart_data)
                                    <?php
                                    $image_products=DB::table('products')->select('image')->where('id',$cart_data->products_id)->get();
                                    ?>
                                    <tr>
                                    <td class="cart_product">
                                        @foreach($image_products as $image_product)
                                            <a href=""><img src="{{url('products/small',$image_product->image)}}" alt="" style="width: 100px;"></a>
                                        @endforeach
                                    </td>
                                    <td class="cart_description">
                                        <h4><a href="">{{$cart_data->product_name}}</a></h4>
                                        <p>{{$cart_data->product_code}} | {{$cart_data->size}}</p>
                                    </td>
                                    <td class="cart_price">
                                        <p>Rp {{$cart_data->price}} K</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <p>{{$cart_data->quantity}}</p>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">Rp {{$cart_data->price*$cart_data->quantity}} K</p>
                                    </td>
                                    
                                </tr>
                               
                                @endforeach
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td style="text-align: center; vertical-align: middle;">
                                  <a href="javascript:" rel="{{$order->id}}" rel1="finish-oreder" class="btn btn-danger btn-medium deleteRecord">Finish</a>
                            </td>
                                </tbody>
                            </table>
                        </div>
                       
                    </section>

                </div>
            </form>
        </div>
    </div>
    <div style="margin-bottom: 20px;"></div>
        </div>




    </div>
   



   

    

@endsection


@section('jsblock')
    <script src="{{asset('js/excanvas.min.js')}}"></script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.ui.custom.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.flot.min.js')}}"></script>
    <script src="{{asset('js/jquery.flot.resize.min.js')}}"></script>
    <script src="{{asset('js/jquery.peity.min.js')}}"></script>
    <script src="{{asset('js/fullcalendar.min.js')}}"></script>
    <script src="{{asset('js/matrix.js')}}"></script>
    <script src="{{asset('js/matrix.dashboard.js')}}"></script>
    <script src="{{asset('js/jquery.gritter.min.js')}}"></script>
    <script src="{{asset('js/matrix.interface.js')}}"></script>
    <script src="{{asset('js/matrix.chat.js')}}"></script>
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/jquery.wizard.js')}}"></script>
    <script src="{{asset('js/jquery.uniform.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/matrix.popover.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/matrix.tables.js')}}"></script>
    <script src="{{asset('js/matrix.form_validation.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script type="text/javascript">
        // This function is called from the pop-up menus to transfer to
        // a different page. Ignore if the value returned is a null string:
        function goPage (newURL) {

            // if url is empty, skip the menu dividers and reset the menu selection to default
            if (newURL != "") {

                // if url is "-", it is this page -- reset the menu:
                if (newURL == "-" ) {
                    resetMenu();
                }
                // else, send page to designated URL
                else {
                    document.location.href = newURL;
                }
            }
        }

        // resets the menu selection upon entry to this page:
        function resetMenu() {
            document.gomenu.selector.selectedIndex = 2;
        }
    </script>

<script>
        $(".deleteRecord").click(function () {
            var id=$(this).attr('rel');
            var deleteFunction=$(this).attr('rel1');
            swal({
                title:'Are you sure?',
                text:"You won't be able to revert this!",
                type:'warning',
                showCancelButton:true,
                confirmButtonColor:'#3085d6',
                cancelButtonColor:'#d33',
                confirmButtonText:'Yes, finish it!',
                cancelButtonText:'No, cancel!',
                confirmButtonClass:'btn btn-success',
                cancelButtonClass:'btn btn-danger',
                buttonsStyling:false,
                reverseButtons:true
            },function () {
                window.location.href="/admin/"+deleteFunction+"/"+id;
            });
        });
    </script>

@endsection
