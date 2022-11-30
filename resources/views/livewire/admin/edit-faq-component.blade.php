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
                            <a href="{{ route('admin.faq') }}" type="button" class="btn btn-primary waves-effect waves-light">All Faq</a>
                            <a href="{{ route('admin.addfaq') }}" type="button" class="btn btn-success waves-effect waves-light">Add Faq</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <form class="form-horizontal" files="true" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @if ($heading)
                                <div class="mb-3">
                                    <label for="example-password" class="form-label">Heading</label>
                                    <input type="text" id="simpleinput" class="form-control" wire:model="heading">
                                    @error('heading')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                                @endif
                                @if ($faqbg)
                                <div class="mb-3">
                                    <label for="example-fileinput" class="form-label">Background Image</label>
                                    <input type="file" id="example-fileinput" class="form-control"  wire:model="newfaqbg"/>
                                    @if ($newfaqbg)
                                    <img src="{{ $newfaqbg->temporaryUrl() }}" width="120"/>
                                    @endif
                                    @error('newfaqbg')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                                @endif
                        </div> <!-- end col -->

                        <div class="col-lg-6">

                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Title</label>
                                    <input type="text" id="simpleinput" class="form-control" wire:model="title"  wire:keyup="generateSlug">
                                    @error('title')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                                @if ($faqimg)
                                <div class="mb-3">
                                    <label for="example-fileinput" class="form-label">Side Image</label>
                                    <input type="file" id="example-fileinput" class="form-control"  wire:model="newfaqimg"/>
                                      @if($newfaqimg)
                                            <img src="{{ $newfaqimg->temporaryUrl() }}" width="120"/>
                                        @else
                                            <img src="{{ asset('assets/img/faqs')}}/{{ $faqimg }}" width="120"/>
                                        @endif
                                    @error('newfaqimg')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                                @endif
                        </div> <!-- end col -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="example-textarea" class="form-label">Description</label>
                                <textarea class="form-control" id="example-textarea" rows="5"  wire:model="body"></textarea>
                                @error('body')<p class="text-danger">{{ $message }}</p>@enderror
                            </div>
                        </div><!-- end col -->
                            <input type="submit" id="SubmitBtn" value="Update Faq" name="submit" wire:click.prevent="updateFaqs()" class="btn btn-info rounded-pill waves-effect waves-light col-md-2">
                    </form>
                    </div>
                    <!-- end row-->

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div>
    <!-- end row -->
</div>
