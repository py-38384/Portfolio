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
            <h1 class="section-title main-title">{{ $blog->blog_title }}</h1>
        </div>
        <div>
            <div class="blog-conainer">
                <div class="blog-hero-image-container">
                    <img src="{{ asset('uploads/images/blogs/' . $blog->hero_image)  }}" alt="">
                </div>
                <div class="blog-content">
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
                    <article>
                        <h1 style="font-size:2.2rem;font-weight:700;color:#111827;margin-top:2rem;">{{ $blog->blog_title }}</h1>
                        <p class="meta" style="color:#6b7280;font-size:0.9rem;margin-bottom:1rem;">
                            By <strong>{{ $frontend->name }}</strong> - Last Updated <time>{{ $blog->created_at->format('M d, Y g:i A') }}</time>
                        </p>

                        <div style="margin-bottom: 20px;">
                            @foreach ($blog->tags as $tag)
                            <span class="tag" style="display:inline-block;background:#e0f2fe;color:#0369a1;font-weight:600;padding:3px 10px;border-radius:6px;font-size:0.85rem;margin-right:5px;">{{ $tag->value }}</span>
                            @endforeach
                        </div>
                        {!! $blog->blog_content_html !!}
                    </article>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            document.querySelectorAll('pre code').forEach((el) => {
                hljs.highlightElement(el);
                const button = document.createElement('button');
                button.innerText = 'Copy';
                button.classList.add('copy-btn');
                el.parentElement.style.position = 'relative';
                button.style.position = 'absolute';
                button.style.top = '12px';
                button.style.right = '12px';
                button.addEventListener('click', () => {
                    navigator.clipboard.writeText(el.innerText);
                    button.innerText = 'Copied!';
                    setTimeout(() => (button.innerText = 'Copy'), 2000);
                });
                el.parentElement.appendChild(button);
            });
        </script>
    @endpush
</x-guest-layout>