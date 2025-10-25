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
                            <a class="image-container" href="/assets/images/deshivendor.png">
                                <img src="{{ asset('uploads/images/projects/' . $project->hero_image) }}"
                                    alt="{{ $project->project_title }}">
                            </a>
                        </div>
                        <div class="details-container">
                            <div class="category">{{ $project->category->name }}</div>
                            <a href="/portfolios/1" class="title">{{ $project->project_title }}</a>
                            <div class="description">{{ $project->short_description }}</div>
                            <div class="technologis">
                                @foreach ($project->tags as $tag)
                                    <span class="technology">{{ $tag }}</span>
                                @endforeach
                            </div>
                            <div class="button-container">
                                <a href="" class="btn btn-primary"><span class="icon"><i
                                            class="fa-solid fa-up-right-from-square"></i></span>Live Preview</a>
                                <a href="" class="btn btn-secondary"> &lt;&gt;Source Code</a>
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
                <div class="video-container">
                    <div class="video-intro">
                        <img src="{{ asset('assets/images/youtube-thumbnail.jpg') }}" alt="Video-Intro">
                        <a href="https://www.youtube.com/watch?v=DEeaT6FxEws" class="play-icon popup-youtube"><img
                                src="assets/images/youtube.png" alt="Youtube Play"></a>
                    </div>
                </div>
                <h4>{{ $frontend->about_story_title }}</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, veritatis eius sunt et molestias
                    veniam neque vitae amet atque. Ab, placeat? Quisquam itaque quas inventore distinctio quaerat, animi
                    quam error! Eum hic laudantium, debitis repellendus est nihil cupiditate sit molestiae libero et id
                    voluptates corporis consequuntur itaque ipsam optio exercitationem facilis tenetur recusandae
                    voluptatem consequatur fuga accusamus. Quam, consectetur deleniti omnis dignissimos numquam non.
                    Modi perferendis reprehenderit dicta. Labore sit delectus at ab illum culpa sapiente cum facilis
                    reprehenderit eos officia voluptate libero consequuntur nemo explicabo molestiae voluptas reiciendis
                    repellat aliquam aliquid, laudantium, porro ipsum ipsa. Consequuntur architecto modi eum corporis
                    autem. Recusandae provident corrupti officiis labore quas vitae at. Molestiae obcaecati dolores
                    temporibus asperiores non sed fugit ad dicta!</p>
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
                    <a href="" class="btn-primary">{{ $frontend->about_button_text }}</a>
                </div>

            </div>
        </div>
    </section>

    <section class="testimonial-section">
        <div class="section-title-and-desc">
            <h1 class="section-title">Testimonial</h1>
            <p class="section-desc">Have a look what people have to say about me</p>
        </div>
        <div class="carousel-container">
            <div class="carousel">
                <div class="slider">
                    <section class="testimonial-wrapper">
                        <div class="testimonial">
                            <div class="dp"><img src="{{ asset('assets/images/testimonial1.webp') }}" alt=""></div>
                            <h5 class="name">Devid vescar</h5>
                            <div class="degisnation">Agency Owner</div>
                            <p class="testimonial-message">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Libero consectetur, veritatis id laborum odio animi expedita nihil quibusdam minus repellendus molestias magnam voluptatum ullam eveniet esse rerum, ipsum ratione quisquam recusandae? Quasi beatae id natus. Nisi, beatae eum? Porro, ad! Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta quibusdam debitis vel fugit id cum deleniti culpa est. Aspernatur dolore, quaerat dicta voluptatum ea dolorem a necessitatibus minus quasi eos est adipisci voluptatibus animi iste eaque? Incidunt beatae veniam amet explicabo quo dolorem unde, modi eveniet dolorum delectus aspernatur iure ut minus reprehenderit nam magni nobis pariatur, ipsum et a voluptas. Totam dicta nostrum, quas dolorem ipsam blanditiis atque et praesentium consequuntur! Quam illo rerum assumenda impedit eligendi ut beatae aliquam ducimus deserunt perspiciatis provident, omnis aperiam iure dolorum amet libero minus soluta repellat quas fuga sed aspernatur. Consectetur laborum vero molestiae ipsum, dicta harum maxime exercitationem amet tenetur consequatur, mollitia praesentium illum dolorum corporis temporibus accusantium, aut eveniet. Quod. </p>
                            <div class="star-container">
                                <x-svgs.star-fill width="25"/> 
                                <x-svgs.star-fill width="25"/> 
                                <x-svgs.star-fill width="25"/> 
                                <x-svgs.star-fill width="25"/> 
                                <x-svgs.star-outline width="20"/> 
                            </div>
                        </div>
                    </section>
                    <section class="testimonial-wrapper">
                        <div class="testimonial">
                            <div class="dp"><img src="{{ asset('assets/images/testimonial1.webp') }}" alt=""></div>
                            <h5 class="name">Devid vescar</h5>
                            <div class="degisnation">Agency Owner</div>
                            <p class="testimonial-message">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Libero consectetur, veritatis id laborum odio animi expedita nihil quibusdam minus repellendus molestias magnam voluptatum ullam eveniet esse rerum, ipsum ratione quisquam recusandae? Quasi beatae id natus. Nisi, beatae eum? Porro, ad! </p>
                            <div class="star-container">
                                <x-svgs.star-fill width="25"/> 
                                <x-svgs.star-fill width="25"/> 
                                <x-svgs.star-fill width="25"/> 
                                <x-svgs.star-fill width="25"/> 
                                <x-svgs.star-outline width="20"/> 
                            </div>
                        </div>
                    </section>
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

    <section class="blog-section">
        <div class="section-title-and-desc">
            <h1 class="section-title">{{ $frontend->blog_title }}</h1>
            <p class="section-desc">{{ $frontend->blog_desc }}</p>
        </div>
        <div class="blog-container">
            <div class="blog">
                <div class="feature-image">
                    <img src="/assets/images/4884785.jpg" alt="">
                </div>
                <div class="content-container">
                    <div class="tag-container"><span class="tag">Technology</span><span class="tag">Javascript</span>
                    </div>
                    <a href="{{ route('blogs.details', 1) }}" class="title">what is a javascript?</a>
                    <div class="content">JavaScript is a programming language and core technology of the web platform,
                        alongside HTML and CSS. Ninety-nine percent of websites...
                        <a href="{{ route('blogs.details', 1) }}" class="link">Read more</a>
                    </div>
                    <div class="timestamp"><i class="fa-solid fa-clock"></i> 15 min ago</div>
                </div>
            </div>
            <div class="blog">
                <div class="feature-image">
                    <img src="/assets/images/18697.jpg" alt="">
                </div>
                <div class="content-container">
                    <div class="tag-container"><span class="tag">Technology</span><span class="tag">Javascript</span>
                    </div>
                    <a href="{{ route('blogs.details', 1) }}" class="title">what is a javascript?</a>
                    <div class="content">JavaScript is a programming language and core technology of the web platform,
                        alongside HTML and CSS. Ninety-nine percent of websites...
                        <a href="{{ route('blogs.details', 1) }}" class="link">Read more</a>
                    </div>
                    <div class="timestamp"><i class="fa-solid fa-clock"></i> 15 min ago</div>
                </div>
            </div>
            <div class="blog">
                <div class="feature-image">
                    <img src="/assets/images/professional-programmer-working-late-dark-offic.jpg" alt="">
                </div>
                <div class="content-container">
                    <div class="tag-container"><span class="tag">Technology</span><span class="tag">Javascript</span>
                    </div>
                    <a href="{{ route('blogs.details', 1) }}" class="title">what is a javascript?</a>
                    <div class="content">JavaScript is a programming language and core technology of the web platform,
                        alongside HTML and CSS. Ninety-nine percent of websites...
                        <a href="{{ route('blogs.details', 1) }}" class="link">Read more</a>
                    </div>
                    <div class="timestamp"><i class="fa-solid fa-clock"></i> 15 min ago</div>
                </div>
            </div>
        </div>
        <div class="see-more-container">
            <a href="{{ route('blogs') }}" class="btn btn-primary see-more-button">See More</a>
        </div>
    </section>

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