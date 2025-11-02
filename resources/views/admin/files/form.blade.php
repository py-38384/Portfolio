<x-app-layout>
  @section('title')
    {{ $title }}
  @endsection
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __($title) }}
    </h2>
  </x-slot>

  <div class="form-container">
    <div class="form-card">
      <form action="{{ isset($file) ? route('file.update', $file->id) : route('file.store') }}" method="post"
        onsubmit="handleFormSubmit(event)" enctype="multipart/form-data">
        @csrf
        @if(isset($file))
          @method('PUT')
        @endif
        <div class="form-group">
          <div class="back-button-container">
            <a href="{{ route('file.index') }}" class="btn back-button"><span></span>back</a>
          </div>
        </div>
        <div class="form-group">
          <x-input-label for="file_type" :value="__('File Type')" />

          <select class="custom-select" name="file_type">
            <option value="video" @selected(isset($file) && $file->file_type == "video")>Video</option>
            <option value="audio" @selected(isset($file) && $file->file_type == "audio")>Audio</option>
            <option value="image" @selected(isset($file) && $file->file_type == "image")>Image</option>
            <option value="pdf" @selected(isset($file) && $file->file_type == "pdf")>PDF</option>
            <option value="document" @selected(isset($file) && $file->file_type == "document")>Document</option>
            <option value="text" @selected(isset($file) && $file->file_type == "text")>Text</option>
            <option value="other" @selected(isset($file) && $file->file_type == "other")>Other</option>
          </select>
          <x-input-error class="mt-2" :messages="$errors->get('file_type')" />
        </div>
        <div class="form-group">
          <x-input-label for="path" :value="__('File Path')" />
          <x-text-input id="path" name="path" type="text" class="mt-1 block w-full"
            value="{{ old('path', isset($file) ? $file->path : '') }}" required autocomplete="path" />
          <x-input-error class="mt-2" :messages="$errors->get('path')" />
        </div>
        <div class="form-group">
          <label>Visibility</label>
          <div class="select-wrapper">
            <select class="custom-select" name="public">
              <option value=1 @selected(isset($file) && $file->public == 1)>Public</option>
              <option value=0 @selected(isset($file) && $file->public == 0)>Private</option>
            </select>
          </div>
          <x-input-error class="mt-2" :messages="$errors->get('public')" />
        </div>
        @if(!isset($file))
        <div class="form-group">
          <label>Upload File</label>
          <p>Max file Size 500mb</p>
          <div>
            <x-text-input id="file" name="file" type="file" class="mt-1 block w-50" required autocomplete="file" />
          </div>
          <x-input-error class="mt-2" :messages="$errors->get('file')" />
        </div>
        @endif

        <div>
          <button type="submit" class="btn-submit">Upload</button>
        </div>
      </form>
    </div>
  </div>

  @section('scripts')
    <script>
      document.querySelector('#image').addEventListener('change', (e) => {
        const file = e.target.files[0]
        const label = $('.hero-placeholder')[0]
        if (file) {
          const placeholder = $('.images-placeholder.hero')[0]
          if (placeholder) {
            placeholder.style.display = 'none'
          }
          const imageUrl = URL.createObjectURL(file)
          const imageElement = label.querySelector('.preview')
          imageElement.style.display = 'block';
          imageElement.src = imageUrl;
        }
      })
    </script>
  @endsection
</x-app-layout>