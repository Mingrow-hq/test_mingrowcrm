<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
/* Client Reset Password — scoped */
body.customers.reset-password {
    background: #f9f8ff !important;
    font-family: 'Inter', -apple-system, sans-serif;
    -webkit-font-smoothing: antialiased;
}
body.customers.reset-password #wrapper,
body.customers.reset-password #content { background: transparent !important; }
body.customers.reset-password .container { max-width: 520px !important; margin: 4rem auto !important; padding: 0 1.5rem !important; }

.crp-card {
    background: #fff;
    border: 1.5px solid #e2e0ee;
    border-radius: 20px;
    padding: 2.5rem 2.25rem;
    box-shadow: 0 4px 32px rgba(89,20,176,0.07);
    animation: crp-up .45s cubic-bezier(.22,1,.36,1);
}
@keyframes crp-up { from{opacity:0;transform:translateY(18px);} to{opacity:1;transform:translateY(0);} }

.crp-icon {
    width:64px;height:64px;
    background:linear-gradient(135deg,rgba(89,20,176,.12),rgba(255,193,7,.08));
    border:1.5px solid rgba(89,20,176,.12);border-radius:16px;
    display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;color:#5914b0;
}
.crp-icon svg { width:32px;height:32px; }

.crp-title { font-size:1.5rem;font-weight:800;color:#0a0a0a;text-align:center;margin:0 0 .4rem;letter-spacing:-.4px; }
.crp-sub   { font-size:.875rem;color:#6b6880;text-align:center;margin:0 0 2rem;line-height:1.6; }

.crp-field { margin-bottom:1.1rem; }
.crp-field label { display:block;font-size:.8rem;font-weight:600;color:#353349;margin-bottom:.4rem;letter-spacing:.02em; }
.crp-field .form-control {
    width:100%!important;height:46px!important;padding:0 1rem!important;
    border:1.5px solid #e2e0ee!important;border-radius:12px!important;
    font-size:.9rem!important;color:#14121f!important;background:#f9f8ff!important;
    transition:border-color .2s,box-shadow .2s,background .2s!important;
    outline:none!important;font-family:'Inter',sans-serif!important;box-shadow:none!important;-webkit-appearance:none;
}
.crp-field .form-control:focus { border-color:#5914b0!important;background:#fff!important;box-shadow:0 0 0 3.5px rgba(89,20,176,.12)!important; }
.crp-field .form-control::placeholder { color:#ccc9dd; }

.crp-pw-wrap { position:relative; }
.crp-pw-wrap .form-control { padding-right:3rem!important; }
.crp-eye-btn {
    position:absolute;right:.9rem;top:50%;transform:translateY(-50%);
    background:none;border:none;cursor:pointer;padding:0;color:#9491a7;
    display:flex;align-items:center;transition:color .2s;z-index:5;
}
.crp-eye-btn:hover { color:#5914b0; }
.crp-eye-btn svg { width:18px;height:18px; }

.crp-strength-bar { height:3px;border-radius:4px;background:#e2e0ee;margin-top:.5rem;overflow:hidden; }
.crp-strength-fill { height:100%;border-radius:4px;transition:width .35s,background .35s; }

.crp-btn {
    width:100%;height:48px;background:#5914b0;color:#fff!important;
    border:none;border-radius:12px;font-size:.9375rem;font-weight:600;
    cursor:pointer;font-family:'Inter',sans-serif;
    transition:background .2s,transform .12s,box-shadow .2s;
    box-shadow:0 4px 18px rgba(89,20,176,.32);
    display:flex;align-items:center;justify-content:center;gap:.5rem;
    margin-top:.5rem;
}
.crp-btn:hover { background:#3d0b7a;box-shadow:0 6px 28px rgba(89,20,176,.42);transform:translateY(-1px); }
.crp-btn:active { transform:translateY(0); }

.crp-alerts .alert { border-radius:8px;font-size:.875rem;font-weight:500;margin-bottom:1.25rem;padding:.7rem 1rem;border:none; }
.crp-alerts .alert-danger  { background:#fff0f0;color:#c0392b;border-left:3px solid #e74c3c; }
.crp-alerts .alert-success { background:#f0fff6;color:#15803d;border-left:3px solid #22c55e; }
</style>

<div class="crp-card">
    <div class="crp-icon">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"/>
        </svg>
    </div>

    <h1 class="crp-title"><?= _l('admin_auth_reset_password_heading'); ?></h1>
    <p class="crp-sub">Enter your new password below. Make it strong and memorable.</p>

    <div class="crp-alerts">
        <?php get_template_part('alerts'); ?>
    </div>

    <?= form_open($this->uri->uri_string()); ?>

    <?php if (validation_errors()): ?>
    <div class="alert alert-danger" style="border-radius:8px;font-size:.875rem;margin-bottom:1.25rem;border:none;background:#fff0f0;color:#c0392b;border-left:3px solid #e74c3c;padding:.7rem 1rem;">
        <?= validation_errors(); ?>
    </div>
    <?php endif; ?>

    <!-- New password -->
    <div class="crp-field">
        <label for="crp-pw"><?= _l('customer_reset_password'); ?></label>
        <div class="crp-pw-wrap">
            <input type="password" id="crp-pw" name="password" class="form-control"
                   placeholder="New password" oninput="crpStrength(this.value)">
            <button type="button" class="crp-eye-btn" onclick="crpToggle('crp-pw',this)">
                <svg id="crp-eye-crp-pw" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </button>
        </div>
        <div class="crp-strength-bar">
            <div class="crp-strength-fill" id="crp-sfill" style="width:0;"></div>
        </div>
    </div>

    <!-- Confirm password -->
    <div class="crp-field">
        <label for="crp-pwr"><?= _l('customer_reset_password_repeat'); ?></label>
        <div class="crp-pw-wrap">
            <input type="password" id="crp-pwr" name="passwordr" class="form-control"
                   placeholder="Confirm password">
            <button type="button" class="crp-eye-btn" onclick="crpToggle('crp-pwr',this)">
                <svg id="crp-eye-crp-pwr" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </button>
        </div>
    </div>

    <button type="submit" class="crp-btn">
        <?= _l('auth_reset_password_submit'); ?>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:17px;height:17px">
            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"/>
        </svg>
    </button>

    <?= form_close(); ?>
</div>

<script>
function crpToggle(id, btn) {
    var inp = document.getElementById(id);
    var icon = document.getElementById('crp-eye-' + id);
    if (inp.type === 'password') {
        inp.type = 'text';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>';
    } else {
        inp.type = 'password';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>';
    }
}
function crpStrength(val) {
    var fill = document.getElementById('crp-sfill');
    var s = 0;
    if (val.length >= 8)  s += 25;
    if (val.length >= 12) s += 25;
    if (/[A-Z]/.test(val) && /[a-z]/.test(val)) s += 25;
    if (/[0-9!@#$%^&*]/.test(val)) s += 25;
    fill.style.width = s + '%';
    fill.style.background = ['#ef4444','#f97316','#ffc107','#22c55e'][Math.floor(s/26)] || '#22c55e';
}
</script>