<div>
   <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                     <div class="row">
                        <div class="button-list mb-1" style="text-align: right;">
                            <a href="{{ route('admin.addhero') }}" type="button" class="btn btn-success waves-effect waves-light">Add Slider</a>
                        </div>
                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                            @forelse ( $heros as $slider )
                                <tr>
                                    <td>{{ $slider->id }}</td>
                                    <td><img src="{{ asset('assets/img/hero') }}/{{ $slider->hero }}" width="60"/></td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->status }}</td>
                                    <td>{{ $slider->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.edithero',['slug'=>$slider->slug]) }}"><i  class="fa fa-edit fa-1x"></i></a>
                                        <a href="#" onclick="confirm('Ara you sure, You want to delete this Hero slider') || event.stopImmediatePropagation()" wire:click.prevent="deleteVector({{ $slider->id }})" style="margin:0 10px 0 10px"><i class="fa fa-trash fa-1x text-danger"></i></a>
                                    </td>
                                </tr>
                            @empty
                                
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</div>
