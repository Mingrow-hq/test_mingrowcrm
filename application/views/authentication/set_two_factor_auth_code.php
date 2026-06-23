<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $this->load->view('authentication/includes/head.php'); ?>
<body class="auth-page authentication two-factor-authentication-code">

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
            <div class="ag-brand-logo"><?= get_dark_company_logo(); ?></div>
            <div class="ag-brand-badge">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:10px;height:10px">
                    <path fill-rule="evenodd" d="M9.661 2.237a.531.531 0 01.678 0 11.947 11.947 0 007.078 2.749.5.5 0 01.479.425c.069.52.104 1.05.104 1.589 0 5.162-3.26 9.563-7.834 11.256a.48.48 0 01-.332 0C5.26 16.564 2 12.163 2 7c0-.538.035-1.069.104-1.589a.5.5 0 01.48-.425 11.947 11.947 0 007.077-2.749z" clip-rule="evenodd"/>
                </svg>
                Two-Factor Auth
            </div>
            <h1 class="ag-brand-heading">Your account<br>is <span class="ag-gold">protected</span></h1>
            <p class="ag-brand-sub">
                Two-factor authentication adds a critical layer of security. Enter the 6-digit code from your authenticator app to continue.
            </p>
            <div class="ag-info-box" style="text-align:center;">
                <div style="width:60px;height:60px;background:rgba(255,193,7,0.12);border:1.5px solid rgba(255,193,7,0.25);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;color:#ffc107;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width:28px;height:28px">
                        <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <p style="font-size:14px!important;color:rgba(255,255,255,0.7);margin:0 0 8px;font-family:inherit;">
                    Open your authenticator app and enter the 6-digit code shown for this account.
                </p>
                <p style="font-size:12px!important;color:rgba(255,193,7,0.6);margin:0;font-weight:500;font-family:inherit;">
                    ↻ Code refreshes every 30 seconds
                </p>
            </div>
        </div>

        <!-- GLASS CARD -->
        <div class="ag-glass">

            <div class="ag-otp-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                </svg>
            </div>

            <h2 class="ag-card-heading ag-card-center"><?= _l('admin_two_factor_auth_heading'); ?></h2>
            <p class="ag-card-sub ag-card-center" style="margin-bottom:28px;"><?= _l('two_factor_authentication'); ?></p>

            <div class="ag-alerts">
                <?php $this->load->view('authentication/includes/alerts'); ?>
            </div>

            <?= form_open($this->uri->uri_string()); ?>

            <?php if (validation_errors()): ?>
            <div class="alert alert-danger"><?= validation_errors(); ?></div>
            <?php endif; ?>

            <div class="ag-field">
                <label for="code" style="text-align:center;display:block;"><?= _l('two_factor_authentication_code'); ?></label>
                <input type="text" id="code" name="code" class="form-control"
                       placeholder="000 000" maxlength="6"
                       autocomplete="one-time-code"
                       style="text-align:center;font-size:28px!important;letter-spacing:10px!important;height:64px!important;font-weight:700!important;padding:0 16px!important;">
            </div>

            <button type="submit" class="btn ag-btn" style="margin-top:8px;">
                <?= _l('confirm'); ?>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:17px;height:17px">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"/>
                </svg>
            </button>

            <?= form_close(); ?>

            <div class="ag-alt">
                <a href="<?= admin_url('authentication'); ?>">
                    ← <?= _l('back_to_login'); ?>
                </a>
            </div>

        </div>

    </div>
</div>

<script>
document.getElementById('code').addEventListener('input', function() {
    this.value = this.value.replace(/\D/g, '').slice(0, 6);
});
</script>

</body>
</html>