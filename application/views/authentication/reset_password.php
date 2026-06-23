<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $this->load->view('authentication/includes/head.php'); ?>
<body class="auth-page authentication reset-password">

<div class="ag-bg">
    <div class="ag-blob ag-blob-1"></div>
    <div class="ag-blob ag-blob-2"></div>
    <div class="ag-blob ag-blob-3"></div>
    <div class="ag-blob ag-blob-4"></div>
</div>

<div class="ag-root">
    <div class="ag-container">

        <!-- LEFT BRAND -->
        <div class="ag-brand">
            <div class="ag-brand-logo">
    <img src="https://mingrow.cloud/uploads/company/light-logo.png" alt="Mingrow" style="max-height:46px; width:auto; display:block; filter: none !important;">
</div>
            <div class="ag-brand-badge">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:10px;height:10px">
                    <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd"/>
                </svg>
                New Password
            </div>
            <h1 class="ag-brand-heading">Create a strong<br><span class="ag-gold">new password</span></h1>
            <p class="ag-brand-sub">Choose a password that is secure and easy to remember. Avoid reusing old passwords.</p>
            <div class="ag-info-box">
                <p class="ag-info-box-title">Password tips</p>
                <?php
                $tips = [
                    'At least 8 characters long',
                    'Mix of uppercase &amp; lowercase',
                    'Include numbers or symbols',
                    'Avoid names or birthdays',
                ];
                foreach ($tips as $tip): ?>
                <div class="ag-info-row">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#ffc107" style="width:14px;height:14px;flex-shrink:0;margin-top:2px">
                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"/>
                    </svg>
                    <?= $tip; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- GLASS CARD -->
        <div class="ag-glass">

            <div class="ag-otp-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"/>
                </svg>
            </div>

            <h2 class="ag-card-heading ag-card-center"><?= _l('admin_auth_reset_password_heading'); ?></h2>
            <p class="ag-card-sub ag-card-center" style="margin-bottom:24px;">Enter and confirm your new password below.</p>

            <div class="ag-alerts">
                <?php $this->load->view('authentication/includes/alerts'); ?>
            </div>

            <?= form_open($this->uri->uri_string()); ?>

            <?php if (validation_errors()): ?>
            <div class="alert alert-danger"><?= validation_errors(); ?></div>
            <?php endif; ?>

            <!-- New password -->
            <div class="ag-field">
                <label for="password"><?= _l('admin_auth_reset_password'); ?></label>
                <div class="ag-pw-wrap">
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="New password" oninput="agStrength(this.value)">
                    <button type="button" class="ag-eye-btn" onclick="agTogglePw('password',this)">
                        <svg id="ag-eye-password" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </button>
                </div>
                <div class="ag-strength">
                    <div class="ag-strength-fill" id="ag-sfill" style="width:0;background:#ef4444;"></div>
                </div>
            </div>

            <!-- Confirm password -->
            <div class="ag-field">
                <label for="passwordr"><?= _l('admin_auth_reset_password_repeat'); ?></label>
                <div class="ag-pw-wrap">
                    <input type="password" id="passwordr" name="passwordr" class="form-control"
                           placeholder="Confirm password">
                    <button type="button" class="ag-eye-btn" onclick="agTogglePw('passwordr',this)">
                        <svg id="ag-eye-passwordr" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn ag-btn">
                <?= _l('auth_reset_password_submit'); ?>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:17px;height:17px">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"/>
                </svg>
            </button>

            <?= form_close(); ?>
        </div>

    </div>
</div>

<script>
function agTogglePw(id, btn) {
    var inp = document.getElementById(id);
    var icon = document.getElementById('ag-eye-' + id);
    var show = inp.type === 'password';
    inp.type = show ? 'text' : 'password';
    icon.innerHTML = show
        ? '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>'
        : '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>';
}
function agStrength(val) {
    var fill = document.getElementById('ag-sfill');
    var s = 0;
    if (val.length >= 8)  s += 25;
    if (val.length >= 12) s += 25;
    if (/[A-Z]/.test(val) && /[a-z]/.test(val)) s += 25;
    if (/[0-9!@#$%^&*]/.test(val)) s += 25;
    fill.style.width = s + '%';
    fill.style.background = ['#ef4444','#f97316','#ffc107','#22c55e'][Math.floor(s/26)] || '#22c55e';
}
</script>

</body>
</html>