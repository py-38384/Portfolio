<header>
    <div class="logo">
        <a href="/">It's Pial</a>
    </div>
    <nav>
        <ul>
            <li><a href="/" style="color: {{ request()->route()->getName() == 'home'? 'var(--active-text-color)' : 'var(--primary-text-color)'}}" class="link">Home</a></li>
            <li><a href="{{ route('portfolios') }}" style="color: {{ request()->route()->getName() == 'portfolios'? 'var(--active-text-color)' : 'var(--primary-text-color)'}}" class="link">Portfolio</a></li>
            <li><a href="{{ route('about') }}" style="color: {{ request()->route()->getName() == 'about'? 'var(--active-text-color)' : 'var(--primary-text-color)'}}" class="link">About</a></li>
            <li><a href="{{ route('blogs') }}" style="color: {{ request()->route()->getName() == 'blogs'? 'var(--active-text-color)' : 'var(--primary-text-color)'}}" class="link">Blog</a></li>
            <li><a href="{{ route('contact') }}" style="color: {{ request()->route()->getName() == 'contact'? 'var(--active-text-color)' : 'var(--primary-text-color)'}}" class="link">Contact me</a></li>
        </ul>
    </nav>
    <div class="menu">
        <i class="fa-solid fa-bars"></i>
    </div>
</header>
<div class="responsive-nav-list">
    <div class="close-btn-container">
        <div class="logo">
            <a href="/">It's Pial</a>
        </div>
        <button class="close-nav-btn"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <ul>
        <li><a href="/" style="color: {{ request()->route()->getName() == 'home'? 'var(--active-text-color)' : 'var(--primary-text-color)'}}" class="link">Home</a></li>
        <li><a href="{{ route('portfolios') }}" style="color: {{ request()->route()->getName() == 'portfolios'? 'var(--active-text-color)' : 'var(--primary-text-color)'}}" class="link">Portfolio</a></li>
        <li><a href="{{ route('about') }}" style="color: {{ request()->route()->getName() == 'about'? 'var(--active-text-color)' : 'var(--primary-text-color)'}}" class="link">About</a></li>
        <li><a href="{{ route('blogs') }}" style="color: {{ request()->route()->getName() == 'blogs'? 'var(--active-text-color)' : 'var(--primary-text-color)'}}" class="link">Blog</a></li>
        <li><a href="{{ route('contact') }}" style="color: {{ request()->route()->getName() == 'contact'? 'var(--active-text-color)' : 'var(--primary-text-color)'}}" class="link">Contact me</a></li>
    </ul>
</div>
<script>
    const menu = document.querySelector('.menu');
    menu.addEventListener('click', (e) => {
        const res_nav_links = document.querySelector('.responsive-nav-list');
        res_nav_links.style.display = 'block';
    })
    const closeNavBtn = document.querySelector('.close-nav-btn');
    closeNavBtn.addEventListener('click', (e) => {
        const res_nav_links = document.querySelector('.responsive-nav-list');
        res_nav_links.style.display = 'none';
    })
</script>