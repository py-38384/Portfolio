<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Logo Update') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your website icon and favicon.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.icons') }}" class="mt-6 space-y-6" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        
        <div class="form-group">
          <label>Icon</label>
          <label class="hero-placeholder icon-placeholder" for="icon">
            @if(isset($generalSettings->icon))
            <img class="preview" src="{{ asset('uploads/images/general/icons/'.$generalSettings->icon) }}" alt="">
            @else
            <div class="images-placeholder icon">
              <i class="fa-solid fa-image"></i>
            </div>
            <img class="preview" src="" alt="">
            @endif
            <span class="hoverEffect"><i class="fa-solid fa-camera-retro"></i></span>
          </label>
          <input type="file" style="display: none;" name="icon" id="icon">
          <x-input-error class="mt-2" :messages="$errors->get('icon')" />
        </div>

        <div class="form-group">
          <label>Favicon</label>
          <label class="hero-placeholder favicon-placeholder" for="favicon">
            @if(isset($generalSettings->favicon))
            <img class="preview" src="{{ asset('uploads/images/general/icons/'.$generalSettings->favicon) }}" alt="">
            @else
            <div class="images-placeholder favicon">
              <i class="fa-solid fa-image"></i>
            </div>
            <img class="preview" src="" alt="">
            @endif
            <span class="hoverEffect"><i class="fa-solid fa-camera-retro"></i></span>
          </label>
          <input type="file" style="display: none;" name="favicon" id="favicon">
          <x-input-error class="mt-2" :messages="$errors->get('favicon')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
    @section('scripts')
    <script>
        document.querySelector('#icon').addEventListener('change', (e) => {
            const file = e.target.files[0]
            const label = $('.icon-placeholder')[0]
            if (file) {
                const placeholder = $('.images-placeholder.icon')[0]
                if(placeholder){
                    placeholder.style.display = 'none'
                }
                const imageUrl = URL.createObjectURL(file)
                const imageElement = label.querySelector('.preview')
                imageElement.style.display = 'block';
                imageElement.src = imageUrl;
            }
        })
        document.querySelector('#favicon').addEventListener('change', (e) => {
            const file = e.target.files[0]
            const label = $('.favicon-placeholder')[0]
            if (file) {
                const placeholder = $('.images-placeholder.favicon')[0]
                if(placeholder){
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
</section>
