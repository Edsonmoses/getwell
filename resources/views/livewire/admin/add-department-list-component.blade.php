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
                            <a href="{{ route('admin.departmentlist') }}" type="button" class="btn btn-primary waves-effect waves-light">All Department Categories</a>
                            <a href="{{ route('admin.adddepartmentlist') }}" type="button" class="btn btn-success waves-effect waves-light">Add Department Category</a>
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

                                
                        </div> <!-- end col -->

                        <div class="col-lg-6">
                            <div class="mb-3">
                                    <label for="example-fileinput" class="form-label">Image</label>
                                    <input type="file" id="example-fileinput" class="form-control"  wire:model="image"/>
                                    @if ($image)
                                    {{-- <img src="{{ $image->temporaryUrl() }}" width="120"/>--}}
                                    @endif
                                    @error('image')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                         </div> <!-- end col -->
                            <input type="submit" id="SubmitBtn" value="Save Department" name="submit" wire:click.prevent="addDepartment()" class="btn btn-info rounded-pill waves-effect waves-light col-md-2">
                    </form>
                    </div>
                    <!-- end row-->

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div>
    <!-- end row -->
</div>
