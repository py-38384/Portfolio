<x-app-layout>
  @section('title')
    {{ $title }}
  @endsection
  @section('prepend_scripts')
    <script>
      @if(isset($blog))
      window.editor_content = @json($blog->description);
      window.editor_content = JSON.parse(window.editor_content)
      @else
      window.editor_content = null;
      @endif
    </script>
  @endsection
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __($title) }}
    </h2>
  </x-slot>

  <div class="form-container">
    <div class="form-card">

      <form action="{{ isset($blog)? route('blogs.update', $blog->id): route('blogs.store') }}" method="post" onsubmit="handleFormSubmit(event)" enctype="multipart/form-data">
        @csrf
        @if(isset($blog))
        @method('PUT')
        @endif
        <div class="form-group">
          <div class="back-button-container">
            <a href="{{ route('blogs.index') }}" class="btn back-button"><span></span>back</a>
          </div>
        </div>
        <div class="form-group">
          <x-input-label for="blog_title" :value="__('Blog Title')" />
          <x-text-input id="blog_title" name="blog_title" type="text" class="mt-1 block w-full"
            value="{{ old('blog_title', isset($blog)? $blog->blog_title: '') }}" required autofocus autocomplete="blog_title" />
          <x-input-error class="mt-2" :messages="$errors->get('blog_title')" />
        </div>

        <div class="form-group">
          <label>Hero Image</label>
          <label class="hero-placeholder" for="hero_image">
            @if(isset($blog))
            <img class="preview" src="{{ isset($blog)? asset('uploads/images/blogs/'.$blog->hero_image):'' }}" alt="">
            @else
            <div class="images-placeholder hero">
              <i class="fa-solid fa-image"></i>
            </div>
            <img class="preview" src="" alt="">
            @endif
            <span class="hoverEffect"><i class="fa-solid fa-camera-retro"></i></span>
          </label>
          <input type="file" style="display: none;" name="hero_image" id="hero_image">
          <x-input-error class="mt-2" :messages="$errors->get('hero_image')" />
        </div>

        <div class="form-group">
          <label>Short Description</label>
          <textarea class="short-desc" name="short_description" placeholder="Write a short summary...">{{ old('short_description', isset($blog)?$blog->short_description: '') }}</textarea>
          <x-input-error class="mt-2" :messages="$errors->get('short_description')" />
        </div>

        <div class="form-group">
          <label>Blog Content</label>
          <div id="editorjs"></div>
          <input type="hidden" name="description" value="{{ old('description', isset($blog)? $blog->description: '') }}" id="description">
          <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div class="form-group">
          <label>Status</label>
          <div class="select-wrapper">
            <select class="custom-select" name="status">
              <option @selected(isset($blog) && $blog->status == 'pending')>Pending</option>
              <option @selected(isset($blog) && $blog->status == 'published')>Published</option>
            </select>
          </div>
          <x-input-error class="mt-2" :messages="$errors->get('status')" />
        </div>

        <button type="submit" class="btn-submit">Save Project</button>
      </form>
    </div>
  </div>

  @section('scripts')
    <script>
      document.querySelector('#hero_image').addEventListener('change', (e) => {
        const file = e.target.files[0]
        const label = $('.hero-placeholder')[0]
        if (file) {
          const placeholder = $('.images-placeholder.hero')[0]
          if(placeholder){
            placeholder.style.display = 'none'
          }
          const imageUrl = URL.createObjectURL(file)
          const imageElement = label.querySelector('.preview')
          imageElement.style.display = 'block';
          imageElement.src = imageUrl;
        }
      })
    
      async function handleFormSubmit (e) {
        e.preventDefault();
        try {
          const content = await window.editor.save();
          document.getElementById('description').value = JSON.stringify(content);
          e.target.submit()
        } catch (err) {
          console.error('Auto-save failed:', err);
        }
      }
      @if(!isset($blog))
      const addCachedEditorContent = async () => {
        const data = @json($cached_blog);
        await window.editor.isReady;
        if(data){
          window.editor.render(data);
        }
      };
      setTimeout(() => {
        addCachedEditorContent();
      }, 100)
      @endif

      const csrf_token = document.querySelector("meta[name='csrf-token']").getAttribute('content');
      setInterval(async () => {
          try {
              const content = await window.editor.save();
              fetch(blogAutoSaveDarftRoute ?? '/save-blog-darft', {
              method: 'POST',
                  headers: {
                      'X-CSRF-TOKEN': csrf_token,
                      'Content-Type': 'application/json'
                  },
                  body: JSON.stringify({ data: content })
              }).then(res => res.json()).then(data => {
                // console.log(data)
              })

          } catch (err) {
              // 
          }
      }, 5000);
    </script>
  @endsection
</x-app-layout>