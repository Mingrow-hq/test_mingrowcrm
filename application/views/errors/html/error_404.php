<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $heading; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --brand:  #5914b0;
            --brand2: #7c3aed;
            --gold:   #ffc107;
            --white:  #ffffff;
        }

        html, body {
            height: 100%;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            -webkit-font-smoothing: antialiased;
            overflow: hidden;
        }

        /* ── ANIMATED BACKGROUND ── */
        .ag-bg {
            position: fixed; inset: 0; z-index: 0;
            background: radial-gradient(ellipse at 20% 50%, #1a0840 0%, #060011 55%, #0d0024 100%);
            overflow: hidden;
        }
        .ag-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            animation: ag-float linear infinite;
            will-change: transform;
            pointer-events: none;
        }
        .ag-blob-1 {
            width: 520px; height: 520px;
            background: radial-gradient(circle, rgba(89,20,176,.55), transparent 70%);
            top: -120px; left: -80px;
            animation-duration: 22s;
        }
        .ag-blob-2 {
            width: 420px; height: 420px;
            background: radial-gradient(circle, rgba(124,58,237,.45), transparent 70%);
            bottom: -100px; right: -60px;
            animation-duration: 28s; animation-delay: -8s;
        }
        .ag-blob-3 {
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(255,193,7,.18), transparent 70%);
            top: 40%; left: 55%;
            animation-duration: 18s; animation-delay: -5s;
        }
        .ag-blob-4 {
            width: 360px; height: 360px;
            background: radial-gradient(circle, rgba(89,20,176,.3), transparent 70%);
            bottom: 10%; left: 20%;
            animation-duration: 32s; animation-delay: -14s;
        }
        @keyframes ag-float {
            0%   { transform: translate(0, 0)    scale(1); }
            33%  { transform: translate(30px, -40px) scale(1.06); }
            66%  { transform: translate(-20px, 30px) scale(0.96); }
            100% { transform: translate(0, 0)    scale(1); }
        }

        /* ── ROOT LAYOUT ── */
        .ag-root {
            position: relative; z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
        }

        /* ── GLASS CARD ── */
        .ag-card {
            width: 100%;
            max-width: 540px;
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(60px) saturate(180%);
            -webkit-backdrop-filter: blur(60px) saturate(180%);
            border: 1px solid rgba(255,255,255,0.16);
            border-radius: 28px;
            padding: 52px 48px 44px;
            box-shadow:
                0 2px 0 0 rgba(255,255,255,0.18) inset,
                0 48px 80px rgba(0,0,0,0.55),
                0 0 0 1px rgba(89,20,176,0.12);
            animation: ag-up .55s cubic-bezier(.22,1,.36,1);
            text-align: center;
        }
        @keyframes ag-up {
            from { opacity: 0; transform: translateY(28px) scale(.97); }
            to   { opacity: 1; transform: translateY(0)    scale(1); }
        }

        /* ── LOGO ── */
        .ag-logo {
            display: block;
            margin: 0 auto 32px;
            max-height: 40px;
            width: auto;
        }

        /* ── ERROR CODE ── */
        .ag-code {
            font-size: 96px;
            font-weight: 900;
            line-height: 1;
            letter-spacing: -4px;
            background: linear-gradient(135deg, #ffffff 0%, rgba(255,255,255,.6) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
            position: relative;
            display: inline-block;
        }
        /* gold accent bar under the number */
        .ag-code::after {
            content: '';
            display: block;
            width: 48px;
            height: 3px;
            background: linear-gradient(90deg, var(--gold), rgba(255,193,7,0));
            border-radius: 99px;
            margin: 12px auto 0;
        }

        /* ── ICON ── */
        .ag-icon {
            width: 64px; height: 64px;
            background: linear-gradient(135deg, rgba(255,193,7,.18), rgba(89,20,176,.18));
            border: 1.5px solid rgba(255,193,7,.22);
            border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
            margin: 24px auto 20px;
            color: var(--gold);
        }
        .ag-icon svg { width: 30px; height: 30px; }

        /* ── TEXT ── */
        .ag-heading {
            font-size: 22px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -.3px;
            margin-bottom: 10px;
        }
        .ag-message {
            font-size: 15px;
            color: rgba(255,255,255,0.6);
            line-height: 1.7;
            margin-bottom: 32px;
        }
        .ag-message a {
            color: var(--gold) !important;
            font-weight: 600;
            text-decoration: none;
            background: none !important;
        }
        .ag-message a:hover { text-decoration: underline; }

        /* ── CTA BUTTON  (inside message HTML from PHP) ── */
        /* Override the red TW classes with brand colours */
        .ag-message a.text-white.bg-red-600,
        .ag-message a[class*="bg-red"],
        .ag-cta {
            display: inline-flex !important;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
            padding: 14px 28px !important;
            background: var(--gold) !important;
            color: #0a0a0a !important;
            font-size: 15px !important;
            font-weight: 700 !important;
            border-radius: 14px !important;
            text-decoration: none !important;
            box-shadow: 0 4px 24px rgba(255,193,7,.45), 0 1px 0 rgba(255,255,255,.35) inset;
            transition: transform .15s, box-shadow .15s, background .15s;
            border: none !important;
            cursor: pointer;
        }
        .ag-message a.text-white.bg-red-600:hover,
        .ag-message a[class*="bg-red"]:hover {
            transform: translateY(-2px);
            background: #ffca28 !important;
            box-shadow: 0 8px 36px rgba(255,193,7,.6), 0 1px 0 rgba(255,255,255,.35) inset;
        }

        /* ── DIVIDER ── */
        .ag-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,.12), transparent);
            margin: 28px 0;
        }

        /* ── FOOTER INFO ── */
        .ag-footer {
            font-size: 13px;
            color: rgba(255,255,255,.35);
        }
        .ag-footer a {
            color: rgba(255,255,255,.5);
            text-decoration: none;
        }
        .ag-footer a:hover { color: rgba(255,255,255,.8); }

        /* ── STEPS (for trial-over context) ── */
        .ag-steps {
            display: flex;
            flex-direction: column;
            gap: 10px;
            text-align: left;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 16px;
            padding: 18px 20px;
            margin: 20px 0 0;
        }
        .ag-step {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 13px;
            color: rgba(255,255,255,.6);
        }
        .ag-step-num {
            width: 22px; height: 22px;
            min-width: 22px;
            background: rgba(255,193,7,.15);
            border: 1px solid rgba(255,193,7,.3);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 11px;
            font-weight: 700;
            color: var(--gold);
            margin-top: 1px;
        }

        @media (max-width: 540px) {
            .ag-card { padding: 36px 24px 32px; }
            .ag-code  { font-size: 72px; }
            .ag-heading { font-size: 19px; }
        }
    </style>
</head>
<body>

<!-- BACKGROUND -->
<div class="ag-bg">
    <div class="ag-blob ag-blob-1"></div>
    <div class="ag-blob ag-blob-2"></div>
    <div class="ag-blob ag-blob-3"></div>
    <div class="ag-blob ag-blob-4"></div>
</div>

<!-- CARD -->
<div class="ag-root">
    <div class="ag-card">

        <!-- Logo -->
        <img src="https://mingrow.cloud/uploads/company/light-logo.png"
             alt="Mingrow" class="ag-logo"
             onerror="this.style.display='none'">

        <!-- Error number (replaced by JS if != 404) -->
        <div class="ag-code" id="ag-code">403</div>

        <!-- Icon -->
        <div class="ag-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
            </svg>
        </div>

        <!-- Heading -->
        <h2 class="ag-heading" id="ag-heading"><?= htmlspecialchars($heading, ENT_QUOTES, 'UTF-8'); ?></h2>

        <!-- Message (may contain HTML links/buttons from PHP) -->
        <div class="ag-message" id="ag-message">
            <?= $message; ?>
        </div>

        <div class="ag-divider"></div>

        <div class="ag-footer">
            Need help? <a href="mailto:support@mingrow.cloud">Contact support</a> &nbsp;·&nbsp;
            <a href="https://mingrow.cloud">mingrow.cloud</a>
        </div>

    </div>
</div>

<script>
// The PHP passes JS that replaces '404' → real error code inside <h2>.
// We also update our visible code element.
(function () {
    var codeEl = document.getElementById('ag-code');
    // Watch for the script-injected change on the heading, then mirror it
    var headingEl = document.getElementById('ag-heading');
    var observer = new MutationObserver(function () {
        var match = headingEl.innerHTML.match(/\b(\d{3})\b/);
        if (match) codeEl.textContent = match[1];
    });
    observer.observe(headingEl, { childList: true, subtree: true, characterData: true });

    // Fallback: run after all inline scripts have executed
    window.addEventListener('load', function () {
        var match = headingEl.innerHTML.match(/\b(\d{3})\b/);
        if (match) codeEl.textContent = match[1];
    });
})();
</script>

</body>
</html>