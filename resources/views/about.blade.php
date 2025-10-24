<x-guest-layout>
    <section class="about-section about-page">
        <div class="section-title-and-desc">
            <h1 class="section-title">{{ $frontend->about_title }}</h1>
            <p class="section-desc">{{ $frontend->about_desc }}</p>
            <div class="back-to-home">
                <a href="/"><span class="material-symbols-outlined">arrow_back</span> Back To Home </a>
            </div>
        </div>
        <div class="about-me-container">
            <div class="band"></div>
            <div class="image-container"><img src="{{ asset('uploads/images/frontend/about_image/'.$frontend->about_image) }}" alt=""></div>
            <div class="video-container">
                <div class="video-intro">
                    <img src="{{ asset('assets/images/youtube-thumbnail.jpg') }}" alt="Video-Intro">
                    <a href="https://www.youtube.com/watch?v=DEeaT6FxEws" class="play-icon popup-youtube"><img
                            src="assets/images/youtube.png" alt="Youtube Play"></a>
                </div>
            </div>
            <div class="content">
                <h4>{{ $frontend->about_story_title }}</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, veritatis eius sunt et molestias veniam neque vitae amet atque. Ab, placeat? Quisquam itaque quas inventore distinctio quaerat, animi quam error! Eum hic laudantium, debitis repellendus est nihil cupiditate sit molestiae libero et id voluptates corporis consequuntur itaque ipsam optio exercitationem facilis tenetur recusandae voluptatem consequatur fuga accusamus. Quam, consectetur deleniti omnis dignissimos numquam non. Modi perferendis reprehenderit dicta. Labore sit delectus at ab illum culpa sapiente cum facilis reprehenderit eos officia voluptate libero consequuntur nemo explicabo molestiae voluptas reiciendis repellat aliquam aliquid, laudantium, porro ipsum ipsa. Consequuntur architecto modi eum corporis autem. Recusandae provident corrupti officiis labore quas vitae at. Molestiae obcaecati dolores temporibus asperiores non sed fugit ad dicta!</p>
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
                    <a href="" class="btn-primary">{{ $frontend->about_button_text }}</a>
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