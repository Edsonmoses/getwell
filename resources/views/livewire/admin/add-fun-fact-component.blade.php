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
                            <a href="{{ route('admin.funfact') }}" type="button" class="btn btn-primary waves-effect waves-light">All Funfacts</a>
                            <a href="{{ route('admin.addfunfact') }}" type="button" class="btn btn-success waves-effect waves-light">Add Funfact</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <form class="form-horizontal" files="true" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Title</label>
                                    <input type="text" id="simpleinput" class="form-control" wire:model="title"  wire:keyup="generateSlug">
                                    @error('title')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="example-fileinput" class="form-label">Icon</label>
                                    <input type="file" id="example-fileinput" class="form-control"  wire:model="icon"/>
                                    @if ($icon)
                                    <img src="{{ $icon->temporaryUrl() }}" width="120"/>
                                    @endif
                                    @error('icon')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Video link</label>
                                    <input type="text" id="simpleinput" class="form-control"  wire:model="video">
                                    @error('video')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                        </div> <!-- end col -->

                        <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Counter</label>
                                    <input type="text" id="simpleinput" class="form-control"  wire:model="number">
                                    @error('number')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="example-fileinput" class="form-label">Video Image</label>
                                    <input type="file" id="example-fileinput" class="form-control"  wire:model="videoimg"/>
                                    @if ($videoimg)
                                    <img src="{{ $videoimg->temporaryUrl() }}" width="120"/>
                                    @endif
                                    @error('videoimg')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                        </div> <!-- end col -->
                            <input type="submit" id="SubmitBtn" value="Save Funfact" name="submit" wire:click.prevent="addFunfacts()" class="btn btn-info rounded-pill waves-effect waves-light col-md-2">
                    </form>
                    </div>
                    <!-- end row-->

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div>
    <!-- end row -->
</div>
