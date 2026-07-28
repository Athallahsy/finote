<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>Finote — Personal Finance Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=IBM+Plex+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root{
            --bg:#FAF8F4;
            --surface:#FFFFFF;
            --ink:#14140F;
            --ink-soft:rgba(20,20,15,0.62);
            --ink-faint:rgba(20,20,15,0.4);
            --line:rgba(20,20,15,0.1);
            --line-soft:rgba(20,20,15,0.06);
            --accent:#F59E0B;
            --accent-ink:#0F172A;
            --accent-tint:rgba(245,158,11,0.1);
            --radius:14px;
        }
        [data-theme="dark"]{
            --bg:#0F0F0D;
            --surface:#171713;
            --ink:#F8FAFC;
            --ink-soft:rgba(248,250,252,0.62);
            --ink-faint:rgba(248,250,252,0.4);
            --line:rgba(248,250,252,0.12);
            --line-soft:rgba(248,250,252,0.07);
            --accent:#F5B93F;
            --accent-ink:#0F172A;
            --accent-tint:rgba(245,185,63,0.12);
        }
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        html{scroll-behavior:smooth}
        body{
            background:var(--bg);color:var(--ink);
            font-family:'IBM Plex Sans',sans-serif;
            -webkit-font-smoothing:antialiased;
            transition:background-color .35s ease,color .35s ease;
        }
        .serif{font-family:'Fraunces',serif}
        a{color:inherit}
        .wrap{max-width:1100px;margin:0 auto;padding:0 24px}

        /* subtle backdrop */
        .field{position:fixed;inset:0;z-index:0;pointer-events:none;overflow:hidden}
        .field::before{
            content:'';position:absolute;top:-15%;right:-10%;width:640px;height:640px;
            background:radial-gradient(circle,var(--accent-tint),transparent 68%);
            filter:blur(10px);
        }

        /* NAV — floating pill, centered links, logo mark */
        header{position:fixed;top:0;left:0;right:0;z-index:100;padding:18px 24px 0}
        nav{
            max-width:820px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;
            padding:10px 10px 10px 18px;border-radius:100px;
            background:color-mix(in srgb, var(--surface) 82%, transparent);
            border:1px solid var(--line);backdrop-filter:blur(16px) saturate(160%);
            box-shadow:0 10px 30px -14px rgba(20,20,15,0.18);
        }
        [data-theme="dark"] nav{box-shadow:0 10px 30px -14px rgba(0,0,0,0.5)}
        .logo{display:flex;align-items:center;gap:8px;font-family:'Fraunces',serif;font-weight:600;font-size:1.08rem;letter-spacing:-.02em;text-decoration:none;color:var(--ink)}
        .logo-mark{width:26px;height:26px;border-radius:8px;background:var(--ink);color:var(--bg);display:grid;place-items:center;font-family:'Fraunces',serif;font-size:.85rem;font-weight:600;flex-shrink:0}
        [data-theme="dark"] .logo-mark{background:var(--accent);color:var(--accent-ink)}
        .nav-links{display:flex;gap:4px;align-items:center;position:relative}
        .nav-links a{font-size:.85rem;color:var(--ink-soft);text-decoration:none;transition:color .2s,background .2s;padding:7px 14px;border-radius:100px}
        .nav-links a:hover{color:var(--ink);background:var(--line-soft)}
        .nav-right{display:flex;align-items:center;gap:6px}
        .icon-btn{width:34px;height:34px;border-radius:100px;border:none;background:transparent;color:var(--ink-soft);display:grid;place-items:center;cursor:pointer;transition:color .2s,background .2s}
        .icon-btn:hover{color:var(--ink);background:var(--line-soft)}
        .btn{
            font-size:.9rem;font-weight:500;text-decoration:none;padding:10px 18px;border-radius:10px;
            transition:opacity .2s,transform .2s;cursor:pointer;display:inline-flex;align-items:center;gap:6px;
        }
        .btn-text{color:var(--ink-soft)}
        .btn-text:hover{color:var(--ink)}
        .btn-primary{background:var(--ink);color:var(--bg)}
        .btn-primary:hover{opacity:.85;transform:translateY(-1px)}
        [data-theme="dark"] .btn-primary{background:var(--accent);color:var(--accent-ink)}

        /* HERO */
        .hero{position:relative;z-index:1;padding:120px 24px 70px;text-align:center}
        .eyebrow{font-size:.78rem;letter-spacing:.08em;text-transform:uppercase;color:var(--ink-faint);font-weight:500;margin-bottom:22px}
        h1.headline{
            font-family:'Fraunces',serif;font-weight:500;
            font-size:clamp(2.6rem,6vw,4.4rem);line-height:1.05;letter-spacing:-.02em;
            max-width:780px;margin:0 auto 24px;
        }
        h1.headline .accent-word{color:var(--accent);font-style:italic}
        .hero-sub{max-width:500px;margin:0 auto 36px;font-size:1.05rem;line-height:1.6;color:var(--ink-soft)}
        .hero-cta{display:flex;gap:14px;justify-content:center;flex-wrap:wrap;margin-bottom:64px}

        /* simple balance card mockup */
        .mock{
            max-width:420px;margin:0 auto;background:var(--surface);border:1px solid var(--line);
            border-radius:20px;padding:28px;text-align:left;box-shadow:0 20px 60px -20px rgba(20,20,15,0.15);
        }
        [data-theme="dark"] .mock{box-shadow:0 20px 60px -20px rgba(0,0,0,0.5)}
        .mock-row{display:flex;justify-content:space-between;align-items:center}
        .mock-label{font-size:.78rem;color:var(--ink-faint);text-transform:uppercase;letter-spacing:.06em}
        .mock-balance{font-family:'Fraunces',serif;font-size:2.1rem;margin:6px 0 2px;letter-spacing:-.01em}
        .mock-delta{font-size:.82rem;color:#3D9A5C;display:inline-flex;align-items:center;gap:4px}
        .mock-divider{height:1px;background:var(--line-soft);margin:22px 0}
        .mock-list{display:flex;flex-direction:column;gap:14px}
        .mock-item{display:flex;align-items:center;gap:12px}
        .mock-icon{width:36px;height:36px;border-radius:10px;background:var(--accent-tint);color:var(--accent);display:grid;place-items:center;flex-shrink:0}
        .mock-item-text{flex:1;text-align:left}
        .mock-item-title{font-size:.87rem;font-weight:500}
        .mock-item-sub{font-size:.76rem;color:var(--ink-faint)}
        .mock-amount{font-size:.87rem;font-weight:500}

        /* TRUST STRIP */
        .trust{position:relative;z-index:1;padding:36px 24px;border-top:1px solid var(--line-soft);border-bottom:1px solid var(--line-soft)}
        .trust-row{display:flex;justify-content:center;align-items:center;gap:56px;flex-wrap:wrap;max-width:900px;margin:0 auto}
        .trust-item{text-align:center}
        .trust-num{font-family:'Fraunces',serif;font-size:1.6rem;letter-spacing:-.01em}
        .trust-num .accent{color:var(--accent)}
        .trust-label{font-size:.78rem;color:var(--ink-faint);margin-top:2px}

        /* FEATURES */
        .features{position:relative;z-index:1;padding:110px 24px;max-width:1000px;margin:0 auto}
        .features-head{text-align:center;max-width:520px;margin:0 auto 64px}
        .features-head .eyebrow{margin-bottom:14px}
        .features-head h2{font-family:'Fraunces',serif;font-weight:500;font-size:clamp(1.8rem,3.4vw,2.4rem);letter-spacing:-.02em;line-height:1.2}
        .feature-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1px;background:var(--line-soft);border:1px solid var(--line-soft);border-radius:18px;overflow:hidden}
        .feature-card{background:var(--surface);padding:36px 30px;transition:background .2s}
        .feature-card:hover{background:var(--accent-tint)}
        .feature-icon{width:42px;height:42px;border-radius:11px;background:var(--accent-tint);color:var(--accent);display:grid;place-items:center;margin-bottom:20px}
        .feature-card h3{font-size:1.02rem;font-weight:600;margin-bottom:8px;letter-spacing:-.01em}
        .feature-card p{font-size:.87rem;color:var(--ink-soft);line-height:1.6}

        /* CTA */
        .cta{position:relative;z-index:1;text-align:center;padding:90px 24px 130px}
        .cta h2{font-family:'Fraunces',serif;font-weight:500;font-size:clamp(2rem,4.4vw,3.1rem);letter-spacing:-.02em;line-height:1.1;margin-bottom:20px}
        .cta p{color:var(--ink-soft);margin-bottom:34px;font-size:1rem}

        footer{position:relative;z-index:1;border-top:1px solid var(--line-soft)}
        .foot-row{display:flex;justify-content:space-between;align-items:center;padding:26px 24px;max-width:1100px;margin:0 auto;flex-wrap:wrap;gap:12px}
        .foot-row p{font-size:.82rem;color:var(--ink-faint)}

        .reveal{opacity:0;transform:translateY(16px);transition:opacity .6s ease,transform .6s ease}
        .reveal.active{opacity:1;transform:translateY(0)}

        @media(max-width:820px){
            .nav-links{display:none}
            .feature-grid{grid-template-columns:1fr}
            .trust-row{gap:32px}
        }
    </style>
</head>
<body>
    <div class="field"></div>

    <header>
        <nav>
            <a href="#" class="logo">
                <span class="logo-mark">F</span>
                Finote
            </a>
            <div class="nav-links">
                <a href="#features">Features</a>
                <a href="{{ url('/admin/login') }}">Dashboard</a>
            </div>
            <div class="nav-right">
                <button class="icon-btn" id="theme-switcher" aria-label="Toggle theme">
                    <i data-lucide="moon" style="width:16px;height:16px"></i>
                </button>
                <a href="{{ url('/register') }}" class="btn btn-text" style="padding:8px 14px">Register</a>
                <a href="{{ url('/admin/login') }}" class="btn btn-primary" style="padding:8px 16px">
                    Sign in <i data-lucide="arrow-up-right" style="width:13px;height:13px"></i>
                </a>
            </div>
        </nav>
    </header>

    <section class="hero">
        <div class="wrap">
            <p class="eyebrow reveal">Personal Finance Management</p>
            <h1 class="headline reveal" style="transition-delay:.05s">
                Track income & expenses,<br><span class="accent-word">effortlessly</span>.
            </h1>
            <p class="hero-sub reveal" style="transition-delay:.1s">
                Finote gives you a clear, distraction-free view of your money. Manage transactions, organize categories, export PDF reports, and sync seamlessly with mobile.
            </p>
            <div class="hero-cta reveal" style="transition-delay:.15s">
                <a href="{{ url('/register') }}" class="btn btn-primary" style="padding:12px 24px">
                    Get Started Free <i data-lucide="arrow-up-right" style="width:15px;height:15px"></i>
                </a>
                <a href="#features" class="btn btn-text" style="border:1px solid var(--line)">
                    Explore Features
                </a>
            </div>

            <div class="mock reveal" style="transition-delay:.25s">
                <div class="mock-row">
                    <div>
                        <div class="mock-label">Total Balance</div>
                        <div class="mock-balance">Rp 18.500.000</div>
                        <span class="mock-delta"><i data-lucide="trending-up" style="width:13px;height:13px"></i> Active tracking</span>
                    </div>
                    <div class="mock-icon"><i data-lucide="wallet" style="width:17px;height:17px"></i></div>
                </div>
                <div class="mock-divider"></div>
                <div class="mock-list">
                    <div class="mock-item">
                        <div class="mock-icon"><i data-lucide="arrow-down-left" style="width:16px;height:16px"></i></div>
                        <div class="mock-item-text">
                            <div class="mock-item-title">Gaji Bulanan</div>
                            <div class="mock-item-sub">Kategori: Income</div>
                        </div>
                        <div class="mock-amount" style="color:#3D9A5C">+Rp 7.500.000</div>
                    </div>
                    <div class="mock-item">
                        <div class="mock-icon"><i data-lucide="arrow-up-right" style="width:16px;height:16px"></i></div>
                        <div class="mock-item-text">
                            <div class="mock-item-title">Makanan & Minuman</div>
                            <div class="mock-item-sub">Kategori: Expense</div>
                        </div>
                        <div class="mock-amount">-$150.000</div>
                    </div>
                    <div class="mock-item">
                        <div class="mock-icon"><i data-lucide="arrow-up-right" style="width:16px;height:16px"></i></div>
                        <div class="mock-item-text">
                            <div class="mock-item-title">Tagihan Listrik</div>
                            <div class="mock-item-sub">Kategori: Expense</div>
                        </div>
                        <div class="mock-amount">-$450.000</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="trust">
        <div class="trust-row">
            <div class="trust-item reveal"><div class="trust-num"><span class="accent">100</span>%</div><div class="trust-label">User Data Isolated</div></div>
            <div class="trust-item reveal" style="transition-delay:.05s"><div class="trust-num"><span class="accent">REST</span> API</div><div class="trust-label">Flutter Mobile Ready</div></div>
            <div class="trust-item reveal" style="transition-delay:.1s"><div class="trust-num"><span class="accent">PDF</span> Export</div><div class="trust-label">Instant Reports</div></div>
        </div>
    </section>

    <section class="features" id="features">
        <div class="features-head">
            <p class="eyebrow reveal">What Finote Offers</p>
            <h2 class="reveal" style="transition-delay:.05s">Simple tools for complete financial control.</h2>
        </div>
        <div class="feature-grid reveal" style="transition-delay:.1s">
            <div class="feature-card">
                <div class="feature-icon"><i data-lucide="bar-chart-2" style="width:20px;height:20px"></i></div>
                <h3>Visual Analytics</h3>
                <p>Interactive Filament dashboard charts for monthly income vs expense breakdowns and category stats.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i data-lucide="file-text" style="width:20px;height:20px"></i></div>
                <h3>PDF Export</h3>
                <p>Generate and download clean, printable PDF reports of all your transactions with one click.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i data-lucide="folder-tree" style="width:20px;height:20px"></i></div>
                <h3>Custom Categories</h3>
                <p>Organize your transactions effortlessly with customizable income and expense categories.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i data-lucide="smartphone" style="width:20px;height:20px"></i></div>
                <h3>Mobile REST API</h3>
                <p>Full-featured REST API with Laravel Sanctum authentication, ready for Flutter mobile integration.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i data-lucide="shield-check" style="width:20px;height:20px"></i></div>
                <h3>Strict Data Isolation</h3>
                <p>Every transaction and category is securely scoped to your user account for maximum privacy.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i data-lucide="layout-dashboard" style="width:20px;height:20px"></i></div>
                <h3>Filament Admin Panel</h3>
                <p>Manage users, categories, and transactions with a fast, modern Filament 3 web administration panel.</p>
            </div>
        </div>
    </section>

    <section class="cta">
        <div class="wrap">
            <h2 class="reveal">Ready to take control of<br>your personal finances?</h2>
            <p class="reveal" style="transition-delay:.05s">Start tracking your income and expenses with Finote today.</p>
            <a href="{{ url('/register') }}" class="btn btn-primary reveal" style="transition-delay:.1s;padding:13px 28px;font-size:.95rem">
                Get Started Free <i data-lucide="arrow-up-right" style="width:15px;height:15px"></i>
            </a>
        </div>
    </section>

    <footer>
        <div class="foot-row">
            <a href="#" class="logo" style="font-size:1.05rem">Finote<em>.</em></a>
            <p>© {{ date('Y') }} Finote. All rights reserved.</p>
        </div>
    </footer>

    <script>
        lucide.createIcons();

        const themeBtn = document.getElementById('theme-switcher');
        const html = document.documentElement;
        themeBtn.addEventListener('click', () => {
            const next = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', next);
            themeBtn.innerHTML = next === 'dark'
                ? '<i data-lucide="sun" style="width:16px;height:16px"></i>'
                : '<i data-lucide="moon" style="width:16px;height:16px"></i>';
            lucide.createIcons();
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting){ entry.target.classList.add('active'); observer.unobserve(entry.target); }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>
</body>
</html>
