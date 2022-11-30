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
                            <a href="{{ route('admin.hero') }}" type="button" class="btn btn-primary waves-effect waves-light">All Sliders</a>
                            <a href="{{ route('admin.addhero') }}" type="button" class="btn btn-success waves-effect waves-light">Add Slider</a>
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
                                    <label for="example-email" class="form-label">Subtitle</label>
                                    <input type="text" id="simpleinput" class="form-control" wire:model="subtitle">
                                        @error('subtitle')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="example-password" class="form-label">Facebook</label>
                                    <input type="text" id="simpleinput" class="form-control" wire:model="facebook">
                                    @error('facebook')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Linkedin</label>
                                    <input type="text" id="simpleinput" class="form-control"  wire:model="linkedin">
                                    @error('linkedin')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                        </div> <!-- end col -->

                        <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Twitter</label>
                                    <input type="text" id="simpleinput" class="form-control"  wire:model="twitter">
                                    @error('twitter')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="example-multiselect" class="form-label">Youtube</label>
                                    <input type="text" id="simpleinput" class="form-control"  wire:model="youtube">
                                    @error('youtube')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="example-fileinput" class="form-label">Hero Image</label>
                                    <input type="file" id="example-fileinput" class="form-control"  wire:model="hero"/>
                                    @if ($hero)
                                    <img src="{{ $hero->temporaryUrl() }}" width="120"/>
                                    @endif
                                    @error('hero')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                        </div> <!-- end col -->
                            <input type="submit" id="SubmitBtn" value="Save Hero" name="submit" wire:click.prevent="addSlider()" class="btn btn-info rounded-pill waves-effect waves-light col-md-2">
                    </form>
                    </div>
                    <!-- end row-->

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div>
    <!-- end row -->
</div>
