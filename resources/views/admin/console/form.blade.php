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

  @php
    $array_index = 0;
  @endphp

  <div class="form-container">
    <div class="form-card">

      <form action="{{ isset($console)? route('console.update', $console->id) :route('console.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if(isset($console))
        @method("PUT")
        @endif
        <div class="form-group">
          <div class="back-button-container">
            <a href="{{ route('console.index') }}" class="btn back-button"><span></span>back</a>
          </div>
        </div>
        <div class="form-group">
          <x-input-label for="property" :value="__('Property Name')" />
          <x-text-input id="property" name="property" type="text" placeholder="Your Name" class="mt-1 block w-full"
            value="{{ old('property', isset($console) ? $console->property : '') }}" required autocomplete="property" />
          <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div class="form-group">
          <label>type</label>
          <div class="select-wrapper">
            <select class="custom-select" id="type_select" name="type">
              <option value="string" @selected(isset($console) && $console->type == 'string')>String</option>
              <option value="array" @selected(isset($console) && $console->type == 'array')>Array</option>
            </select>
          </div>
          <x-input-error class="mt-2" :messages="$errors->get('status')" />
        </div>
        <div class="form-group" id="value_container">
          @if(isset($console))
            @php
              $console->content = json_decode($console->content);
            @endphp
            @if($console->type == 'string')
              <div>
                <!-- String Input -->
                <x-input-label for="string" :value="__('String Value')" />
                <x-text-input
                    id="string"
                    name="string"
                    type="text"
                    placeholder="String Value"
                    class="mt-1 block w-full"
                    :value="old('string', $console->content->string ?? '')"
                    required
                    autocomplete="string"
                />
                <x-input-error class="mt-2" :messages="$errors->get('string')" />

                <!-- Link Input -->
                <x-input-label for="link" :value="__('Link Value')" />
                <x-text-input
                    id="link"
                    name="link"
                    type="text"
                    placeholder="Link Value"
                    class="mt-1 block w-full"
                    :value="old('link', $console->content->link ?? '')"
                    autocomplete="link"
                />
                <x-input-error class="mt-2" :messages="$errors->get('link')" />

              </div>
            @else
              <div class="form-group" id="value_container">
                <div id="array_value_container">
                  @foreach ($console->content as $index => $content)
                  @php
                  $array_index = $index;
                  @endphp
                    <div>
                      <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="string_value">
                        Array value #{{ $index }}
                      </label>
                      <input
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                        id="string_value" name="value[0][string]" value="{{ $content->string }}" type="text" placeholder="Value" required="required"
                        autocomplete="string_value">
                      <input
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                        id="string_value" name="value[0][link]" value="{{ $content->link }}" type="text" placeholder="Link" autocomplete="string_value">
                    </div>
                  @endforeach
                </div>
                <div>
                  <button class="btn mt-2 text-xl" onclick="addArrayValue(event)">+</button>
                </div>
              </div>
            @endif
          @else
            <div>
              <x-input-label for="string" :value="__('String Value')" />
              <x-text-input id="string" name="string" type="text" placeholder="String Value" class="mt-1 block w-full"
                value="" required autocomplete="string" />
              <x-text-input id="link" name="link" type="text" placeholder="Link Value" class="mt-1 block w-full" value=""
                autocomplete="link" />
              <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
          @endif

        </div>
        <div class="form-group">
          <label>Status</label>
          <div class="select-wrapper">
            <select class="custom-select" name="status">
              <option @selected(isset($console) && $console->status == 'pending')>Pending</option>
              <option @selected(isset($console) && $console->status == 'published')>Published</option>
            </select>
          </div>
          <x-input-error class="mt-2" :messages="$errors->get('status')" />
        </div>

        <button type="submit" class="btn-submit">Save Property</button>
      </form>
    </div>
  </div>

  @section('scripts')
    <script>
      const typeSelect = document.querySelector('#type_select');
      const valueContainer = document.querySelector('#value_container');
      let index = {{ $array_index+1 }};
      typeSelect.addEventListener('change', (e) => {
        const value = e.target.value;
        if (value === 'string') {
          index = 1;
          const html = `<div>
                              <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="string_value">
                                  Value
                              </label>
                              <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" id="string_value" name="string" type="text" placeholder="Value" required="required" autocomplete="string_value">
                              <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" id="string_value" name="link" type="text" placeholder="Link" autocomplete="string_value">
                            </div>`;
          valueContainer.innerHTML = html;
        }
        if (value === 'array') {
          const html = `<div id="array_value_container">
                              <div>
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="string_value">
                                    Array value #0
                                </label>
                                <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" id="string_value" name="value[0][string]" type="text" placeholder="Value" required="required" autocomplete="string_value">
                                <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" id="string_value" name="value[0][link]" type="text" placeholder="Link" autocomplete="string_value">
                              </div>
                            </div>
                            <div>
                              <button class="btn mt-2 text-xl" onclick="addArrayValue(event)">+</button>
                            </div>`;
          valueContainer.innerHTML = html;
        }
        if (value === 'object') {
          index = 1;
        }
      })

      function addArrayValue(event) {
        event.preventDefault();

        const valueContainer = document.querySelector('#array_value_container');

        const div = document.createElement('div');

        const label = document.createElement('label');
        label.classList.add(
          'block',
          'font-medium',
          'text-sm',
          'text-gray-700',
          'dark:text-gray-300'
        );
        label.setAttribute('for', 'string_value');
        label.innerText = `Array value #${index}`;

        const value_input = document.createElement('input');
        value_input.classList.add(
          'border-gray-300',
          'dark:border-gray-700',
          'dark:bg-gray-900',
          'dark:text-gray-300',
          'focus:border-indigo-500',
          'dark:focus:border-indigo-600',
          'focus:ring-indigo-500',
          'dark:focus:ring-indigo-600',
          'rounded-md',
          'shadow-sm',
          'mt-1',
          'block',
          'w-full'
        );
        value_input.setAttribute('name', `value[${index}][string]`);
        value_input.setAttribute('type', 'text');
        value_input.setAttribute('required', 'required');
        value_input.setAttribute('placeholder', 'Value');

        const link_input = document.createElement('input');
        link_input.classList.add(
          'border-gray-300',
          'dark:border-gray-700',
          'dark:bg-gray-900',
          'dark:text-gray-300',
          'focus:border-indigo-500',
          'dark:focus:border-indigo-600',
          'focus:ring-indigo-500',
          'dark:focus:ring-indigo-600',
          'rounded-md',
          'shadow-sm',
          'mt-1',
          'block',
          'w-full'
        );
        link_input.setAttribute('name', `value[${index}][link]`);
        link_input.setAttribute('type', 'text');
        link_input.setAttribute('placeholder', 'Link');

        div.append(label, value_input, link_input);
        valueContainer.append(div);

        index++;
      }

    </script>
  @endsection
</x-app-layout>