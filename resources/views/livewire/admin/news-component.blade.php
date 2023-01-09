<div>
   <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="mt-0 header-title">Subscribed users</h3>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                            @forelse ( $news as $subscribed )
                            @if ($subscribed->email)
                                <tr>
                                    <td>{{ $subscribed->id }}</td>
                                    <td>{{ $subscribed->email }}</td>
                                    <td>{{ $subscribed->status }}</td>
                                    <td>{{ $subscribed->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.editnews',['slug'=>$subscribed->slug]) }}"><i  class="fa fa-edit fa-1x"></i></a>
                                        <a href="#" onclick="confirm('Ara you sure, You want to delete this Hero subscribed') || event.stopImmediatePropagation()" wire:click.prevent="deleteVector({{ $subscribed->id }})" style="margin:0 10px 0 10px"><i class="fa fa-trash fa-1x text-danger"></i></a>
                                    </td>
                                </tr>
                                @endif
                            @empty
                                
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="mt-0 header-title"> Intro text</h3>
                     <div class="row">
                        <div class="button-list mb-1" style="text-align: right;">
                            <a href="{{ route('admin.addnews') }}" type="button" class="btn btn-success waves-effect waves-light">Add News</a>
                        </div>
                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                            @forelse ( $news as $hnews )
                                <tr>
                                    <td>{{ $hnews->id }}</td>
                                    <td>{{ $hnews->title }}</td>
                                    <td>{{ $hnews->status }}</td>
                                    <td>{{ $hnews->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.editnews',['slug'=>$hnews->slug]) }}"><i  class="fa fa-edit fa-1x"></i></a>
                                        <a href="#" onclick="confirm('Ara you sure, You want to delete this Hero hnews') || event.stopImmediatePropagation()" wire:click.prevent="deleteVector({{ $hnews->id }})" style="margin:0 10px 0 10px"><i class="fa fa-trash fa-1x text-danger"></i></a>
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
