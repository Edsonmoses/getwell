<div>
   <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                     <div class="row">
                        <div class="button-list mb-1" style="text-align: right;">
                            <a href="{{ route('admin.adddepartmentlist') }}" type="button" class="btn btn-success waves-effect waves-light">Add Department</a>
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
                            @forelse ( $departmentlist as $depart )
                                <tr>
                                    <td>{{ $depart->id }}</td>
                                    <td><img src="{{ asset('assets/img/departmentlist') }}/{{ $depart->image }}" width="60"/></td>
                                    <td>{{ $depart->name }}</td>
                                    <td>{{ $depart->status }}</td>
                                    <td>{{ $depart->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.editdepartmentlist',['slug'=>$depart->slug]) }}"><i  class="fa fa-edit fa-1x"></i></a>
                                        <a href="#" onclick="confirm('Ara you sure, You want to delete this department') || event.stopImmediatePropagation()" wire:click.prevent="deleteVector({{ $depart->id }})" style="margin:0 10px 0 10px"><i class="fa fa-trash fa-1x text-danger"></i></a>
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
