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
                            <a href="{{ route('admin.department') }}" type="button" class="btn btn-primary waves-effect waves-light">All Departments</a>
                            <a href="{{ route('admin.adddepartment') }}" type="button" class="btn btn-success waves-effect waves-light">Add Department</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <form class="form-horizontal" files="true" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @if ($toptitle)
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Intro Title</label>
                                    <input type="text" id="simpleinput" class="form-control" wire:model="toptitle">
                                    @error('toptitle')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                               @endif
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Title</label>
                                    <input type="text" id="simpleinput" class="form-control" wire:model="title"  wire:keyup="generateSlug">
                                    @error('title')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="example-password" class="form-label">Department</label>
                                    <select class="form-select" wire:model="department_id">
                                        <option selected=""> Select department</option>
                                        @forelse ($departmentl as $list )
                                            <option value="{{ $list->id }}">{{ $list->name }}</option>
                                        @empty
                                            
                                        @endforelse
                                    </select>
                                    @error('department_id')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="example-fileinput" class="form-label">Image</label>
                                    <input type="file" id="example-fileinput" class="form-control"  wire:model="newimage"/>
                                      @if($newimage)
                                            <img src="{{ $newimage->temporaryUrl() }}" width="120"/>
                                        @else
                                            <img src="{{ asset('assets/img/departments')}}/{{ $image }}" width="120"/>
                                        @endif
                                    @error('image')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                        </div> <!-- end col -->

                        <div class="col-lg-6">
                            @if ($topsubtitle)
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Intro Subtitle</label>
                                    <input type="text" id="simpleinput" class="form-control"  wire:model="topsubtitle">
                                    @error('topsubtitle')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                              @endif
                                <div class="mb-3">
                                    <label for="example-email" class="form-label">Subtitle</label>
                                    <input type="text" id="simpleinput" class="form-control" wire:model="subtitle">
                                        @error('subtitle')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="example-multiselect" class="form-label">Working hours</label>
                                    <select class="form-select" wire:model="timetable_id">
                                        <option selected=""> Select Work hours</option>
                                        @forelse ($timetable as $ttable )
                                            <option value="{{ $ttable->id }}">{{ $ttable->name }} {{ $ttable->wtime }}</option>
                                        @empty
                                            
                                        @endforelse
                                    </select>
                                    @error('timetable_id')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="example-textarea" class="form-label">Description</label>
                                <textarea class="form-control" id="example-textarea" rows="5"  wire:model="desc"></textarea>
                                @error('desc')<p class="text-danger">{{ $message }}</p>@enderror
                            </div>
                        </div><!-- end col -->
                            <input type="submit" id="SubmitBtn" value="Update Department" name="submit" wire:click.prevent="updateDepartments()" class="btn btn-info rounded-pill waves-effect waves-light col-md-2">
                    </form>
                    </div>
                    <!-- end row-->

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div>
    <!-- end row -->
</div>
