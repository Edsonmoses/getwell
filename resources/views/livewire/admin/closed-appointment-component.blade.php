<div>
   <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                     <div class="row">
                        <div class="button-list mb-1" style="text-align: right;">
                            <a href="{{ route('admin.appointment') }}" type="button" class="btn btn-success waves-effect waves-light">Open Appointment</a>
                        </div>
                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>email</th>
                            <th>Phone</th>
                             <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                            @forelse ( $closedappointments as $closed )
                                <tr>
                                    <td>{{ $closed->id }}</td>
                                    <td>{{ $closed->uname }}</td>
                                    <td>{{ $closed->uemail }}</td>
                                    <td>{{ $closed->unumber }}</td>
                                    <td>{{ $closed->status }}</td>
                                    <td>{{ $closed->created_at }}</td>
                                    <td>
                                        <a type="button" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg-{{ $closed->id }}"><i  class="fa fa-eye fa-1x"></i></a>
                                        @if ($closed->status == 'open')
                                         <a href="#" onclick="confirm('Ara you sure, You want to close this appointment') || event.stopImmediatePropagation()" wire:click.prevent="closed({{ $closed->id }})" style="margin:0 10px 0 10px"><i class="fa fa-times-circle fa-1x text-danger"></i></a>
                                        @endif
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
 <!--  Modal content for the Large example -->
  @forelse ( $closedappointments as $closed )
<div class="modal fade" id="bs-example-modal-lg-{{ $closed->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Appointment 00{{ $closed->id}} </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="container">
                <div class="row">
                    <div class="col-md-6 mb-2">
                       <strong>Full Name:</strong> {{ $closed->uname}}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Email Address:</strong> {{ $closed->uemail}}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Phone Number:</strong> {{ $closed->unumber}}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Booking Date:</strong> {{ $closed->udate}}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Department:</strong> {{ $closed->udepartment}}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Doctor:</strong> {{ $closed->udoctor}}
                    </div>
                    <div class="col-md-12">
                        <strong>Message:</strong><br/>{{ $closed->umsg}}
                    </div>
                    </div><!-- /.row -->
                </div><!-- /.container -->
               </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 @empty
 @endforelse