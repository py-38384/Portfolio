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
  <style>
    .tag-container{
      display: flex;
      flex-direction: column;
    }
  </style>
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
            value="{{ old('blog_title', isset($blog)? $blog->blog_title: '') }}" required  autocomplete="blog_title" />
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
          <div style="margin-bottom: 15px; display: flex; gap: 10px; flex-wrap: wrap;" class="tag-container">
            @if (isset($blog->tags))
              @foreach ($blog->tags as $index => $tag)
                <div style="display: flex; gap: 5px; align-items: center;">
                  <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" value="{{ $tag->value }}" id="tag" name="tag[{{ $index }}][text]" type="text" placeholder="tag" autocomplete="tag">
                  <input type="color" value="{{ $tag->color }}" name="tag[{{ $index }}][color]" style="height: 48px; width: 70px;">
                </div>
              @endforeach
              @else
              <div style="display: flex; gap: 5px; align-items: center;">
                <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="tag" name="tag[0][text]" type="text" placeholder="tag" autocomplete="tag">
                <input type="color" name="tag[0][color]" style="height: 48px; width: 70px;">
              </div>
            @endif
          </div>
          <button type="submit" class="btn-submit add-tag-button">Add Tag</button>
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

        <div style="position: sticky; bottom: 0px; background-color: rgb(255 255 255); padding: 20px 0; z-index: 10;">
          @if(isset($blog))
          <button type="submit" class="btn-submit">Update Blog</button>
          @else
          <button type="submit" class="btn-submit">Save Blog</button>
          @endif
        </div>
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
      const addTagButton = document.querySelector('.add-tag-button');
      const tagContainer = document.querySelector('.tag-container');

      window.tag_index = {{ count($blog->tags) }};
      addTagButton.addEventListener("click", (e) => {
        e.preventDefault();
        const tagInput = document.createElement('input');
        tagInput.classList.add(
          "border-gray-300",
          "dark:border-gray-700",
          "dark:bg-gray-900",
          "dark:text-gray-300",
          "focus:border-indigo-500",
          "dark:focus:border-indigo-600",
          "focus:ring-indigo-500",
          "dark:focus:ring-indigo-600",
          "rounded-md",
          "shadow-sm",
        );
        tagInput.id = "tag";
        tagInput.name = `tag[${window.tag_index}][text]`;
        tagInput.type = "text";
        tagInput.placeholder = "tag";
        const colorInput = document.createElement('input');
        colorInput.type = 'color';
        colorInput.name = `tag[${window.tag_index}][color]`;
        colorInput.style.height = '48px';
        colorInput.style.width = '70px';
        const container = document.createElement('div');
        container.style.display = 'flex';
        container.style.gap = '5px';
        container.style.alignItems = 'center';
        container.append(tagInput, colorInput)
        tagContainer.append(container);
        window.tag_index++;
      })
    </script>
  @endsection
</x-app-layout>