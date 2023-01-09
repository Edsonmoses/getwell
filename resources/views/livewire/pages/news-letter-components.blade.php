 <div class="st-news-letter">
    <form class="mailchimp st-news-letter-form">
    <input type="email" name="subscribe" id="subscriber-email" placeholder="Enter Your Email Address"  wire:model="email"  wire:keyup="generateSlug">
    <button type="submit" id="subscribe-button" class="st-mailchimp-btn"  wire:click.prevent="addNews()"><i class="fas fa-paper-plane"></i></button>
    <!-- SUBSCRIPTION SUCCESSFUL OR ERROR MESSAGES -->
    @if (Session::has('message'))
                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                @endif
    </form>
    @foreach ($contacts as $contact ) 
        @php
            $cellphone = explode(",",$contact->phone);
        @endphp
        @if (!empty($cellphone[0]))
            <div class="st-news-letter-number">{{ $cellphone[0] }}</div>
        @endif
    @endforeach
</div>