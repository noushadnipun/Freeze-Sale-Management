<option>Select Visi ID</option>
@foreach($getOutlet as $data)
    
    <option 
            data-token="{{$data->name}}" 
            data-outlet-name="{{$data->name}}" 
            data-outlet-id="{{$data->id}}" 
            data-mobile="<?php echo 'Mobile: '?>{{$data->mobile}}" 
            data-address="<?php echo 'Address: '?>{{$data->address}}" 
            data-distributor="<?php $dataDistrobutor = App\Distributor::where('id', $data->distributor_id)->first();?>{{!empty($dataDistrobutor) ? $dataDistrobutor->name: ''}}" 
            data-distributor-id="{{!empty($dataDistrobutor) ? $dataDistrobutor->id: ''}}"
            data-visi-size="{{$data->visi_size}}"
            value="{{$data->id}}"> 
            
            {{$data->visi_id}} 

    </option>
@endforeach
    

