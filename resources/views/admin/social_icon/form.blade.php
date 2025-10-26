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
      <form action="{{ isset($social_icon) ? route('social_icon.update', $social_icon->id) : route('social_icon.store') }}"
        method="post" onsubmit="handleFormSubmit(event)" enctype="multipart/form-data">
        @csrf
        @if(isset($social_icon))
          @method('PUT')
        @endif
        <div class="form-group">
          <div class="back-button-container">
            <a href="{{ route('social_icon.index') }}" class="btn back-button"><span></span>back</a>
          </div>
        </div>
        <div class="form-group">
          <label>Icon Svg</label>
          <textarea class="short-desc" name="svg"
            placeholder="Write Icon Svg Code Here...">{{ old('svg', isset($social_icon) ? $social_icon->icon : '') }}</textarea>
          <x-input-error class="mt-2" :messages="$errors->get('svg')" />
        </div>
        <div class="form-group">
          <x-input-label for="link" :value="__('Link')" />
          <x-text-input id="link" name="link" type="text" class="mt-1 block w-full"
            value="{{ old('link', isset($social_icon) ? $social_icon->link : '') }}" required
            autocomplete="link" />
          <x-input-error class="mt-2" :messages="$errors->get('link')" />
        </div>

        <div>
          <button type="submit" class="btn-submit">Save Social</button>
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