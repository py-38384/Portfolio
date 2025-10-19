<x-app-layout>
  @section('title')
    {{ $title }}
  @endsection
  @section('prepend_scripts')
    <script>
      @if(isset($project))
      window.editor_content = @json($project->description);
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

      <form action="{{ isset($project)? route('projects.update', $project->id): route('projects.store') }}" method="post" onsubmit="handleFormSubmit(event)" enctype="multipart/form-data">
        @csrf
        @if(isset($project))
        @method('PUT')
        @endif
        <div class="form-group">
          <div class="back-button-container">
            <a href="{{ route('projects.index') }}" class="btn back-button"><span></span>back</a>
          </div>
        </div>
        <div class="form-group">
          <x-input-label for="project_title" :value="__('Project Title')" />
          <x-text-input id="project_title" name="project_title" type="text" class="mt-1 block w-full"
            value="{{ old('project_title', isset($project)? $project->project_title: '') }}" required autofocus autocomplete="project_title" />
          <x-input-error class="mt-2" :messages="$errors->get('project_title')" />
        </div>

        <div class="form-group">
          <label>Hero Image</label>
          <label class="hero-placeholder" for="hero_image">
            @if(isset($project))
            <img class="preview" src="{{ isset($project)? asset('uploads/images/projects/'.$project->hero_image):'' }}" alt="">
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
          <label>Gallery Images</label>
          <div class="gallery-image-container">
            <style>
              .gallery-image-container .preview-container {
                display: flex;
              }
            </style>
            <div class="preview-container">
              @if(isset($project))
              @foreach ($project->gallery_images as $gallery_image)
              <div class="gallery-placeholder">
                <img class="preview" src="{{ asset('uploads/images/projects/gallery/'.$gallery_image) }}" alt="">
              </div>
              @endforeach
              @endif

            </div>
            <div>
              <label for="gallery_image"  class="gallery-placeholder">
                <div class="images-placeholder">
                  <i class="fa-solid fa-images"></i>
                </div>
                <span class="hoverEffect"></span>
              </label>
            </div>
            <input type="file" style="display: none;" id="gallery_image" name="gallery_images[]" accept="image/*"
              multiple>
            <x-input-error class="mt-2" :messages="$errors->get('gallery_image')" />
          </div>
        </div>

        <div class="form-group">
          <label>Short Description</label>
          <textarea class="short-desc" name="short_description" placeholder="Write a short summary...">{{ old('short_description', isset($project)?$project->short_description: '') }}</textarea>
          <x-input-error class="mt-2" :messages="$errors->get('short_description')" />
        </div>

        <div class="form-group">
          <label>Detailed Description</label>
          <div id="editorjs"></div>
          <input type="hidden" name="description" value="{{ old('description', isset($project)? $project->description: '') }}" id="description">
          <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div class="form-group">
          <label>Status</label>
          <div class="select-wrapper">
            <select class="custom-select" name="status">
              <option @selected(isset($project) && $project->status == 'pending')>Pending</option>
              <option @selected(isset($project) && $project->status == 'published')>Published</option>
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
      document.querySelector('#gallery_image').addEventListener('change', (e) => {
        const files = Array.from(e.target.files) 
        const label = $('.hero-placeholder')[0]
        const preview_container = $('.preview-container')[0]
        preview_container.innerHTML = ''
        let preview_html = '';
        if (files.length > 0) {
          files.forEach(file => {
            const imageUrl = URL.createObjectURL(file)
            preview_html += `
                <div class="gallery-placeholder">
                  <img class="preview" src="${imageUrl}" alt="">
                </div>
              `;
          })
          preview_container.style.display = 'flex'
          preview_container.innerHTML = preview_html;
        } else {

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
      @if(!isset($project))
      const addCachedEditorContent = async () => {
        const data = @json($cached_project);
        await window.editor.isReady;
        if(data){
          window.editor.render(data);
        }
      };
      setTimeout(() => {
        addCachedEditorContent();
      }, 100)
      @endif
    </script>
  @endsection
</x-app-layout>