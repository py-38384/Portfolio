<x-guest-layout>
    <section class="portfolio-section">
        <div class="section-title-and-desc main-title-and-desc">
            <h1 class="section-title main-title mt-10">Blogs</h1>
            <p class="section-desc">Blogs that may be useful for you and of course me.</p>
            <div class="back-to-home">
                <a href="/"><span class="material-symbols-outlined">arrow_back</span> Back To Home </a>
            </div>
        </div>
        <div class="blog-container blog-container-all">
            @foreach ($blogs as $blog)
            <div class="blog blog-all">
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
                    <div class="content">
                        {{ $blog->short_description }}
                        <a href="{{ route('blogs.details', $blog->slug) }}" class="link">Read more</a>
                    </div>
                    <div class="timestamp"><i class="fa-solid fa-clock"></i> {{ $blog->created_at->diffForHumans() }}</div>
                </div>
            </div>
            @endforeach
            
        </div>
    </section>
</x-guest-layout>