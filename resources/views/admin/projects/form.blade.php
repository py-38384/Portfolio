<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Add New Project') }}
    </h2>
  </x-slot>

  <div class="form-container">
    <div class="form-card">

      <form>
        <div class="form-group">
          <x-input-label for="project_title" :value="__('Project Title')" />
          <x-text-input id="project_title" name="project_title" type="text" class="mt-1 block w-full"
            :value="old('project_title')" required autofocus autocomplete="project_title" />
          <x-input-error class="mt-2" :messages="$errors->get('project_title')" />
        </div>

        <div class="form-group">
          <label>Hero Image</label>
          <label class="hero-placeholder" for="hero_image">
            <div class="images-placeholder hero">
              <i class="fa-solid fa-image"></i>
            </div>
            <img class="preview" src="" alt="">
            <span class="hoverEffect"><i class="fa-solid fa-camera-retro"></i></span>
          </label>
          <input type="file" style="display: none;" name="hero_image" id="hero_image">
        </div>

        <div class="form-group">
          <label>Gallery Images</label>
          <div class="gallery-image-container">

            <div class="preview-container">

              <div class="gallery-placeholder">
                <img class="preview" src="" alt="">
              </div>

            </div>
            <div>
              <label for="gallery_image"  class="gallery-placeholder">
                <div class="images-placeholder">
                  <i class="fa-solid fa-images"></i>
                </div>
                <span class="hoverEffect"></span>
              </label>
            </div>
            <input type="file" style="display: none;" id="gallery_image" name="gallery_image[]" accept="image/*"
              multiple>
          </div>
        </div>

        <div class="form-group">
          <label>Short Description</label>
          <textarea class="short-desc" placeholder="Write a short summary..."></textarea>
        </div>

        <div class="form-group">
          <label>Detailed Description</label>
          <div id="editorjs"></div>
        </div>

        <div class="form-group">
          <label>Status</label>
          <div class="select-wrapper">
            <select class="custom-select">
              <option>Pending</option>
              <option>Published</option>
            </select>
          </div>
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
          placeholder.style.display = 'none'
          const imageUrl = URL.createObjectURL(file)
          const imageElement = label.querySelector('.preview')
          imageElement.style.display = 'block';
          imageElement.src = imageUrl;
        }
      })
      document.querySelector('#gallery_image').addEventListener('change', (e) => {
        const files = Array.from(e.target.files) 
        console.log(files);
        const label = $('.hero-placeholder')[0]
        const preview_container = $('.preview-container')[0]
        preview_container.innerHTML = ''
        let preview_html = '';
        if (files.length > 0) {
          files.forEach(file => {
            console.log(file)
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
    </script>
  @endsection
</x-app-layout>