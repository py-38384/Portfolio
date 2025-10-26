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

      <form action="{{ isset($testimonial) ? route('testimonial.update', $testimonial->id) : route('testimonial.store') }}"
        method="post" onsubmit="handleFormSubmit(event)" enctype="multipart/form-data">
        @csrf
        @if(isset($testimonial))
          @method('PUT')
        @endif
        <div class="form-group">
          <div class="back-button-container">
            <a href="{{ route('testimonial.index') }}" class="btn back-button"><span></span>back</a>
          </div>
        </div>
        <div class="form-group">
          <label>Image</label>
          <label class="hero-placeholder" for="image">
            @if(isset($testimonial))
              <img class="preview" src="{{ isset($testimonial) ? asset('uploads/images/testimonial/' . $testimonial->image) : '' }}"
                alt="">
            @else
              <div class="images-placeholder hero">
                <i class="fa-solid fa-image"></i>
              </div>
              <img class="preview" src="" alt="">
            @endif
            <span class="hoverEffect"><i class="fa-solid fa-camera-retro"></i></span>
          </label>
          <input type="file" style="display: none;" name="image" id="image">
          <x-input-error class="mt-2" :messages="$errors->get('image')" />
        </div>
        <div class="form-group">
          <x-input-label for="name" :value="__('Full Name')" />
          <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
            value="{{ old('name', isset($testimonial) ? $testimonial->name : '') }}" required
            autocomplete="name" />
          <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="form-group">
          <x-input-label for="designation" :value="__('Designation')" />
          <x-text-input id="designation" name="designation" type="text" class="mt-1 block w-full"
            value="{{ old('designation', isset($testimonial) ? $testimonial->designation : '') }}" placeholder="Business Owner" required
            autocomplete="designation" />
          <x-input-error class="mt-2" :messages="$errors->get('designation')" />
        </div>
        <div class="form-group">
          <label>Message</label>
          <textarea class="short-desc" name="message"
            placeholder="Write Testimonial Here...">{{ old('message', isset($testimonial) ? $testimonial->message : '') }}</textarea>
          <x-input-error class="mt-2" :messages="$errors->get('message')" />
        </div>

        <div class="form-group">
          <label>Stars</label>
          <div class="select-wrapper">
            <select class="custom-select" name="stars">
              <option value="1" @selected(isset($testimonial) && $testimonial->stars == 1)>1 Star</option>
              <option value="2" @selected(isset($testimonial) && $testimonial->stars == 2)>2 Star</option>
              <option value="3" @selected(isset($testimonial) && $testimonial->stars == 3)>3 Star</option>
              <option value="4" @selected(isset($testimonial) && $testimonial->stars == 4)>4 Star</option>
              <option value="5" @selected(isset($testimonial) && $testimonial->stars == 5)>5 Star</option>
            </select>
          </div>
          <x-input-error class="mt-2" :messages="$errors->get('testimonial->stars')" />
        </div>

        <div>
          <button type="submit" class="btn-submit">Save Testimonial</button>
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