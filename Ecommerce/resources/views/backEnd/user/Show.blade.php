@extends('backEnd.layouts.master')
@section('title','List User')
@section('content')
    <div id="breadcrumb"> <a href="{{url('/admin')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{route('user.Show')}}" class="current">Users</a></div>
    <div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Well done!</strong> {{Session::get('message')}}
            </div>
        @endif
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>List User</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Name</th>    
                        <th>Email</th>
                        <th>Address</th>
                        <th>city</th>
                        <th>state</th>
                        <th>country</th>
                        <th>mobile</th>
                        <th>Join At</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <?php $i++; ?>
                        <tr class="gradeC">
                            <td>{{$i}}</td>
                            <td style="vertical-align: middle;">{{$user->id}}</td>
                            <td style="vertical-align: middle;">{{$user->name}}</td>
                            <td style="vertical-align: middle;">{{$user->email}}</td>
                            <td style="vertical-align: middle;">{{$user->address}}</td>
                            <td style="vertical-align: middle;">{{$user->city}}</td>
                            <td style="vertical-align: middle;">{{$user->state}}</td>
                            <td style="vertical-align: middle;">{{$user->country}}</td>
                            <td style="vertical-align: middle;">{{$user->mobile}}</td>
                            <td style="vertical-align: middle;">{{$user->created_at}}</td>
                           
                            

                            
                           
                            </td>

                        </tr>
                        
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('jsblock')
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.ui.custom.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.uniform.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/matrix.js')}}"></script>
    <script src="{{asset('js/matrix.tables.js')}}"></script>
    <script src="{{asset('js/matrix.popover.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
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
                confirmButtonText:'Yes, delete it!',
                cancelButtonText:'No, cancel!',
                confirmButtonClass:'btn btn-success',
                cancelButtonClass:'btn btn-danger',
                buttonsStyling:false,
                reverseButtons:true
            },function () {
                window.location.href="/admin/"+deleteFunction+"/"+id;
                //  window.location=window.location.href+"/admin/"+deleteFunction+"/"+id;
            });
        });
    </script>
@endsection