<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Finote — Ultimate Experience</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --bg-base: #060608;
            --bg-surface: #0d0d10;
            --bg-card: #111116;
            --accent: #f5a524;
            --accent-dim: rgba(245,165,36,0.12);
            --accent-border: rgba(245,165,36,0.25);
            --text-main: #f0ede8;
            --text-muted: rgba(240,237,232,0.45);
            --text-sub: rgba(240,237,232,0.7);
            --border: rgba(255,255,255,0.06);
            --border-mid: rgba(255,255,255,0.1);
            --nav-bg: rgba(6,6,8,0.8);
            --grid-color: rgba(255,255,255,0.022);
            --line-color: rgba(255,255,255,0.06);
        }
        [data-theme="light"] {
            --bg-base: #faf9f7;
            --bg-surface: #ffffff;
            --bg-card: #f4f2ee;
            --accent: #e8920a;
            --accent-dim: rgba(232,146,10,0.1);
            --accent-border: rgba(232,146,10,0.3);
            --text-main: #18161a;
            --text-muted: rgba(24,22,26,0.45);
            --text-sub: rgba(24,22,26,0.7);
            --border: rgba(0,0,0,0.07);
            --border-mid: rgba(0,0,0,0.12);
            --nav-bg: rgba(250,249,247,0.85);
            --grid-color: rgba(0,0,0,0.028);
            --line-color: rgba(0,0,0,0.08);
        }
        ::view-transition-old(root),::view-transition-new(root){animation:none;mix-blend-mode:normal}
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        html{scroll-behavior:smooth}
        body{background:var(--bg-base);color:var(--text-main);font-family:'DM Sans',sans-serif;overflow-x:hidden;transition:background-color .4s,color .4s}

        /* GRID BG */
        .grid-bg{position:fixed;inset:0;background-image:linear-gradient(var(--grid-color) 1px,transparent 1px),linear-gradient(90deg,var(--grid-color) 1px,transparent 1px);background-size:60px 60px;pointer-events:none;z-index:0}
        .orb{position:fixed;border-radius:50%;filter:blur(120px);pointer-events:none;z-index:0;opacity:.45}
        .orb-1{width:600px;height:600px;background:radial-gradient(circle,rgba(245,165,36,.1),transparent 70%);top:-100px;left:-200px}
        .orb-2{width:500px;height:500px;background:radial-gradient(circle,rgba(255,107,53,.07),transparent 70%);bottom:200px;right:-100px}
        .noise{position:fixed;inset:0;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");opacity:.03;pointer-events:none;z-index:9999}

        /* NAVBAR */
        .navbar-wrap{position:fixed;top:20px;left:0;right:0;z-index:1000;padding:0 20px}
        .navbar-custom{max-width:1040px;margin:0 auto;background:var(--nav-bg);backdrop-filter:blur(24px) saturate(180%);border:1px solid var(--border);padding:10px 20px 10px 24px;border-radius:20px;display:flex;justify-content:space-between;align-items:center;box-shadow:0 8px 32px rgba(0,0,0,.2)}
        .nav-logo{font-family:'Syne',sans-serif;font-weight:800;font-size:1.4rem;color:var(--text-main);text-decoration:none;letter-spacing:-.5px}
        .nav-logo span{color:var(--accent)}
        .nav-links{display:flex;gap:4px;align-items:center}
        .nav-link-item{color:var(--text-muted);text-decoration:none;font-size:.875rem;font-weight:500;padding:6px 12px;border-radius:10px;transition:color .2s,background .2s}
        .nav-link-item:hover{color:var(--text-main);background:var(--border)}
        .nav-right{display:flex;gap:8px;align-items:center}
        .theme-btn{background:var(--bg-card);border:1px solid var(--border);color:var(--text-main);width:40px;height:40px;border-radius:12px;cursor:pointer;display:grid;place-items:center;transition:all .3s}
        .theme-btn:hover{border-color:var(--accent);color:var(--accent)}
        .btn-premium{background:var(--accent);color:#000;padding:10px 20px;border-radius:12px;font-weight:700;font-size:.875rem;text-decoration:none;transition:all .3s;display:inline-flex;align-items:center;gap:8px;letter-spacing:-.2px}
        .btn-premium:hover{opacity:.88;transform:translateY(-1px);box-shadow:0 8px 24px rgba(245,165,36,.25);color:#000}

        /* HERO */
        .hero-section{position:relative;z-index:1;padding-top:180px;padding-bottom:80px;text-align:center}
        .hero-badge{display:inline-flex;align-items:center;gap:8px;padding:6px 14px 6px 8px;background:var(--bg-card);border:1px solid var(--border);border-radius:100px;font-size:.8rem;font-weight:600;color:var(--text-sub);margin-bottom:2rem;letter-spacing:.02em}
        .badge-dot{width:22px;height:22px;background:var(--accent-dim);border-radius:50%;display:grid;place-items:center}
        .badge-dot::after{content:'';width:8px;height:8px;background:var(--accent);border-radius:50%;animation:pulse 2s infinite}
        @keyframes pulse{0%,100%{transform:scale(1);opacity:1}50%{transform:scale(1.3);opacity:.7}}
        .hero-title{font-family:'Syne',sans-serif;font-size:clamp(3.2rem,8vw,6.5rem);font-weight:800;letter-spacing:-4px;line-height:.92;margin-bottom:28px;color:var(--text-main)}
        .gradient-text{background:linear-gradient(135deg,#f5a524 0%,#ff6b35 60%,#f5a524 100%);background-size:200% auto;-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;animation:shine 4s linear infinite}
        @keyframes shine{0%{background-position:0% center}100%{background-position:200% center}}
        .hero-sub{max-width:500px;margin:0 auto 40px;font-size:1.1rem;color:var(--text-muted);line-height:1.65;font-weight:400}
        .hero-cta-group{display:flex;gap:12px;justify-content:center;align-items:center;flex-wrap:wrap}
        .btn-ghost{color:var(--text-sub);padding:10px 20px;border-radius:12px;font-weight:500;font-size:.875rem;text-decoration:none;border:1px solid var(--border);transition:all .3s;display:inline-flex;align-items:center;gap:8px;background:var(--bg-surface)}
        .btn-ghost:hover{border-color:var(--accent-border);color:var(--text-main)}

        /* STATS BAR */
        .stats-bar{position:relative;z-index:1;max-width:700px;margin:70px auto 0;display:flex;justify-content:center;border:1px solid var(--border);border-radius:20px;background:var(--bg-surface);overflow:hidden}
        .stat-item{flex:1;padding:24px 20px;text-align:center;border-right:1px solid var(--border)}
        .stat-item:last-child{border-right:none}
        .stat-number{font-family:'Syne',sans-serif;font-size:1.8rem;font-weight:800;color:var(--text-main);letter-spacing:-1px;display:block}
        .stat-number span{color:var(--accent)}
        .stat-label{font-size:.78rem;color:var(--text-muted);font-weight:500;margin-top:4px;display:block;letter-spacing:.02em}

        /* MARQUEE */
        .marquee-section{position:relative;z-index:1;overflow:hidden;padding:36px 0;border-top:1px solid var(--line-color);border-bottom:1px solid var(--line-color);margin:80px 0}
        .marquee-track{display:flex;gap:48px;animation:marquee 22s linear infinite;width:max-content}
        .marquee-item{display:flex;align-items:center;gap:12px;color:var(--text-muted);font-size:.875rem;font-weight:500;white-space:nowrap}
        .marquee-item i{color:var(--accent)}
        @keyframes marquee{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}

        /* FEATURES - ALTERNATING ROWS */
        .features-section{position:relative;z-index:1;max-width:1040px;margin:0 auto 100px;padding:0 24px}
        .features-header{margin-bottom:80px}
        .section-label{font-size:.78rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--accent);margin-bottom:12px;display:block}
        .section-title{font-family:'Syne',sans-serif;font-size:clamp(1.8rem,4vw,2.8rem);font-weight:800;letter-spacing:-2px;line-height:1.1}

        .feature-row{display:grid;grid-template-columns:1fr 1fr;gap:0;align-items:stretch;border-top:1px solid var(--line-color);min-height:280px}
        .feature-row:last-child{border-bottom:1px solid var(--line-color)}
        .feature-row.reverse .feature-text{order:2;border-left:1px solid var(--line-color);border-right:none}
        .feature-row.reverse .feature-visual{order:1;border-right:none}

        .feature-text{padding:52px 48px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid var(--line-color)}
        .feature-num{font-family:'Syne',sans-serif;font-size:.8rem;font-weight:800;color:var(--accent);letter-spacing:.1em;margin-bottom:20px;opacity:.7}
        .feature-title{font-family:'Syne',sans-serif;font-size:1.6rem;font-weight:800;letter-spacing:-1px;margin-bottom:14px;line-height:1.1}
        .feature-desc{color:var(--text-muted);font-size:.95rem;line-height:1.7;margin-bottom:24px}
        .feature-tags{display:flex;gap:8px;flex-wrap:wrap}
        .tag{font-size:.75rem;font-weight:600;padding:5px 12px;border-radius:100px;background:var(--accent-dim);color:var(--accent);border:1px solid var(--accent-border);letter-spacing:.02em}

        /* Feature visual area */
        .feature-visual{padding:52px 48px;display:flex;flex-direction:column;justify-content:center;align-items:center;gap:28px;position:relative;overflow:hidden}
        .fv-icon-wrap{width:64px;height:64px;background:var(--accent-dim);border:1px solid var(--accent-border);border-radius:20px;display:grid;place-items:center;color:var(--accent);flex-shrink:0}

        /* Mini chart bars */
        .fv-mini-chart{display:flex;align-items:flex-end;gap:8px;height:80px;width:100%;max-width:220px}
        .bar{flex:1;background:var(--border-mid);border-radius:6px 6px 0 0;transition:height .3s}
        .bar.accent{background:var(--accent)}

        /* Shield rings */
        .fv-shield-ring{position:relative;width:100px;height:100px;display:grid;place-items:center}
        .ring{position:absolute;border-radius:50%;border:1px solid var(--accent-border);animation:ringPulse 3s ease-in-out infinite}
        .r1{width:40px;height:40px;background:var(--accent-dim)}
        .r2{width:70px;height:70px;animation-delay:.5s}
        .r3{width:100px;height:100px;animation-delay:1s}
        @keyframes ringPulse{0%,100%{opacity:.3;transform:scale(1)}50%{opacity:.8;transform:scale(1.05)}}

        /* Currencies */
        .fv-currencies{display:flex;flex-wrap:wrap;gap:8px;justify-content:center;max-width:200px}
        .cur{font-family:'Syne',sans-serif;font-size:.75rem;font-weight:700;padding:6px 14px;border-radius:100px;background:var(--bg-card);border:1px solid var(--border);color:var(--text-muted);letter-spacing:.05em}
        .cur.accent{background:var(--accent-dim);border-color:var(--accent-border);color:var(--accent)}

        /* Rules */
        .fv-rules{display:flex;flex-direction:column;gap:10px;width:100%;max-width:240px}
        .rule-item{font-size:.78rem;color:var(--text-muted);padding:10px 14px;background:var(--bg-card);border:1px solid var(--border);border-radius:10px;font-family:monospace;line-height:1.4}
        .rule-item span{color:var(--accent);font-weight:700}

        /* FOOTER CTA */
        .footer-cta{position:relative;z-index:1;text-align:center;padding:100px 20px 120px;max-width:700px;margin:0 auto}
        .footer-cta h2{font-family:'Syne',sans-serif;font-size:clamp(2.5rem,6vw,4rem);font-weight:800;letter-spacing:-3px;line-height:1;margin-bottom:24px}
        .footer-cta p{color:var(--text-muted);margin-bottom:40px;font-size:1.05rem}

        /* FOOTER BAR */
        .footer-bar{position:relative;z-index:1;border-top:1px solid var(--line-color);padding:24px 40px;display:flex;justify-content:space-between;align-items:center;max-width:1040px;margin:0 auto}
        .footer-bar p{color:var(--text-muted);font-size:.83rem}

        /* REVEAL */
        .reveal{opacity:0;transform:translateY(20px);transition:opacity .7s cubic-bezier(.2,1,.2,1),transform .7s cubic-bezier(.2,1,.2,1)}
        .reveal.active{opacity:1;transform:translateY(0)}

        @media(max-width:768px){
            .feature-row,.feature-row.reverse{grid-template-columns:1fr}
            .feature-row.reverse .feature-text{order:0;border-left:none;border-top:1px solid var(--line-color)}
            .feature-visual{border-right:none!important;border-left:none!important;padding:32px 24px;min-height:180px}
            .feature-text{padding:36px 24px;border-right:none!important}
            .nav-links{display:none}
            .stats-bar{flex-direction:column}
            .stat-item{border-right:none;border-bottom:1px solid var(--border)}
            .stat-item:last-child{border-bottom:none}
            .hero-title{letter-spacing:-2px}
        }

        .badge-coming-soon {
    font-size: .68rem;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 100px;
    background: rgba(255,255,255,0.06);
    color: var(--text-muted);
    border: 1px solid var(--border-mid);
    letter-spacing: .05em;
    text-transform: uppercase;
    vertical-align: middle;
    margin-left: 8px;
    white-space: nowrap;
}
    </style>
</head>
<body>
    <div class="grid-bg"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="noise"></div>

    <!-- NAVBAR -->
    <div class="navbar-wrap">
        <nav class="navbar-custom">
            <a href="#" class="nav-logo">Finote<span>.</span></a>
            <div class="nav-links">
                <a href="#features" class="nav-link-item">Features</a>
                <a href="#" class="nav-link-item">Pricing</a>
                <a href="#" class="nav-link-item">About</a>
            </div>
            <div class="nav-right">
                <button class="theme-btn" id="theme-switcher" aria-label="Toggle theme">
                    <i data-lucide="sun" size="16"></i>
                </button>
                <a href="{{ url('/register') }}" class="btn-ghost d-none d-sm-inline-flex">
    Register
</a>
                <a href="{{ url('/admin/login') }}" class="btn-premium d-none d-sm-inline-flex">
                    Dashboard <i data-lucide="arrow-up-right" size="14"></i>
                </a>
            </div>
        </nav>
    </div>

    <!-- HERO -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-badge reveal">
                <div class="badge-dot"></div>
                Now in Public Beta
            </div>
            <h1 class="hero-title reveal" style="transition-delay:.1s">
                Master your<br>flow <span class="gradient-text">effortlessly.</span>
            </h1>
            <p class="hero-sub reveal" style="transition-delay:.2s">
                Finote combines world-class aesthetics with powerful financial tools. Built for those who demand precision without complexity.
            </p>
            <div class="hero-cta-group reveal" style="transition-delay:.3s">
                <a href="{{ url('/register') }}" class="btn-premium">
    Start Your Journey <i data-lucide="arrow-up-right" size="16"></i>
</a>
                <a href="#features" class="btn-ghost">
                    <i data-lucide="play-circle" size="16"></i> See how it works
                </a>
            </div>
            <div class="stats-bar reveal" style="transition-delay:.45s">
                <div class="stat-item">
                    <span class="stat-number">$<span>2.4</span>B</span>
                    <span class="stat-label">Assets Tracked</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number"><span>140</span>K+</span>
                    <span class="stat-label">Active Users</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number"><span>99.9</span>%</span>
                    <span class="stat-label">Uptime SLA</span>
                </div>
            </div>
        </div>
    </section>

    <!-- MARQUEE -->
    <div class="marquee-section">
        <div class="marquee-track">
            <div class="marquee-item"><i data-lucide="bar-chart-2" size="14"></i> Real-time Analytics</div>
            <div class="marquee-item"><i data-lucide="shield-check" size="14"></i> Bank-grade Security</div>
            <div class="marquee-item"><i data-lucide="zap" size="14"></i> Instant Transactions</div>
            <div class="marquee-item"><i data-lucide="globe" size="14"></i> Multi-Currency</div>
            <div class="marquee-item"><i data-lucide="cpu" size="14"></i> AI-powered Insights</div>
            <div class="marquee-item"><i data-lucide="layers" size="14"></i> Portfolio Tracking</div>
            <div class="marquee-item"><i data-lucide="bell" size="14"></i> Smart Alerts</div>
            <div class="marquee-item"><i data-lucide="bar-chart-2" size="14"></i> Real-time Analytics</div>
            <div class="marquee-item"><i data-lucide="shield-check" size="14"></i> Bank-grade Security</div>
            <div class="marquee-item"><i data-lucide="zap" size="14"></i> Instant Transactions</div>
            <div class="marquee-item"><i data-lucide="globe" size="14"></i> Multi-Currency</div>
            <div class="marquee-item"><i data-lucide="cpu" size="14"></i> AI-powered Insights</div>
            <div class="marquee-item"><i data-lucide="layers" size="14"></i> Portfolio Tracking</div>
            <div class="marquee-item"><i data-lucide="bell" size="14"></i> Smart Alerts</div>
        </div>
    </div>

    <!-- FEATURES -->
    <section class="features-section" id="features">
        <div class="features-header reveal">
            <span class="section-label">Core Features</span>
            <h2 class="section-title">Everything you need,<br>nothing you don't.</h2>
        </div>

        <!-- Row 1 -->
        <div class="feature-row reveal">
            <div class="feature-text">
                <div class="feature-num">01</div>
                <h3 class="feature-title">Real-time Analytics
    <span class="badge-coming-soon">Coming Soon</span>
</h3>
                <p class="feature-desc">Monitor every transaction with microscopic detail. Predictive insights powered by AI help you stay ahead of your financial goals.</p>
                <div class="feature-tags">
                    <span class="tag">Live Data</span>
                    <span class="tag">AI Insights</span>
                    <span class="tag">Custom Reports</span>
                </div>
            </div>
            <div class="feature-visual">
                <div class="fv-icon-wrap"><i data-lucide="bar-chart-big" size="28"></i></div>
                <div class="fv-mini-chart">
                    <div class="bar" style="height:40%"></div>
                    <div class="bar" style="height:65%"></div>
                    <div class="bar" style="height:50%"></div>
                    <div class="bar" style="height:80%"></div>
                    <div class="bar accent" style="height:95%"></div>
                    <div class="bar" style="height:70%"></div>
                    <div class="bar" style="height:85%"></div>
                </div>
            </div>
        </div>

        <!-- Row 2 reversed -->
        <div class="feature-row reverse reveal">
            <div class="feature-text">
                <div class="feature-num">02</div>
                <h3 class="feature-title">Vault Grade Security
    <span class="badge-coming-soon">Coming Soon</span>
</h3>
                <p class="feature-desc">Military-level encryption guards every byte of your data. Sleep easy knowing your finances are protected 24/7.</p>
                <div class="feature-tags">
                    <span class="tag">AES-256</span>
                    <span class="tag">2FA Auth</span>
                    <span class="tag">Zero Knowledge</span>
                </div>
            </div>
            <div class="feature-visual">
                <div class="fv-icon-wrap"><i data-lucide="shield-check" size="28"></i></div>
                <div class="fv-shield-ring">
                    <div class="ring r1"></div>
                    <div class="ring r2"></div>
                    <div class="ring r3"></div>
                </div>
            </div>
        </div>

        <!-- Row 3 -->
        <div class="feature-row reveal">
            <div class="feature-text">
                <div class="feature-num">03</div>
               <h3 class="feature-title">Multi-Currency
    <span class="badge-coming-soon">Coming Soon</span>
</h3>
                <p class="feature-desc">Seamless management of global assets across 180+ currencies and crypto. One wallet, the whole world.</p>
                <div class="feature-tags">
                    <span class="tag">180+ Currencies</span>
                    <span class="tag">Crypto</span>
                    <span class="tag">Auto Convert</span>
                </div>
            </div>
            <div class="feature-visual">
                <div class="fv-icon-wrap"><i data-lucide="globe" size="28"></i></div>
                <div class="fv-currencies">
                    <span class="cur">USD</span>
                    <span class="cur">EUR</span>
                    <span class="cur accent">BTC</span>
                    <span class="cur">JPY</span>
                    <span class="cur">IDR</span>
                    <span class="cur">ETH</span>
                </div>
            </div>
        </div>

        <!-- Row 4 reversed -->
        <div class="feature-row reverse reveal">
            <div class="feature-text">
                <div class="feature-num">04</div>
                <h3 class="feature-title">Smart Rules
    <span class="badge-coming-soon">Coming Soon</span>
</h3>
                <p class="feature-desc">Automate your savings and investments with intelligent conditional workflows. Set it once, let it work forever.</p>
                <div class="feature-tags">
                    <span class="tag">Auto-save</span>
                    <span class="tag">Triggers</span>
                    <span class="tag">Schedules</span>
                </div>
            </div>
            <div class="feature-visual">
                <div class="fv-icon-wrap"><i data-lucide="cpu" size="28"></i></div>
                <div class="fv-rules">
                    <div class="rule-item">IF balance &gt; $1000 → <span>Save 10%</span></div>
                    <div class="rule-item">EVERY Friday → <span>Invest $50</span></div>
                    <div class="rule-item">IF spend &gt; $200 → <span>Alert me</span></div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER CTA -->
    <section class="footer-cta">
        <h2 class="reveal">Ready to take<br><span style="color:var(--accent)">control?</span></h2>
        <p class="reveal" style="transition-delay:.1s">Join 140,000+ people who trust Finote to manage their financial life with clarity.</p>
        <div class="reveal" style="transition-delay:.2s">
            <a href="{{ url('/register') }}" class="btn-premium" style="font-size:1rem;padding:14px 32px">
    Get Started Free <i data-lucide="arrow-up-right" size="18"></i>
</a>
        </div>
    </section>

    <footer>
        <div class="footer-bar">
            <a href="#" class="nav-logo" style="font-size:1.1rem">Finote<span>.</span></a>
            <p>© 2025 Finote. All rights reserved.</p>
        </div>
    </footer>

    <script>
        lucide.createIcons();

        const themeBtn = document.getElementById('theme-switcher');
        const html = document.documentElement;

        themeBtn.addEventListener('click', (e) => {
            if (!document.startViewTransition) { toggleTheme(); return; }
            const x = e.clientX, y = e.clientY;
            const endRadius = Math.hypot(Math.max(x, innerWidth-x), Math.max(y, innerHeight-y));
            const currentTheme = html.getAttribute('data-theme');
            const transition = document.startViewTransition(() => toggleTheme());
            transition.ready.then(() => {
                const clipPath = [`circle(0px at ${x}px ${y}px)`, `circle(${endRadius}px at ${x}px ${y}px)`];
                document.documentElement.animate(
                    { clipPath: currentTheme === 'dark' ? clipPath : [...clipPath].reverse() },
                    { duration: 700, easing: 'cubic-bezier(0.4,0,0.2,1)',
                      pseudoElement: currentTheme === 'dark' ? '::view-transition-new(root)' : '::view-transition-old(root)' }
                );
            });
        });

        function toggleTheme() {
            const newTheme = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', newTheme);
            themeBtn.innerHTML = newTheme === 'dark' ? '<i data-lucide="sun" size="16"></i>' : '<i data-lucide="moon" size="16"></i>';
            lucide.createIcons();
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) { entry.target.classList.add('active'); observer.unobserve(entry.target); }
            });
        }, { threshold: 0.08 });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        function animateCounter(el, target) {
            const isFloat = target % 1 !== 0;
            let start = 0;
            const step = (ts) => {
                if (!start) start = ts;
                const progress = Math.min((ts - start) / 1500, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                el.textContent = isFloat ? (eased * target).toFixed(1) : Math.floor(eased * target);
                if (progress < 1) requestAnimationFrame(step);
            };
            requestAnimationFrame(step);
        }

        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const spans = entry.target.querySelectorAll('.stat-number span');
                    [2.4, 140, 99.9].forEach((t, i) => animateCounter(spans[i], t));
                    statsObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });
        const statsBar = document.querySelector('.stats-bar');
        if (statsBar) statsObserver.observe(statsBar);
    </script>
</body>
</html>
