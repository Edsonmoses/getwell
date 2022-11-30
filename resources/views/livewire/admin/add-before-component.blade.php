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
                            <a href="{{ route('admin.before') }}" type="button" class="btn btn-primary waves-effect waves-light">All Before</a>
                            <a href="{{ route('admin.addbefore') }}" type="button" class="btn btn-success waves-effect waves-light">Add Before</a>
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
                                    <label for="example-fileinput" class="form-label">Before Image</label>
                                    <input type="file" id="example-fileinput" class="form-control"  wire:model="before"/>
                                    @if ($before)
                                    <img src="{{ $before->temporaryUrl() }}" width="120"/>
                                    @endif
                                    @error('before')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                        </div> <!-- end col -->

                        <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="example-email" class="form-label">Subtitle</label>
                                    <input type="text" id="simpleinput" class="form-control" wire:model="subtitle">
                                        @error('subtitle')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="example-fileinput" class="form-label">After Image</label>
                                    <input type="file" id="example-fileinput" class="form-control"  wire:model="after"/>
                                    @if ($after)
                                    <img src="{{ $after->temporaryUrl() }}" width="120"/>
                                    @endif
                                    @error('after')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                        </div> <!-- end col -->
                            <input type="submit" id="SubmitBtn" value="Save Before" name="submit" wire:click.prevent="addBefore()" class="btn btn-info rounded-pill waves-effect waves-light col-md-2">
                    </form>
                    </div>
                    <!-- end row-->

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div>
    <!-- end row -->
</div>
