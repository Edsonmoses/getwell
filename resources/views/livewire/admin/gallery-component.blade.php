<div>
   <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                     <div class="row">
                        <div class="button-list mb-1" style="text-align: right;">
                            <a href="{{ route('admin.addgallery') }}" type="button" class="btn btn-success waves-effect waves-light">Add gallery</a>
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
                            @forelse ( $galleries as $gallery )
                                <tr>
                                    <td>{{ $gallery->id }}</td>
                                    <td>
                                         @php
                                                $image = explode(",",$gallery->image);
                                            @endphp
                                        @if (!empty($image[1]))
                                            <img src="{{ asset('assets/img/gallery') }}/{{ $image[1] }}" width="60"/>
                                        @endif
                                    </td>
                                    <td>{{ $gallery->name }}</td>
                                    <td>{{ $gallery->status }}</td>
                                    <td>{{ $gallery->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.editgallery',['slug'=>$gallery->slug]) }}"><i  class="fa fa-edit fa-1x"></i></a>
                                        <a href="#" onclick="confirm('Ara you sure, You want to delete this gallery') || event.stopImmediatePropagation()" wire:click.prevent="deleteVector({{ $gallery->id }})" style="margin:0 10px 0 10px"><i class="fa fa-trash fa-1x text-danger"></i></a>
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
