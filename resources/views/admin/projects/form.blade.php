<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Add New Project') }}
    </h2>
  </x-slot>

  <div class="form-container">
    <div class="form-card">
      <div class="form-title">Add New Project</div>

      <form>
        <div class="form-group">
          <label>Project Title</label>
          <input type="text" placeholder="Enter project title">
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
          <x-wysiwyg/>
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
</x-app-layout>