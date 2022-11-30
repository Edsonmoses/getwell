<div>
   <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                     <div class="row">
                        <div class="button-list mb-1" style="text-align: right;">
                            <a href="{{ route('admin.addabout') }}" type="button" class="btn btn-success waves-effect waves-light">Add About us</a>
                        </div>
                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                            @forelse ( $aboutus as $aboutus )
                                <tr>
                                    <td>{{ $aboutus->id }}</td>
                                    <td>{{ $aboutus->title }}</td>
                                    <td>{!! Str::words($aboutus->subtitle , 6, ' ...') !!}</td>
                                    <td>{{ $aboutus->status }}</td>
                                    <td>{{ $aboutus->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.editabout',['slug'=>$aboutus->slug]) }}"><i  class="fa fa-edit fa-1x"></i></a>
                                        <a href="#" onclick="confirm('Ara you sure, You want to delete this Hero aboutus') || event.stopImmediatePropagation()" wire:click.prevent="deleteVector({{ $aboutus->id }})" style="margin:0 10px 0 10px"><i class="fa fa-trash fa-1x text-danger"></i></a>
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
