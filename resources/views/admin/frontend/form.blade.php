<x-app-layout>
  @section('title')
    {{ $title }}
  @endsection
  @section('prepend_scripts')
    <script>
      window.editor_content = @json($frontend->about_story);
      window.editor_content = JSON.parse(window.editor_content)
    </script>
  @endsection
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __($title) }}
    </h2>
  </x-slot>

  <div class="form-container">
    <div class="form-card">

      <form action="{{ route('frontend.store') }}" method="post" onsubmit="handleFormSubmit(event)"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
          <div class="back-button-container">
            <a href="{{ route('frontend.index') }}" class="btn back-button"><span></span>back</a>
          </div>
        </div>

        <div class="form-group radio-wrapper">
          <input type="radio" name="current_theme_color" value="blue" id="option-1" @if($frontend->current_theme_color == "blue") checked @endif>
          <label for="option-1" class="option option-1" style="--main-color: #4184ff;">
            <div class="dot"></div>
            <span>Blue</span>
          </label>
          <input type="radio" name="current_theme_color" value="navy" id="option-2" @if($frontend->current_theme_color == "navy") checked @endif>
          <label for="option-2" class="option option-2" style="--main-color: #183153;">
            <div class="dot"></div>
            <span>Navy</span>
          </label>
          <input type="radio" name="current_theme_color" value="green" id="option-3" @if($frontend->current_theme_color == "green") checked @endif>
          <label for="option-3" class="option option-3" style="--main-color: #00AA4D;">
            <div class="dot"></div>
            <span>Green</span>
          </label>
          <input type="radio" name="current_theme_color" value="red" id="option-4" @if($frontend->current_theme_color == "red") checked @endif>
          <label for="option-4" class="option option-4" style="--main-color:  #FF4141;">
            <div class="dot"></div>
            <span>Red</span>
          </label>
          <input type="radio" name="current_theme_color" value="custom" id="option-5" @if($frontend->current_theme_color == "custom") checked @endif>
          <label for="option-5" class="option option-5" style="--main-color:  black;">
            <div class="dot"></div>
            <span>Custom</span>
          </label>
        </div>

        <div class="custom-colors-container" style="display: @if($frontend->current_theme_color != "custom") none @endif ;">
          <label for="primary_body_color">
              <span>--primary-body-color:</span>
              <x-text-input id="primary_body_color" name="primary_body_color" type="hidden" placeholder="--primary-body-color" class="mt-1" value="{{ $frontend->theme_colors['primary_body_color'] }}"/>
              <div class="color-picker-1"></div>
            </label>
            
            <label for="active_text_color">
              <span>--active-text-color:</span> 
              <x-text-input id="active_text_color" name="active_text_color" type="hidden" placeholder="--active-text-color" class="mt-1" value="{{ $frontend->theme_colors['active_text_color'] }}"/>
              <div class="color-picker-2"></div>
            </label>
            
            <label for="outline_default_color">
              <span>--outline-default-color:</span> 
              <x-text-input id="outline_default_color" name="outline_default_color" type="hidden" placeholder="--outline-default-color" class="mt-1" value="{{ $frontend->theme_colors['outline_default_color'] }}"/>
              <div class="color-picker-3"></div>
            </label>

            <label for="box_shadow_color">
              <span>--box-shadow-color:</span> 
              <x-text-input id="box_shadow_color" name="box_shadow_color" type="hidden" placeholder="--box-shadow-color" class="mt-1" value="{{ $frontend->theme_colors['box_shadow_color'] }}"/>
              <div class="color-picker-4"></div>
            </label>
        </div>

        <div class="form-group">
          <x-input-label for="name" :value="__('Name')" />
          <x-text-input id="name" name="name" type="text" placeholder="Your Name" class="mt-1 block w-full"
            value="{{ old('name', $frontend->name) }}" required autocomplete="name" />
          <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div class="form-group">
          <x-input-label for="hero_brief" :value="__('Hero brief')" />
          <textarea class="short-desc" name="hero_brief"
            placeholder="Write a short brief of your portfolio...">{{ old('hero_brief', $frontend->hero_brief) }}</textarea>
          <x-input-error class="mt-2" :messages="$errors->get('hero_brief')" />
        </div>
        <div class="form-group">
          <label>Hero Image</label>
          <label class="hero-placeholder" for="hero_image">
            @if($frontend->hero_image)
              <img class="preview" src="{{ asset('uploads/images/frontend/hero_image/' . $frontend->hero_image) }}" alt="">
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
          <x-input-label for="portfolio_title" :value="__('Portfolio Title')" />
          <x-text-input id="portfolio_title" name="portfolio_title" type="text" placeholder="Portfolio Title"
            class="mt-1 block w-full" value="{{ old('portfolio_title', $frontend->portfolio_title) }}" required
            autocomplete="portfolio_title" />
          <x-input-error class="mt-2" :messages="$errors->get('portfolio_title')" />
        </div>
        <div class="form-group">
          <x-input-label for="portfolio_desc" :value="__('Portfolio Desc')" />
          <textarea class="short-desc" name="portfolio_desc" style="min-height: 100px !important;"
            placeholder="Write a short description of portfolio section..">{{ old('portfolio_desc', $frontend->portfolio_desc) }}</textarea>
          <x-input-error class="mt-2" :messages="$errors->get('portfolio_desc')" />
        </div>
        <div class="form-group">
          <x-input-label for="about_title" :value="__('About Title')" />
          <x-text-input id="about_title" name="about_title" type="text" placeholder="About Title"
            class="mt-1 block w-full" value="{{ old('about_title', $frontend->about_title) }}" required
            autocomplete="about_title" />
          <x-input-error class="mt-2" :messages="$errors->get('about_title')" />
        </div>
        <div class="form-group">
          <x-input-label for="about_desc" :value="__('About Desc')" />
          <textarea class="short-desc" name="about_desc" style="min-height: 100px !important;"
            placeholder="Write a short description of portfolio section..">{{ old('about_desc', $frontend->about_desc) }}</textarea>
          <x-input-error class="mt-2" :messages="$errors->get('about_desc')" />
        </div>

        <div class="form-group">
          <label>About image</label>
          <label class="hero-placeholder about-placeholder" for="about_image">
            @if($frontend->about_image)
              <img class="preview" src="{{ asset('uploads/images/frontend/about_image/' . $frontend->about_image) }}"
                alt="">
            @else
              <div class="images-placeholder hero">
                <i class="fa-solid fa-image"></i>
              </div>
              <img class="preview" src="" alt="">
            @endif
            <span class="hoverEffect"><i class="fa-solid fa-camera-retro"></i></span>
          </label>
          <input type="file" style="display: none;" name="about_image" id="about_image">
          <x-input-error class="mt-2" :messages="$errors->get('about_image')" />
        </div>

        <div class="form-group">
          <x-input-label for="about_story_title" :value="__('About Story Title')" />
          <x-text-input id="about_story_title" name="about_story_title" type="text" placeholder="Your Name"
            class="mt-1 block w-full" value="{{ old('about_story_title', $frontend->about_story_title) }}" required
            autocomplete="name" />
          <x-input-error class="mt-2" :messages="$errors->get('about_story_title')" />
        </div>

        <div class="form-group">
          <x-input-label for="about_story" :value="__('About Story')" />
          <div id="editorjs"></div>
          <input type="hidden" name="about_story"
            value="{{ old('about_story', $frontend->about_story) }}" id="about_story">
          <x-input-error class="mt-2" :messages="$errors->get('about_story')" />
        </div>

        <div class="form-group">
          <label>Skills Icons</label>
          <div class="gallery-image-container">
            <style>
              .gallery-image-container .preview-container {
                display: flex;
              }
            </style>
            <div class="preview-container">
              @if(isset($frontend->skills_icons))
                @foreach ($frontend->skills_icons as $skills_icon)
                  <div class="gallery-placeholder">
                    <img class="preview" src="{{ asset('uploads/images/frontend/skills_icons/' . $skills_icon) }}" alt="">
                  </div>
                @endforeach
              @endif

            </div>
            <div>
              <label for="about_skills_images" class="gallery-placeholder">
                <div class="images-placeholder">
                  <i class="fa-solid fa-images"></i>
                </div>
                <span class="hoverEffect"></span>
              </label>
            </div>
            <input type="file" style="display: none;" id="about_skills_images" name="about_skills_images[]"
              accept="image/*" multiple>
            <x-input-error class="mt-2" :messages="$errors->get('about_skills_images')" />
          </div>
        </div>
        <div class="form-group">
          <x-input-label for="about_button_text" :value="__('About Button Text')" />
          <x-text-input id="about_button_text" name="about_button_text" type="text" placeholder="Your Name"
            class="mt-1 block w-full" value="{{ old('about_button_text', $frontend->about_button_text) }}" required
            autocomplete="name" />
          <x-input-error class="mt-2" :messages="$errors->get('about_button_text')" />
        </div>

        <div class="form-group">
          <x-input-label for="blog_title" :value="__('Blog Title')" />
          <x-text-input id="blog_title" name="blog_title" type="text" placeholder="Your Name" class="mt-1 block w-full"
            value="{{ old('blog_title', $frontend->blog_title) }}" required autocomplete="name" />
          <x-input-error class="mt-2" :messages="$errors->get('blog_title')" />
        </div>
        <div class="form-group">
          <x-input-label for="blog_desc" :value="__('Blog Desc')" />
          <textarea class="short-desc" name="blog_desc" style="min-height: 100px !important;"
            placeholder="Write a short description of portfolio section..">{{ old('blog_desc', $frontend->blog_desc) }}</textarea>
          <x-input-error class="mt-2" :messages="$errors->get('blog_desc')" />
        </div>
        <div class="form-group">
          <x-input-label for="contact_title" :value="__('Contact Title')" />
          <x-text-input id="contact_title" name="contact_title" type="text" placeholder="Your Name"
            class="mt-1 block w-full" value="{{ old('contact_title', $frontend->contact_title) }}" required autocomplete="name" />
          <x-input-error class="mt-2" :messages="$errors->get('contact_title')" />
        </div>
        <div class="form-group">
          <x-input-label for="contact_desc" :value="__('Contact Desc')" />
          <textarea class="short-desc" name="contact_desc" style="min-height: 100px !important;"
            placeholder="Write a short description of portfolio section..">{{ old('contact_desc', $frontend->contact_desc) }}</textarea>
          <x-input-error class="mt-2" :messages="$errors->get('contact_desc')" />
        </div>

        <div class="form-group">
          <label>Contact Image</label>
          <label class="hero-placeholder contact-placeholder" for="contact_image">
            @if($frontend->contact_image)
            <img class="preview" src="{{ asset('uploads/images/frontend/contact_image/'.$frontend->contact_image) }}" alt="">
            @else
            <div class="images-placeholder hero">
              <i class="fa-solid fa-image"></i>
            </div>
            <img class="preview" src="" alt="">
            @endif
            <span class="hoverEffect"><i class="fa-solid fa-camera-retro"></i></span>
          </label>
          <input type="file" style="display: none;" name="contact_image" id="contact_image">
          <x-input-error class="mt-2" :messages="$errors->get('contact_image')" />
        </div>

        <div class="form-group">
          <x-input-label for="copyright_text" :value="__('Copyright Text')" />
          <x-text-input id="copyright_text" name="copyright_text" type="text" placeholder="Copyright Text"
            class="mt-1 block w-full" value="{{ old('copyright_text', $frontend->copyright_text) }}" required
            autocomplete="copyright_text" />
          <x-input-error class="mt-2" :messages="$errors->get('copyright_text')" />
        </div>
        <div style="position: sticky; bottom: 0px; background-color: rgb(255 255 255); padding: 20px 0;">
          <button type="submit" class="btn-submit">Save Frontend</button>
        </div>
      </form>
    </div>
  </div>

  @section('scripts')
    <script>
      document.querySelector('#hero_image').addEventListener('change', (e) => {
        const file = e.target.files[0];
        const label = $('.hero-placeholder')[0];
        if (file) {
          const placeholder = $('.images-placeholder.hero')[0];
          if (placeholder) {
            placeholder.style.display = 'none';
          }
          const imageUrl = URL.createObjectURL(file);
          const imageElement = label.querySelector('.preview');
          imageElement.style.display = 'block';
          imageElement.src = imageUrl;
        }
      })
      document.querySelector('#about_image').addEventListener('change', (e) => {
        const file = e.target.files[0];
        const label = $('.about-placeholder')[0];
        if (file) {
          const placeholder = $('.about-placeholder .images-placeholder.hero')[0];
          if (placeholder) {
            placeholder.style.display = 'none';
          }
          const imageUrl = URL.createObjectURL(file);
          const imageElement = label.querySelector('.preview');
          imageElement.style.display = 'block';
          imageElement.src = imageUrl;
        }
      })
      document.querySelector('#contact_image').addEventListener('change', (e) => {
        const file = e.target.files[0];
        const label = $('.contact-placeholder')[0];
        if (file) {
          const placeholder = $('.contact-placeholder .images-placeholder.hero')[0]
          if (placeholder) {
            placeholder.style.display = 'none';
          }
          const imageUrl = URL.createObjectURL(file);
          const imageElement = label.querySelector('.preview');
          imageElement.style.display = 'block';
          imageElement.src = imageUrl;
        }
      })
      document.querySelector('#about_skills_images').addEventListener('change', (e) => {
        const files = Array.from(e.target.files);
        const label = $('.hero-placeholder')[0];
        const preview_container = $('.preview-container')[0];
        preview_container.innerHTML = '';
        let preview_html = '';
        if (files.length > 0) {
          files.forEach(file => {
            const imageUrl = URL.createObjectURL(file);
            preview_html += `
                  <div class="gallery-placeholder">
                    <img class="preview" src="${imageUrl}" alt="">
                  </div>
                `;
          })
          preview_container.style.display = 'flex';
          preview_container.innerHTML = preview_html;
        } else {

        }
      })
      async function handleFormSubmit(e) {
        e.preventDefault();
        try {
          const content = await window.editor.save();
          document.getElementById('about_story').value = JSON.stringify(content);
          e.target.submit();
        } catch (err) {
          console.error('Auto-save failed:', err);
        }
      }
      document.querySelectorAll('input[name="current_theme_color"]').forEach((radio) => {
        radio.addEventListener('change', (e) => {
          const value = e.target.value;
          if(value === 'custom'){
            document.querySelector('.custom-colors-container').style.display = "block";
          } else {
            document.querySelector('.custom-colors-container').style.display = "none";
          }
        });
      });
    </script>
  @endsection
</x-app-layout>