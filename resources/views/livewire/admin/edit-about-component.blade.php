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
                            <a href="{{ route('admin.about') }}" type="button" class="btn btn-primary waves-effect waves-light">About us</a>
                            <a href="{{ route('admin.addabout') }}" type="button" class="btn btn-success waves-effect waves-light">Add about us</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <form class="form-horizontal" files="true" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Into Title</label>
                                    <input type="text" id="simpleinput" class="form-control" wire:model="title"  wire:keyup="generateSlug">
                                    @error('title')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="example-email" class="form-label">Intro Subtitle</label>
                                    <input type="text" id="simpleinput" class="form-control" wire:model="subtitle">
                                        @error('subtitle')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="example-password" class="form-label">Name</label>
                                    <input type="text" id="simpleinput" class="form-control" wire:model="aname">
                                    @error('aname')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                        </div> <!-- end col -->

                        <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Title</label>
                                    <input type="text" id="simpleinput" class="form-control"  wire:model="name">
                                    @error('name')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="example-multiselect" class="form-label">Designation</label>
                                    <input type="text" id="simpleinput" class="form-control"  wire:model="designation">
                                    @error('designation')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="example-fileinput" class="form-label">Avatar</label>
                                    <input type="file" id="example-fileinput" class="form-control"  wire:model="newavatar"/>
                                      @if($newavatar)
                                            <img src="{{ $newavatar->temporaryUrl() }}" width="120"/>
                                        @else
                                            <img src="{{ asset('assets/img/aboutus')}}/{{ $avatar }}" width="120"/>
                                        @endif
                                    @error('newavatar')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="example-textarea" class="form-label">Description</label>
                                <textarea class="form-control" id="example-textarea" rows="5"  wire:model="desc"></textarea>
                            </div>
                        </div><!-- end col -->
                            <input type="submit" id="SubmitBtn" value="Update About us" name="submit" wire:click.prevent="updateAbout()" class="btn btn-info rounded-pill waves-effect waves-light col-md-2">
                    </form>
                    </div>
                    <!-- end row-->

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div>
    <!-- end row -->
</div>
