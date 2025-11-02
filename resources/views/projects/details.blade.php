<x-guest-layout>
    @push('styles')
        <style>
            .main-title {
                margin: 30px 0 !important;
            }
        </style>
    @endpush
    <section class="portfolio-section">
        <div class="section-title-and-desc">
            <h1 class="section-title main-title mt-10">{{ $project->project_title }}</h1>
            <p class="section-desc">{{ $project->short_description }}</p>
        </div>
        <div>
            <div>
                <div class="carousel-container">
                    <div class="carousel">
                        <div class="slider">
                            <section style="cursor: pointer;"
                                onclick="window.open('{{ asset("uploads/images/projects/$project->hero_image") }}', '_blank')">
                                <img src="{{ asset("uploads/images/projects/$project->hero_image") }}" width="100%" alt="">
                            </section>

                            @if($project->gallery_image)
                                @foreach ($project->gallery_image as $gallery_image)
                                    <section style="cursor: pointer;"
                                        onclick="window.open('{{ asset("uploads/images/projects/gallery/$gallery_image") }}', '_blank')">
                                        <img src="{{ asset("uploads/images/projects/gallery/$gallery_image") }}" width="100%" alt="">
                                    </section>
                                @endforeach
                            @endif
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
                            @if($project->live_link)
                                <a href="{{ $project->live_link }}" target="_blank" class="btn btn-primary"> <span class="icon"><i
                                            class="fa-solid fa-up-right-from-square"></i></span>Live Preview</a>
                            @endif
                            @if($project->source_link)
                                <a href="{{ $project->source_link }}" target="_blank" class="btn btn-secondary"> &lt;&gt;Source Code</a>
                            @endif
                        </div>
                        <style>
                            h1,
                            h2,
                            h3,
                            h4,
                            h5,
                            h6 {
                                font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
                                font-weight: 600;
                                line-height: 1.2;
                                margin: 1.2em 0 0.5em;
                                color: #222;
                            }

                            /* Individual sizes and slight color/weight variations */
                            h1 {
                                font-size: 2.25rem;
                                /* ~36px */
                                font-weight: 700;
                                color: #111;
                            }

                            h2 {
                                font-size: 1.6rem;
                                font-weight: 600;
                                padding-left: 8px;
                                color: #111827;
                                margin-top: 2rem;
                                margin-bottom: 30px;
                            }

                            h3 {
                                font-size: 1.5rem;
                                /* ~24px */
                                color: #333;
                            }

                            h4 {
                                font-size: 1.25rem;
                                /* ~20px */
                                color: #444;
                            }

                            h5 {
                                font-size: 1.1rem;
                                /* ~18px */
                                color: #555;
                            }

                            h6 {
                                font-size: 1rem;
                                /* ~16px */
                                color: #666;
                                text-transform: uppercase;
                                letter-spacing: 0.5px;
                            }

                            table {
                                width: 100%;
                                border-collapse: collapse;
                                /* Removes double borders */
                                margin: 1em 0;
                                font-family: Arial, sans-serif;
                                font-size: 16px;
                            }

                            th,
                            td {
                                border: 1px solid #ccc;
                                /* Light gray border */
                                padding: 8px 12px;
                                text-align: left;
                            }

                            th {
                                background-color: #f5f5f5;
                                /* Light background for header */
                                font-weight: 600;
                            }

                            tr:nth-child(even) {
                                background-color: #fafafa;
                                /* Subtle striping */
                            }

                            tr:hover {
                                background-color: #f0f0f0;
                                /* Hover effect */
                            }

                            /* Center container */
                            .download-container {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                margin: 40px 0;
                            }

                            /* Button styling */
                            .download-btn {
                                display: inline-flex;
                                align-items: center;
                                gap: 8px;
                                /* space between icon and text */
                                background-color: #313131;
                                color: #fff;
                                padding: 8px 16px;
                                border-radius: 6px;
                                text-decoration: none;
                                font-family: "Segoe UI", Arial, sans-serif;
                                font-weight: 600;
                                font-size: 18px;
                                transition: background-color 0.2s ease, transform 0.1s ease;
                            }

                            /* Hover and active states */
                            .download-btn:hover {
                                background-color: #0056b3;
                                transform: translateY(-1px);
                            }

                            .download-btn:active {
                                transform: translateY(0);
                            }

                            /* Optional: icon size consistency */
                            .download-btn svg {
                                width: 18px;
                                height: 18px;
                            }

                            p {
                                font-size: 17px;
                            }
                        </style>

                        {!! $project->descriptionHtml !!}

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


        prev.addEventListener('click', (e) => {
            if (direction === 1) {
                slider.style.transform = `translateX(${sliding_proportion})`
            } else {
                carousel.style.justifyContent = 'flex-end'
                slider.appendChild(slider.firstElementChild)
                slider.style.transform = `translateX(${sliding_proportion})`
                direction = 1
            }
            setTimeout(() => {
                slider.style.transition = 'none'
                slider.prepend(slider.lastElementChild)
                slider.style.transform = "translateX(0)"
                setTimeout(() => {
                    slider.style.transition = '0.3s'
                }, 100)
            }, 300)
        })

        next.addEventListener('click', (e) => {
            if (direction === -1) {
                slider.style.transform = `translateX(-${sliding_proportion})`
            } else {
                carousel.style.justifyContent = 'flex-start'
                slider.prepend(slider.lastElementChild)
                slider.style.transform = `translateX(-${sliding_proportion})`
                direction = -1
            }
            setTimeout(() => {
                slider.style.transition = 'none'
                slider.appendChild(slider.firstElementChild)
                slider.style.transform = "translateX(0)"
                setTimeout(() => {
                    slider.style.transition = '0.3s'
                }, 100)
            }, 300)
        })
    </script>
@endpush