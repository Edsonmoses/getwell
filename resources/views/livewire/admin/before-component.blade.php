<div>
   <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                     <div class="row">
                        <div class="button-list mb-1" style="text-align: right;">
                            <a href="{{ route('admin.addbefore') }}" type="button" class="btn btn-success waves-effect waves-light">Add before</a>
                        </div>
                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Before & After</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                            @forelse ( $before as $before )
                                <tr>
                                    <td>{{ $before->id }}</td>
                                    <td><img src="{{ asset('assets/img/before') }}/{{ $before->before }}" width="60"/><img src="{{ asset('assets/img/before') }}/{{ $before->after }}" width="60"/></td>
                                    <td>{{ $before->title }}</td>
                                    <td>{{ $before->status }}</td>
                                    <td>{{ $before->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.editbefore',['slug'=>$before->slug]) }}"><i  class="fa fa-edit fa-1x"></i></a>
                                        <a href="#" onclick="confirm('Ara you sure, You want to delete this Hero before') || event.stopImmediatePropagation()" wire:click.prevent="deleteVector({{ $before->id }})" style="margin:0 10px 0 10px"><i class="fa fa-trash fa-1x text-danger"></i></a>
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
