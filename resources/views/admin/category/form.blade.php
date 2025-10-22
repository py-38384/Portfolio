<x-app-layout>
  @section('title')
    {{ $title }}
  @endsection
  @section('prepend_scripts')
    <script>
      
    </script>
  @endsection
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __($title) }}
    </h2>
  </x-slot>

  <div class="form-container">
    <div class="form-card">

      <form action="{{ isset($category)? route('category.update', $category->id): route('category.store') }}" method="post" onsubmit="handleFormSubmit(event)" enctype="multipart/form-data">
        @csrf
        @if(isset($category))
        @method('PUT')
        @endif
        <div class="form-group">
          <div class="back-button-container">
            <a href="{{ route('category.index') }}" class="btn back-button"><span></span>back</a>
          </div>
        </div>
        <div class="form-group">
          <x-input-label for="name" :value="__('Category Name')" />
          <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
            value="{{ old('name', isset($category)? $category->name: '') }}" required  autocomplete="name" />
          <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="form-group">
          <label>For</label>
          <div class="select-wrapper">
            <select class="custom-select" name="for">
              <option @selected(isset($category) && $category->status == 'category')>Project</option>
              <option @selected(isset($category) && $category->status == 'blog')>Blog</option>
            </select>
          </div>
          <x-input-error class="mt-2" :messages="$errors->get('status')" />
        </div>
        @if(isset($category))
        <button type="submit" class="btn-submit">Update Category</button>
        @else
        <button type="submit" class="btn-submit">Save Category</button>
        @endif
      </form>
    </div>
  </div>

  
</x-app-layout>