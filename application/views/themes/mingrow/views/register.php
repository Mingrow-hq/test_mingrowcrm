<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

/* ═══════════════════════════════════════════════
   RESET & PAGE
═══════════════════════════════════════════════ */
*, *::before, *::after { box-sizing: border-box; }

body.customers.register {
    margin: 0 !important;
    padding: 0 !important;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
    -webkit-font-smoothing: antialiased;
    min-height: 100vh;
    transition: background .3s, color .3s;
}
body.customers.register #wrapper,
body.customers.register #content {
    padding: 0 !important;
    margin: 0 !important;
    background: transparent !important;
}
body.customers.register .container,
body.customers.register .container > .row {
    width: 100% !important;
    max-width: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
}

/* Hide any default/framework-generated navbar/header that is NOT our custom topbar */
body.customers.register .navbar,
body.customers.register .navbar-default,
body.customers.register .navbar-fixed-top,
body.customers.register nav.navbar,
body.customers.register header:not(.rg-topbar-wrap),
body.customers.register #header:not(.rg-topbar-wrap) {
    display: none !important;
}

/* ═══════════════════════════════════════════════
   DARK THEME (default)
═══════════════════════════════════════════════ */
body.customers.register,
body.customers.register.theme-dark {
    background: #09011a !important;
}

/* ── Animated Background ── */
body.customers.register .rg-bg,
body.customers.register.theme-dark .rg-bg {
    display: block;
}
.rg-bg {
    position: fixed; inset: 0; z-index: 0; pointer-events: none;
    background:
        radial-gradient(ellipse 65% 55% at 20% 40%, rgba(89,20,176,.5) 0%, transparent 65%),
        radial-gradient(ellipse 45% 50% at 85% 15%, rgba(124,58,237,.22) 0%, transparent 60%),
        radial-gradient(ellipse 50% 45% at 75% 85%, rgba(55,10,120,.35) 0%, transparent 60%),
        linear-gradient(160deg, #0e0225 0%, #04000f 100%);
}
.rg-blob {
    position: absolute; border-radius: 50%;
    filter: blur(80px); pointer-events: none;
    animation: rg-drift linear infinite;
    will-change: transform;
}
.rg-blob-1 { width:500px;height:500px; background:radial-gradient(circle,rgba(89,20,176,.35),transparent 70%); top:-100px;left:-60px; animation-duration:25s; }
.rg-blob-2 { width:380px;height:380px; background:radial-gradient(circle,rgba(124,58,237,.25),transparent 70%); bottom:-80px;right:-40px; animation-duration:30s;animation-delay:-10s; }
.rg-blob-3 { width:280px;height:280px; background:radial-gradient(circle,rgba(255,193,7,.08),transparent 70%); top:40%;right:15%; animation-duration:20s;animation-delay:-5s; }
@keyframes rg-drift {
    0%   { transform:translate(0,0) scale(1); }
    33%  { transform:translate(25px,-35px) scale(1.05); }
    66%  { transform:translate(-18px,28px) scale(.96); }
    100% { transform:translate(0,0) scale(1); }
}

/* ── Topbar ── */
.rg-topbar-wrap {
    position: sticky; top: 16px; z-index: 500;
    padding: 0 24px;
    pointer-events: none;
}
.rg-topbar {
    max-width: 900px;
    margin: 0 auto;
    backdrop-filter: blur(28px) saturate(180%);
    -webkit-backdrop-filter: blur(28px) saturate(180%);
    border-radius: 18px;
    padding: 12px 24px;
    display: flex; align-items: center; justify-content: space-between;
    pointer-events: all;
    transition: background .3s, border-color .3s, box-shadow .3s;
}

body.customers.register .rg-topbar,
body.customers.register.theme-dark .rg-topbar {
    background: rgba(255,255,255,.08);
    border: 1px solid rgba(255,255,255,.16);
    box-shadow: 0 8px 32px rgba(0,0,0,.35), 0 1px 0 rgba(255,255,255,.12) inset;
}

.rg-topbar-logo img { height: 34px; width: auto; display: block; }
.rg-topbar-right { display: flex; align-items: center; gap: 14px; }

/* ── Language select (dark) ── */
.rg-lang-wrap {
    position: relative;
    display: inline-flex;
    align-items: center;
}
.rg-lang {
    background: transparent !important;
    border: none !important;
    outline: none !important;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: color .2s;
    padding-right: 20px !important;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
body.customers.register .rg-lang,
body.customers.register.theme-dark .rg-lang { color: #fff !important; }
.rg-lang option { background: #1a0535; color: #fff; }

/* Dropdown arrow icon for language */
.rg-lang-arrow {
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    display: flex;
    align-items: center;
    transition: color .2s;
}
.rg-lang-arrow svg { width: 13px; height: 13px; }
body.customers.register .rg-lang-arrow,
body.customers.register.theme-dark .rg-lang-arrow { color: #fff; }

/* ── Moon-only Theme Toggle Button ── */
.rg-theme-btn {
    background: none;
    border: none;
    cursor: pointer;
    padding: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    transition: color .2s, background .2s;
    outline: none;
}
.rg-theme-btn svg { width: 18px; height: 18px; display: block; }
body.customers.register .rg-theme-btn,
body.customers.register.theme-dark .rg-theme-btn {
    color: #ffffff;
}
body.customers.register .rg-theme-btn:hover,
body.customers.register.theme-dark .rg-theme-btn:hover {
    background: rgba(255,255,255,.1);
    color: #fff;
}

/* ── Login btn (dark) ── */
.rg-login-btn {
    display: inline-flex; align-items: center; gap: 6px;
    height: 36px; padding: 0 16px;
    border-radius: 9px;
    font-size: 13px; font-weight: 600;
    text-decoration: none;
    transition: background .2s, border-color .2s, color .2s;
}
.rg-login-btn svg { width: 14px; height: 14px; }
body.customers.register .rg-login-btn,
body.customers.register.theme-dark .rg-login-btn {
    background: rgba(255,255,255,.07);
    border: 1px solid rgba(255,255,255,.18) !important;
    color: rgba(255,255,255,.8) !important;
}
body.customers.register .rg-login-btn:hover,
body.customers.register.theme-dark .rg-login-btn:hover {
    background: rgba(255,255,255,.14);
    border-color: rgba(255,255,255,.28) !important;
    color: #fff !important;
}

/* ── Main Wrapper (dark) ── */
.rg-main {
    position: relative; z-index: 10;
    max-width: 900px;
    margin: 0 auto;
    padding: 36px 24px 60px;
}

/* ── Page Header (dark) ── */
.rg-header { text-align: center; margin-bottom: 36px; }
.rg-header-badge {
    display: inline-flex; align-items: center; gap: 6px;
    border-radius: 100px;
    padding: 5px 14px;
    font-size: 11px; font-weight: 700;
    letter-spacing: 1px; text-transform: uppercase;
    margin-bottom: 14px;
    transition: background .3s, border-color .3s, color .3s;
}
.rg-header-badge svg { width: 12px; height: 12px; }
body.customers.register .rg-header-badge,
body.customers.register.theme-dark .rg-header-badge {
    background: rgba(255,193,7,.12);
    border: 1px solid rgba(255,193,7,.25);
    color: #ffc107;
}
.rg-header h1 {
    font-size: 30px; font-weight: 800; letter-spacing: -.5px;
    margin: 0 0 8px;
    transition: color .3s;
}
body.customers.register .rg-header h1,
body.customers.register.theme-dark .rg-header h1 { color: #fff; }
.rg-header p {
    font-size: 15px; margin: 0;
    transition: color .3s;
}
body.customers.register .rg-header p,
body.customers.register.theme-dark .rg-header p { color: rgba(255,255,255,.5); }

/* ── Steps (dark) ── */
.rg-steps {
    display: flex; align-items: center;
    margin-bottom: 32px;
    padding: 16px 28px;
    border-radius: 16px;
    backdrop-filter: blur(12px);
    transition: background .3s, border-color .3s;
}
body.customers.register .rg-steps,
body.customers.register.theme-dark .rg-steps {
    background: rgba(255,255,255,.05);
    border: 1px solid rgba(255,255,255,.1);
}
.rg-step { display: flex; align-items: center; gap: 10px; font-size: 13px; font-weight: 600; }
.rg-step-num {
    width: 30px; height: 30px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 700; flex-shrink: 0;
    transition: background .3s, color .3s, box-shadow .3s;
}
.rg-step-label { transition: color .3s; }
body.customers.register .rg-step-active .rg-step-num,
body.customers.register.theme-dark .rg-step-active .rg-step-num { background: #ffc107; color: #0a0a0a; box-shadow: 0 0 0 3px rgba(255,193,7,.25); }
body.customers.register .rg-step-active .rg-step-label,
body.customers.register.theme-dark .rg-step-active .rg-step-label { color: #ffc107; }
body.customers.register .rg-step-done .rg-step-num,
body.customers.register.theme-dark .rg-step-done .rg-step-num { background: #22c55e; color: #fff; }
body.customers.register .rg-step-done .rg-step-label,
body.customers.register.theme-dark .rg-step-done .rg-step-label { color: #86efac; }
body.customers.register .rg-step-pending .rg-step-num,
body.customers.register.theme-dark .rg-step-pending .rg-step-num { background: rgba(255,255,255,.1); color: rgba(255,255,255,.3); border: 1px solid rgba(255,255,255,.12); }
body.customers.register .rg-step-pending .rg-step-label,
body.customers.register.theme-dark .rg-step-pending .rg-step-label { color: rgba(255,255,255,.3); }
.rg-step-line { flex: 1; height: 1px; margin: 0 14px; min-width: 32px; transition: background .3s; }
body.customers.register .rg-step-line,
body.customers.register.theme-dark .rg-step-line { background: rgba(255,255,255,.1); }
.rg-step-line-done { background: linear-gradient(90deg, #5914b0, #7c3aed) !important; }

/* ── Alerts (dark) ── */
.rg-alerts .alert {
    border-radius: 12px; font-size: 14px; font-weight: 500;
    margin-bottom: 16px; padding: 10px 14px; border: none;
}
body.customers.register .rg-alerts .alert-danger,
body.customers.register.theme-dark .rg-alerts .alert-danger  { background: rgba(239,68,68,.15); color: #fca5a5; border-left: 3px solid #ef4444; }
body.customers.register .rg-alerts .alert-success,
body.customers.register.theme-dark .rg-alerts .alert-success { background: rgba(34,197,94,.12); color: #86efac; border-left: 3px solid #22c55e; }
body.customers.register .rg-alerts .alert-warning,
body.customers.register.theme-dark .rg-alerts .alert-warning { background: rgba(255,193,7,.12); color: #fde047; border-left: 3px solid #ffc107; }

/* ── Validation Error ── */
.rg-validation-error {
    border-radius: 12px; font-size: 14px; font-weight: 500;
    margin-bottom: 20px; padding: 12px 16px; border: none;
}
body.customers.register .rg-validation-error,
body.customers.register.theme-dark .rg-validation-error {
    background: rgba(239,68,68,.15); color: #fca5a5; border-left: 3px solid #ef4444;
}

/* ── Glass Card (dark) ── */
.rg-card {
    backdrop-filter: blur(40px) saturate(160%);
    -webkit-backdrop-filter: blur(40px) saturate(160%);
    border-radius: 20px;
    padding: 28px 32px;
    margin-bottom: 20px;
    animation: rg-card-in .4s cubic-bezier(.22,1,.36,1) both;
    transition: background .3s, border-color .3s, box-shadow .3s;
}
.rg-card:nth-child(2) { animation-delay: .08s; }
@keyframes rg-card-in { from{opacity:0;transform:translateY(16px);} to{opacity:1;transform:none;} }
body.customers.register .rg-card,
body.customers.register.theme-dark .rg-card {
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.12);
    box-shadow: 0 1px 0 rgba(255,255,255,.1) inset, 0 20px 60px rgba(0,0,0,.35);
}

/* card header */
.rg-card-head {
    display: flex; align-items: center; gap: 12px;
    margin-bottom: 22px; padding-bottom: 18px;
    transition: border-color .3s;
}
body.customers.register .rg-card-head,
body.customers.register.theme-dark .rg-card-head { border-bottom: 1px solid rgba(255,255,255,.08); }
.rg-card-icon {
    width: 42px; height: 42px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    transition: background .3s, border-color .3s, color .3s;
}
.rg-card-icon svg { width: 20px; height: 20px; }
body.customers.register .rg-card-icon,
body.customers.register.theme-dark .rg-card-icon {
    background: linear-gradient(135deg, rgba(89,20,176,.35), rgba(124,58,237,.2));
    border: 1px solid rgba(167,139,250,.25);
    color: #c4b5fd;
}
.rg-card-title { font-size: 16px; font-weight: 700; margin: 0 0 2px; transition: color .3s; }
.rg-card-sub   { font-size: 12px; margin: 0; transition: color .3s; }
body.customers.register .rg-card-title,
body.customers.register.theme-dark .rg-card-title { color: #fff; }
body.customers.register .rg-card-sub,
body.customers.register.theme-dark .rg-card-sub   { color: rgba(255,255,255,.4); }

/* ── Form Grid ── */
.rg-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px 18px; }
.rg-grid.rg-col-1 { grid-template-columns: 1fr; }
.rg-full { grid-column: 1 / -1; }

/* ── Field ── */
.rg-f { margin-bottom: 0; }
.rg-f > label {
    display: block;
    font-size: 12px; font-weight: 600;
    margin-bottom: 6px; letter-spacing: .02em;
    transition: color .3s;
}
body.customers.register .rg-f > label,
body.customers.register.theme-dark .rg-f > label { color: rgba(255,255,255,.6); }
.rg-f .rg-req { color: #f87171; margin-right: 2px; }
.rg-iw { position: relative; }
.rg-f .form-control,
.rg-f select.form-control {
    width: 100% !important; height: 46px !important; padding: 0 14px !important;
    border-radius: 11px !important;
    font-size: 14px !important;
    font-family: 'Inter', sans-serif !important;
    outline: none !important; box-shadow: none !important;
    -webkit-appearance: none;
    transition: border-color .18s, background .18s, box-shadow .18s, color .18s !important;
}
body.customers.register .rg-f .form-control,
body.customers.register .rg-f select.form-control,
body.customers.register.theme-dark .rg-f .form-control,
body.customers.register.theme-dark .rg-f select.form-control {
    background: #3d1b6d !important;
    border: 1px solid rgba(255,255,255,.12) !important;
    color: #fff !important;
}
body.customers.register .rg-f .form-control::placeholder,
body.customers.register.theme-dark .rg-f .form-control::placeholder { color: rgba(255,255,255,.2) !important; font-size: 13px !important; }
body.customers.register .rg-f .form-control:focus,
body.customers.register.theme-dark .rg-f .form-control:focus {
    border-color: rgba(167,139,250,.6) !important;
    background: rgba(255,255,255,.1) !important;
    box-shadow: 0 0 0 3px rgba(89,20,176,.2) !important;
}
body.customers.register .rg-f select.form-control option,
body.customers.register.theme-dark .rg-f select.form-control option { background: #1a0535; color: #fff; }
.rg-f .form-error, .rg-f p.help-block { font-size: 12px; color: #f87171; margin: 4px 0 0; display: block; }

/* password eye */
.rg-pw { position: relative; }
.rg-pw .form-control { padding-right: 44px !important; }
.rg-eye {
    position: absolute; right: 13px; top: 50%; transform: translateY(-50%);
    background: none; border: none; cursor: pointer; padding: 0;
    display: flex; align-items: center; z-index: 5;
    transition: color .18s;
}
.rg-eye svg { width: 17px; height: 17px; }
body.customers.register .rg-eye,
body.customers.register.theme-dark .rg-eye { color: rgba(255,255,255,.3); }
body.customers.register .rg-eye:hover,
body.customers.register.theme-dark .rg-eye:hover { color: rgba(255,255,255,.8); }

/* ── Terms (dark) ── */
.rg-terms {
    border-radius: 14px; padding: 16px 20px; margin-bottom: 20px;
    transition: background .3s, border-color .3s;
}
body.customers.register .rg-terms,
body.customers.register.theme-dark .rg-terms {
    background: rgba(255,193,7,.05);
    border: 1px solid rgba(255,193,7,.18);
}
.rg-terms-row { display: flex; align-items: flex-start; gap: 12px; }
.rg-terms-row input[type="checkbox"] { width: 17px; height: 17px; margin-top: 2px; accent-color: #5914b0; cursor: pointer; flex-shrink: 0; }
.rg-terms-row label { font-size: 14px; cursor: pointer; margin: 0; line-height: 1.6; transition: color .3s; }
body.customers.register .rg-terms-row label,
body.customers.register.theme-dark .rg-terms-row label { color: rgba(255,255,255,.7); }
.rg-terms-row label a { color: #ffc107; font-weight: 600; text-decoration: none; }
.rg-terms-row label a:hover { text-decoration: underline; }
.rg-terms-err { font-size: 12px; color: #f87171; margin: 6px 0 0 29px; }

/* ── reCAPTCHA ── */
.rg-recaptcha { margin-bottom: 20px; }

/* ── Honeypot ── */
.honey-element { display: none !important; }

/* ── Submit Bar (dark) ── */
.rg-submit-bar {
    display: flex; align-items: center; justify-content: space-between; gap: 16px;
    border-radius: 18px; padding: 20px 28px;
    transition: background .3s, border-color .3s, box-shadow .3s;
}
body.customers.register .rg-submit-bar,
body.customers.register.theme-dark .rg-submit-bar {
    background: rgba(255,255,255,.06);
    backdrop-filter: blur(40px);
    -webkit-backdrop-filter: blur(40px);
    border: 1px solid rgba(255,255,255,.12);
    box-shadow: 0 1px 0 rgba(255,255,255,.1) inset, 0 20px 60px rgba(0,0,0,.3);
}
.rg-submit-note { font-size: 13px; line-height: 1.6; transition: color .3s; }
body.customers.register .rg-submit-note,
body.customers.register.theme-dark .rg-submit-note { color: rgba(255,255,255,.4); }
body.customers.register .rg-submit-note strong,
body.customers.register.theme-dark .rg-submit-note strong { color: rgba(255,255,255,.7); font-weight: 600; }

/* ── CTA Button ── */
.rg-btn {
    height: 50px; padding: 0 32px;
    background: #ffc107;
    color: #0a0a0a !important;
    border: none; border-radius: 13px;
    font-size: 15px; font-weight: 700;
    cursor: pointer; font-family: 'Inter', sans-serif;
    display: inline-flex; align-items: center; gap: 8px;
    white-space: nowrap; text-decoration: none;
    box-shadow: 0 4px 20px rgba(255,193,7,.45), 0 1px 0 rgba(255,255,255,.35) inset;
    transition: transform .14s, box-shadow .14s, background .14s;
}
.rg-btn:hover {
    background: #ffca28 !important;
    transform: translateY(-1px);
    box-shadow: 0 8px 32px rgba(255,193,7,.55), 0 1px 0 rgba(255,255,255,.35) inset !important;
    color: #0a0a0a !important;
}
.rg-btn:active { transform: translateY(0); }
.rg-btn svg { width: 16px; height: 16px; }

/* ── Custom Fields (dark) ── */
body.customers.register .register-contact-custom-fields .form-group,
body.customers.register .register-company-custom-fields .form-group,
body.customers.register.theme-dark .register-contact-custom-fields .form-group,
body.customers.register.theme-dark .register-company-custom-fields .form-group { margin-bottom: 14px !important; }

body.customers.register .register-contact-custom-fields label,
body.customers.register .register-company-custom-fields label,
body.customers.register.theme-dark .register-contact-custom-fields label,
body.customers.register.theme-dark .register-company-custom-fields label {
    font-size: 12px !important; font-weight: 600 !important;
    color: rgba(255,255,255,.6) !important; margin-bottom: 6px !important;
}

body.customers.register .bootstrap-select .dropdown-toggle,
body.customers.register.theme-dark .bootstrap-select .dropdown-toggle {
    background: #3d1b6d !important;
    border: 1px solid #6b46c1 !important;
    color: #fff !important;
}
body.customers.register .bootstrap-select .filter-option,
body.customers.register.theme-dark .bootstrap-select .filter-option { color: #fff !important; }

body.customers.register .register-contact-custom-fields .form-control,
body.customers.register .register-company-custom-fields .form-control,
body.customers.register.theme-dark .register-contact-custom-fields .form-control,
body.customers.register.theme-dark .register-company-custom-fields .form-control {
    background: #3d1b6d !important;
    border: 1px solid #6b46c1 !important;
    color: #fff !important;
    font-family: 'Inter', sans-serif !important;
    height: 46px !important; padding: 0 14px !important; font-size: 14px !important;
}

body.customers.register .register-company-custom-fields input,
body.customers.register .register-company-custom-fields select,
body.customers.register .register-company-custom-fields textarea,
body.customers.register.theme-dark .register-company-custom-fields input,
body.customers.register.theme-dark .register-company-custom-fields select,
body.customers.register.theme-dark .register-company-custom-fields textarea {
    background: #3d1b6d !important;
    border: 1px solid #6b46c1 !important;
    color: #fff !important;
}

/* ── Subdomain / slug field (dark) — unified with other inputs ── */
body.customers.register .slug.form-control,
body.customers.register.theme-dark .slug.form-control {
    background: #3d1b6d !important;
    border: 1px solid rgba(255,255,255,.12) !important;
    color: #ffffff !important;
    height: 46px !important;
    border-radius: 11px !important;
    font-size: 14px !important;
    font-family: 'Inter', sans-serif !important;
    padding: 0 14px !important;
    box-shadow: none !important;
    outline: none !important;
    width: 100% !important;
    transition: border-color .18s, background .18s, box-shadow .18s !important;
}
body.customers.register .slug.form-control::placeholder,
body.customers.register.theme-dark .slug.form-control::placeholder { color: rgba(255,255,255,.25) !important; }
body.customers.register .slug.form-control:focus,
body.customers.register.theme-dark .slug.form-control:focus {
    border-color: rgba(167,139,250,.6) !important;
    background: rgba(255,255,255,.1) !important;
    box-shadow: 0 0 0 3px rgba(89,20,176,.2) !important;
}

body.customers.register .register-country-group,
body.customers.register.theme-dark .register-country-group { width: 150px !important; margin: 0 auto !important; }
body.customers.register .register-country-group .bootstrap-select,
body.customers.register .register-country-group .form-control,
body.customers.register.theme-dark .register-country-group .bootstrap-select,
body.customers.register.theme-dark .register-country-group .form-control { width: 100% !important; }
body.customers.register .register-country-group .bootstrap-select .dropdown-toggle,
body.customers.register.theme-dark .register-country-group .bootstrap-select .dropdown-toggle { border: none !important; box-shadow: none !important; }

body.customers.register .register-company-custom-fields .form-control,
body.customers.register .register-company-custom-fields input,
body.customers.register .register-company-custom-fields select,
body.customers.register .register-company-custom-fields textarea,
body.customers.register.theme-dark .register-company-custom-fields .form-control,
body.customers.register.theme-dark .register-company-custom-fields input,
body.customers.register.theme-dark .register-company-custom-fields select,
body.customers.register.theme-dark .register-company-custom-fields textarea {
    width: 100% !important; height: 46px !important;
    background: #3d1b6d !important;
    border: 1px solid rgba(255,255,255,.12) !important;
    border-radius: 11px !important;
    color: #fff !important; padding: 0 14px !important; box-shadow: none !important;
}

body.customers.register .register-company-custom-fields .bootstrap-select .dropdown-toggle,
body.customers.register.theme-dark .register-company-custom-fields .bootstrap-select .dropdown-toggle {
    height: 46px !important; background: #3d1b6d !important;
    border: 1px solid rgba(255,255,255,.12) !important;
    border-radius: 11px !important; color: #fff !important;
}

body.customers.register .register-company-custom-fields .form-group,
body.customers.register .register-company-custom-fields .bootstrap-select,
body.customers.register .register-company-custom-fields .dropdown-toggle,
body.customers.register .register-company-custom-fields .slug,
body.customers.register .register-company-custom-fields input[type="text"],
body.customers.register.theme-dark .register-company-custom-fields .form-group,
body.customers.register.theme-dark .register-company-custom-fields .bootstrap-select,
body.customers.register.theme-dark .register-company-custom-fields .dropdown-toggle,
body.customers.register.theme-dark .register-company-custom-fields .slug,
body.customers.register.theme-dark .register-company-custom-fields input[type="text"] {
    background: #3d1b6d !important; color: #fff !important;
    border: 1px solid rgba(255,255,255,.12) !important;
    border-radius: 11px !important; height: 46px !important; box-shadow: none !important;
}

body.customers.register #rg-language,
body.customers.register.theme-dark #rg-language { color: #fff !important; }
body.customers.register #rg-language option,
body.customers.register.theme-dark #rg-language option { color: #fff !important; background: #2d1454 !important; }

/* ═══════════════════════════════════════════════
   LIGHT THEME
═══════════════════════════════════════════════ */
body.customers.register.theme-light {
    background: #ffffff !important;
}

/* Hide ALL blobs/animated background in light mode */
body.customers.register.theme-light .rg-bg { display: none !important; }
body.customers.register.theme-light .rg-blob { display: none !important; }

/* Topbar */
body.customers.register.theme-light .rg-topbar {
    background: #ffffff;
    border: 1px solid #e5e1f0;
    box-shadow: 0 4px 24px rgba(89,20,176,.08), 0 1px 3px rgba(0,0,0,.06);
    backdrop-filter: none;
    -webkit-backdrop-filter: none;
}

/* Language select */
body.customers.register.theme-light .rg-lang { color: #5914b0 !important; }
body.customers.register.theme-light .rg-lang option { background: #fff; color: #1a0535; }
body.customers.register.theme-light .rg-lang-arrow { color: #5914b0; }

/* Login btn */
body.customers.register.theme-light .rg-login-btn {
    background: #f3eeff;
    border: 1px solid #d8ccf5 !important;
    color: #5914b0 !important;
}
body.customers.register.theme-light .rg-login-btn:hover {
    background: #ede5ff;
    border-color: #b89cf0 !important;
    color: #3d1b6d !important;
}

/* Moon toggle button — light theme */
body.customers.register.theme-light .rg-theme-btn {
    color: #5914b0;
}
body.customers.register.theme-light .rg-theme-btn:hover {
    background: rgba(89,20,176,.07);
    color: #3d1b6d;
}

/* Main */
body.customers.register.theme-light .rg-main { position: relative; z-index: 10; }

/* Header */
body.customers.register.theme-light .rg-header-badge {
    background: rgba(251,191,36,.12);
    border: 1px solid rgba(251,191,36,.35);
    color: #b45309;
}
body.customers.register.theme-light .rg-header h1 { color: #12062b; }
body.customers.register.theme-light .rg-header p { color: #6b7280; }

/* Steps */
body.customers.register.theme-light .rg-steps {
    background: #ffffff;
    border: 1px solid #e5e1f0;
    box-shadow: 0 2px 12px rgba(89,20,176,.06);
    backdrop-filter: none;
}
body.customers.register.theme-light .rg-step-active .rg-step-num {
    background: #fbbf24; color: #0a0a0a;
    box-shadow: 0 0 0 3px rgba(251,191,36,.22);
}
body.customers.register.theme-light .rg-step-active .rg-step-label { color: #b45309; }
body.customers.register.theme-light .rg-step-done .rg-step-num   { background: #16a34a; color: #fff; }
body.customers.register.theme-light .rg-step-done .rg-step-label  { color: #166534; }
body.customers.register.theme-light .rg-step-pending .rg-step-num {
    background: #f3eeff;
    color: #a78bfa;
    border: 1px solid #d8ccf5;
}
body.customers.register.theme-light .rg-step-pending .rg-step-label { color: #a78bfa; }
body.customers.register.theme-light .rg-step-line { background: #e5e1f0; }

/* Alerts */
body.customers.register.theme-light .rg-alerts .alert-danger  { background: #fef2f2; color: #991b1b; border-left: 3px solid #ef4444; }
body.customers.register.theme-light .rg-alerts .alert-success { background: #f0fdf4; color: #166534; border-left: 3px solid #22c55e; }
body.customers.register.theme-light .rg-alerts .alert-warning { background: #fffbeb; color: #92400e; border-left: 3px solid #fbbf24; }
body.customers.register.theme-light .rg-validation-error     { background: #fef2f2; color: #991b1b; border-left: 3px solid #ef4444; }

/* Cards */
body.customers.register.theme-light .rg-card {
    background: #ffffff;
    border: 1px solid #e5e1f0;
    box-shadow: 0 2px 16px rgba(89,20,176,.07), 0 1px 4px rgba(0,0,0,.04);
    backdrop-filter: none;
    -webkit-backdrop-filter: none;
}
body.customers.register.theme-light .rg-card-head { border-bottom: 1px solid #f0ebff; }
body.customers.register.theme-light .rg-card-icon {
    background: linear-gradient(135deg, rgba(89,20,176,.1), rgba(124,58,237,.08));
    border: 1px solid rgba(124,58,237,.2);
    color: #7c3aed;
}
body.customers.register.theme-light .rg-card-title { color: #12062b; }
body.customers.register.theme-light .rg-card-sub   { color: #9ca3af; }

/* Field labels */
body.customers.register.theme-light .rg-f > label { color: #374151; }
body.customers.register.theme-light .rg-f .rg-req { color: #dc2626; }

/* Inputs */
body.customers.register.theme-light .rg-f .form-control,
body.customers.register.theme-light .rg-f select.form-control {
    background: #ffffff !important;
    border: 1px solid #d1c4f0 !important;
    color: #12062b !important;
}
body.customers.register.theme-light .rg-f .form-control::placeholder { color: #9ca3af !important; font-size: 13px !important; }
body.customers.register.theme-light .rg-f .form-control:focus {
    border-color: #7c3aed !important;
    background: #fcf9ff !important;
    box-shadow: 0 0 0 3px rgba(124,58,237,.12) !important;
}
body.customers.register.theme-light .rg-f select.form-control option { background: #fff; color: #12062b; }

/* Password eye */
body.customers.register.theme-light .rg-eye { color: #9ca3af; }
body.customers.register.theme-light .rg-eye:hover { color: #5914b0; }

/* Terms */
body.customers.register.theme-light .rg-terms {
    background: #fffcf0;
    border: 1px solid rgba(251,191,36,.3);
}
body.customers.register.theme-light .rg-terms-row label { color: #374151; }
body.customers.register.theme-light .rg-terms-row label a { color: #b45309; }
body.customers.register.theme-light .rg-terms-row input[type="checkbox"] { accent-color: #7c3aed; }

/* Submit bar */
body.customers.register.theme-light .rg-submit-bar {
    background: #ffffff;
    border: 1px solid #e5e1f0;
    box-shadow: 0 2px 16px rgba(89,20,176,.07);
    backdrop-filter: none;
    -webkit-backdrop-filter: none;
}
body.customers.register.theme-light .rg-submit-note { color: #6b7280; }
body.customers.register.theme-light .rg-submit-note strong { color: #374151; }

/* CTA button — yellow in both themes */
body.customers.register.theme-light .rg-btn {
    background: #fbbf24;
    color: #0a0a0a !important;
    box-shadow: 0 4px 18px rgba(251,191,36,.45), 0 1px 0 rgba(255,255,255,.45) inset;
}
body.customers.register.theme-light .rg-btn:hover {
    background: #f59e0b !important;
    box-shadow: 0 8px 28px rgba(251,191,36,.55) !important;
    color: #0a0a0a !important;
}

/* Custom fields — light */
body.customers.register.theme-light .register-contact-custom-fields label,
body.customers.register.theme-light .register-company-custom-fields label { color: #374151 !important; }

body.customers.register.theme-light .register-contact-custom-fields .form-control,
body.customers.register.theme-light .register-company-custom-fields .form-control,
body.customers.register.theme-light .register-company-custom-fields input,
body.customers.register.theme-light .register-company-custom-fields select,
body.customers.register.theme-light .register-company-custom-fields textarea {
    background: #ffffff !important;
    border: 1px solid #d1c4f0 !important;
    color: #12062b !important;
}

body.customers.register.theme-light .bootstrap-select .dropdown-toggle {
    background: #ffffff !important;
    border: 1px solid #d1c4f0 !important;
    color: #12062b !important;
}
body.customers.register.theme-light .bootstrap-select .filter-option { color: #12062b !important; }

body.customers.register.theme-light .register-company-custom-fields .bootstrap-select .dropdown-toggle {
    background: #ffffff !important;
    border: 1px solid #d1c4f0 !important;
    color: #12062b !important;
}

body.customers.register.theme-light .register-company-custom-fields .form-group,
body.customers.register.theme-light .register-company-custom-fields .bootstrap-select,
body.customers.register.theme-light .register-company-custom-fields .dropdown-toggle,
body.customers.register.theme-light .register-company-custom-fields .slug,
body.customers.register.theme-light .register-company-custom-fields input[type="text"] {
    background: #ffffff !important;
    color: #12062b !important;
    border: 1px solid #d1c4f0 !important;
}

/* Subdomain / slug — light theme */
body.customers.register.theme-light .slug.form-control {
    background: #ffffff !important;
    border: 1px solid #d1c4f0 !important;
    color: #12062b !important;
    height: 46px !important;
    border-radius: 11px !important;
    font-size: 14px !important;
    font-family: 'Inter', sans-serif !important;
    padding: 0 14px !important;
    box-shadow: none !important;
    outline: none !important;
    width: 100% !important;
}
body.customers.register.theme-light .slug.form-control::placeholder { color: #9ca3af !important; }
body.customers.register.theme-light .slug.form-control:focus {
    border-color: #7c3aed !important;
    background: #fcf9ff !important;
    box-shadow: 0 0 0 3px rgba(124,58,237,.12) !important;
}

body.customers.register.theme-light #rg-language { color: #5914b0 !important; }
body.customers.register.theme-light #rg-language option { color: #1a0535 !important; background: #fff !important; }

/* ═══════════════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════════════ */
@media (max-width: 700px) {
    .rg-grid { grid-template-columns: 1fr; }
    .rg-full { grid-column: 1; }
    .rg-submit-bar { flex-direction: column; align-items: stretch; }
    .rg-btn { width: 100%; justify-content: center; }
    .rg-main { padding: 24px 16px 48px; }
    .rg-card { padding: 20px 18px; }
    .rg-topbar { padding: 12px 16px; }
    .rg-topbar-logo img { height: 28px; }
}

@media (max-width: 480px) {
    .rg-steps { padding: 12px 16px; }
    .rg-step-label { font-size: 11px; }
    .rg-step-num { width: 26px; height: 26px; font-size: 11px; }
    .rg-header h1 { font-size: 24px; }
    .rg-topbar-right { gap: 10px; }
}

@media (min-width: 701px) and (max-width: 900px) {
    .rg-main { padding: 28px 20px 48px; }
}
</style>

<!-- Background blobs (hidden in light mode via CSS) -->
<div class="rg-bg">
    <div class="rg-blob rg-blob-1"></div>
    <div class="rg-blob rg-blob-2"></div>
    <div class="rg-blob rg-blob-3"></div>
</div>

<!-- ══════════════════════════
     STICKY TOPBAR — single header for both themes
══════════════════════════ -->
<div class="rg-topbar-wrap">
<div class="rg-topbar">
    <div class="rg-topbar-logo">
        <img src="https://mingrow.cloud/uploads/company/light-logo.png" alt="Mingrow" id="rg-logo-img">
    </div>
    <div class="rg-topbar-right">

        <!-- Language Switcher -->
        <?php if (! is_language_disabled()) { ?>
        <div class="rg-lang-wrap">
            <select name="language" id="rg-language" class="rg-lang"
                    onchange="change_contact_language(this)">
                <?php $selected = (get_contact_language() != '') ? get_contact_language() : get_option('active_language'); ?>
                <?php foreach ($this->app->get_available_languages() as $availableLanguage) { ?>
                <option value="<?= e($availableLanguage); ?>" <?= ($availableLanguage == $selected) ? 'selected' : ''; ?>>
                    <?= e(ucfirst($availableLanguage)); ?>
                </option>
                <?php } ?>
            </select>
            <!-- Visible dropdown arrow -->
            <span class="rg-lang-arrow" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                </svg>
            </span>
        </div>
        <?php } ?>

        <!-- Theme Toggle — moon icon only, no track, no label -->
        <button class="rg-theme-btn" id="rg-theme-toggle" aria-label="Toggle theme" title="Toggle light/dark mode" type="button">
            <!-- Moon icon — always shown, color changes per theme -->
            <svg id="rg-moon-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z" clip-rule="evenodd"/>
            </svg>
        </button>

        <!-- Sign In Button -->
        <a href="<?= site_url('authentication/login'); ?>" class="rg-login-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 015.25 2h5.5A2.25 2.25 0 0113 4.25v2a.75.75 0 01-1.5 0v-2a.75.75 0 00-.75-.75h-5.5a.75.75 0 00-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 00.75-.75v-2a.75.75 0 011.5 0v2A2.25 2.25 0 0110.75 18h-5.5A2.25 2.25 0 013 15.75V4.25z" clip-rule="evenodd"/>
                <path fill-rule="evenodd" d="M6 10a.75.75 0 01.75-.75h9.546l-1.048-.943a.75.75 0 111.004-1.114l2.5 2.25a.75.75 0 010 1.114l-2.5 2.25a.75.75 0 11-1.004-1.114l1.048-.943H6.75A.75.75 0 016 10z" clip-rule="evenodd"/>
            </svg>
            Sign In
        </a>
    </div>
</div>
</div><!-- /rg-topbar-wrap -->

<!-- ══════════════════════════
     MAIN
══════════════════════════ -->
<div class="rg-main">

    <!-- Page Header -->
    <div class="rg-header">
        <div class="rg-header-badge">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
            </svg>
            Create Account
        </div>
        <h1><?= _l('clients_register_heading'); ?></h1>
        <p>Fill in the details below to get started with Mingrow.</p>
    </div>

    <!-- Progress Steps -->
    <div class="rg-steps">
        <div class="rg-step rg-step-active">
            <span class="rg-step-num">1</span>
            <span class="rg-step-label">Contact Info</span>
        </div>
        <div class="rg-step-line"></div>
        <div class="rg-step rg-step-active">
            <span class="rg-step-num">2</span>
            <span class="rg-step-label">Company Info</span>
        </div>
        <div class="rg-step-line"></div>
        <div class="rg-step rg-step-pending">
            <span class="rg-step-num">3</span>
            <span class="rg-step-label">Done</span>
        </div>
    </div>

    <!-- Alerts -->
    <div class="rg-alerts">
        <?php get_template_part('alerts'); ?>
    </div>

    <?= form_open('authentication/register', ['id' => 'register-form']); ?>

    <?php if (validation_errors()): ?>
    <div class="rg-validation-error">
        <?= validation_errors(); ?>
    </div>
    <?php endif; ?>

    <!-- ════════════════════════════
         CARD 1 — CONTACT INFO
    ════════════════════════════ -->
    <div class="rg-card">
        <div class="rg-card-head">
            <span class="rg-card-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                </svg>
            </span>
            <div>
                <p class="rg-card-title"><?= _l('client_register_contact_info'); ?></p>
                <p class="rg-card-sub">Your personal contact details</p>
            </div>
        </div>

        <div class="rg-grid">

            <!-- First name -->
            <div class="rg-f register-firstname-group">
                <label for="<?= e($fields['firstname']); ?>">
                    <span class="rg-req">*</span><?= _l('clients_firstname'); ?>
                </label>
                <div class="rg-iw">
                    <input type="text" class="form-control"
                           name="<?= e($fields['firstname']); ?>"
                           id="<?= e($fields['firstname']); ?>"
                           placeholder="First name"
                           value="<?= set_value($fields['firstname']); ?>">
                    <?= form_error($fields['firstname']); ?>
                </div>
            </div>

            <!-- Last name -->
            <div class="rg-f register-lastname-group">
                <label for="<?= e($fields['lastname']); ?>">
                    <span class="rg-req">*</span><?= _l('clients_lastname'); ?>
                </label>
                <div class="rg-iw">
                    <input type="text" class="form-control"
                           name="<?= e($fields['lastname']); ?>"
                           id="<?= e($fields['lastname']); ?>"
                           placeholder="Last name"
                           value="<?= set_value($fields['lastname']); ?>">
                    <?= form_error($fields['lastname']); ?>
                </div>
            </div>

            <!-- Email -->
            <div class="rg-f register-email-group rg-full">
                <label for="<?= e($fields['email']); ?>">
                    <span class="rg-req">*</span><?= _l('clients_email'); ?>
                </label>
                <div class="rg-iw">
                    <input type="email" class="form-control"
                           name="<?= e($fields['email']); ?>"
                           id="<?= e($fields['email']); ?>"
                           placeholder="you@company.com"
                           value="<?= set_value($fields['email']); ?>">
                    <?= form_error($fields['email']); ?>
                </div>
            </div>

            <!-- Phone -->
            <div class="rg-f register-contact-phone-group">
                <label for="contact_phonenumber">
                    <?php if ($requiredFields['contact']['contact_contact_phonenumber']['is_required']) { ?><span class="rg-req">*</span><?php } ?>
                    <?= _l('clients_phone'); ?>
                </label>
                <div class="rg-iw">
                    <input type="text" class="form-control" name="contact_phonenumber" id="contact_phonenumber"
                           placeholder="+1 234 567 8900"
                           value="<?= set_value('contact_phonenumber'); ?>">
                    <?= form_error('contact_phonenumber'); ?>
                </div>
            </div>

            <!-- Position -->
            <div class="rg-f register-position-group">
                <label for="title">
                    <?php if ($requiredFields['contact']['contact_title']['is_required']) { ?><span class="rg-req">*</span><?php } ?>
                    <?= _l('contact_position'); ?>
                </label>
                <div class="rg-iw">
                    <input type="text" class="form-control" name="title" id="title"
                           placeholder="e.g. CEO, Manager"
                           value="<?= set_value('title'); ?>">
                    <?= form_error('title'); ?>
                </div>
            </div>

            <!-- Password -->
            <div class="rg-f register-password-group">
                <label for="rg-pw">
                    <span class="rg-req">*</span><?= _l('clients_register_password'); ?>
                </label>
                <div class="rg-iw rg-pw">
                    <input type="password" class="form-control" name="password" id="rg-pw"
                           placeholder="New password">
                    <button type="button" class="rg-eye" onclick="rgEye('rg-pw',this)">
                        <svg id="rg-eye-rg-pw" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </button>
                    <?= form_error('password'); ?>
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="rg-f register-password-repeat-group">
                <label for="rg-pwr">
                    <span class="rg-req">*</span><?= _l('clients_register_password_repeat'); ?>
                </label>
                <div class="rg-iw rg-pw">
                    <input type="password" class="form-control" name="passwordr" id="rg-pwr"
                           placeholder="Confirm password">
                    <button type="button" class="rg-eye" onclick="rgEye('rg-pwr',this)">
                        <svg id="rg-eye-rg-pwr" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </button>
                    <?= form_error('passwordr'); ?>
                </div>
            </div>

        </div><!-- /rg-grid -->

        <!-- Contact custom fields -->
        <div class="register-contact-custom-fields" style="margin-top:16px;">
            <?= render_custom_fields('contacts', '', ['show_on_client_portal' => 1]); ?>
        </div>
    </div><!-- /card 1 -->

    <!-- ════════════════════════════
         CARD 2 — COMPANY INFO
    ════════════════════════════ -->
    <div class="rg-card">
        <div class="rg-card-head">
            <span class="rg-card-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/>
                </svg>
            </span>
            <div>
                <p class="rg-card-title"><?= _l('client_register_company_info'); ?></p>
                <p class="rg-card-sub">Your organization's billing details</p>
            </div>
        </div>

        <div class="rg-grid">

            <!-- Company -->
            <div class="rg-f register-company-group rg-full">
                <label for="<?= e($fields['company']); ?>">
                    <?php if (get_option('company_is_required') == 1) { ?><span class="rg-req">*</span><?php } ?>
                    <?= _l('clients_company'); ?>
                </label>
                <div class="rg-iw">
                    <input type="text" class="form-control"
                           name="<?= e($fields['company']); ?>"
                           id="<?= e($fields['company']); ?>"
                           placeholder="Acme Inc."
                           value="<?= set_value($fields['company']); ?>">
                    <?= form_error($fields['company']); ?>
                </div>
            </div>

            <?php if (get_option('company_requires_vat_number_field') == 1) { ?>
            <!-- VAT -->
            <div class="rg-f register-vat-group">
                <label for="vat">
                    <?php if (isset($requiredFields['company']['company_vat']) && $requiredFields['company']['company_vat']['is_required']) { ?>
                        <span class="rg-req">*</span>
                    <?php } ?>
                    <?= _l('clients_vat'); ?>
                </label>
                <div class="rg-iw">
                    <input type="text" class="form-control" name="vat" id="vat"
                           placeholder="VAT number"
                           value="<?= set_value('vat'); ?>">
                    <?= form_error('vat'); ?>
                </div>
            </div>
            <?php } ?>

            <!-- Country -->
            <div class="rg-f register-country-group">
                <label for="country">
                    <?php if ($requiredFields['company']['company_country']['is_required']) { ?><span class="rg-req">*</span><?php } ?>
                    <?= _l('clients_country'); ?>
                </label>
                <div class="rg-iw">
                    <select data-none-selected-text="<?= _l('dropdown_non_selected_tex'); ?>"
                            name="country" class="form-control" id="country">
                        <option value=""></option>
                        <?php foreach (get_all_countries() as $country) { ?>
                        <option value="<?= e($country['country_id']); ?>"
                            <?php if (get_option('customer_default_country') == $country['country_id']) { echo ' selected'; } ?>
                            <?= set_select('country', $country['country_id']); ?>>
                            <?= e($country['short_name']); ?>
                        </option>
                        <?php } ?>
                    </select>
                    <?= form_error('country'); ?>
                </div>
            </div>

        </div><!-- /rg-grid -->

        <!-- Company custom fields -->
        <div class="register-company-custom-fields" style="margin-top:16px;">
            <?= render_custom_fields('customers', '', ['show_on_client_portal' => 1]); ?>
        </div>
    </div><!-- /card 2 -->

    <!-- Honeypot -->
    <?php if ($honeypot) { ?>
    <label class="honey-element" for="firstname"></label>
    <input class="honey-element" autocomplete="off" type="text" id="firstname" name="firstname" placeholder="Your first name here">
    <label class="honey-element" for="lastname"></label>
    <input class="honey-element" autocomplete="off" type="text" id="lastname" name="lastname" placeholder="Your last name here">
    <label class="honey-element" for="email"></label>
    <input class="honey-element" autocomplete="off" type="email" id="email" name="email" placeholder="Your e-mail here">
    <label class="honey-element" for="company"></label>
    <input class="honey-element" autocomplete="off" type="text" id="company" name="company" placeholder="Your company here">
    <?php } ?>

    <!-- Terms & Conditions -->
    <?php if (is_gdpr() && get_option('gdpr_enable_terms_and_conditions') == 1) { ?>
    <div class="rg-terms register-terms-and-conditions-wrapper">
        <div class="rg-terms-row">
            <input type="checkbox" name="accept_terms_and_conditions" id="accept_terms_and_conditions"
                   <?= set_checkbox('accept_terms_and_conditions', 'on'); ?>>
            <label for="accept_terms_and_conditions">
                <?= _l('gdpr_terms_agree', terms_url()); ?>
            </label>
        </div>
        <p class="rg-terms-err"><?= form_error('accept_terms_and_conditions'); ?></p>
    </div>
    <?php } ?>

    <!-- reCAPTCHA -->
    <?php if (show_recaptcha_in_customers_area()) { ?>
    <div class="rg-recaptcha register-recaptcha">
        <div class="g-recaptcha" data-sitekey="<?= get_option('recaptcha_site_key'); ?>"></div>
        <?= form_error('g-recaptcha-response'); ?>
    </div>
    <?php } ?>

    <!-- Submit Bar -->
    <div class="rg-submit-bar">
        <p class="rg-submit-note">
            <strong>Fields marked <span style="color:#f87171;">*</span> are required.</strong><br>
            Your data is encrypted and protected.
        </p>
        <button type="submit" autocomplete="off"
                data-loading-text="<?= _l('wait_text'); ?>"
                class="rg-btn">
            <?= _l('clients_register_string'); ?>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd"/>
            </svg>
        </button>
    </div>

    <?= form_close(); ?>

</div><!-- /rg-main -->

<script>
/* ── Password Eye Toggle ── */
function rgEye(id, btn) {
    var inp  = document.getElementById(id);
    var icon = document.getElementById('rg-eye-' + id);
    if (inp.type === 'password') {
        inp.type = 'text';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>';
    } else {
        inp.type = 'password';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>';
    }
}

/* ── Theme Switcher ── */
(function () {
    var STORAGE_KEY = 'rg_theme';

    /* Logo URLs:
       Dark Theme  → light-logo.png  (light/white logo on dark background)
       Light Theme → dark-logo.png   (dark/coloured logo on white background)
    */
    var DARK_THEME_LOGO  = 'https://mingrow.cloud/uploads/company/light-logo.png';
    var LIGHT_THEME_LOGO = 'https://mingrow.cloud/uploads/company/dark-logo.png';

    var body    = document.body;
    var btn     = document.getElementById('rg-theme-toggle');
    var logo    = document.getElementById('rg-logo-img');
    var current = (localStorage.getItem(STORAGE_KEY) === 'light') ? 'light' : 'dark';

    function applyTheme(theme) {
        if (theme === 'light') {
            body.classList.remove('theme-dark');
            body.classList.add('theme-light');
            if (logo) logo.src = LIGHT_THEME_LOGO;
        } else {
            body.classList.remove('theme-light');
            body.classList.add('theme-dark');
            if (logo) logo.src = DARK_THEME_LOGO;
        }
        current = theme;
        localStorage.setItem(STORAGE_KEY, theme);
    }

    /* Apply saved or default theme on load */
    applyTheme(current);

    /* Toggle on click */
    if (btn) {
        btn.addEventListener('click', function () {
            applyTheme(current === 'dark' ? 'light' : 'dark');
        });
    }
})();
</script>
