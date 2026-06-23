<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

/* RESET */
*, *::before, *::after { box-sizing: border-box; }
body.customers_login {
    margin: 0 !important; padding: 0 !important;
    overflow-x: hidden; overflow-y: auto;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
    -webkit-font-smoothing: antialiased;
    background: transparent !important;
}
body.customers_login #wrapper, body.customers_login #content {
    padding: 0 !important; margin: 0 !important; background: transparent !important;
}
body.customers_login .container, body.customers_login .container > .row {
    width: 100% !important; max-width: 100% !important; padding: 0 !important; margin: 0 !important;
}

/* PAGE SHELL */
.lp-page {
    position: fixed; inset: 0; z-index: 100; display: flex;
    font-family: 'Inter', -apple-system, sans-serif;
    transition: background .4s ease;
}
.lp-page[data-theme="dark"] {
    background:
        radial-gradient(ellipse 70% 60% at 30% 55%, rgba(89,20,176,.55) 0%, transparent 65%),
        radial-gradient(ellipse 45% 45% at 80% 20%, rgba(124,58,237,.25) 0%, transparent 60%),
        radial-gradient(ellipse 55% 50% at 10% 80%, rgba(55,10,120,.4) 0%, transparent 60%),
        linear-gradient(160deg, #0e0225 0%, #04000f 100%);
}
.lp-page[data-theme="light"] {
    background:
        radial-gradient(ellipse 60% 55% at 25% 50%, rgba(124,77,255,.07) 0%, transparent 65%),
        radial-gradient(ellipse 45% 40% at 80% 20%, rgba(124,77,255,.06) 0%, transparent 60%),
        radial-gradient(ellipse 50% 45% at 10% 85%, rgba(124,77,255,.05) 0%, transparent 60%),
        linear-gradient(160deg, #faf8ff 0%, #ffffff 100%);
}

/* THEME TOGGLE BUTTON */
.lp-theme-toggle {
    position: absolute; top: 20px; right: 24px; z-index: 300;
    display: flex; align-items: center; gap: 8px;
    border: none; cursor: pointer; padding: 7px 14px 7px 10px;
    border-radius: 50px; font-family: 'Inter', sans-serif;
    font-size: 12px; font-weight: 600; transition: background .3s, border-color .3s, color .3s;
}
.lp-page[data-theme="dark"] .lp-theme-toggle {
    background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.18);
    color: rgba(255,255,255,.85);
}
.lp-page[data-theme="dark"] .lp-theme-toggle:hover {
    background: rgba(255,255,255,.16); border-color: rgba(255,255,255,.3); color: #fff;
}
.lp-page[data-theme="light"] .lp-theme-toggle {
    background: rgba(124,77,255,.08); border: 1px solid rgba(124,77,255,.22);
    color: #3D2B6B;
}
.lp-page[data-theme="light"] .lp-theme-toggle:hover {
    background: rgba(124,77,255,.14); border-color: rgba(124,77,255,.38); color: #140042;
}
.lp-toggle-track {
    width: 38px; height: 21px; border-radius: 11px;
    position: relative; flex-shrink: 0; transition: background .35s;
}
.lp-page[data-theme="dark"] .lp-toggle-track { background: rgba(255,255,255,.18); }
.lp-page[data-theme="light"] .lp-toggle-track { background: rgba(124,77,255,.22); }
.lp-toggle-knob {
    position: absolute; top: 2.5px; width: 16px; height: 16px;
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    transition: left .28s cubic-bezier(.22,1,.36,1), background .3s;
}
.lp-page[data-theme="dark"] .lp-toggle-knob { left: 3px; background: #ffc107; }
.lp-page[data-theme="light"] .lp-toggle-knob { left: 19px; background: #7C4DFF; }
.lp-toggle-knob svg { width: 10px; height: 10px; color: #fff; }

/* LEFT SECTION */
.lp-left {
    flex: 0 0 55%; display: flex; flex-direction: column;
    padding: 36px 44px 28px; position: relative; overflow: hidden;
}
.lp-page[data-theme="light"] .lp-left::before {
    content: ''; position: absolute; inset: 0; pointer-events: none;
    background:
        radial-gradient(ellipse 70% 60% at 30% 55%, rgba(124,77,255,.05) 0%, transparent 70%),
        radial-gradient(ellipse 40% 40% at 80% 10%, rgba(124,77,255,.03) 0%, transparent 60%);
}

/* Logo top */
.lp-logo-top {
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 120px; flex-shrink: 0; z-index: 5; position: relative;
}
.lp-logo-top img { height: 60px; width: auto; display: block; }
/* logo show/hide by theme */
.lp-logo-dark  { display: block; }
.lp-logo-light { display: none; }
.lp-page[data-theme="dark"]  .lp-logo-dark  { display: block; }
.lp-page[data-theme="dark"]  .lp-logo-light { display: none; }
.lp-page[data-theme="light"] .lp-logo-dark  { display: none; }
.lp-page[data-theme="light"] .lp-logo-light { display: block; }

/* HEADING */
.lp-heading { z-index: 5; position: relative; margin-bottom: 55px; flex-shrink: 0; }
.lp-heading h2 {
    font-size: 48px; font-weight: 900; line-height: 1.1;
    letter-spacing: -.5px; margin: 0 0 5px; transition: color .35s;
}
.lp-page[data-theme="dark"] .lp-heading h2 { color: #ffffff; }
.lp-page[data-theme="light"] .lp-heading h2 { color: #5914b0; }
.lp-heading .lp-accent { font-size: 28px; font-weight: 700; line-height: 1.25; margin: 0; transition: color .35s; }
.lp-page[data-theme="dark"] .lp-heading .lp-accent { color: #ffffff; }
.lp-page[data-theme="light"] .lp-heading .lp-accent { color: #6B6780; }
.lp-heading .lp-accent span { color: #FFC107; }

/* FEATURE GRID */
.lp-grid {
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 18px 24px; max-width: 760px; z-index: 5;
    position: relative; margin-bottom: 28px; flex-shrink: 0;
}
.lp-gi {
    display: flex; flex-direction: column; align-items: center;
    gap: 6px; font-size: 14px; font-weight: 600; text-align: center; line-height: 1.3;
    transition: color .35s;
}
.lp-page[data-theme="dark"] .lp-gi { color: rgba(255,255,255,.72); }
.lp-page[data-theme="light"] .lp-gi { color: #6B6780; }
.lp-gi-icon {
    width: 44px; height: 44px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    transition: background .2s, border-color .2s, box-shadow .2s, color .35s;
}
.lp-gi-icon svg { width: 28px; height: 28px; }
.lp-page[data-theme="dark"] .lp-gi-icon {
    background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.14);
    color: #ffc107; box-shadow: 0 1px 0 rgba(255,255,255,.08) inset;
}
.lp-page[data-theme="dark"] .lp-gi:hover .lp-gi-icon {
    background: rgba(255,193,7,.12); border-color: rgba(255,193,7,.3);
}
.lp-page[data-theme="light"] .lp-gi-icon {
    background: #ffffff; border: 1px solid rgba(124,77,255,.18);
    color: #7C4DFF; box-shadow: 0 2px 8px rgba(124,77,255,.1), 0 1px 0 rgba(255,255,255,.8) inset;
}
.lp-page[data-theme="light"] .lp-gi:hover .lp-gi-icon {
    background: rgba(124,77,255,.06); border-color: rgba(124,77,255,.3);
    box-shadow: 0 4px 14px rgba(124,77,255,.15), 0 1px 0 rgba(255,255,255,.8) inset;
}
/* ILLUSTRATION */
.lp-illus {
    flex: 1; position: relative; display: flex;
    align-items: center; justify-content: center; z-index: 5; min-height: 0;
}
.lp-glow {
    position: absolute; width: 260px; height: 260px; border-radius: 50%;
    filter: blur(30px); pointer-events: none;
    animation: lp-glow-pulse 3s ease-in-out infinite alternate; transition: background .4s;
}
.lp-page[data-theme="dark"] .lp-glow {
    background: radial-gradient(circle, rgba(124,58,237,.7) 0%, rgba(89,20,176,.4) 40%, transparent 70%);
}
.lp-page[data-theme="light"] .lp-glow {
    background: radial-gradient(circle, rgba(124,77,255,.25) 0%, rgba(124,77,255,.1) 40%, transparent 70%);
}
@keyframes lp-glow-pulse { 0%{opacity:.7;transform:scale(.95);} 100%{opacity:1;transform:scale(1.08);} }

.lp-rings { position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); pointer-events: none; }
.lp-ring { position: absolute; border-radius: 50%; left: 50%; bottom: 0; transform: translateX(-50%); transition: border-color .35s; }
.lp-ring-1 { width: 170px; height: 42px; }
.lp-ring-2 { width: 260px; height: 64px; bottom: -11px; }
.lp-ring-3 { width: 360px; height: 88px; bottom: -23px; }
.lp-ring-4 { width: 460px; height: 112px; bottom: -35px; }
.lp-page[data-theme="dark"] .lp-ring-1 { border: 1px solid rgba(167,139,250,.3); }
.lp-page[data-theme="dark"] .lp-ring-2 { border: 1px solid rgba(167,139,250,.22); }
.lp-page[data-theme="dark"] .lp-ring-3 { border: 1px solid rgba(167,139,250,.14); }
.lp-page[data-theme="dark"] .lp-ring-4 { border: 1px solid rgba(167,139,250,.08); }
.lp-page[data-theme="light"] .lp-ring-1 { border: 1px solid rgba(124,77,255,.18); }
.lp-page[data-theme="light"] .lp-ring-2 { border: 1px solid rgba(124,77,255,.12); }
.lp-page[data-theme="light"] .lp-ring-3 { border: 1px solid rgba(124,77,255,.08); }
.lp-page[data-theme="light"] .lp-ring-4 { border: 1px solid rgba(124,77,255,.05); }

.lp-rays { position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%); width: 2px; height: 120px; pointer-events: none; }
.lp-ray { position: absolute; bottom: 0; left: 50%; width: 1.5px; height: 100%; transform-origin: bottom center; border-radius: 1px; transition: background .35s; }
.lp-page[data-theme="dark"] .lp-ray { background: linear-gradient(to top, rgba(167,139,250,.5), transparent); opacity: .5; }
.lp-page[data-theme="light"] .lp-ray { background: linear-gradient(to top, rgba(124,77,255,.3), transparent); opacity: .4; }
.lp-ray:nth-child(1){transform:translateX(-50%) rotate(-45deg);}
.lp-ray:nth-child(2){transform:translateX(-50%) rotate(-27deg);}
.lp-ray:nth-child(3){transform:translateX(-50%) rotate(-13deg);}
.lp-ray:nth-child(4){transform:translateX(-50%) rotate(0deg);opacity:.7;}
.lp-ray:nth-child(5){transform:translateX(-50%) rotate(13deg);}
.lp-ray:nth-child(6){transform:translateX(-50%) rotate(27deg);}
.lp-ray:nth-child(7){transform:translateX(-50%) rotate(45deg);}

/* 3D Logo show/hide by theme */
.lp-logo3d { position: relative; z-index: 10; width: 128px; height: 128px; object-fit: contain; animation: lp-float 4s ease-in-out infinite; }
.lp-logo3d-dark  { filter: drop-shadow(0 24px 48px rgba(0,0,0,.5)) drop-shadow(0 0 30px rgba(124,58,237,.8)); }
.lp-logo3d-light { filter: drop-shadow(0 24px 48px rgba(124,77,255,.2)) drop-shadow(0 0 30px rgba(124,77,255,.25)); display: none; }
.lp-page[data-theme="dark"]  .lp-logo3d-dark  { display: block; }
.lp-page[data-theme="dark"]  .lp-logo3d-light { display: none; }
.lp-page[data-theme="light"] .lp-logo3d-dark  { display: none; }
.lp-page[data-theme="light"] .lp-logo3d-light { display: block; }
@keyframes lp-float { 0%,100%{transform:translateY(0) rotate(-2deg);} 50%{transform:translateY(-12px) rotate(2deg);} }

/* Floating stat cards */
.lp-card {
    position: absolute; border-radius: 14px; padding: 10px 14px; z-index: 12;
    backdrop-filter: blur(20px) saturate(160%); -webkit-backdrop-filter: blur(20px) saturate(160%);
    transition: background .35s, border-color .35s, box-shadow .35s;
}
.lp-page[data-theme="dark"] .lp-card {
    background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.18);
    box-shadow: 0 8px 32px rgba(0,0,0,.3), 0 1px 0 rgba(255,255,255,.12) inset;
}
.lp-page[data-theme="light"] .lp-card {
    background: rgba(255,255,255,.92); border: 1px solid rgba(124,77,255,.15);
    box-shadow: 0 8px 32px rgba(124,77,255,.1), 0 1px 0 rgba(255,255,255,.9) inset;
}
.lp-card-rev{left:8px;top:50%;transform:translateY(-55%);min-width:128px;}
.lp-card-ai{right:8px;top:30%;transform:translateY(-50%);min-width:110px;}
.lp-card-av{right:16px;bottom:30px;}
.lp-card-pie{left:170px;bottom:20px;}

.lp-cl { font-size:8.5px;font-weight:600;margin-bottom:2px;white-space:nowrap;transition:color .35s; }
.lp-page[data-theme="dark"] .lp-cl { color:rgba(255,255,255,.5); }
.lp-page[data-theme="light"] .lp-cl { color:#9B8CC0; }
.lp-cv { font-size:15px;font-weight:800;line-height:1;transition:color .35s; }
.lp-page[data-theme="dark"] .lp-cv { color:#fff; }
.lp-page[data-theme="light"] .lp-cv { color:#140042; }
.lp-cd { font-size:8.5px;font-weight:600;color:#4ade80;margin-top:2px; }
.lp-spark { width:70px;height:26px;display:block;margin-top:5px; }
/* dual sparklines */
.lp-spark-light { display:none; }
.lp-page[data-theme="dark"]  .lp-spark-dark  { display:block; }
.lp-page[data-theme="dark"]  .lp-spark-light { display:none; }
.lp-page[data-theme="light"] .lp-spark-dark  { display:none; }
.lp-page[data-theme="light"] .lp-spark-light { display:block; }

.lp-ai-title { font-size:9px;font-weight:700;margin-bottom:3px;transition:color .35s; }
.lp-page[data-theme="dark"] .lp-ai-title { color:rgba(255,255,255,.55); }
.lp-page[data-theme="light"] .lp-ai-title { color:#9B8CC0; }
.lp-ai-body { font-size:10.5px;line-height:1.5;font-weight:500;max-width:98px;transition:color .35s; }
.lp-page[data-theme="dark"] .lp-ai-body { color:#fff; }
.lp-page[data-theme="light"] .lp-ai-body { color:#140042; }
.lp-ai-body strong { color:#ffc107; }
.lp-ai-link { font-size:9px;font-weight:600;text-decoration:none;display:block;margin-top:4px;transition:color .35s; }
.lp-page[data-theme="dark"] .lp-ai-link { color:#a78bfa; }
.lp-page[data-theme="light"] .lp-ai-link { color:#7C4DFF; }

.lp-av-wrap { display:flex;align-items:center;gap:7px; }
.lp-av { width:30px;height:30px;border-radius:8px;display:flex;align-items:center;justify-content:center;transition:background .35s,border-color .35s,color .35s; }
.lp-page[data-theme="dark"] .lp-av { background:rgba(167,139,250,.25);border:1px solid rgba(167,139,250,.3);color:#c4b5fd; }
.lp-page[data-theme="light"] .lp-av { background:rgba(124,77,255,.1);border:1px solid rgba(124,77,255,.2);color:#7C4DFF; }
.lp-av svg { width:16px;height:16px; }
.lp-avl { display:flex;flex-direction:column;gap:4px; }
.lp-avl-bar { height:5px;border-radius:3px;transition:background .35s; }
.lp-page[data-theme="dark"] .lp-avl-bar { background:rgba(255,255,255,.15); }
.lp-page[data-theme="light"] .lp-avl-bar { background:rgba(124,77,255,.15); }
.lp-avl-bar:first-child{width:46px;} .lp-avl-bar:last-child{width:28px;}

/* TRUST BAR */
.lp-trust {
    display:inline-flex;align-items:center;gap:10px;backdrop-filter:blur(12px);
    border-radius:12px;padding:10px 18px;width:fit-content;max-width:420px;margin-top:12px;
    transition:background .35s,border-color .35s,box-shadow .35s;
}
.lp-page[data-theme="dark"] .lp-trust { background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12); }
.lp-page[data-theme="light"] .lp-trust { background:rgba(255,255,255,.85);border:1px solid rgba(124,77,255,.18);box-shadow:0 4px 16px rgba(124,77,255,.08); }
.lp-trust-ic { width:32px;height:32px;flex-shrink:0;background:rgba(255,193,7,.12);border:1px solid rgba(255,193,7,.25);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#ffc107; }
.lp-trust-ic svg { width:16px;height:16px; }
.lp-trust-txt { font-size:12px;font-weight:700;line-height:1.5;transition:color .35s; }
.lp-page[data-theme="dark"] .lp-trust-txt { color:#fff; }
.lp-page[data-theme="light"] .lp-trust-txt { color:#140042; }
.lp-trust-txt span { font-weight:400;display:block;font-size:11px;transition:color .35s; }
.lp-page[data-theme="dark"] .lp-trust-txt span { color:rgba(255,255,255,.5); }
.lp-page[data-theme="light"] .lp-trust-txt span { color:#6B6780; }

/* RIGHT SECTION */
.lp-right { flex:1;display:flex;align-items:center;justify-content:center;padding:32px 40px;position:relative; }
.lp-page[data-theme="light"] .lp-right::before {
    content:'';position:absolute;inset:0;pointer-events:none;z-index:0;
    background:radial-gradient(ellipse 80% 80% at 60% 50%,rgba(124,77,255,.05) 0%,transparent 70%),
    linear-gradient(170deg,#fdfcff 0%,#f8f5ff 100%);
}

/* LOGIN CARD */
.lp-glass {
    width:100%;max-width:420px;border-radius:24px;padding:40px 36px 36px;
    position:relative;z-index:1;animation:lp-up .55s cubic-bezier(.22,1,.36,1);
    backdrop-filter:blur(60px) saturate(180%);-webkit-backdrop-filter:blur(60px) saturate(180%);
    transition:background .35s,border-color .35s,box-shadow .35s;
}
.lp-page[data-theme="dark"] .lp-glass {
    background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.18);
    box-shadow:0 2px 0 0 rgba(255,255,255,.18) inset,0 40px 80px rgba(0,0,0,.5),0 0 0 1px rgba(89,20,176,.1);
}
.lp-page[data-theme="light"] .lp-glass {
    background:#ffffff;border:1px solid rgba(124,77,255,.2);
    box-shadow:0 2px 0 0 rgba(255,255,255,.9) inset,0 20px 60px rgba(124,77,255,.12),0 4px 16px rgba(124,77,255,.06);
}
@keyframes lp-up { from{opacity:0;transform:translateY(24px) scale(.98);}to{opacity:1;transform:none;} }

/* Form header */
.lp-fh { margin-bottom:24px; }
.lp-fh h2 { font-size:22px;font-weight:800;letter-spacing:-.3px;margin:0 0 5px;transition:color .35s; }
.lp-page[data-theme="dark"] .lp-fh h2 { color:#ffffff; }
.lp-page[data-theme="light"] .lp-fh h2 { color:#140042; }
.lp-fh p { font-size:13.5px;margin:0;transition:color .35s; }
.lp-page[data-theme="dark"] .lp-fh p { color:rgba(255,255,255,.5); }
.lp-page[data-theme="light"] .lp-fh p { color:#6B6780; }

/* Fields */
.lp-f { margin-bottom:14px; }
.lp-f > label { display:block;font-size:12.5px;font-weight:600;margin-bottom:6px;letter-spacing:.01em;transition:color .35s; }
.lp-page[data-theme="dark"] .lp-f > label { color:rgba(255,255,255,.75); }
.lp-page[data-theme="light"] .lp-f > label { color:#3D2B6B; }
.lp-iw { position:relative; }
.lp-ico { position:absolute;left:13px;top:50%;transform:translateY(-50%);display:flex;align-items:center;pointer-events:none;transition:color .35s; }
.lp-page[data-theme="dark"] .lp-ico { color:rgba(255,255,255,.35); }
.lp-page[data-theme="light"] .lp-ico { color:rgba(124,77,255,.45); }
.lp-ico svg { width:16px;height:16px; }
.lp-f .form-control {
    width:100%!important;height:48px!important;padding:0 42px!important;
    border-radius:12px!important;font-size:14px!important;font-family:'Inter',sans-serif!important;
    outline:none!important;box-shadow:none!important;-webkit-appearance:none;
    transition:border-color .2s,background .2s,box-shadow .2s,color .35s!important;
}
.lp-page[data-theme="dark"] .lp-f .form-control {
    background:rgba(255,255,255,.07)!important;border:1px solid rgba(255,255,255,.14)!important;color:#ffffff!important;
}
.lp-page[data-theme="dark"] .lp-f .form-control::placeholder { color:rgba(255,255,255,.25)!important;font-size:13px!important; }
.lp-page[data-theme="dark"] .lp-f .form-control:focus {
    border-color:rgba(167,139,250,.6)!important;background:rgba(255,255,255,.1)!important;
    box-shadow:0 0 0 3px rgba(89,20,176,.2)!important;
}
.lp-page[data-theme="light"] .lp-f .form-control {
    background:#fdfcff!important;border:1px solid rgba(124,77,255,.2)!important;color:#140042!important;
}
.lp-page[data-theme="light"] .lp-f .form-control::placeholder { color:#B0A8CC!important;font-size:13px!important; }
.lp-page[data-theme="light"] .lp-f .form-control:focus {
    border-color:rgba(124,77,255,.55)!important;background:#ffffff!important;
    box-shadow:0 0 0 3px rgba(124,77,255,.1)!important;
}

.lp-eye {
    position:absolute;right:13px;top:50%;transform:translateY(-50%);
    background:none;border:none;cursor:pointer;padding:0;z-index:999;
    display:flex;align-items:center;transition:color .2s;
}
.lp-page[data-theme="dark"] .lp-eye { color:rgba(255,255,255,.75)!important; }
.lp-page[data-theme="dark"] .lp-eye:hover { color:#ffffff!important; }
.lp-page[data-theme="light"] .lp-eye { color:rgba(124,77,255,.5)!important; }
.lp-page[data-theme="light"] .lp-eye:hover { color:#7C4DFF!important; }
.lp-eye svg { width:17px;height:17px;stroke:currentColor; }
.lp-f select.form-control { padding:0 50px 0 42px!important; }
.lp-page[data-theme="dark"] .lp-f select.form-control { color:rgba(255,255,255,.8)!important; }
.lp-page[data-theme="dark"] .lp-f select.form-control option { background:#1a0535;color:#fff; }
.lp-page[data-theme="light"] .lp-f select.form-control { color:#140042!important; }
.lp-page[data-theme="light"] .lp-f select.form-control option { background:#ffffff;color:#140042; }

/* label+link row */
.lp-lr { display:flex;justify-content:space-between;align-items:center;margin-bottom:6px; }
.lp-lr label { font-size:12.5px;font-weight:600;margin:0;transition:color .35s; }
.lp-page[data-theme="dark"] .lp-lr label { color:rgba(255,255,255,.75); }
.lp-page[data-theme="light"] .lp-lr label { color:#3D2B6B; }
.lp-lr a { font-size:12.5px;font-weight:500;text-decoration:none;transition:color .35s; }
.lp-page[data-theme="dark"] .lp-lr a { color:#ffc107; }
.lp-page[data-theme="light"] .lp-lr a { color:#7C4DFF; }
.lp-lr a:hover { text-decoration:underline; }

/* remember */
.lp-rem { display:flex;justify-content:space-between;align-items:center;margin-bottom:20px; }
.lp-rem-l { display:flex;align-items:center;gap:8px; }
.lp-rem input[type="checkbox"] { width:16px;height:16px;cursor:pointer; }
.lp-page[data-theme="dark"] .lp-rem input[type="checkbox"] { accent-color:#7c3aed; }
.lp-page[data-theme="light"] .lp-rem input[type="checkbox"] { accent-color:#7C4DFF; }
.lp-rem label { font-size:13px;margin:0;cursor:pointer;transition:color .35s; }
.lp-page[data-theme="dark"] .lp-rem label { color:rgba(255,255,255,.6); }
.lp-page[data-theme="light"] .lp-rem label { color:#6B6780; }

/* LOGIN BUTTON */
.lp-btn {
    width:100%;height:50px;background:#ffc107;border:none;border-radius:13px;
    font-size:15px;font-weight:700;display:flex;align-items:center;justify-content:center;gap:8px;
    cursor:pointer;font-family:'Inter',sans-serif;text-decoration:none;padding:0;letter-spacing:.02em;
    transition:transform .15s,box-shadow .15s,background .15s,color .15s;
}
.lp-page[data-theme="dark"] .lp-btn { color:#1a0535!important;box-shadow:0 4px 20px rgba(89,20,176,.5),0 1px 0 rgba(255,255,255,.18) inset; }
.lp-page[data-theme="light"] .lp-btn { color:#140042!important;box-shadow:0 4px 20px rgba(255,193,7,.35),0 1px 0 rgba(255,255,255,.5) inset; }
.lp-btn:hover {
    background:#ffd54f!important;
    transform:translateY(-1px);
}
.lp-page[data-theme="dark"] .lp-btn:hover { color:#1a0535!important; box-shadow:0 8px 32px rgba(89,20,176,.6),0 1px 0 rgba(255,255,255,.18) inset!important; }
.lp-page[data-theme="light"] .lp-btn:hover { color:#140042!important; box-shadow:0 8px 28px rgba(255,193,7,.45),0 1px 0 rgba(255,255,255,.3) inset!important; }
.lp-btn:active { transform:translateY(0); }
.lp-btn svg { width:16px;height:16px; }

/* divider */
.lp-div { display:flex;align-items:center;gap:12px;font-size:12px;margin:18px 0;transition:color .35s; }
.lp-page[data-theme="dark"] .lp-div { color:rgba(255,255,255,.3); }
.lp-page[data-theme="light"] .lp-div { color:#B0A8CC; }
.lp-div::before,.lp-div::after { content:'';flex:1;height:1px;transition:background .35s; }
.lp-page[data-theme="dark"] .lp-div::before,.lp-page[data-theme="dark"] .lp-div::after { background:rgba(255,255,255,.1); }
.lp-page[data-theme="light"] .lp-div::before,.lp-page[data-theme="light"] .lp-div::after { background:rgba(124,77,255,.12); }

/* social buttons */
.lp-soc {
    width:100%;height:46px;border-radius:12px;
    display:flex;align-items:center;justify-content:center;gap:10px;
    font-size:14px;font-weight:600;cursor:pointer;font-family:'Inter',sans-serif;
    text-decoration:none;margin-bottom:10px;
    transition:background .2s,border-color .2s,transform .1s,box-shadow .2s,color .35s;
}
.lp-page[data-theme="dark"] .lp-soc { background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.13)!important;color:rgba(255,255,255,.8)!important; }
.lp-page[data-theme="dark"] .lp-soc:hover { background:rgba(255,255,255,.12);border-color:rgba(255,255,255,.22)!important;transform:translateY(-1px);color:#fff!important; }
.lp-page[data-theme="light"] .lp-soc { background:#ffffff;border:1px solid rgba(124,77,255,.18)!important;color:#3D2B6B!important;box-shadow:0 1px 4px rgba(124,77,255,.07); }
.lp-page[data-theme="light"] .lp-soc:hover { background:#fdfcff;border-color:rgba(124,77,255,.35)!important;transform:translateY(-1px);color:#140042!important;box-shadow:0 4px 14px rgba(124,77,255,.12); }
.lp-soc:last-of-type { margin-bottom:0; }

.lp-line { height:1px;margin:20px 0;transition:background .35s; }
.lp-page[data-theme="dark"] .lp-line { background:rgba(255,255,255,.08); }
.lp-page[data-theme="light"] .lp-line { background:rgba(124,77,255,.1); }
.lp-alt { text-align:center;margin-top:18px;font-size:13.5px;transition:color .35s; }
.lp-page[data-theme="dark"] .lp-alt { color:rgba(255,255,255,.45); }
.lp-page[data-theme="light"] .lp-alt { color:#6B6780; }
.lp-alt a { font-weight:700;text-decoration:none;transition:color .35s; }
.lp-page[data-theme="dark"] .lp-alt a { color:#ffc107; }
.lp-page[data-theme="light"] .lp-alt a { color:#7C4DFF; }
.lp-alt a:hover { text-decoration:underline; }
.lp-sec { display:flex;align-items:center;justify-content:center;gap:5px;margin-top:16px;font-size:11.5px;transition:color .35s; }
.lp-page[data-theme="dark"] .lp-sec { color:rgba(255,255,255,.3); }
.lp-page[data-theme="light"] .lp-sec { color:#B0A8CC; }
.lp-sec svg { width:13px;height:13px; }

/* alerts */
.lp-alerts .alert { border-radius:10px;font-size:13px;font-weight:500;margin-bottom:14px;padding:9px 13px;border:none; }
.lp-page[data-theme="dark"] .lp-alerts .alert-danger  { background:rgba(239,68,68,.15);color:#fca5a5;border-left:3px solid #ef4444; }
.lp-page[data-theme="dark"] .lp-alerts .alert-success { background:rgba(34,197,94,.12);color:#86efac;border-left:3px solid #22c55e; }
.lp-page[data-theme="dark"] .lp-alerts .alert-warning { background:rgba(255,193,7,.12);color:#fde047;border-left:3px solid #ffc107; }
.lp-page[data-theme="light"] .lp-alerts .alert-danger  { background:rgba(239,68,68,.08);color:#dc2626;border-left:3px solid #ef4444; }
.lp-page[data-theme="light"] .lp-alerts .alert-success { background:rgba(34,197,94,.08);color:#16a34a;border-left:3px solid #22c55e; }
.lp-page[data-theme="light"] .lp-alerts .alert-warning { background:rgba(255,193,7,.1);color:#b45309;border-left:3px solid #ffc107; }
.lp-rc { margin-bottom:14px; }

/* RESPONSIVE */
@media (max-width:1200px) {
    html, body { overflow-x: hidden !important; width: 100% !important; max-width: 100% !important; }
    .lp-theme-toggle { top:16px;left:20px;right:auto;padding:5px; }
    #lp-toggle-label { display: none; }
    .lp-page { flex-direction:column;overflow-y:auto;overflow-x:hidden;align-items:center;width:100% !important;max-width:100% !important; }
    .lp-left { display:flex;flex:none;width:100%;padding:8px 15px 0;align-items:center;text-align:center; }
    .lp-grid,.lp-illus,.lp-trust { display:none; }
    .lp-logo-top { margin-bottom:25px;justify-content:center; }
    .lp-logo-top img { height:50px; }
    .lp-heading { margin-bottom:0; }
    .lp-heading h2 { margin:0 0 8px;line-height:1.05;font-size:28px; }
    .lp-heading .lp-accent { margin:0;line-height:1.1;font-size:18px; }
    .lp-right { width:100%;flex:none;display:flex;align-items:center;justify-content:center;padding:25px 20px 10px; }
    .lp-page[data-theme="light"] .lp-right::before { display:none; }
    .lp-glass { width:92%;max-width:360px;margin:0 auto;padding:24px 20px 24px; }
}
@media (max-width:480px) { .lp-glass { padding:28px 20px 24px; } }
</style>

<div class="lp-page" id="lp-page" data-theme="dark">

<!-- THEME TOGGLE BUTTON -->
<button class="lp-theme-toggle" id="lp-toggle-btn" onclick="lpToggleTheme()" title="Toggle theme">
    <div class="lp-toggle-track">
        <div class="lp-toggle-knob" id="lp-knob">
            <svg id="lp-toggle-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zm4.478 3.272a.75.75 0 011.06 0l1.591 1.59a.75.75 0 01-1.06 1.061L16.47 6.574a.75.75 0 010-1.06zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zm-3.272 4.478a.75.75 0 010 1.06l-1.59 1.591a.75.75 0 01-1.061-1.06l1.59-1.59a.75.75 0 011.061 0zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zm-4.478-1.272a.75.75 0 010 1.06l-1.591 1.59a.75.75 0 11-1.06-1.06l1.59-1.591a.75.75 0 011.061 0zM3 12a.75.75 0 01.75-.75H6a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm3.272-4.478a.75.75 0 011.06 0l1.591 1.59A.75.75 0 117.864 10.17L6.273 8.582a.75.75 0 010-1.06zM12 7.5a4.5 4.5 0 100 9 4.5 4.5 0 000-9z"/>
            </svg>
        </div>
    </div>
    <span id="lp-toggle-label">Light Mode</span>
</button>

<!-- LEFT BRAND PANEL -->
<div class="lp-left">

    <!-- Dual logos -->
    <div class="lp-logo-top">
        <img src="https://mingrow.cloud/uploads/company/light-logo.png" alt="Mingrow" class="lp-logo-dark">
        <img src="https://mingrow.cloud/uploads/company/dark-logo.png"  alt="Mingrow" class="lp-logo-light">
    </div>

    <!-- Heading -->
    <div class="lp-heading">
        <h2>The AI Business OS</h2>
        <p class="lp-accent">Everything your <span>Business</span> needs.</p>
    </div>

    <!-- 4x2 Feature Grid -->
    <div class="lp-grid">
        <div class="lp-gi"><div class="lp-gi-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg></div>CRM &amp; Sales</div>
        <div class="lp-gi"><div class="lp-gi-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/></svg></div>Projects &amp; Tasks</div>
        <div class="lp-gi"><div class="lp-gi-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z"/></svg></div>WhatsApp Marketing</div>
        <div class="lp-gi"><div class="lp-gi-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/></svg></div>AI Assistant</div>
        <div class="lp-gi"><div class="lp-gi-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg></div>Invoicing &amp; Payments</div>
        <div class="lp-gi"><div class="lp-gi-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg></div>HR &amp; Teams</div>
        <div class="lp-gi"><div class="lp-gi-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.712 4.33a9.027 9.027 0 011.652 1.306c.51.51.944 1.064 1.306 1.652M16.712 4.33l-3.448 4.138m3.448-4.138a9.014 9.014 0 00-9.424 0M19.67 7.288l-4.138 3.448m4.138-3.448a9.014 9.014 0 010 9.424m-4.138-5.976a3.736 3.736 0 00-.88-1.388 3.737 3.737 0 00-1.388-.88m2.268 2.268a3.765 3.765 0 010 2.528m-2.268-4.796a3.765 3.765 0 00-2.528 0m4.796 4.796c-.181.506-.475.982-.88 1.388a3.736 3.736 0 01-1.388.88m2.268-2.268l4.138 3.448m0 0a9.027 9.027 0 01-1.306 1.652c-.51.51-1.064.944-1.652 1.306m0 0l-3.448-4.138m3.448 4.138a9.014 9.014 0 01-9.424 0m5.976-4.138a3.765 3.765 0 01-2.528 0m0 0a3.736 3.736 0 01-1.388-.88 3.737 3.737 0 01-.88-1.388m2.268 2.268L7.288 19.67m0 0a9.024 9.024 0 01-1.652-1.306 9.027 9.027 0 01-1.306-1.652m0 0l4.138-3.448M4.33 16.712a9.014 9.014 0 010-9.424m4.138 5.976a3.765 3.765 0 010-2.528m0 0c.181-.506.475-.982.88-1.388a3.736 3.736 0 011.388-.88m-2.268 2.268L4.33 7.288m6.406 1.18L7.288 4.33m0 0a9.024 9.024 0 00-1.652 1.306A9.025 9.025 0 004.33 7.288"/></svg></div>Support Tickets</div>
        <div class="lp-gi"><div class="lp-gi-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3"/></svg></div>Reports &amp; Analytics</div>
    </div>

    <!-- 3D Illustration -->
    <div class="lp-illus">
        <div class="lp-glow"></div>
        <div class="lp-rays">
            <div class="lp-ray"></div><div class="lp-ray"></div><div class="lp-ray"></div>
            <div class="lp-ray"></div><div class="lp-ray"></div><div class="lp-ray"></div>
            <div class="lp-ray"></div>
        </div>
        <div class="lp-rings">
            <div class="lp-ring lp-ring-1"></div><div class="lp-ring lp-ring-2"></div>
            <div class="lp-ring lp-ring-3"></div><div class="lp-ring lp-ring-4"></div>
        </div>
        <!-- Dual 3D logos -->
        <img src="https://mingrow.cloud/uploads/company/white-3d-logo-mingrow.png" alt="Mingrow 3D" class="lp-logo3d lp-logo3d-dark">
        <img src="https://mingrow.cloud/uploads/company/3d-logo-mingrow.png"       alt="Mingrow 3D" class="lp-logo3d lp-logo3d-light">

        <!-- Revenue card -->
        <div class="lp-card lp-card-rev">
            <div class="lp-cl">Total Revenue</div>
            <div class="lp-cv">&#8377; 12,54,000</div>
            <div class="lp-cd">&#9650; 24.5% this month</div>
            <!-- Dark sparkline -->
            <svg class="lp-spark lp-spark-dark" viewBox="0 0 70 26" fill="none">
                <polyline points="0,22 10,16 22,18 34,9 44,11 56,4 70,2" stroke="#a78bfa" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                <polygon points="0,22 10,16 22,18 34,9 44,11 56,4 70,2 70,26 0,26" fill="rgba(167,139,250,.15)"/>
            </svg>
            <!-- Light sparkline -->
            <svg class="lp-spark lp-spark-light" viewBox="0 0 70 26" fill="none">
                <polyline points="0,22 10,16 22,18 34,9 44,11 56,4 70,2" stroke="#7C4DFF" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                <polygon points="0,22 10,16 22,18 34,9 44,11 56,4 70,2 70,26 0,26" fill="rgba(124,77,255,.1)"/>
            </svg>
        </div>

        <!-- AI Insight card -->
        <div class="lp-card lp-card-ai">
            <div class="lp-ai-title">AI Insight</div>
            <div class="lp-ai-body">Sales may increase by <strong>23%</strong> this month.</div>
            <a href="#" class="lp-ai-link">View Details &#8594;</a>
        </div>

        <!-- Avatar card -->
        <div class="lp-card lp-card-av">
            <div class="lp-av-wrap">
                <div class="lp-av"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg></div>
                <div class="lp-avl"><div class="lp-avl-bar"></div><div class="lp-avl-bar"></div></div>
            </div>
        </div>

        <!-- Pie card — pie-bg circle changes per theme via CSS class -->
        <div class="lp-card lp-card-pie">
            <svg width="34" height="34" viewBox="0 0 34 34">
                <circle class="lp-pie-bg" cx="17" cy="17" r="12" fill="none" stroke-width="6"/>
                <circle cx="17" cy="17" r="12" fill="none" stroke="#7c3aed" stroke-width="6" stroke-dasharray="48 28" stroke-dashoffset="-8"/>
                <circle cx="17" cy="17" r="12" fill="none" stroke="#ffc107" stroke-width="6" stroke-dasharray="18 58" stroke-dashoffset="-56"/>
            </svg>
        </div>
    </div>

    <!-- Trust bar -->
    <div class="lp-trust">
        <div class="lp-trust-ic"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg></div>
        <div class="lp-trust-txt">Secure. Intelligent. Scalable.<span>Built to grow with your business.</span></div>
    </div>

</div><!-- /lp-left -->

<!-- RIGHT — Login Card -->
<div class="lp-right">
    <div class="lp-glass">

        <div class="lp-fh">
            <h2>Welcome back &#128075;</h2>
            <p>Login to your Mingrow account</p>
        </div>

        <div class="lp-alerts">
            <?php get_template_part('alerts'); ?>
        </div>

        <?= form_open($this->uri->uri_string(), ['class' => 'login-form']); ?>
        <?php hooks()->do_action('clients_login_form_start'); ?>

        <!-- Email -->
        <div class="lp-f">
            <label for="email"><?= _l('clients_login_email'); ?></label>
            <div class="lp-iw">
                <span class="lp-ico">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                </span>
                <input type="text" autofocus="true" class="form-control" name="email" id="email" placeholder="Enter your email">
                <?= form_error('email'); ?>
            </div>
        </div>

        <!-- Password -->
        <div class="lp-f">
            <div class="lp-lr">
                <label for="lp-pw"><?= _l('clients_login_password'); ?></label>
                <a href="<?= site_url('authentication/forgot_password'); ?>"><?= _l('customer_forgot_password'); ?></a>
            </div>
            <div class="lp-iw">
                <span class="lp-ico">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                </span>
                <input type="password" class="form-control" name="password" id="lp-pw" placeholder="&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;">
                <button type="button" class="lp-eye" onclick="lpEye('lp-pw',this)">
                    <svg id="lp-eye-lp-pw" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </button>
                <?= form_error('password'); ?>
            </div>
        </div>

        <!-- reCAPTCHA -->
        <?php if (show_recaptcha_in_customers_area()) { ?>
        <div class="lp-rc">
            <div class="g-recaptcha" data-sitekey="<?= get_option('recaptcha_site_key'); ?>"></div>
        </div>
        <?= form_error('g-recaptcha-response'); ?>
        <?php } ?>

        <!-- Remember me -->
        <div class="lp-rem">
            <div class="lp-rem-l">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember"><?= _l('clients_login_remember'); ?></label>
            </div>
        </div>

        <!-- Login button -->
        <button type="submit" class="lp-btn">
            Log in to Mingrow
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd"/></svg>
        </button>

        <div class="lp-div">or continue with</div>

        <!-- Google -->
        <a href="#" class="lp-soc">
            <svg width="18" height="18" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
            Continue with Google
        </a>

        <?php hooks()->do_action('clients_login_form_end'); ?>
        <?= form_close(); ?>

        <?php if (get_option('allow_registration') == 1) { ?>
        <div class="lp-line"></div>
        <div class="lp-alt">New to Mingrow? <a href="<?= site_url('authentication/register'); ?>"><?= _l('clients_register_string'); ?></a></div>
        <?php } ?>

        <div class="lp-sec">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
            Your data is protected with enterprise-grade security.
        </div>

    </div><!-- /lp-glass -->
</div><!-- /lp-right -->

</div><!-- /lp-page -->

<style>
/* Pie chart bg circle — theme-aware via CSS */
.lp-page[data-theme="dark"] .lp-pie-bg { stroke: rgba(255,255,255,.1); }
.lp-page[data-theme="light"] .lp-pie-bg { stroke: rgba(124,77,255,.12); }
</style>

<script>
/* ── Password Eye Toggle ── */
function lpEye(id, btn) {
    var inp  = document.getElementById(id);
    var icon = document.getElementById('lp-eye-' + id);
    if (inp.type === 'password') {
        inp.type = 'text';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>';
    } else {
        inp.type = 'password';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>';
    }
}

/* ── Theme Toggle ── */
var SUN_ICON = '<path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zm4.478 3.272a.75.75 0 011.06 0l1.591 1.59a.75.75 0 01-1.06 1.061L16.47 6.574a.75.75 0 010-1.06zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zm-3.272 4.478a.75.75 0 010 1.06l-1.59 1.591a.75.75 0 01-1.061-1.06l1.59-1.59a.75.75 0 011.061 0zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zm-4.478-1.272a.75.75 0 010 1.06l-1.591 1.59a.75.75 0 11-1.06-1.06l1.59-1.591a.75.75 0 011.061 0zM3 12a.75.75 0 01.75-.75H6a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm3.272-4.478a.75.75 0 011.06 0l1.591 1.59A.75.75 0 117.864 10.17L6.273 8.582a.75.75 0 010-1.06zM12 7.5a4.5 4.5 0 100 9 4.5 4.5 0 000-9z"/>';
var MOON_ICON = '<path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/>';

function lpApplyTheme(theme) {
    var page  = document.getElementById('lp-page');
    var icon  = document.getElementById('lp-toggle-icon');
    var label = document.getElementById('lp-toggle-label');
    page.setAttribute('data-theme', theme);
    if (theme === 'dark') {
        icon.innerHTML  = SUN_ICON;
        icon.setAttribute('fill', 'currentColor');
        icon.removeAttribute('stroke');
        label.textContent = 'Light Mode';
    } else {
        icon.innerHTML  = MOON_ICON;
        icon.setAttribute('fill', 'none');
        icon.setAttribute('stroke', 'currentColor');
        icon.setAttribute('stroke-width', '1.5');
        label.textContent = 'Dark Mode';
    }
}

function lpToggleTheme() {
    var page    = document.getElementById('lp-page');
    var current = page.getAttribute('data-theme');
    var next    = current === 'dark' ? 'light' : 'dark';
    lpApplyTheme(next);
    try { localStorage.setItem('mingrow-login-theme', next); } catch(e){}
}

/* ── On page load: restore saved theme ── */
(function() {
    var saved = 'dark';
    try { saved = localStorage.getItem('mingrow-login-theme') || 'dark'; } catch(e){}
    lpApplyTheme(saved);
})();
</script>
