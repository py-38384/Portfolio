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
            <x-text-input id="project_title" name="project_title" type="text" class="mt-1 block w-full" :value="old('project_title')" required autofocus autocomplete="project_title" />
            <x-input-error class="mt-2" :messages="$errors->get('project_title')" />
        </div>

        <div class="form-group">
          <label>Hero Image</label>
          <div class="hero-placeholder">+</div>
        </div>

        <div class="form-group">
          <label>Gallery Images</label>
          <div class="gallery-placeholder">
            <div>+</div>
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

    </script>
  @endsection
</x-app-layout>