<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                @if (Session::has('message'))
                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                @endif
                  <div class="row">
                        <div class="button-list mb-1" style="text-align: right;">
                            <a href="{{ route('admin.team') }}" type="button" class="btn btn-primary waves-effect waves-light">All Teams</a>
                            <a href="{{ route('admin.addteam') }}" type="button" class="btn btn-success waves-effect waves-light">Add Team</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <form class="form-horizontal" files="true" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Name</label>
                                    <input type="text" id="simpleinput" class="form-control" wire:model="name"  wire:keyup="generateSlug">
                                    @error('name')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="example-email" class="form-label">desc</label>
                                    <textarea class="form-control" id="example-textarea" rows="5"  wire:model="desc"></textarea>
                                     @error('desc')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="example-password" class="form-label">Education</label>
                                    <textarea class="form-control" id="example-textarea" rows="5"  wire:model="education"></textarea>
                                    @error('education')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">specialr</label>
                                    <input type="text" id="simpleinput" class="form-control"  wire:model="specialr">
                                    @error('specialr')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Email</label>
                                    <input type="text" id="simpleinput" class="form-control"  wire:model="email">
                                    @error('email')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">hours</label>
                                    <input type="text" id="simpleinput" class="form-control"  wire:model="hours">
                                    @error('hours')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Linkedin</label>
                                    <input type="text" id="simpleinput" class="form-control"  wire:model="linkedin">
                                    @error('linkedin')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="example-fileinput" class="form-label">Image</label>
                                    <input type="file" id="example-fileinput" class="form-control"  wire:model="image"/>
                                    @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}" width="120"/>
                                    @endif
                                    @error('image')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Subtitle</label>
                                    <input type="text" id="simpleinput" class="form-control"  wire:model="subtitle">
                                    @error('subtitle')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                        </div> <!-- end col -->

                        <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Designation</label>
                                    <input type="text" id="simpleinput" class="form-control"  wire:model="designation">
                                    @error('designation')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="example-multiselect" class="form-label">bio</label>
                                    <textarea class="form-control" id="example-textarea" rows="5"  wire:model="bio"></textarea>
                                    @error('bio')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="example-multiselect" class="form-label">specialeft</label>
                                    <input type="text" id="simpleinput" class="form-control"  wire:model="specialeft">
                                    @error('specialeft')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="example-multiselect" class="form-label">Address</label>
                                    <input type="text" id="simpleinput" class="form-control"  wire:model="address">
                                    @error('address')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="example-multiselect" class="form-label">Phone</label>
                                    <input type="text" id="simpleinput" class="form-control"  wire:model="phone">
                                    @error('phone')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                                 <div class="mb-3">
                                    <label for="example-multiselect" class="form-label">Facebook</label>
                                    <input type="text" id="simpleinput" class="form-control"  wire:model="facebook">
                                    @error('facebook')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                                 <div class="mb-3">
                                    <label for="example-multiselect" class="form-label">Twitter</label>
                                    <input type="text" id="simpleinput" class="form-control"  wire:model="twitter">
                                    @error('twitter')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="example-multiselect" class="form-label">Department</label>
                                    <select class="form-select" wire:model="department_id">
                                    <option selected=""> Select department</option>
                                    @forelse ($departmentlists as $department )
                                         <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @empty
                                        
                                    @endforelse
                                   
                                </select>
                                    @error('title')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>

                                 <div class="mb-3">
                                    <label for="example-multiselect" class="form-label">Title</label>
                                    <input type="text" id="simpleinput" class="form-control"  wire:model="title">
                                    @error('title')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>

                                
                        </div> <!-- end col -->
                            <input type="submit" id="SubmitBtn" value="Save Teams" name="submit" wire:click.prevent="addTeams()" class="btn btn-info rounded-pill waves-effect waves-light col-md-2">
                    </form>
                    </div>
                    <!-- end row-->

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div>
    <!-- end row -->
</div>
