<section class="st-shape-wrap" id="contact">
      <div class="st-shape1"><img src="assets/user/assets/img/shape/contact-shape1.svg" alt="shape1"></div>
      <div class="st-shape2"><img src="assets/user/assets/img/shape/contact-shape2.svg" alt="shape2"></div>
      <div class="st-height-b120 st-height-lg-b80"></div>
      <div class="container">
        <div class="st-section-heading st-style1">
          <h2 class="st-section-heading-title">Stay connect with us</h2>
          <div class="st-seperator">
            <div class="st-seperator-left wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s"></div>
            <div class="st-seperator-center"><img src="assets/user/assets/img/icons/4.png" alt="icon"></div>
            <div class="st-seperator-right wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s"></div>
          </div>
          <div class="st-section-heading-subtitle">Lorem Ipsum is simply dummy text of the printing and typesetting industry. <br>Lorem Ipsum the industry's standard dummy text.</div>
        </div>
        <div class="st-height-b40 st-height-lg-b40"></div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-10 offset-lg-1">
            <div id="st-alert"></div>
             @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                            @endif
            <form action="assets/php/mail.php" class="row st-contact-form st-type1" method="post"  id="contact-form">
              <div class="col-lg-6">
                <div class="st-form-field st-style1">
                  <label>Full Name</label>
                  <input type="text" id="name" name="name" placeholder="Jhon Doe" required  wire:model="name"  wire:keyup="generateSlug"/>
                  @error('name')<p class="text-danger">{{ $message }}</p>@enderror
                </div>
              </div><!-- .col -->
              <div class="col-lg-6">
                <div class="st-form-field st-style1">
                  <label>Email Address</label> 
                  <input type="text" id="email" name="email" placeholder="example@gmail.com" required  wire:model="email"/>
                  @error('email')<p class="text-danger">{{ $message }}</p>@enderror
                </div>
              </div><!-- .col -->
              <div class="col-lg-6">
                <div class="st-form-field st-style1">
                  <label>Subject</label>
                  <input type="text" id="subject" name="subject" placeholder="Write subject" required  wire:model="subject"/>
                  @error('subject')<p class="text-danger">{{ $message }}</p>@enderror
                </div>
              </div><!-- .col -->
              <div class="col-lg-6">
                <div class="st-form-field st-style1">
                  <label>Phone</label>      
                  <input type="text" id="phone" name="phone" placeholder="+00 376 12 465" required  wire:model="phone"/>
                  @error('phone')<p class="text-danger">{{ $message }}</p>@enderror
                </div>
              </div><!-- .col -->
              <div class="col-lg-12">
                <div class="st-form-field st-style1">
                  <label>Your Message</label>      
                  <textarea cols="30" rows="10" id="msg" name="msg" placeholder="Write something here..." required   wire:model="msg"></textarea>
                  @error('msg')<p class="text-danger">{{ $message }}</p>@enderror
                </div>
              </div><!-- .col -->
              <div class="col-lg-12">
                <div class="text-center">
                  <div class="st-height-b10 st-height-lg-b10"></div>
                  <button class="st-btn st-style1 st-color1 st-size-medium" type="submit" wire:click.prevent="addCantactform()">Send message</button>
                </div>
              </div><!-- .col -->
            </form>
          </div><!-- .col -->
        </div>
      </div>
      <div class="st-height-b120 st-height-lg-b80"></div>
    </section>