<div>
   <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                     <div class="row">
                        <div class="button-list mb-1" style="text-align: right;">
                            <a href="{{ route('admin.addcontact') }}" type="button" class="btn btn-success waves-effect waves-light">Add contact</a>
                        </div>
                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                            @forelse ( $contacts as $contact )
                                <tr>
                                    <td>{{ $contact->id }}</td>
                                    <td>{{ $contact->address }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->status }}</td>
                                    <td>{{ $contact->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.editcontact',['slug'=>$contact->slug]) }}"><i  class="fa fa-edit fa-1x"></i></a>
                                        <a href="#" onclick="confirm('Ara you sure, You want to delete this contact') || event.stopImmediatePropagation()" wire:click.prevent="deleteVector({{ $contact->id }})" style="margin:0 10px 0 10px"><i class="fa fa-trash fa-1x text-danger"></i></a>
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
