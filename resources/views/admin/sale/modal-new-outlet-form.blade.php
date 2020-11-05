<!-- Modal -->
<div class="modal fade" id="{{ (!empty($editOutlet)) ? 'exampleModal'.$editOutletID : 'exampleModal'}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ (!empty($editOutlet)) ? route('admin_outlet_update') : route('admin_outlet_store') }}" method="POST" id="{{ (!empty($editOutlet)) ? 'modalOutletEdit' : 'modalOutletNew'}}">
                @csrf
                @if(!empty($editOutlet))
                    <input type="hidden" name="id" id="id" value="{{$editOutlet->id}}">
                @endif
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ (!empty($editOutlet)) ? 'Edit Outlet' : 'Add New Outlet'}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    
                <div class="modal-body">
                    <div id="msg"></div>
                    <div class="form-group">
                        <label for="outletName">Visi ID</label>
                        <input type="text" name="visi_id" class="form-control" placeholder="Enter ID" value="{{ (!empty($editOutlet)) ? $editOutlet->visi_id : '' }}" required>
                    </div>
                    <div class="form-group">
                        <label for="outletName">Visi Size</label>
                        <input type="text" name="visi_size" class="form-control" placeholder="Enter Size" value="{{ (!empty($editOutlet)) ? $editOutlet->visi_size : '' }}" required>
                    </div>
                    <div class="form-group">
                        <label for="outletName">Outlet Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter name" value="{{ (!empty($editOutlet)) ? $editOutlet->name : '' }}" required>
                    </div>
                    <div class="form-group">
                        <label for="outletAddess">Outlet Address</label>
                        <input type="text" name="address" class="form-control" placeholder="Enter Address" value="{{ (!empty($editOutlet)) ? $editOutlet->address : '' }}" required>
                    </div>
                    <div class="form-group">
                        <label for="outletMobile">Cell No</label>
                        <input type="text" name="mobile" class="form-control" placeholder="Enter Mobile" value="{{ (!empty($editOutlet)) ? $editOutlet->mobile : '' }}" required>
                    </div>
                    <div class="form-group">
                        <label for="outletMobile"> Distributor</label>
                        <select name="distributor_id" id="" class="form-control">
                            <option value="">Select</option>
                            @php
                                $showDistributorList = App\Distributor::get();
                            @endphp
                            @foreach ($showDistributorList as $data)
                                <option value="{{$data->id}}" {{ (!empty($editOutlet)) && $editOutlet->distributor_id == $data->id ? 'selected' : '' }} >{{ $data->name }}</option>
                            @endforeach
                            
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submit-outlet-form" ddata-dismiss="modal">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
