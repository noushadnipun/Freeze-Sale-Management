@extends('admin.layouts.master')

@section('site-title')
Sevices
@endsection

@section('page-content')
@include('admin.includes.message')

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-body">
                 <div class="pb-2 d-flex justify-content-between">
                    <div>
                        <label for="">Search</label>
                        <form action="" method="get" id='searchform'>
                            @csrf
                            <input type="text" name="search" id="search" class="form-control form-control-sm" placeholder="Visi ID / Visi Size">
                        </form>
                    </div>

                    <div>
                        <label for="">Filter By Outlets</label>
                        <select name="" id="filterOutlet" class="form-control form-control-sm">
                            @php
                                $filterOutlet = App\Outlet::get();
                            @endphp
                            <option value="showall" selected>Show All</option>
                            @foreach ($filterOutlet as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach 
                        </select>
                    </div>

                    <div>
                        <label for="">Filter By Distributor</label>
                        <select name="" id="filterDistributor" class="form-control form-control-sm">
                            @php
                                $filterDistributor = App\Distributor::get();
                            @endphp
                            <option value="showall" selected>Show All</option>
                            @foreach ($filterDistributor as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach 
                        </select>
                    </div>

                    <div class="">
                        <label>Filter By Date</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" name="datefilter" class="form-control form-control-sm" id="reservation" autocomplete="off">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div>
                        <label for="">Export As PDF</label>
                        <a href="{{route('admin_sale_pdf')}}" target="_blank" class="btn btn-sm btn-danger d-block">Export as pdf</a>
                    </div>

                    <div>
                        <label for="">Export As Excel</label>
                        <a href="{{route('admin_sale_export_excel')}}" target="_blank" class="btn btn-sm btn-success d-block">Export as Excel</a>
                    </div>


                </div>
            </div>
        </div>


        <div class="card card-purple card-outline">
            <div class="card-header">
                <h3 class="card-title">All Service Records</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body px-2 py-3">
              <div id="showdata">
              </div>

             
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

@endsection
@section('cusjs')

<script>
    $(document).ready(function(){
        //Show All Data
        function getRecord(){
            $.ajax({
                type: "GET",
                url: "{{route('admin_sale_ajax_get_datatable')}}",
                //url: "{{route('admin_distributor_sale', '63')}}",
                success: function(data){
                    $("#showdata").empty().append(data)
                    //call Paginate Function which is created Below
                    paginate("{{route('admin_sale_ajax_get_datatable')}}")
                }
            })
        }
        getRecord()
        //
        //Paginition
            function paginate(arg){
                $('#showdata').on('click', ".pagination a", function(e){
                    e.preventDefault();
                    let url = $(this).attr('href').split('page=')[1];
                    $.ajax({
                        type: "get",
                        url: arg+"?page="+url,
                        success: function(data){
                            $('#showdata').empty().append(data);
                        },
                    })
                })
            }
        paginate();

        //
        //Search
        $('#searchform').on('keyup', function(){
            var search = $('input#search').val()
            //console.log(search);
            var token = '{{ csrf_token() }}';
            $.ajax({
                type: "GET",
                url: "{{route('admin_sale_search')}}",
                data: {
                    search : search,
                    _token: token,
                },
                success: function(data){
                    // console.log(data)
                    if(search){
                        $('#showdata').empty().append(data);
                        paginate("{{route('admin_sale_search')}}");
                        //console.log(data)
                    } else {
                        getRecord() 
                    }
                }
            })
        })

        //Filter
        //Filter Outlet
        $("#filterOutlet").change(function(e){
            e.preventDefault;
            let foutletUrl = $(this).find(":selected").val();
            $.ajax({
                type: "GET",
                url: "{{route('admin_sale_filterOutlet', '')}}/"+foutletUrl,
                success: function(data){
                    if(foutletUrl != 'showall'){
                        $('#showdata').empty().append(data);
                    } else{
                        getRecord() 
                    }
                    //console.log(data)
                }
            })
        })
        //Filter Distributor
        $("#filterDistributor").change(function(e){
            e.preventDefault;
            let fdistributorUrl = $(this).find(":selected").val();
            $.ajax({
                type: "GET",
                url: "{{route('admin_sale_filterDistributor', '')}}/"+fdistributorUrl,
                success: function(data){
                    if(fdistributorUrl != 'showall'){
                        $('#showdata').empty().append(data);
                    } else{
                        getRecord() 
                    }
                    //console.log(data)
                }
            })
        })

        //Filter DateRange 
        $('#reservation').change('.applyBtn', function(e){
            e.preventDefault;
            let dateRangePick = $('input#reservation').val();
            $.ajax({
                type: "GET",
                url: "{{route('admin_sale_filterDate', '')}}/"+dateRangePick,
                success: function(data){
                    $('#showdata').empty().append(data);
                    //console.log(data)
                }
            })
        })
        $('.cancelBtn').click(function(e){
            e.preventDefault;  
            getRecord()   
            console.log('s')
        })

    })
</script>


<style>
    .table td{
        padding: 2px;
        vertical-align: middle;
    }
    .table th {
        vertical-align: middle;
    }
    .table td div.border-bottom {
        vertical-align: top;
    }
    .table td div.border-bottom:last-child{
        border-bottom: 0px !important;
    }
</style>


<script>
    //Date range picker
    $('#reservation').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD',
        },
    })
  
    //Date range picker with time picker
    
    $('#reservationtime').daterangepicker({
    timePicker: false,
    timePickerIncrement: 0,
    locale: {
        format: 'MM-DD-YYYY hh:mm A'
    }
})



</script>


@endsection