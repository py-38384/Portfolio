<x-guest-layout>
    <section class="portfolio-section">
        <div class="section-title-and-desc">
            <h1 class="section-title main-title mt-10">Portfolio</h1>
            <p class="section-desc">Here are all of the projects I've worked on. Feel free to take a look.</p>
            <div class="back-to-home">
                <a href="/"><span class="material-symbols-outlined">arrow_back</span> Back To Home</a>
            </div>
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
                        <a href="{{ route('portfolios.details', $project->id) }}"
                            class="title">{{ $project->project_title }}</a>
                        <div class="description">{{ $project->short_description }}</div>
                        <div class="technologis">
                            @foreach ($project->tags as $tag)
                                <span class="technology">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <div class="button-container">
                            @if($project->live_link)
                                <a target="_blank" href="{{ $project->live_link }}" class="btn btn-primary"><span
                                        class="icon"><i class="fa-solid fa-up-right-from-square"></i></span>Live Preview</a>
                            @endif
                            @if($project->source_link)
                                <a target="_blank" href="{{ $project->source_link }}" class="btn btn-secondary"> &lt;&gt;Source
                                    Code</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-10">{{ $projects->links() }}</div>
    </section>
</x-guest-layout>