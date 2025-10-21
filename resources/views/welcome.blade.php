<x-guest-layout>
    <section class="hero-sections">
        <div>
            <div class="hero-title"> &gt; <span class="addition-space">&nbsp</span> <span id="element"></span></div>
            <p class="small-desc">{{ $fontend->hero_brief }}</p>
        </div>
        <div class="computer-image">
            <img src="{{ asset('uploads/images/frontend/hero_image/'.$fontend->hero_image) }}" alt="Computer">
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
                                    "<a href="{{ $item['link'] }}" target="_blank">{{ $item['string'] }}</a>"@if($index != (count($command->content)-1)),@endif 
                                    @else
                                    "{{ $item['string'] }}"@if($index != (count($command->content)-1)),@endif
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

    <section class="portfolio-section">
        <div class="section-title-and-desc">
            <h1 class="section-title">{{ $fontend->portfolio_title }}</h1>
            <p class="section-desc">{{ $fontend->portfolio_desc }}</p>
        </div>
        <div class="portfolio-container">
            <div class="portfolio">
                <div class="image-wrapper">
                    <a class="image-container" href="/assets/images/deshivendor.png">
                        <img src="/assets/images/deshivendor.png" alt="">
                    </a>
                </div>
                <div class="details-container">
                    <div class="category">E-Commerce</div>
                    <a href="/portfolios/1" class="title">Multi Vendor E-Commerce</a>
                    <div class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates eius odit dolorem voluptate vel rem pariatur? Ratione praesentium beatae corporis illo ut repellat, libero nihil. Laborum illo esse maiores nostrum!</div>
                    <div class="technologis">
                        <span class="technology">HTML</span>
                        <span class="technology">CSS</span>
                        <span class="technology">Javascript</span>
                    </div>
                    <div class="button-container">
                        <a href="" class="btn btn-primary"><span class="icon"><i class="fa-solid fa-up-right-from-square"></i></span>Live Preview</a>
                        <a href="" class="btn btn-secondary"> &lt;&gt;Source Code</a>
                    </div>
                </div>
            </div>
            <div class="portfolio">
                <div class="image-wrapper">
                    <a class="image-container" href="/assets/images/Smart-Learning.png">
                        <img src="/assets/images/Smart-Learning.png" alt="">
                    </a>
                </div>  
                <div class="details-container">
                    <div class="category">E-Learning</div>
                    <a href="/portfolios/1" class="title">A Fontend Design For A E-Learning Platform</a>
                    <div class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates eius odit dolorem voluptate vel rem pariatur? Ratione praesentium beatae corporis illo ut repellat, libero nihil. Laborum illo esse maiores nostrum!</div>
                    <div class="technologis">
                        <span class="technology">HTML</span>
                        <span class="technology">CSS</span>
                        <span class="technology">Javascript</span>
                    </div>
                    <div class="button-container">
                        <a href="" class="btn btn-primary"><span class="icon"><i class="fa-solid fa-up-right-from-square"></i></span>Live Preview</a>
                        <a href="" class="btn btn-secondary"> &lt;&gt;Source Code</a>
                    </div>
                </div>
            </div>
            <div class="portfolio">
                <div class="image-wrapper">
                    <a class="image-container" href="/assets/images/ultimateorganiclife.png">
                        <img src="/assets/images/ultimateorganiclife.png" alt="">
                    </a>
                </div>
                <div class="details-container">
                    <div class="category">E-Commerce</div>
                    <a href="/portfolios/1" class="title">A Organic Beauty Product Selling E-Commerce Website</a>
                    <div class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates eius odit dolorem voluptate vel rem pariatur? Ratione praesentium beatae corporis illo ut repellat, libero nihil. Laborum illo esse maiores nostrum!</div>
                    <div class="technologis">
                        <span class="technology">HTML</span>
                        <span class="technology">CSS</span>
                        <span class="technology">Javascript</span>
                    </div>
                    <div class="button-container">
                        <a href="" class="btn btn-primary"> <span class="icon"><i class="fa-solid fa-up-right-from-square"></i></span>Live Preview</a>
                        <a href="" class="btn btn-secondary"> &lt;&gt;Source Code</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="see-more-container">
            <a href="{{ route('portfolios') }}" class="btn btn-primary see-more-button">See More</a>
        </div>
    </section>

    <section class="about-section">
        <div class="section-title-and-desc">
            <h1 class="section-title">{{ $fontend->about_title }}</h1>
            <p class="section-desc">{{ $fontend->about_desc }}</p>
        </div>
        <div class="about-me-container">
            <div class="band"></div>
            <div class="image-container"><img src="{{ asset('uploads/images/frontend/about_image/'.$fontend->about_image) }}" alt=""></div>
            <div class="content">
                <h4>{{ $fontend->about_story_title }}</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, veritatis eius sunt et molestias veniam neque vitae amet atque. Ab, placeat? Quisquam itaque quas inventore distinctio quaerat, animi quam error! Eum hic laudantium, debitis repellendus est nihil cupiditate sit molestiae libero et id voluptates corporis consequuntur itaque ipsam optio exercitationem facilis tenetur recusandae voluptatem consequatur fuga accusamus. Quam, consectetur deleniti omnis dignissimos numquam non. Modi perferendis reprehenderit dicta. Labore sit delectus at ab illum culpa sapiente cum facilis reprehenderit eos officia voluptate libero consequuntur nemo explicabo molestiae voluptas reiciendis repellat aliquam aliquid, laudantium, porro ipsum ipsa. Consequuntur architecto modi eum corporis autem. Recusandae provident corrupti officiis labore quas vitae at. Molestiae obcaecati dolores temporibus asperiores non sed fugit ad dicta!</p>
                <h4>Skills</h4>
                <div class="skills-icon">
                    @php
                        $fontend->about_skills_image = json_decode($fontend->about_skills_image);
                    @endphp
                    @foreach ($fontend->about_skills_image as $skill_image)
                    <span class="icon"><img src="{{ asset("uploads/images/frontend/skills_icons/".$skill_image) }}" alt=""></span>
                    @endforeach
                </div>
                <div class="CTA-button">
                    <a href="" class="btn-primary">{{ $fontend->about_button_text }}</a>
                </div>
                
            </div>
        </div>
    </section>

    <section class="blog-section">
        <div class="section-title-and-desc">
            <h1 class="section-title">{{ $fontend->blog_title }}</h1>
            <p class="section-desc">{{ $fontend->blog_desc }}</p>
        </div>
        <div class="blog-container">
            <div class="blog">
                <div class="feature-image">
                    <img src="/assets/images/4884785.jpg" alt="">
                </div>
                <div class="content-container">
                    <div class="tag-container"><span class="tag">Technology</span><span class="tag">Javascript</span></div>
                    <a href="{{ route('blogs.details',1) }}" class="title">what is a javascript?</a>
                    <div class="content">JavaScript is a programming language and core technology of the web platform, alongside HTML and CSS. Ninety-nine percent of websites...
                    <a href="{{ route('blogs.details',1) }}" class="link">Read more</a>
                    </div>
                    <div class="timestamp"><i class="fa-solid fa-clock"></i> 15 min ago</div>
                </div>
            </div>
            <div class="blog">
                <div class="feature-image">
                    <img src="/assets/images/18697.jpg" alt="">
                </div>
                <div class="content-container">
                    <div class="tag-container"><span class="tag">Technology</span><span class="tag">Javascript</span></div>
                    <a href="{{ route('blogs.details',1) }}" class="title">what is a javascript?</a>
                    <div class="content">JavaScript is a programming language and core technology of the web platform, alongside HTML and CSS. Ninety-nine percent of websites...
                    <a href="{{ route('blogs.details',1) }}" class="link">Read more</a>
                    </div>
                    <div class="timestamp"><i class="fa-solid fa-clock"></i> 15 min ago</div>
                </div>
            </div>
            <div class="blog">
                <div class="feature-image">
                    <img src="/assets/images/professional-programmer-working-late-dark-offic.jpg" alt="">
                </div>
                <div class="content-container">
                    <div class="tag-container"><span class="tag">Technology</span><span class="tag">Javascript</span></div>
                    <a href="{{ route('blogs.details',1) }}" class="title">what is a javascript?</a>
                    <div class="content">JavaScript is a programming language and core technology of the web platform, alongside HTML and CSS. Ninety-nine percent of websites...
                    <a href="{{ route('blogs.details',1) }}" class="link">Read more</a>    
                    </div>
                    <div class="timestamp"><i class="fa-solid fa-clock"></i> 15 min ago</div>
                </div>
            </div>
        </div>
        <div class="see-more-container">
            <a href="{{ route('blogs.index') }}" class="btn btn-primary see-more-button">See More</a>
        </div>
    </section>

    <section class="contact-section">
        <div class="section-title-and-desc">
            <h1 class="section-title">{{ $fontend->contact_title }}</h1>
            <p class="section-desc">{{ $fontend->contact_desc }}</p>
        </div>
        <div class="contact-container">
            <div class="left-side">
                <div class="represent-image"><img src="{{ asset("uploads/images/frontend/contact_image/$fontend->contact_image") }}" alt=""></div>
            </div>
            <div class="right-side">
                <form action="{{ route('save.contact') }}" method="post">
                    @csrf
                    <div class="form-field">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" value="{{ old('subject') }}" placeholder="Subject" name="subject">
                    </div>
                    <div class="form-field">
                        <label for="full_name">Full Name</label>
                        <input type="text" id="full_name" value="{{ old('full_name') }}" placeholder="Full Name" name="full_name">
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
        strings: ["{{ $fontend->name }}"],
        typeSpeed: 150,
        });
    </script>
    @endpush
</x-guest-layout>