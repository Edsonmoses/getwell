<div>
   <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                            @forelse ( $contactform as $contact )
                                <tr>
                                    <td>{{ $contact->id }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>{{ $contact->subject }}</td>
                                    <td>{{ $contact->created_at }}</td>
                                    <td>
                                        <a type="button" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg-{{ $contact->id }}"><i  class="fa fa-eye fa-1x"></i></a>
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
  @forelse ( $contactform as $contact )
<div class="modal fade" id="bs-example-modal-lg-{{ $contact->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Contact Form 00{{ $contact->id}} </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="container">
                <div class="row">
                    <div class="col-md-6 mb-2">
                       <strong>Full Name:</strong> {{ $contact->name}}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Email Address:</strong> {{ $contact->email}}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Phone Number:</strong> {{ $contact->phone}}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Subject:</strong> {{ $contact->subject}}
                    </div>
                    <div class="col-md-12">
                        <strong>Message:</strong><br/>{{ $contact->msg}}
                    </div>
                    </div><!-- /.row -->
                </div><!-- /.container -->
               </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 @empty
 @endforelse