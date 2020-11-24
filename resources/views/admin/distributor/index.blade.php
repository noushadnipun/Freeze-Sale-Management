@extends('admin.layouts.master')

@section('site-title')
    Distributors
@endsection

@section('page-content')

    @include('admin.includes.message')

    <div class="row">
        <div class="col-md-4">
            <div id="dataform">
                <form action="{{ route('admin_distributor_store') }}" method="POST" id="form-submit" class="ni">
                    @csrf
                    <div class="card card-purple card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Add</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                            <label for="outletName">Distributor Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" required>
                            </div>
                            <div class="form-group">
                                <label for="outletMobile">Cell No</label>
                                <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Enter Mobile">
                            </div>
                            <div class="form-group">
                                <label for="outletAddess">Description</label>
                                <input type="text" name="description" id="description" class="form-control" placeholder="Enter Address">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn bg-purple store-data-btn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- End Col  4 -->
        <div class="col-md-8">
            <div class="card card-primary card-outline">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                       <h3 class="card-title">All Distributor Records </h3> <a href="{{ route('admin_distributor') }}" class=" ml-1 btn-xs btn-success" title="Add New">  <i class="fa fa-plus"></i></a>
                    </div> 

                    <form action="" method="get" id='searchform'>
                        @csrf
                        <input type="text" name="search" id="search" class="form-control form-control-sm">
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body" id="showdata">
              
                
                
              
            </div>
            <!-- /.card-body -->
          </div>
        </div>
    </div>

@endsection

@section('cusjs')
    <script>
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){
            let msg = $('#ajaxMsg');
            function fadeOut(){
                $(msg).delay(1200).fadeIn(200);
                $(msg).delay(1200).fadeOut(500);
            }


            //Showdata
            function getRecord(){
                $.ajax({
                    type: "GET",
                    url: "{{route('admin_distributor_data')}}",
                    success: function (data) {
                        //console.log(data)
                        $('#showdata').empty().append(data);
                        paginate();
                    }
                });
            }
            getRecord();

            // Data Store Form
            
            //Edit Data View
            $('#showdata').on('click', ".edit-data-btn", function(e){
                e.preventDefault();
                var id = $(this).data('target');
                $.ajax({
                    type: "GET",
                    url: "{{route('admin_distributor_edit', '')}}/"+id,
                    success: function (data) {
                        //alert(data)
                        $('#dataform').empty().append(data);
                        getRecord();
                    },
                });
            })
            //Data Store add Update
            
            //Update Data
            $('#dataform').on('click', '.update-data-btn',  function(e){
                e.preventDefault();
                var id = $('input#id').val();
                var token = '{{ csrf_token() }}';
                var name = $('input#name').val();
                var mobile = $('input#mobile').val();
                var description = $('input#description').val();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin_distributor_update') }}",
                    data:   {
                        _token: token,
                        id: id,
                        name: name,
                        mobile: mobile,
                        description: description,
                    },
                    success: function(data){
                        $(msg).empty().append('<div class="alert alert-success" role="alert">Data Updated Successfully</div>');
                        fadeOut();
                        //$('input').val('');
                        getRecord();
                    }
                })
                
            })
            //
            //Delete Data
            $('#showdata').on('click',".delete-data-btn", function(e){
                e.preventDefault();
                var id = $(this).data('target');
                $.ajax({
                    type: 'GET',
                    url: "{{route('admin_distributor_delete', '')}}/"+id,
                    success: function(data){
                        $(msg).empty().append('<div class="alert alert-danger" role="alert">Data Deleted Successfully</div>');
                        fadeOut();
                        getRecord();
                    }
                })
                    
            })
            //
            
            //Create data
            $('#form-submit').on('submit', function(e){
                e.preventDefault();

                //console.log('success');
                var token = '{{ csrf_token() }}';
                var name = $('input#name').val();
                var mobile = $('input#mobile').val();
                var description = $('input#description').val();

                //insert Dtata
                $.ajax({
                    type: 'post',
                    url:   '{{ route('admin_distributor_store') }}',
                    data:   {
                        _token: token,
                        name: name,
                        mobile: mobile,
                        description: description,
                    },
                    success: function(data){
                        $(msg).empty().append('<div class="alert alert-success" role="alert">Data Added Successfully</div>');
                        fadeOut();
                        $('input').val('');
                        getRecord();
                    },
                    error: function(data){
                        alert("Error")
                    } 
                })

            })

            //

            //Paginition
            function paginate(){
                $(document).ajaxComplete(function() {
                    $('.pagination a').click(function(e) {
                        e.preventDefault();
                        var url = $(this).attr('href');
                        $.ajax({
                            url: url,
                            success: function(data) {
                                $('#showdata').html(data);
                            }
                        });
                    });
                });
            }
            
            //

            //Search
            $('#searchform').on('keyup', function(){
                var search = $('input#search').val()
                //console.log(search);
                var token = '{{ csrf_token() }}';
                $.ajax({
                    type: "GET",
                    url: "{{route('admin_distributor_search')}}",
                    data: {
                        search : search,
                        _token: token,
                    },
                    success: function(data){
                        // console.log(data)
                        if(search){
                            $('#showdata').empty().html(data);
                            paginate();
                            //console.log(data.length)
                        } else {
                            getRecord() 
                        }
                    }
                })
            })
            

        })
    </script>

    <?php /*
    <link rel="stylesheet" href="{{asset('public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <script src="{{asset('public/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>


    <script>
    $(function () {
        $('#customDataTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        });
    });
    </script>
    */?>
@endsection
