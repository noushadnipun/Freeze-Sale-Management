<!-- Modal -->
<div class="modal fade" id="modalOutletPreviousReportModal{{$getId}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content" id="modalOutletPreviousReport">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$lastThreeMonth}} to  {{$todayDate}} <span class="badge badge-secondary">{{$totalService}} Services</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    
                <div class="modal-body">
                    @include('admin.sale.index-datatable')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>
