<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'GPPIK Maranatha Antan' }}</title>
    @if(site_setting('favicon'))
    <link rel="icon" href="{{ asset('storage/' . site_setting('favicon')) }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('storage/' . site_setting('favicon')) }}" type="image/x-icon">
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <style>
        :root {--blue-1:#003a8c;--blue-2:#0066cc;--muted:#6b7280;--dark:#0b132b;--gray-light:#f0f4ff;}
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,"Helvetica Neue",Arial;background:#ffffff;color:#102a43;scroll-behavior: smooth;}
        .navbar{background:linear-gradient(90deg,var(--blue-1),var(--blue-2));color:#fff;display:flex;justify-content:space-between;align-items:center;padding:16px 48px;position:sticky;top:0;z-index:50;overflow:visible}
        .navbar-left{display:flex;align-items:center;}
        .logo{font-weight:700;font-size:20px}
        .menu {display:flex;gap:12px;transition:transform .4s ease, opacity .4s ease;}
        .menu a{
            color:#fff;
            text-decoration:none;
            font-weight:600;
            padding:6px 16px;
            border-radius:6px;
            transition:all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position:relative;
            overflow:hidden;
            background:transparent;
        }
        .menu a::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.5s ease, height 0.5s ease;
            z-index: 1;
        }
        .menu a:hover::before {
            width: 300px;
            height: 300px;
        }
        .menu a span {
            position: relative;
            z-index: 2;
        }
        .menu a:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .menu a.active-menu {
            background: rgba(255,255,255,0.15);
        }
        .menu a:active {
            transform: translateY(1px);
        }
        body {
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1 0 auto;
        }
        
        /* Dropdown Menu Styles */
        .dropdown{position:relative;display:inline-block}
        .dropdown > a{display:flex;align-items:center;gap:4px}
        .dropdown-content{display:none;position:absolute;top:calc(100% + 8px);left:50%;transform:translateX(-50%);background:#0066cc;min-width:140px;box-shadow:0 8px 16px rgba(0,0,0,0.3);border-radius:8px;overflow:hidden;z-index:1000}
        .dropdown-content::before{content:'';position:absolute;top:-6px;left:50%;transform:translateX(-50%);width:0;height:0;border-left:8px solid transparent;border-right:8px solid transparent;border-bottom:8px solid #0066cc}
        .dropdown-content a{display:flex;align-items:center;justify-content:center;gap:8px;padding:12px 20px;color:#fff;text-decoration:none;font-weight:500;transition:background 0.2s}
        .dropdown-content a:hover{background:rgba(255,255,255,0.15)}
        .dropdown:hover .dropdown-content{display:block;position:absolute}
        .dropdown-arrow{font-size:12px;transition:transform 0.2s}
        .dropdown:hover .dropdown-arrow{transform:rotate(180deg)}
        
        .menu-toggle {display:none;font-size:26px;cursor:pointer;color:#fff;}
        @media(max-width:768px){
            .navbar {
                padding: 12px 20px;
            }
            .menu {
                flex-direction: column;
                position: fixed;
                top: 0;
                left: -100%;
                background: linear-gradient(90deg,var(--blue-1),var(--blue-2));
                width: 280px;
                height: 100%;
                padding-top: 70px;
                opacity: 0;
                overflow-y: auto;
                box-shadow: 5px 0 15px rgba(0,0,0,0.1);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .menu.show {
                left: 0;
                opacity: 1;
            }
            .menu a {
                display: flex;
                padding: 15px 24px;
                text-align: left;
                border-radius: 0;
                margin: 0;
                border-bottom: 1px solid rgba(255,255,255,0.05);
            }
            .menu a:active {
                background: rgba(255,255,255,0.1);
            }
            .menu-toggle {
                display: block;
                z-index: 100;
            }
            .dropdown {
                display: block;
                width: 100%;
            }
            .dropdown > a {
                padding: 15px 24px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid rgba(255,255,255,0.05);
            }
            .dropdown-content {
                position: static;
                box-shadow: none;
                background: rgba(0,0,0,0.1);
                display: none;
                transform: none;
                padding: 0;
                width: 160px;
                margin-left: auto;
                margin-right: 20px;
                border-radius: 4px;
            }
            .dropdown.active .dropdown-content {
                display: block;
            }
            .dropdown-content::before {
                display: none;
            }
            .dropdown-content a {
                padding: 8px 16px;
                font-size: 14px;
                background: transparent;
                display: flex;
                align-items: center;
                gap: 10px;
            }
            .dropdown-content a i {
                width: 16px;
                text-align: center;
                font-size: 14px;
                opacity: 0.9;
            }
            .dropdown-content a span {
                flex: 1;
            }
            .dropdown-content a:hover {
                background: rgba(255,255,255,0.1);
            }
            .dropdown > a .dropdown-arrow {
                transition: transform 0.3s ease;
            }
            .dropdown.active > a .dropdown-arrow {
                transform: rotate(180deg);
            }
            body.menu-open {
                overflow: hidden;
            }
        }
        .page-content { 
            max-width: 1180px; 
            margin: auto; 
            padding: 20px 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .hero-img{
            width:100%;
            border-radius:10px;
            box-shadow:0 8px 30px rgba(13,38,76,0.08);
            overflow:hidden;
            margin-bottom: 20px;
        }
        .hero-img img{
            width:100%;
            height:380px;
            object-fit:cover;
            display:block
        }
        .box{
            background:#fbfcfe;
            border:1px solid #eef3fb;
            padding:20px;
            border-radius:10px;
            margin-bottom: 20px;
        }
        .footer-section{
            background:linear-gradient(180deg,#0b132b,#1c2541);
            color:#fff;
            padding:15px;
            margin-top: 8px;
            width:100%;
            overflow:hidden;
            position: relative;
            z-index: 1;
            flex-shrink: 0;
        }
        .footer-content{
            max-width:1180px;
            margin:auto;
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
            gap:10px;
            position:relative
        }
        
        /* Content spacing adjustments */
        .content-section {
            margin-bottom: 20px;
        }
        .content-section:last-child {
            margin-bottom: 0;
        }
        
        /* Heading spacing */
        h1, h2, h3, h4, h5, h6 {
            margin-bottom: 15px;
        }
        
        /* Paragraph spacing */
        p {
            margin-bottom: 12px;
        }
        p:last-child {
            margin-bottom: 0;
        }
        
        /* List spacing */
        ul, ol {
            margin: 12px 0;
        }
        li {
            margin-bottom: 8px;
        }
        li:last-child {
            margin-bottom: 0;
        }
    </style>
    @stack('head')
    @php($viteManifest = public_path('build/manifest.json'))
    @if (file_exists($viteManifest))
        @vite(['resources/css/app.css','resources/js/app.js'])
    @endif
    <script>
        function toggleMenu() {
            const navMenu = document.getElementById('navMenu');
            const body = document.body;
            
            navMenu.classList.toggle('show');
            body.classList.toggle('menu-open');
            
            // Close all dropdowns when closing menu
            if (!navMenu.classList.contains('show')) {
                document.querySelectorAll('.dropdown').forEach(d => {
                    d.classList.remove('active');
                });
            }
        }
        
        function closeMenu() {
            const navMenu = document.getElementById('navMenu');
            const body = document.body;
            
            if (navMenu.classList.contains('show')) {
                navMenu.classList.remove('show');
                body.classList.remove('menu-open');
                
                // Close all dropdowns
                document.querySelectorAll('.dropdown').forEach(d => {
                    d.classList.remove('active');
                });
            }
        }
        
        // Toggle dropdown di mobile
        document.addEventListener('DOMContentLoaded', function() {
            const dropdowns = document.querySelectorAll('.dropdown > a');
            dropdowns.forEach(dropdown => {
                dropdown.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768) {
                        e.preventDefault();
                        const parentDropdown = this.parentElement;
                        
                        // Tutup semua dropdown lain
                        document.querySelectorAll('.dropdown').forEach(d => {
                            if (d !== parentDropdown) {
                                d.classList.remove('active');
                            }
                        });
                        
                        // Toggle dropdown yang diklik
                        parentDropdown.classList.toggle('active');
                    }
                });
            });

            // Tutup dropdown ketika klik di luar
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown').forEach(d => {
                        d.classList.remove('active');
                    });
                }
            });

            // Tutup dropdown ketika menu mobile ditutup
            const menuToggle = document.querySelector('.menu-toggle');
            menuToggle.addEventListener('click', function() {
                document.querySelectorAll('.dropdown').forEach(d => {
                    d.classList.remove('active');
                });
            });
        });
    </script>
    @stack('scripts-head')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script>window.csrfToken = '{{ csrf_token() }}';</script>
    
    <style>
    #particles-js {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        pointer-events: none;
        background: linear-gradient(135deg, #f0f7ff 0%, #ffffff 100%);
    }
    
    main {
        position: relative;
        z-index: 1;
        background: rgba(255,255,255,0.85);
    }

    .dove-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -2;
        pointer-events: none;
        overflow: hidden;
    }

    .dove {
        position: absolute;
        width: 30px;
        height: 30px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' fill='%230066cc' opacity='0.6'%3E%3Cpath d='M380.8 386.2c36.6-36.6 57.2-86.1 57.2-137.8 0-107.7-87.3-195-195-195S48 140.7 48 248.4c0 51.7 20.6 101.2 57.2 137.8 3.1 3.1 8.2 3.1 11.3 0l11.3-11.3c3.1-3.1 3.1-8.2 0-11.3-30.5-30.5-47.7-71.7-47.7-115.1 0-89.8 72.9-162.7 162.7-162.7s162.7 72.9 162.7 162.7c0 43.4-17.2 84.7-47.7 115.1-3.1 3.1-3.1 8.2 0 11.3l11.3 11.3c3.1 3.2 8.2 3.2 11.3 0z'/%3E%3C/svg%3E");
        background-size: contain;
        background-repeat: no-repeat;
        opacity: 0;
        animation: flyDove 15s linear infinite;
    }

    @keyframes flyDove {
        0% {
            transform: translate(-100px, 100vh) rotate(30deg) scale(1);
            opacity: 0;
        }
        10% {
            opacity: 0.6;
        }
        45% {
            transform: translate(40vw, 40vh) rotate(-10deg) scale(1.2);
        }
        75% {
            transform: translate(70vw, 60vh) rotate(20deg) scale(0.8);
        }
        90% {
            opacity: 0.6;
        }
        100% {
            transform: translate(120vw, -100px) rotate(-20deg) scale(1);
            opacity: 0;
        }
    }

    /* Elegant pattern overlay */
    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: 
            linear-gradient(90deg, #e6f0fd 2px, transparent 2px) 0 0,
            linear-gradient(0deg, #e6f0fd 2px, transparent 2px) 0 0;
        background-size: 50px 50px;
        opacity: 0.5;
        z-index: -3;
        pointer-events: none;
    }

    /* Diagonal stripes */
    body::after {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: repeating-linear-gradient(
            45deg,
            #f0f7ff 0px,
            #f0f7ff 2px,
            transparent 2px,
            transparent 10px
        );
        opacity: 0.3;
        z-index: -4;
        pointer-events: none;
    }
    </style>
</head>
<body>
    <div id="particles-js"></div>
    <div class="dove-container">
        <div class="dove" style="animation-delay: 0s;"></div>
        <div class="dove" style="animation-delay: 5s;"></div>
        <div class="dove" style="animation-delay: 10s;"></div>
    </div>
    
    <nav class="navbar">
        <div class="navbar-left">
            <div class="logo">GPPIK Maranatha Antan</div>
        </div>
        <div class="menu-toggle" onclick="toggleMenu()"><i class="fas fa-bars"></i></div>
        <div class="menu" id="navMenu">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active-menu' : '' }}">
                <span>Beranda</span>
            </a>
            <a href="{{ route('nyanyian.index') }}" class="{{ request()->routeIs('nyanyian.*') ? 'active-menu' : '' }}">
                <span>NHYK</span>
            </a>
            
            <!-- Dropdown Galeri -->
            <div class="dropdown">
                <a href="#" class="{{ request()->routeIs('galeri') || request()->routeIs('video') ? 'active-menu' : '' }}">
                    <span>Galeri <i class="fas fa-chevron-down dropdown-arrow"></i></span>
                </a>
                <div class="dropdown-content">
                    <a href="{{ route('galeri') }}">
                        <i class="fas fa-image"></i>
                        <span>Foto</span>
                    </a>
                    <a href="{{ route('video') }}">
                        <i class="fas fa-video"></i>
                        <span>Video</span>
                    </a>
                </div>
            </div>
            
            <a href="{{ route('warta') }}" class="{{ request()->routeIs('warta*') ? 'active-menu' : '' }}">
                <span>Warta</span>
            </a>
            <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active-menu' : '' }}">
                <span>Kontak</span>
            </a>
            <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active-menu' : '' }}">
                <span>Login</span>
            </a>
        </div>
    </nav>

    <main style="min-height: calc(100vh - 70px); overflow-x: hidden;">
        @yield('content')
    </main>

    <section class="footer-section" style="position: relative;">
        <div class="footer-content">
            <div>
                <h3>Alamat</h3>
                <p>{{ site_setting('alamat_gereja', 'Antan Rayan, Kec. Ngabang, Kabupaten Landak, Kalimantan Barat 79356') }}</p>
                @if(site_setting('telepon_kantor'))
                <p style="margin-top:8px"><i class="fas fa-phone"></i> {{ site_setting('telepon_kantor') }}</p>
                @endif
                @if(site_setting('email_kantor'))
                <p style="margin-top:4px"><i class="fas fa-envelope"></i> {{ site_setting('email_kantor') }}</p>
                @endif
            </div>
            <div><h3>Navigation</h3><ul>
                <li><a href="{{ route('home') }}" style="text-decoration:none;color:#e0e6f1">Beranda</a></li>
                <li><a href="{{ route('nyanyian.index') }}" style="text-decoration:none;color:#e0e6f1">NHYK</a></li>
                <li><a href="{{ route('galeri') }}" style="text-decoration:none;color:#e0e6f1">Galeri Foto</a></li>
                <li><a href="{{ route('video') }}" style="text-decoration:none;color:#e0e6f1">Video</a></li>
                <li><a href="{{ route('kontak') }}" style="text-decoration:none;color:#e0e6f1">Kontak</a></li>
            </ul></div>
            <div>
                <h3>Media Sosial</h3>
                <div style="display:flex;gap:12px;margin-top:12px">
                    @if(site_setting('facebook_url'))
                    <a href="{{ site_setting('facebook_url') }}" target="_blank" style="color:#1877f2;font-size:24px" title="Facebook">
                        <i class="fab fa-facebook"></i>
                    </a>
                    @endif
                    @if(site_setting('instagram_url'))
                    <a href="{{ site_setting('instagram_url') }}" target="_blank" style="color:#e4405f;font-size:24px" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    @endif
                    @if(site_setting('youtube_url'))
                    <a href="{{ site_setting('youtube_url') }}" target="_blank" style="color:#ff0000;font-size:24px" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    @endif
                </div>
                
                @if(site_setting('show_bible_verses', '1') == '1')
                <div style="margin-top:24px">
                    <h3>{{ site_setting('ayat_alkitab_1_ref', 'Filipi 4:13') }}</h3>
                    <p>"{{ site_setting('ayat_alkitab_1_text', 'Segala perkara dapat kutanggung di dalam Dia yang memberi kekuatan kepadaku.') }}"</p>
                </div>
            </div>
            <div>
                <h3>{{ site_setting('ayat_alkitab_2_ref', 'Mazmur 133:1') }}</h3>
                <p>"{{ site_setting('ayat_alkitab_2_text', 'Sungguh, alangkah baiknya dan indahnya, apabila saudara-saudara diam bersama dengan rukun.') }}"</p>
                @endif
            </div>
        </div>
        <div style="max-width:1180px; margin: 30px auto 0; text-align: center; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px;">
            <p>{{ site_setting('copyright_text', '© ' . date('Y') . ' GPPIK Maranatha Antan. All rights reserved.') }}</p>
        </div>
    </section>
    @stack('body-end')
    
    <script>
        particlesJS('particles-js', {
            particles: {
                number: {
                    value: 40,
                    density: {
                        enable: true,
                        value_area: 800
                    }
                },
                color: {
                    value: ['#0066cc', '#003a8c']
                },
                shape: {
                    type: ["circle", "triangle"],
                    stroke: {
                        width: 1,
                        color: "#0066cc"
                    },
                    polygon: {
                        nb_sides: 5
                    },
                    image: {
                        src: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' fill='%230066cc'%3E%3Cpath d='M380.8 386.2c36.6-36.6 57.2-86.1 57.2-137.8 0-107.7-87.3-195-195-195S48 140.7 48 248.4c0 51.7 20.6 101.2 57.2 137.8 3.1 3.1 8.2 3.1 11.3 0l11.3-11.3c3.1-3.1 3.1-8.2 0-11.3-30.5-30.5-47.7-71.7-47.7-115.1 0-89.8 72.9-162.7 162.7-162.7s162.7 72.9 162.7 162.7c0 43.4-17.2 84.7-47.7 115.1-3.1 3.1-3.1 8.2 0 11.3l11.3 11.3c3.1 3.2 8.2 3.2 11.3 0z'/%3E%3C/svg%3E",
                        width: 100,
                        height: 100
                    }
                },
                opacity: {
                    value: 0.6,
                    random: true,
                    anim: {
                        enable: true,
                        speed: 0.5,
                        opacity_min: 0.3,
                        sync: false
                    }
                },
                size: {
                    value: 6,
                    random: true,
                    anim: {
                        enable: true,
                        speed: 0.5,
                        size_min: 3,
                        sync: false
                    }
                },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#0066cc',
                    opacity: 0.4,
                    width: 2
                },
                move: {
                    enable: true,
                    speed: 2,
                    direction: 'none',
                    random: true,
                    straight: false,
                    out_mode: 'out',
                    bounce: false,
                    attract: {
                        enable: true,
                        rotateX: 600,
                        rotateY: 1200
                    }
                }
            },
            interactivity: {
                detect_on: 'canvas',
                events: {
                    onhover: {
                        enable: true,
                        mode: 'bubble'
                    },
                    onclick: {
                        enable: true,
                        mode: 'repulse'
                    },
                    resize: true
                },
                modes: {
                    bubble: {
                        distance: 200,
                        size: 12,
                        duration: 2,
                        opacity: 0.8,
                        speed: 2
                    },
                    repulse: {
                        distance: 200,
                        duration: 0.4
                    }
                }
            },
            retina_detect: true
        });
    </script>
</body>
</html>
