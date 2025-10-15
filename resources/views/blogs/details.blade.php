<x-guest-layout>
    @push('styles')
        <style>
            .main-title{
                margin: 30px 0 !important;
            }
        </style>
    @endpush
    <section class="portfolio-section">
        <div class="section-title-and-desc">
            <h1 class="section-title main-title">How to host a Laravel app in Production on an Ubuntu VPS</h1>
        </div>
        <div>
            <div class="blog-conainer">
                <div class="blog-hero-image-container">
                    <img src="/assets/images/4884785.jpg" alt="">
                </div>
                <div class="blog-content">
                    

                <article style="margin:0 auto;padding:40px 20px;line-height:1.7;color:#1f2937;font-family:'Inter',system-ui,sans-serif;background:#f9fafb;">
    <h1 style="font-size:2.2rem;font-weight:700;color:#111827;margin-top:2rem;">🚀 How to Host a Laravel App in Production on Ubuntu VPS</h1>
    <p class="meta" style="color:#6b7280;font-size:0.9rem;margin-bottom:1.5rem;">
      By <strong>Piyal Hossein</strong> · Last Updated <time>Oct 11, 2025</time>
    </p>

    <div>
      <span class="tag" style="display:inline-block;background:#e0f2fe;color:#0369a1;font-weight:600;padding:3px 10px;border-radius:6px;font-size:0.85rem;margin-right:5px;">Laravel</span>
      <span class="tag" style="display:inline-block;background:#e0f2fe;color:#0369a1;font-weight:600;padding:3px 10px;border-radius:6px;font-size:0.85rem;margin-right:5px;">DevOps</span>
      <span class="tag" style="display:inline-block;background:#e0f2fe;color:#0369a1;font-weight:600;padding:3px 10px;border-radius:6px;font-size:0.85rem;margin-right:5px;">Ubuntu</span>
    </div>

    <p style="margin-top:1rem;">
      Deploying a Laravel application to a live production server is one of the biggest steps in turning your project into a real-world product. 
      In this guide, we’ll walk through how to set up your Laravel app on a fresh Ubuntu VPS, configure Nginx, PHP, and SSL, and get your site running 
      smoothly and securely — all using open-source tools.
    </p>

    <hr style="margin:2rem 0;border:1px solid #e5e7eb;">

    <h2 style="font-size:1.6rem;font-weight:600;border-left:4px solid #2563eb;padding-left:8px;color:#111827;margin-top:2rem;">Step 1: Install Required Packages</h2>
    <p style="margin-top:1rem;">Start by updating your system and installing all necessary software:</p>

    <pre>
<code>sudo apt update && sudo apt upgrade -y
sudo apt install nginx mysql-server php8.2 php8.2-fpm php8.2-mysql php8.2-cli php8.2-xml php8.2-curl php8.2-mbstring unzip git -y
sudo systemctl enable php8.2-fpm
sudo systemctl start php8.2-fpm</code></pre>

    <h2 style="font-size:1.6rem;font-weight:600;border-left:4px solid #2563eb;padding-left:8px;color:#111827;margin-top:2rem; margin-bottom: 30px;">Step 2: Clone Your Laravel Project</h2>
    <pre>
<code>cd /var/www
sudo git clone https://github.com/yourusername/your-laravel-app.git
sudo chown -R www-data:www-data /var/www/your-laravel-app
sudo chmod -R 775 /var/www/your-laravel-app/storage
sudo chmod -R 775 /var/www/your-laravel-app/bootstrap/cache</code></pre>

    <h2 style="font-size:1.6rem;font-weight:600;border-left:4px solid #2563eb;padding-left:8px;color:#111827;margin-top:2rem; margin-bottom: 30px;">Step 3: Set Up Environment</h2>
    <pre>
<code>cd /var/www/your-laravel-app
cp .env.example .env
php artisan key:generate</code></pre>

    <p style="margin-top:1rem;">Then open your <code style="font-family:'Fira Code',monospace;">.env</code> file and configure it for production:</p>

    <pre>
<code>APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
DB_DATABASE=laravel
DB_USERNAME=laraveluser
DB_PASSWORD=securepassword</code></pre>

    <h2 style="font-size:1.6rem;font-weight:600;border-left:4px solid #2563eb;padding-left:8px;color:#111827;margin-top:2rem; margin-bottom: 30px;">Step 4: Configure Nginx</h2>
    <pre>
<code>server {
    listen 80;
    server_name yourdomain.com;
    root /var/www/your-laravel-app/public;

    index index.php index.html;
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}</code></pre>

    <p style="margin-top:1rem;">Then enable the config:</p>

    <pre>
<code>sudo ln -s /etc/nginx/sites-available/laravel.conf /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx</code></pre>

    <h2 style="font-size:1.6rem;font-weight:600;border-left:4px solid #2563eb;padding-left:8px;color:#111827;margin-top:2rem; margin-bottom: 30px;">Step 5: Secure with SSL</h2>
    <pre>
<code>sudo apt install certbot python3-certbot-nginx -y
sudo certbot --nginx -d yourdomain.com</code></pre>

    <hr style="margin:2rem 0;border:1px solid #e5e7eb;">
    <p style="margin-top:1rem;"><strong>Congratulations!</strong> 🎉 Your Laravel app is now live, secure, and production-ready.</p>
  </article>


                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            document.querySelectorAll('pre code').forEach((el) => {
            hljs.highlightElement(el);
            const button = document.createElement('button');
            button.innerText = 'Copy';
            button.classList.add('copy-btn');
            el.parentElement.style.position = 'relative';
            button.style.position = 'absolute';
            button.style.top = '12px';
            button.style.right = '12px';
            button.addEventListener('click', () => {
                navigator.clipboard.writeText(el.innerText);
                button.innerText = 'Copied!';
                setTimeout(() => (button.innerText = 'Copy'), 2000);
            });
            el.parentElement.appendChild(button);
            });
        </script>
    @endpush
</x-guest-layout>