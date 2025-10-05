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

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Convergence&family=Saira+Semi+Condensed:wght@100;200;300;400;500;600;700;800;900&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Dosis:wght@200..800&family=Raleway:ital,wght@0,100..900;1,100..900&family=SUSE+Mono:ital,wght@0,100..800;1,100..800&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');
            :root{
                --primary-text-color: #2F435C; 
                --primary-body-color: #CFE3E7; 
                --active-text-color: #4184FF;
            }
            body{
                background-color: var(--primary-body-color);
                color: var(--primary-text-color);
                font-size: 20px;
                font-family: "Saira Semi Condensed", sans-serif;
            }
            .container{
                max-width: 1000px;
                margin: 0 auto;
            }
            nav ul{
                display: flex;
                gap: 10px;
                align-items: center;
                justify-content: center;
                padding-top: 30px;
            }
            nav ul li{
                padding: 10px;
                height: 30px;
                display: inline-flex;
                justify-content: center;
                align-items: center;
                text-decoration: none;

            }
            nav ul li:hover{
                /* background: #2E425B; */
                color: var(--active-text-color);
            }
            .hero-title{
                font-size: 60px;
                font-weight: 500;
                color: var(--active-text-color);
                margin-bottom: 30px;
                padding: 20px;
                height: 120px;
                display: flex;
                align-items: center;
            }
            .hero-sections{
                margin: 80px 0;
                display: flex;
                justify-content: space-between;
            }
            .hero-sections .small-desc{
                max-width: 500px;
                line-height: 40px;
            }
            .computer-image img{
                width: 350px;
            }
            .console-details{
                width: 100%;
                border-radius: 12px;
                overflow: hidden;
                margin: 40px 0;
                font-size: 18px;
                box-shadow: 0px 0px 20px rgb(37 37 37);
                font-family: "SUSE Mono", sans-serif;
            }
            
            .console-details .top-bar{
                width: 100%;
                height: 33px;
                background-color: rgb(44 44 44);
                display: flex;
                justify-content: end;
            }
            .console-details .top-bar .button-container{
                width: 10%;
                height: 100%;
                /* background-color: blue; */
                display: flex;
                align-items: center;
                padding: 4px;
                gap: 10px;
                justify-content: space-around;
            }
            .console-details .top-bar .button-container .minimize{
                width: 12px;
                height: 12px;
                border-bottom: 1px solid white;
                position: relative;
                cursor: pointer;
            }
            .console-details .top-bar .button-container .minimize:hover::before{
                content: '';
                display: block;
                position: absolute;
                background-color: rgba(253 253 253 / 0.08);
                width: 25px;
                left: -6px;
                border-radius: 50%;
                top: -7px;
                height: 25px;
            }
            .console-details .top-bar .button-container .maximize{
                width: 12px;
                height: 12px;
                border: 1px solid white;
                cursor: pointer;
                position: relative;
            }
            .console-details .top-bar .button-container .maximize:hover::before{
                content: '';
                display: block;
                position: absolute;
                background-color: rgba(253 253 253 / 0.08);
                width: 25px;
                left: -7px;
                border-radius: 50%;
                top: -7px;
                height: 25px;
            }
            .console-details .top-bar .button-container .close{
                width: 15px;
                height: 15px;
                position: relative;
                cursor: pointer;
            }
            .console-details .top-bar .button-container .close .line{
                position: absolute;
                display: inline-block;
                width: 19px;
                height: 1px;
                left: -4px;
                bottom: 7px;
            }
            .console-details .top-bar .button-container .close .line:nth-child(1){
                background-color: white;
                transform: rotate(45deg);
            }
            .console-details .top-bar .button-container .close .line:nth-child(2){
                background-color: white;
                transform: rotate(-45deg);
            }
            .console-details .top-bar .button-container .close:hover .line{
                background-color: rgb(218 0 0);
            }
            .console-details .top-bar .button-container .close:hover::before{
                content: '';
                position: absolute;
                display: block;
                background-color: rgba(253 253 253 / 0.08);
                width: 25px;
                left: -7px;
                border-radius: 50%;
                top: -5px;
                height: 25px;
            }
            .console-details .main-section{
                background: #424242;
                width: 100%;
                border-radius:0 0 12px 12px;
            }
            .main-section{
                padding: 35px;
                display: flex;
                flex-direction: column;
                gap: 25px;
            }
            .main-section .command-container{
                color: white;
                display: flex;
                flex-direction: column;
            }
            .main-section .command-container .command-response{
                color: rgb(230 230 0);
            }
            .main-section .command-container .command-response a{
                color: rgba(0 247 255 / 0.63);
            }
            @keyframes bounce {
                0%{
                    opacity: 1;
                }
                50% {
                    opacity: 0;
                }
                100% {
                    opacity: 1;
                }
            }
            .main-section .command-container .command .cursor{
                animation: bounce .8s infinite;
            }
            .portfolio-section{
                display: flex;
                flex-direction: column;
            }
            .portfolio-container{
                display: flex;
                flex-direction: column;
                gap: 50px;
            }
            .portfolio{
                position: relative;
                display: flex;
                gap: 15px;
                border: 1px solid #E7E7E7;
                background-color: white;
                padding: 15px;
                border-radius: 20px;
                box-shadow: 2px 2px 20px #AEC0E2 ;
            }
            .portfolio .image-container{
                min-width: 500px;
                height: 400px;
                border: 3px solid var(--active-text-color);
                outline: 5px solid #DBF1FF;
                overflow: hidden;
                border-radius: 5px;            
            }
            .portfolio .image-container img{
                min-width: 500px;
                height: 400px;
                object-fit: cover;
                object-position: top;
            }
            
            .portfolio-section h1{
                margin: 0;
                padding: 0;
                text-align: center;
            }
            .portfolio-section p{
                text-align: center;
                margin: 0;
                margin-bottom: 50px;
            }
            .section-title{
                font-size: 35px;
                font-weight: 500;
                color: var(--active-text-color);
            }
            .details-container{
                display: flex;
                flex-direction: column;
                gap: 15px;
                padding: 20px 15px;
                border: 1px solid rgb(230 230 230);
                border-radius: 5px;
                background-color: rgb(247 247 247);
            }
            .details-container .category{
                font-size: 15px;
                color: var(--active-text-color);
            }
            .details-container .title{
                font-size: 28px;
                font-weight: 600;
            }
            .details-container .description{
                font-size: 17px;
            }
            .technologis {
                display: flex;
                gap: 10px;
                font-size: 17px;
            }
            .technologis .technology{
                padding: 5px;
                background-color: white;
                border: 1px solid rgb(230 230 230);
                border-radius: 5px;
                cursor: pointer;
                box-shadow: 0px 0px 2px rgb(211 211 211);
            }
            .technologis .technology:hover{
                color: var(--active-text-color);
                border: 1px solid rgb(230 230 230);
                box-shadow: none;
            }
            .btn{
                display: inline-block;
                padding: 5px;
                font-size: 18px;
                border-radius: 3px;
            }
            .btn-primary{
                background: var(--active-text-color);
                color: white;
                border: 1px solid transparent;
            }
            .btn-primary:hover{
                background-color: rgb(239 248 255);
                color: var(--active-text-color);
                border: 1px solid #6B9FFF;
            }
            .btn-secondary{
                background: rgb(230 230 230);
                border: 1px solid rgb(214 214 214);
            }
            .btn-secondary:hover{
                background-color: transparent;
                color: var(--active-text-color);
            }
            .details-container .button-container{
                display: flex;
                gap: 10px;
            }
            .details-container .button-container .icon{
                font-size: 12px;
            }
            
        </style>
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
                <div>
                    <h1 class="section-title">Portfolio</h1>
                    <p>Here are some of the projects I've worked on. Feel free to take a look.</p>
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