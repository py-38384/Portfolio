<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container">
            <header>
                <nav>
                    <ul>
                        <li><a href="">Home</a></li>
                        <li><a href="">Portfolio</a></li>
                        <li><a href="">About</a></li>
                        <li><a href="">Blog</a></li>
                        <li><a href="">Contact me</a></li>
                    </ul>
                </nav>
            </header>
            <section class="hero-sections">
                <div>
                    <div class="hero-title"> &gt; &nbsp <span id="element"></span></div>
                    <p class="small-desc">I am a professional full-stack web developer experienced in Laravel, React, Next.js, and WordPress. I specialize in building scalable, user-friendly web applications and custom solutions tailored to business needs.</p>
                </div>
                <div class="computer-image">
                    <img src="/assets/images/organic-flat-gamer-room-illustration.png" alt="Computer">
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

                    <div class="command-container">
                        <span class="command"> &gt; pial.location</span>
                        <span class="command-response">"Natore, Bangladesh"</span>
                    </div>
                    <div class="command-container">
                        <span class="command"> &gt; pial.contact</span>
                        <span class="command-response">["<a href="mailto:piyal13133@gmail.com">piyal13133@gmail.com</a>", "<a href="https://github.com/py-38384" target="_blank">github</a>", "<a href="https://www.linkedin.com/in/piyal-hossain-b3720b21b" target="_blank">LinkedIn</a>", "<a href="https://www.facebook.com/piyal.hossain.898691" target="_blank">Facebook</a>", "<a href="https://wa.me/8801317143305" target="_blank">Whatsapp</a>" ]</span>
                    </div>
                    <div class="command-container">
                        <span class="command"> &gt; pial.resume</span>
                        <span class="command-response">"resume(pial).pdf"</span>
                    </div>
                    <div class="command-container">
                        <span class="command"> &gt; pial.interests</span>
                        <span class="command-response">["movie", "walking", "gaming", "traveling"]</span>
                    </div>
                    <div class="command-container">
                        <span class="command"> &gt; pial.Skils</span>
                        <span class="command-response">["Laravel", "Wordpress", "React", "Nextjs", "Socket.io"]</span>
                    </div>
                    <div class="command-container">
                        <span class="command"> &gt; pial.languages</span>
                        <span class="command-response">["PHP", "Javascript", "Typescript", "Python"]</span>
                    </div>
                    <div class="command-container">
                        <span class="command"> &gt; <span class="cursor">|</span></span>
                        <span class="command-response"></span>
                    </div>

                </div>
            </section>

            <section class="portfolio-section">
                <div class="section-title-and-desc">
                    <h1 class="section-title">Portfolio</h1>
                    <p class="section-desc">Here are some of the projects I've worked on. Feel free to take a look.</p>
                </div>
                <div class="portfolio-container">
                    <div class="portfolio">
                        <div>
                            <div class="image-container">
                                <img src="/assets/images/deshivendor.png" alt="">
                            </div>
                        </div>
                        <div class="details-container">
                            <div class="category">E-Commerce</div>
                            <h5 class="title">Multi Vendor E-Commerce</h5>
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
                        <div>
                            <div class="image-container">
                                <img src="/assets/images/Smart-Learning.png" alt="">
                            </div>
                        </div>
                        <div class="details-container">
                            <div class="category">E-Learning</div>
                            <h5 class="title">A Fontend Design For A E-Learning Platform</h5>
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
                        <div>
                            <div class="image-container">
                                <img src="/assets/images/ultimateorganiclife.png" alt="">
                            </div>
                        </div>
                        <div class="details-container">
                            <div class="category">E-Commerce</div>
                            <h5 class="title">A Organic Beauty Product Selling E-Commerce Website</h5>
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
            </section>

            <section class="about-section">
                <div class="section-title-and-desc">
                    <h1 class="section-title">About</h1>
                    <p class="section-desc">A little more about me</p>
                </div>
                <div class="about-me-container">
                    <div class="band"></div>
                    <div class="image-container"><img src={{ asset("/assets/images/about3.png") }} alt=""></div>
                    <div class="content">
                        <h4>My Story</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, veritatis eius sunt et molestias veniam neque vitae amet atque. Ab, placeat? Quisquam itaque quas inventore distinctio quaerat, animi quam error! Eum hic laudantium, debitis repellendus est nihil cupiditate sit molestiae libero et id voluptates corporis consequuntur itaque ipsam optio exercitationem facilis tenetur recusandae voluptatem consequatur fuga accusamus. Quam, consectetur deleniti omnis dignissimos numquam non. Modi perferendis reprehenderit dicta. Labore sit delectus at ab illum culpa sapiente cum facilis reprehenderit eos officia voluptate libero consequuntur nemo explicabo molestiae voluptas reiciendis repellat aliquam aliquid, laudantium, porro ipsum ipsa. Consequuntur architecto modi eum corporis autem. Recusandae provident corrupti officiis labore quas vitae at. Molestiae obcaecati dolores temporibus asperiores non sed fugit ad dicta!</p>
                        <h4>Skills</h4>
                        <div class="skills-icon">
                            <span class="icon"><img src="/assets/svgs/brand-elementor-svgrepo-com.svg" alt=""></span>
                            <span class="icon"><img src="/assets/svgs/css3-02-svgrepo-com.svg" alt=""></span>
                            <span class="icon"><img src="/assets/svgs/html-124-svgrepo-com.svg" alt=""></span>
                            <span class="icon"><img src="/assets/svgs/js01-svgrepo-com.svg" alt=""></span>
                            <span class="icon"><img src="/assets/svgs/laravel-svgrepo-com.svg" alt=""></span>
                            <span class="icon"><img src="/assets/svgs/nextjs-fill-svgrepo-com.svg" alt=""></span>
                            <span class="icon"><img src="/assets/svgs/php01-svgrepo-com.svg" alt=""></span>
                            <span class="icon"><img src="/assets/svgs/react-svgrepo-com.svg" alt=""></span>
                        </div>
                        <div class="CTA-button">
                            <a href="" class="btn-primary">Let's have a talk</a>
                        </div>
                        
                    </div>
                </div>
            </section>

            <section class="blog-section">
                <div class="section-title-and-desc">
                    <h1 class="section-title">Blogs</h1>
                    <p class="section-desc">Blogs that may be useful for you and of course me</p>
                </div>
                <div class="blog-container">
                    <div class="blog">
                        <div class="feature-image">
                            <img src="/assets/images/4884785.jpg" alt="">
                        </div>
                        <div class="content-container">
                            <div class="tag-container"><span class="tag">Technology</span><span class="tag">Javascript</span></div>
                            <h4 class="title">what is a javascript?</h4>
                            <div class="content">JavaScript is a programming language and core technology of the web platform, alongside HTML and CSS. Ninety-nine percent of websites on the World Wide Web use JavaScript on the client side for webpage behavior.</div>
                            <div class="timestamp">15 min ago</div>
                        </div>
                    </div>
                    <div class="blog">
                        <div class="feature-image">
                            <img src="/assets/images/18697.jpg" alt="">
                        </div>
                        <div class="content-container">
                            <div class="tag-container"><span class="tag">Technology</span><span class="tag">Javascript</span></div>
                            <h4 class="title">what is a javascript?</h4>
                            <div class="content">JavaScript is a programming language and core technology of the web platform, alongside HTML and CSS. Ninety-nine percent of websites on the World Wide Web use JavaScript on the client side for webpage behavior.</div>
                            <div class="timestamp">15 min ago</div>
                        </div>
                    </div>
                    <div class="blog">
                        <div class="feature-image">
                            <img src="/assets/images/professional-programmer-working-late-dark-offic.jpg" alt="">
                        </div>
                        <div class="content-container">
                            <div class="tag-container"><span class="tag">Technology</span><span class="tag">Javascript</span></div>
                            <h4 class="title">what is a javascript?</h4>
                            <div class="content">JavaScript is a programming language and core technology of the web platform, alongside HTML and CSS. Ninety-nine percent of websites on the World Wide Web use JavaScript on the client side for webpage behavior.</div>
                            <div class="timestamp">15 min ago</div>
                        </div>
                    </div>
                </div>
            </section>

            <script src="/assets/js/typed.js"></script>

            <script>
                var typed = new Typed('#element', {
                strings: ['Pial Hossen'],
                typeSpeed: 150,
                });
            </script>
        </div>
    </body>
</html>