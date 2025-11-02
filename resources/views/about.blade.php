<x-guest-layout>
    <section class="about-section about-page">
        <div class="section-title-and-desc">
            <h1 class="section-title main-title mt-10">About Me</h1>
            <p class="section-desc">Here is little but about me and what i do.</p>
            <div class="back-to-home">
                <a href="/"><span class="material-symbols-outlined">arrow_back</span> Back To Home</a>
            </div>
        </div>
        <div class="about-me-container">
            <div class="band"></div>
            <div class="image-container"><img src="{{ asset('uploads/images/frontend/about_image/'.$frontend->about_image) }}" alt=""></div>
            <div class="video-container">
                <div class="video-intro">
                    <img src="https://img.youtube.com/vi/{{ $frontend->about_youtube_video_id }}/maxresdefault.jpg" alt="Video-Intro">
                        <a href="https://www.youtube.com/watch?v={{ $frontend->about_youtube_video_id }}" class="play-icon popup-youtube"><img
                                src="assets/images/youtube.png" alt="Youtube Play"></a>
                </div>
            </div>
            <div class="content">
                <h4>{{ $frontend->about_story_title }}</h4>
                <p>{!! $frontend->about_story_html !!}</p>
                <h4>Skills</h4>
                <div class="skills-icon">
                    @php
                        $frontend->about_skills_image = json_decode($frontend->about_skills_image);
                    @endphp
                    @foreach ($frontend->about_skills_image as $skill_image)
                    <span class="icon"><img src="{{ asset("uploads/images/frontend/skills_icons/".$skill_image) }}" alt=""></span>
                    @endforeach
                </div>
                <div class="CTA-button">
                    <a href="{{ $frontend->about_button_link }}" target="_blank" class="btn-primary">{{ $frontend->about_button_text }}</a>
                </div>
                
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            $(document).ready(function () {
                $('.popup-youtube').magnificPopup({
                    type: 'iframe',
                    iframe: {
                        patterns: {
                            youtube: {
                                index: 'youtube.com/',
                                id: 'v=',
                                src: 'https://www.youtube.com/embed/%id%?autoplay=1'
                            }
                        }
                    },
                    mainClass: 'mfp-fade',
                    removalDelay: 300,
                    preloader: false,
                    fixedContentPos: true,
                });
            });
        </script>
    @endpush
</x-guest-layout>