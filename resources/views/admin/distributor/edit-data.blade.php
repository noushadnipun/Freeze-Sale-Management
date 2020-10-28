<form action="{{ (!empty($editDistributor)) ? route('admin_distributor_update') : route('admin_distributor_store') }}" method="POST" id="form-update">
    @csrf
    @if(!empty($editDistributor))
        <input type="hidden" name="id" id="id" value="{{$editDistributor->id}}">
    @endif
    <div class="card card-purple card-outline">
        <div class="card-header bg-purple">
            <h3 class="card-title">Edit</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
            <label for="outletName">Distributor Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" value="{{ (!empty($editDistributor)) ? $editDistributor->name : '' }}" required>
            </div>
            <div class="form-group">
                <label for="outletMobile">Cell No</label>
                <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Enter Mobile" value="{{ (!empty($editDistributor)) ? $editDistributor->mobile : '' }}">
            </div>
            <div class="form-group">
                <label for="outletAddess">Description</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="Enter Address" value="{{ (!empty($editDistributor)) ? $editDistributor->description : '' }}">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn bg-purple update-data-btn">Update</button>
        </div>
    </div>
</form>