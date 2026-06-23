<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en" dir="<?php echo is_rtl() ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo e(get_option('companyname')); ?> &mdash; <?php echo _l('admin_auth_login_heading'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <?php echo app_compile_css('admin-auth'); ?>
    <style>
    /* ================================================================
       MINGROW ADMIN AUTH — APPLE LIQUID GLASS DESIGN
       Primary #5914b0 | Accent #ffc107
    ================================================================ */

    /* === HARD RESET: Override every admin CSS font override === */
    html, body.auth-page,
    body.auth-page > *,
    body.auth-page * {
        box-sizing: border-box;
    }
    html { font-size: 16px !important; }
    body.auth-page {
        font-family: -apple-system, BlinkMacSystemFont, 'Inter', 'Segoe UI', sans-serif !important;
        font-size: 16px !important;
        margin: 0 !important;
        padding: 0 !important;
        overflow: hidden !important;
        width: 100% !important;
        height: 100% !important;
        -webkit-font-smoothing: antialiased !important;
        -moz-osx-font-smoothing: grayscale !important;
        background: #060011 !important;
    }

    /* === ANIMATED BACKGROUND === */
    .ag-bg {
        position: fixed;
        inset: 0;
        z-index: 0;
        background: linear-gradient(130deg, #060011 0%, #12022f 35%, #1f0550 60%, #2a0769 100%);
        overflow: hidden;
    }

    /* Animated color blobs */
    .ag-blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        will-change: transform;
        animation: ag-blob-drift 25s ease-in-out infinite;
    }
    .ag-blob-1 {
        width: 700px; height: 700px;
        background: radial-gradient(circle, rgba(89,20,176,0.55), transparent 70%);
        top: -200px; left: -150px;
        animation-delay: 0s;
    }
    .ag-blob-2 {
        width: 550px; height: 550px;
        background: radial-gradient(circle, rgba(124,58,237,0.45), transparent 70%);
        bottom: -150px; right: -100px;
        animation-delay: -8s;
        animation-duration: 20s;
    }
    .ag-blob-3 {
        width: 350px; height: 350px;
        background: radial-gradient(circle, rgba(255,193,7,0.12), transparent 70%);
        top: 40%; left: 40%;
        animation-delay: -16s;
        animation-duration: 30s;
    }
    .ag-blob-4 {
        width: 450px; height: 450px;
        background: radial-gradient(circle, rgba(61,11,122,0.4), transparent 70%);
        top: 60%; left: -100px;
        animation-delay: -5s;
        animation-duration: 22s;
    }

    @keyframes ag-blob-drift {
        0%, 100% { transform: translate(0, 0) scale(1); }
        25%       { transform: translate(40px, -40px) scale(1.05); }
        50%       { transform: translate(-20px, 30px) scale(0.95); }
        75%       { transform: translate(20px, -10px) scale(1.02); }
    }

    /* Subtle noise layer */
    .ag-bg::after {
        content: '';
        position: absolute;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
        opacity: 0.5;
        pointer-events: none;
    }

    /* === LAYOUT ROOT === */
    .ag-root {
        position: fixed;
        inset: 0;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        overflow-y: auto;
    }

    .ag-container {
    width: 100%;
    max-width: 1180px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 6rem;
    animation: ag-enter 0.7s cubic-bezier(0.22, 1, 0.36, 1) both;
}

    @keyframes ag-enter {
        from { opacity: 0; transform: translateY(28px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* === LEFT BRAND PANEL (floating over background) === */
    .ag-brand {
    flex: 1;
    min-width: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    max-width: 500px;
    padding-left: 20px;
}

    .ag-brand-logo {
        margin-bottom: 2rem;
    }
    .ag-brand-logo img{
    max-height:70px;
    width:auto;
}

    .ag-brand-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 193, 7, 0.12);
        border: 1px solid rgba(255, 193, 7, 0.35);
        color: #ffc107;
        font-size: 11px !important;
        font-weight: 700;
        padding: 5px 14px;
        border-radius: 100px;
        margin-bottom: 1.75rem;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        font-family: inherit !important;
      width: fit-content;
    }

    .ag-brand-heading {
        font-size: 58px !important;
        font-weight: 800;
        color: #ffffff;
        line-height: 1.1;
        margin: 0 0 16px 0;
        letter-spacing: -1.5px;
        font-family: inherit !important;
    }

    .ag-brand-heading .ag-gold {
        background: linear-gradient(120deg, #ffc107 0%, #ffab00 50%, #ff9f0a 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .ag-brand-sub {
        font-size: 16px !important;
        color: rgba(255, 255, 255, 0.5);
        margin: 0 0 2.5rem 0;
        line-height: 1.75;
        max-width: 460px;
        font-family: inherit !important;
    }

    .ag-feature-list {
        list-style: none;
        padding: 0; margin: 0;
        display: flex; flex-direction: column;
        gap: 14px;
    }

    .ag-feature-item {
        display: flex;
        align-items: center;
        gap: 14px;
        font-size: 15px !important;
        color: rgba(255, 255, 255, 0.7);
        font-family: inherit !important;
    }

    .ag-feature-icon {
        width: 36px; height: 36px;
        background: rgba(255, 255, 255, 0.07);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        color: #ffc107;
        backdrop-filter: blur(10px);
    }
    .ag-feature-icon svg { width: 17px; height: 17px; }

    /* === GLASS CARD === */
   .ag-glass{
    flex:0 0 520px;
    position:relative;
    padding:48px;
    border-radius:32px;

    background:rgba(91,20,176,.18);

    backdrop-filter:blur(40px);
    -webkit-backdrop-filter:blur(40px);

    border:1px solid transparent;

    overflow:hidden;

    box-shadow:
        0 0 60px rgba(168,85,247,.15),
        0 30px 80px rgba(0,0,0,.45);
}
.ag-glass:before{
    content:"";
    position:absolute;
    inset:0;
    border-radius:32px;
    padding:1.5px;

    background:
        linear-gradient(
            135deg,
            rgba(255,255,255,.45),
            rgba(255,255,255,.08),
            rgba(168,85,247,.45)
        );

    -webkit-mask:
        linear-gradient(#fff 0 0) content-box,
        linear-gradient(#fff 0 0);

    -webkit-mask-composite:xor;
    mask-composite:exclude;

    pointer-events:none;
}

.ag-glass:after{
    content:"";
    position:absolute;
    inset:-1px;
    border-radius:32px;

    box-shadow:
        0 0 25px rgba(168,85,247,.35);

    pointer-events:none;
}

    /* === CARD TYPOGRAPHY === */
  .ag-card-heading{
    font-size:58px !important;
    font-weight:800 !important;
    color:#fff !important;
    margin-bottom:8px !important;
}

    .ag-card-sub {
        font-size: 15px !important;
        color: rgba(255, 255, 255, 0.45) !important;
        margin: 0 0 28px 0;
        font-family: inherit !important;
    }

    /* === GLASS FIELDS === */
    .ag-field {
        margin-bottom: 18px;
        position: relative;
    }

    .ag-field label,
    .ag-field > label {
        display: block;
        font-size: 13px !important;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.65) !important;
        margin-bottom: 8px !important;
        letter-spacing: 0.02em;
        font-family: inherit !important;
    }

    .ag-field .form-control,
.ag-field input[type="email"],
.ag-field input[type="password"],
.ag-field input[type="text"]{
    width:100%!important;
    height:56px!important;
    padding:0 18px!important;

    background:rgba(255,255,255,.08)!important;

    border:1px solid rgba(255,255,255,.12)!important;

    border-radius:16px!important;

    color:#fff!important;

    backdrop-filter:blur(15px)!important;
}

    .ag-field .form-control::placeholder,
    .ag-field input::placeholder {
        color: rgba(255, 255, 255, 0.25) !important;
    }

    .ag-field .form-control:focus,
    .ag-field input:focus {
        border-color: rgba(255, 193, 7, 0.55) !important;
        background: rgba(255, 255, 255, 0.11) !important;
        box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.10) !important;
    }

    /* Label + link row */
    .ag-label-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }
    .ag-label-row label { margin: 0 !important; }
    .ag-label-row a {
        font-size: 13px !important;
        color: rgba(255, 193, 7, 0.75) !important;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s;
        font-family: inherit !important;
    }
    .ag-label-row a:hover { color: #ffc107 !important; }

    /* Password wrapper */
    .ag-pw-wrap { position: relative; }
    .ag-pw-wrap .form-control,
    .ag-pw-wrap input { padding-right: 50px !important; }

    .ag-eye-btn{
    position:absolute;
    right:14px;
    top:50%;
    transform:translateY(-50%);

    background:none;
    border:none;

    color:rgba(255,255,255,.65) !important;

    cursor:pointer;
    z-index:999;

    display:flex;
    align-items:center;
    justify-content:center;
}

.ag-eye-btn:hover{
    color:#ffffff !important;
}

.ag-eye-btn svg{
    width:18px;
    height:18px;
    stroke:currentColor !important;
}
    .ag-eye-btn:hover { color: rgba(255, 255, 255, 0.8); }
    .ag-eye-btn svg { width: 18px; height: 18px; display: block; }

    /* Checkbox row */
    .ag-check-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 24px;
    }
    .ag-check-row input[type="checkbox"] {
        width: 17px; height: 17px;
        accent-color: #ffc107;
        cursor: pointer;
        flex-shrink: 0;
    }
    .ag-check-row label {
        font-size: 14px !important;
        color: rgba(255, 255, 255, 0.55) !important;
        cursor: pointer; margin: 0 !important;
        font-weight: 400;
        font-family: inherit !important;
    }

    /* === GLASS BUTTON === */
   .ag-btn,
.ag-btn.btn{
    width:100%!important;
    height:58px!important;
    border-radius:16px!important;
    border:none!important;

    background:linear-gradient(
    90deg,
    #f59e0b,
    #fbbf24,
    #fcd34d
)!important;
    color:#fff!important;
    font-size:17px!important;
    font-weight:700!important;

    box-shadow:
        0 12px 30px rgba(147,51,234,.35)!important;

    transition:all .25s ease!important;
}

.ag-btn:hover{
    transform:translateY(-2px)!important;
    box-shadow:
        0 18px 40px rgba(147,51,234,.45)!important;
}
    .ag-btn:active, .ag-btn.btn:active {
        transform: translateY(0) !important;
        box-shadow: 0 2px 12px rgba(89,20,176,0.4) !important;
    }

    /* === ALERTS === */
    .ag-alerts .alert {
        border-radius: 12px !important;
        font-size: 14px !important;
        padding: 12px 16px !important;
        margin-bottom: 20px !important;
        border: none !important;
        font-weight: 500 !important;
        font-family: inherit !important;
    }
    .ag-alerts .alert-danger {
        background: rgba(239, 68, 68, 0.15) !important;
        color: #fca5a5 !important;
        border-left: 3px solid rgba(239,68,68,0.6) !important;
    }
    .ag-alerts .alert-success {
        background: rgba(34, 197, 94, 0.12) !important;
        color: #86efac !important;
        border-left: 3px solid rgba(34,197,94,0.5) !important;
    }
    .ag-alerts .alert-warning {
        background: rgba(255, 193, 7, 0.12) !important;
        color: #fde047 !important;
        border-left: 3px solid rgba(255,193,7,0.5) !important;
    }
    .ag-alerts .alert-info {
        background: rgba(96, 165, 250, 0.12) !important;
        color: #93c5fd !important;
        border-left: 3px solid rgba(96,165,250,0.5) !important;
    }
    /* Validation errors */
    .ag-glass .alert-danger {
        background: rgba(239, 68, 68, 0.15) !important;
        color: #fca5a5 !important;
        border: none !important;
        border-left: 3px solid rgba(239,68,68,0.6) !important;
        border-radius: 10px !important;
        font-size: 13px !important;
        padding: 10px 14px !important;
        margin-bottom: 18px !important;
    }
      .ag-eye-btn,
.ag-eye-btn svg{
    color:#6b7280 !important;
    stroke:#6b7280 !important;
}

    /* reCAPTCHA */
    .ag-recaptcha { margin-bottom: 18px; }
    @media screen and (max-height: 575px) {
        #rc-imageselect, .g-recaptcha {
            transform: scale(0.83); -webkit-transform: scale(0.83);
            transform-origin: 0 0; -webkit-transform-origin: 0 0;
        }
    }

    /* Back link */
    .ag-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: rgba(255, 255, 255, 0.45) !important;
        font-size: 14px !important;
        text-decoration: none;
        margin-bottom: 22px;
        font-weight: 500;
        transition: color 0.2s;
        font-family: inherit !important;
    }
    .ag-back:hover { color: rgba(255,255,255,0.85) !important; }
    .ag-back svg { width: 15px; height: 15px; }

    /* Alt link */
    .ag-alt {
        text-align: center;
        margin-top: 20px;
        font-size: 14px !important;
        color: rgba(255, 255, 255, 0.4);
        font-family: inherit !important;
    }
    .ag-alt a {
        color: rgba(255, 193, 7, 0.85) !important;
        font-weight: 600;
        text-decoration: none;
        font-family: inherit !important;
    }
    .ag-alt a:hover { color: #ffc107 !important; }

    /* Divider */
    .ag-divider {
        display: flex; align-items: center; gap: 12px;
        color: rgba(255,255,255,0.2);
        font-size: 12px !important;
        margin: 14px 0;
        font-family: inherit !important;
    }
    .ag-divider::before, .ag-divider::after {
        content: ''; flex: 1; height: 1px;
        background: rgba(255,255,255,0.1);
    }

    /* OTP icon */
    .ag-otp-icon {
        width: 68px; height: 68px;
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.14);
        border-radius: 18px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px;
        color: #ffc107;
    }
    .ag-otp-icon svg { width: 34px; height: 34px; }

    /* Strength bar */
    .ag-strength {
        height: 3px; border-radius: 4px;
        background: rgba(255,255,255,0.1);
        margin-top: 8px; overflow: hidden;
    }
    .ag-strength-fill {
        height: 100%; border-radius: 4px;
        transition: width 0.35s, background 0.35s;
    }
      

    /* Info box on left panel */
    .ag-info-box {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.10);
        border-radius: 16px;
        padding: 20px 22px;
        margin-top: 24px;
        backdrop-filter: blur(10px);
    }
    .ag-info-box-title {
        font-size: 11px !important;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        font-weight: 700;
        color: rgba(255,255,255,0.35);
        margin: 0 0 14px 0;
        font-family: inherit !important;
    }
    .ag-info-row {
        display: flex; align-items: flex-start; gap: 10px;
        margin-bottom: 10px;
        font-size: 14px !important;
        color: rgba(255,255,255,0.65);
        font-family: inherit !important;
    }
    .ag-info-row:last-child { margin-bottom: 0; }
    .ag-info-step {
        width: 24px; height: 24px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 11px !important; font-weight: 800;
        flex-shrink: 0;
        font-family: inherit !important;
    }
    .ag-info-step-done { background: #ffc107; color: #0a0a0a; }
    .ag-info-step-pending { background: rgba(255,193,7,0.2); color: #ffc107; }

    /* Card header centered */
    .ag-card-center { text-align: center; }
      .ag-security-note{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;

    margin-top:18px;
    padding-top:14px;

    border-top:1px solid rgba(255,255,255,.08);

    color:rgba(255,255,255,.60);
    font-size:12px;
    text-align:center;
}

.ag-security-note svg{
    width:14px;
    height:14px;
    color:#fbbf24;
    flex-shrink:0;
}

    /* === RESPONSIVE === */
    /* ==========================
   MOBILE & TABLET
========================== */

@media (max-width: 960px) {

    .ag-container{
        flex-direction:column;
        justify-content:center;
        align-items:center;
        gap:28px;
        max-width:100%;
    }

    .ag-brand{
        display:flex !important;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        text-align:center;
        max-width:100%;
        padding:0;
        margin:0;
    }

    /* Show only logo + heading on mobile */
    .ag-feature-list{
        display:none;
    }

    .ag-brand-sub{
        display:none;
    }

    .ag-brand-badge{
        display:none;
    }

    .ag-brand-logo{
        margin-bottom:12px;
    }

    .ag-brand-logo img{
        max-height:60px;
        width:auto;
    }

    .ag-brand-heading{
        font-size:34px !important;
        line-height:1.1;
        margin-bottom:0;
        text-align:center;
    }

    .ag-glass{
        flex:0 0 100%;
        width:100%;
        max-width:500px;
    }

    .ag-root{
        padding:1.5rem;
        padding-top:2rem;
        align-items:flex-start;
    }
}

@media (max-width: 520px) {

     .ag-root{
        min-height:100vh!important;
        padding-bottom:10px !important;
    }

    .ag-container{
        gap:10px !important;
    }

    .ag-glass{
        margin-bottom:0 !important;
    }
    body.auth-page{
        overflow-y:auto !important;
    }

    .ag-brand-logo img{
        max-height:50px;
    }

   .ag-brand-heading{
    font-size:22px !important;
    line-height:1.1;
    letter-spacing:1px;
}

.ag-brand-heading br{
    display:none;
}

    .ag-card-heading{
        font-size:24px !important;
    }

    .ag-glass{
        padding:28px 22px;
        border-radius:22px;
    }
  
}
    </style>
    <?php if (show_recaptcha()) { ?>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php } ?>
    <?php if (file_exists(FCPATH . 'assets/css/custom.css')) { ?>
    <link href="<?php echo base_url('assets/css/custom.css'); ?>" rel="stylesheet" id="custom-css">
    <?php } ?>
    <?php hooks()->do_action('app_admin_authentication_head'); ?>
</head>