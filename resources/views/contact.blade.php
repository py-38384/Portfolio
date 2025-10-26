<x-guest-layout>
    <section class="contact-section contact-page">
        <div class="section-title-and-desc">
            <h1 class="section-title main-title mt-10">Contact Me</h1>
            <p class="section-desc">Here is my Contact details. If you want to contact me</p>
            <div class="back-to-home">
                <a href="/"><span class="material-symbols-outlined">arrow_back</span> Back To Home</a>
            </div>
        </div>
        <div class="contact-container address-card">
            <div class="social-icon">
                @foreach ($social_icons as $social_icon)
                <a target="_blank" href="{{ $social_icon->link }}">
                    {!! $social_icon->icon !!}
                </a>
                @endforeach
            </div>
            <div class="address-section">
                <div class="address-raw"><div class="icon"><i class="fa-solid fa-address-card"></i> </div><div class="content">House/Holding, Village/Road: Hugolbari, Hugolbari, Post Office: Natore Sadar - 6400, Natore Sadar, Natore Municipality, Natore, Bangladesh</div></div>
                <div class="address-raw"><div class="icon"><i class="fa-solid fa-envelope"></i> </div><div class="content">piyal13133@gmail.com</div></div>
                <div class="address-raw"><div class="icon"><i class="fa-solid fa-phone"></i> </div><div class="content">+8801317143305</div></div>
            </div>
        </div>
        <div class="contact-container">
            <div class="right-side">
                <form action="{{ route('save.contact') }}" method="post">
                    @csrf
                    <div class="form-field">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" value="{{ old('subject') }}" placeholder="Subject"
                            name="subject">
                    </div>
                    <div class="form-field">
                        <label for="full_name">Full Name</label>
                        <input type="text" id="full_name" value="{{ old('full_name') }}" placeholder="Full Name"
                            name="full_name">
                    </div>
                    <div class="form-field">
                        <label for="email">Email</label>
                        <input type="text" id="email" value="{{ old('email') }}" placeholder="Email" name="email">
                    </div>
                    <div class="form-field">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" placeholder="Message...">{{ old('message') }}</textarea>
                    </div>
                    <div class="form-field submit-button-container">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-guest-layout>