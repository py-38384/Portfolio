<x-guest-layout>
    <section class="hero-sections">
        <div>
            <div class="hero-title"> &gt; <span class="addition-space">&nbsp</span> <span id="element"></span></div>
            <p class="small-desc">{{ $frontend->hero_brief }}</p>
        </div>
        <div class="computer-image">
            <img src="{{ asset('uploads/images/frontend/hero_image/' . $frontend->hero_image) }}" alt="Computer">
        </div>
    </section>

    <section class="console-details">
        <div class="top-bar">
            <div class="button-container">
                <div class="minimize"><span class="line"></span></div>
                <div class="maximize"><span class="line"></span></div>
                <div class="close">
                    <span class="line"></span>
                    <span class="line"></span>
                </div>
            </div>
        </div>
        <div class="main-section">

            @forelse ($console as $command)
                @if($command->status == 'published')
                    @if($command->type == "string")
                        <div class="command-container">
                            <span class="command"> &gt; {{ $command->property }}</span>
                            <span class="command-response">
                                @if($command->content['link'])
                                    "<a href="{{ $command->content['link'] }}" target="_blank">{{ $command->content['string'] }}</a>"
                                @else
                                    "{{ $command->content['string'] }}"
                                @endif
                            </span>
                        </div>
                    @else
                        <div class="command-container">
                            <span class="command"> &gt; {{ $command->property }}</span>
                            <span class="command-response">
                                [
                                @foreach ($command->content as $index => $item)
                                    @if($item['link'])
                                        "<a href="{{ $item['link'] }}"
                                            target="_blank">{{ $item['string'] }}</a>"@if($index != (count($command->content) - 1)),@endif
                                    @else
                                        "{{ $item['string'] }}"@if($index != (count($command->content) - 1)),@endif
                                    @endif
                                @endforeach
                                ]
                            </span>
                        </div>
                    @endif
                @endif
            @empty
                <div class="command-container">
                    <span class="command"> &gt; name.location</span>
                    <span class="command-response" style="color: red;">"System Error! Data Not Found!"</span>
                </div>
            @endforelse

        </div>
    </section>

    @if($projects->count())
        <section class="portfolio-section">
            <div class="section-title-and-desc">
                <h1 class="section-title">{{ $frontend->portfolio_title }}</h1>
                <p class="section-desc">{{ $frontend->portfolio_desc }}</p>
            </div>
            <div class="portfolio-container">
                @foreach ($projects as $project)
                    <div class="portfolio">
                        <div class="image-wrapper">
                            <a class="image-container" href="{{ asset('uploads/images/projects/' . $project->hero_image) }}">
                                <img src="{{ asset('uploads/images/projects/' . $project->hero_image) }}"
                                    alt="{{ $project->project_title }}">
                            </a>
                        </div>
                        <div class="details-container">
                            <div class="category">{{ $project->category->name }}</div>
                            <a href="{{ route('portfolios.details',$project->id) }}" class="title">{{ $project->project_title }}</a>
                            <div class="description">{{ $project->short_description }}</div>
                            <div class="technologis">
                                @foreach ($project->tags as $tag)
                                    <span class="technology">{{ $tag }}</span>
                                @endforeach
                            </div>
                            <div class="button-container">
                                @if($project->live_link)
                                    <a target="_blank" href="{{ $project->live_link }}" class="btn btn-primary"><span class="icon"><i class="fa-solid fa-up-right-from-square"></i></span>Live Preview</a>
                                @endif
                                @if($project->source_link)
                                    <a target="_blank" href="{{ $project->source_link }}" class="btn btn-secondary"> &lt;&gt;Source Code</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="see-more-container">
                <a href="{{ route('portfolios') }}" class="btn btn-primary see-more-button">See More</a>
            </div>
        </section>
    @endif

    <section class="about-section">
        <div class="section-title-and-desc">
            <h1 class="section-title">{{ $frontend->about_title }}</h1>
            <p class="section-desc">{{ $frontend->about_desc }}</p>
        </div>
        <div class="about-me-container">
            <div class="band"></div>
            <div class="image-container"><img
                    src="{{ asset('uploads/images/frontend/about_image/' . $frontend->about_image) }}" alt=""></div>
            <div class="content">
                @if($frontend->about_youtube_video_id)
                <div class="video-container">
                    <div class="video-intro">
                        <img src="https://img.youtube.com/vi/{{ $frontend->about_youtube_video_id }}/maxresdefault.jpg" alt="Video-Intro">
                        <a href="https://www.youtube.com/watch?v={{ $frontend->about_youtube_video_id }}" class="play-icon popup-youtube"><img
                                src="assets/images/youtube.png" alt="Youtube Play"></a>
                    </div>
                </div>
                @endif
                <h4>{{ $frontend->about_story_title }}</h4>
                <p>{!! $frontend->about_story_html !!}</p>
                <h4>Skills</h4>
                <div class="skills-icon">
                    @php
                        $frontend->about_skills_image = json_decode($frontend->about_skills_image);
                    @endphp
                    @foreach ($frontend->about_skills_image as $skill_image)
                        <span class="icon"><img src="{{ asset("uploads/images/frontend/skills_icons/" . $skill_image) }}"
                                alt=""></span>
                    @endforeach
                </div>
                <div class="CTA-button">
                    <a href="{{ $frontend->about_button_link }}" class="btn-primary">{{ $frontend->about_button_text }}</a>
                </div>

            </div>
        </div>
    </section>

    @if($testimonials->count() > 0)
    <section class="testimonial-section">
        <div class="section-title-and-desc">
            <h1 class="section-title">{{ $frontend->testimonial_title }}</h1>
            <p class="section-desc">{{ $frontend->testimonial_desc }}</p>
        </div>
        <div class="carousel-container">
            <div class="carousel">
                <div class="slider">
                    @foreach ($testimonials as $testimonial)
                    <section class="testimonial-wrapper">
                        <div class="testimonial">
                            <div class="dp"><img src="{{ asset('uploads/images/testimonial/'.$testimonial->image) }}" alt="{{ $testimonial->image }}"></div>
                            <h5 class="name">{{ $testimonial->name }}</h5>
                            @if($testimonial->designation) <div class="designation">{{ $testimonial->designation }}</div> @endif
                            <p class="testimonial-message"> <span class="quote-mark"><i class="fa-solid fa-quote-left"></i></span> {{ $testimonial->message }} </p>
                            <div class="star-container">
                                @for ($star_count = 0; $star_count < 5; $star_count++)
                                @if($star_count < $testimonial->stars)
                                <x-svgs.star-fill width="25"/> 
                                @else
                                <x-svgs.star-outline width="20"/> 
                                @endif 
                                @endfor
                            </div>
                        </div>
                    </section>
                    @endforeach
                </div>
                <div class="controls">
                    <div class="prev arrow">
                        <div class="arrow-container">
                            <span></span>
                        </div>
                    </div>
                    <div class="next arrow">
                        <div class="arrow-container">
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($blogs->count() > 0)
    <section class="blog-section">
        <div class="section-title-and-desc">
            <h1 class="section-title">{{ $frontend->blog_title }}</h1>
            <p class="section-desc">{{ $frontend->blog_desc }}</p>
        </div>
        <div class="blog-container">
            @foreach ($blogs as $blog)
            <div class="blog">
                <div class="feature-image">
                    <img src="{{ asset("uploads/images/blogs/$blog->hero_image") }}" alt="">
                </div>
                <div class="content-container">
                    <div class="tag-container">
                        @foreach ($blog->tags as $tag)
                        <span class="tag" style="background-color: {{ $tag->color }}; color: {{ getTextColorBasedOnBackground($tag->color) }}">{{ $tag->value }}</span>
                        @endforeach
                    </div>
                    <a href="{{ route('blogs.details', $blog->slug) }}" class="title">{{ $blog->blog_title }}</a>
                    <div class="content">{{ $blog->blog_title }}
                        <a href="{{ route('blogs.details', $blog->slug) }}" class="link">Read more</a>
                    </div>
                    <div class="timestamp"><i class="fa-solid fa-clock"></i> {{ $blog->created_at->diffForHumans() }}</div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="see-more-container">
            <a href="{{ route('blogs') }}" class="btn btn-primary see-more-button">See More</a>
        </div>
    </section>
    @endif

    <section class="contact-section">
        <div class="section-title-and-desc">
            <h1 class="section-title">{{ $frontend->contact_title }}</h1>
            <p class="section-desc">{{ $frontend->contact_desc }}</p>
        </div>
        <div class="contact-container">
            <div class="left-side">
                <div class="represent-image"><img
                        src="{{ asset("uploads/images/frontend/contact_image/$frontend->contact_image") }}" alt="">
                </div>
            </div>
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

    <section>
    </section>

    @push('scripts')
        <script src="/assets/js/typed.js"></script>
        <script>
            var typed = new Typed('#element', {
                strings: ["{{ $frontend->name }}"],
                typeSpeed: 150,
            });
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