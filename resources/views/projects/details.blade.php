<x-guest-layout>
    @push('styles')
        <style>
            .main-title{
                margin: 30px 0 !important;
            }
        </style>
    @endpush
    <section class="portfolio-section">
        <div class="section-title-and-desc">
            <h1 class="section-title main-title mt-10">🛍️ Advanced E-Commerce Platform</h1>
            <p class="section-desc">Multi-Vendor Marketplace with Modern Architecture</p>
        </div>
        <div>
            <div>
                <!-- <div class="portfolio-image-slider">
                    <div class="left arrow"><span class="square"></span></div>
                    <div class="portfolio-image-container"><img src="/assets/images/deshivendor.png" alt=""></div>
                    <div class="right arrow"><span class="square"></span></div>
                </div> -->
                <div class="carousel-container">
                    <div class="carousel">
                        <div class="slider">
                            <section>
                                <img src="/assets/images/deshivendor.png" alt="">
                            </section>
                            <section>
                                <img src="/assets/images/deshivendor.png" alt="">
                            </section>
                            <section>
                                <img src="/assets/images/deshivendor.png" alt="">
                            </section>
                            <section>
                                <img src="/assets/images/deshivendor.png" alt="">
                            </section>
                            <section>
                                <img src="/assets/images/deshivendor.png" alt="">
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


                <div class="project-description">
                    <div class="project-description-container">
                        <div class="button-container" style="display: flex; gap: 10px;">
                            <a href="" class="btn btn-primary"> <span class="icon"><i
                                        class="fa-solid fa-up-right-from-square"></i></span>Live Preview</a>
                            <a href="" class="btn btn-secondary"> &lt;&gt;Source Code</a>
                        </div>
                        <!-- content Start -->
                        <h2 style="color: #2d3436; font-size: 28px; margin-bottom: 8px;">🛍️ Advanced E-Commerce
                            Platform</h2>
                        <h3 style="color: #0984e3; font-size: 20px; margin-top: 0;">Multi-Vendor Marketplace with Modern
                            Architecture</h3>

                        <p style="color: #555; line-height: 1.8; font-size: 16px; margin: 10px 0;">
                            This project is a full-featured marketplace where multiple vendors can create their own
                            stores, manage products, and handle orders independently.
                            Customers can browse products from different sellers, compare prices, and complete secure
                            checkouts seamlessly.
                        </p>

                        <p style="color: #555; line-height: 1.8; font-size: 16px; margin: 10px 0;">
                            The admin dashboard provides detailed analytics, including sales reports, user activities,
                            and vendor performance tracking.
                            With integrated <b>payment gateways</b> and <b>real-time notifications</b>, it ensures a
                            smooth and engaging shopping experience for everyone.
                        </p>

                        <div
                            style="margin: 20px 0; padding: 12px 16px; background: #f1f3f6; border-left: 4px solid #0984e3; border-radius: 6px;">
                            <h4 style="margin: 0 0 5px 0; color: #2d3436;">💻 Technologies Used</h4>
                            <p style="margin: 0; color: #444;">HTML, CSS, JavaScript, Laravel, MySQL, Bootstrap, jQuery
                            </p>
                        </div>

                        <ul
                            style="list-style: none; padding: 0; margin: 15px 0; color: #444; font-size: 15px; line-height: 1.7;">
                            <li>✅ Vendor registration and approval system</li>
                            <li>✅ Advanced product search and category filtering</li>
                            <li>✅ Dynamic order and delivery tracking</li>
                            <li>✅ Coupon and discount management</li>
                        </ul>

                        <p style="color: #636e72; font-size: 14px; margin-top: 20px;">
                            <b>📅 Last Updated:</b> <span style="color: #2d3436;">Sep 29, 2025</span> &nbsp; | &nbsp;
                            <b>Status:</b> <span style="color: #00b894;">Active</span> &nbsp; | &nbsp;
                            <b>Category:</b> <span style="color: #0984e3;">Technology</span>
                        </p>
                        <!-- content end -->

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
@push('scripts')
<script>
    const slider = document.querySelector('.slider')
const carousel = document.querySelector('.carousel')

const prev = document.querySelector('.controls .prev')
const next = document.querySelector('.controls .next')
let direction = -1

const sliding_proportion = '20%' //  sliding_proportion = 100/number_of_slide


prev.addEventListener('click',(e)=>{
    if(direction === 1){
        slider.style.transform = `translateX(${sliding_proportion})`
    }else{
        carousel.style.justifyContent = 'flex-end'
        slider.appendChild(slider.firstElementChild)
        slider.style.transform = `translateX(${sliding_proportion})`
        direction = 1
    }
    setTimeout(()=>{
        slider.style.transition = 'none'
        slider.prepend(slider.lastElementChild)
        slider.style.transform = "translateX(0)"
        setTimeout(()=>{
            slider.style.transition = '0.3s'
        },100)
    },300)
})

next.addEventListener('click',(e)=>{
    if(direction === -1){
        slider.style.transform = `translateX(-${sliding_proportion})`
    }else{
        carousel.style.justifyContent = 'flex-start'
        slider.prepend(slider.lastElementChild)
        slider.style.transform = `translateX(-${sliding_proportion})`
        direction = -1
    }
    setTimeout(()=>{
        slider.style.transition = 'none'
        slider.appendChild(slider.firstElementChild)
        slider.style.transform = "translateX(0)"
        setTimeout(()=>{
            slider.style.transition = '0.3s'
        },100)
    },300)
})
</script>
@endpush