<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $this->load->view('authentication/includes/head.php'); ?>
<body class="auth-page authentication forgot-password">

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
                Account Recovery
            </div>
            <h1 class="ag-brand-heading">Reset your<br><span class="ag-gold">password</span></h1>
            <p class="ag-brand-sub">
                Enter your email and we'll send a secure reset link to get you back into your account.
            </p>
            <div class="ag-info-box">
                <p class="ag-info-box-title">How it works</p>
                <div class="ag-info-row">
                    <span class="ag-info-step ag-info-step-done">1</span>
                    Enter your registered email address
                </div>
                <div class="ag-info-row">
                    <span class="ag-info-step ag-info-step-pending">2</span>
                    Check your inbox for the reset link
                </div>
                <div class="ag-info-row">
                    <span class="ag-info-step ag-info-step-pending">3</span>
                    Create a new password and sign in
                </div>
            </div>
        </div>

        <!-- GLASS CARD -->
        <div class="ag-glass">

            <a href="<?= admin_url('authentication'); ?>" class="ag-back">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                </svg>
                Back to sign in
            </a>

            <div class="ag-otp-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 01-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 001.183 1.981l6.478 3.488m8.839 2.51l-4.66-2.51m0 0l-1.023-.55a2.25 2.25 0 00-2.134 0l-1.022.55m0 0l-4.661 2.51m16.5 1.615a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V8.844a2.25 2.25 0 011.183-1.98l7.5-4.04a2.25 2.25 0 012.134 0l7.5 4.04a2.25 2.25 0 011.183 1.98V19.5z"/>
                </svg>
            </div>

            <h2 class="ag-card-heading ag-card-center"><?= _l('admin_auth_forgot_password_heading'); ?></h2>
            <p class="ag-card-sub ag-card-center" style="margin-bottom:24px;">We'll email you a link to reset your password.</p>

            <div class="ag-alerts">
                <?php $this->load->view('authentication/includes/alerts'); ?>
            </div>

            <?= form_open($this->uri->uri_string()); ?>

            <?php if (validation_errors()): ?>
            <div class="alert alert-danger"><?= validation_errors(); ?></div>
            <?php endif; ?>

            <div class="ag-field">
                <label for="email"><?= _l('admin_auth_forgot_password_email'); ?></label>
                <input type="email" id="email" name="email" class="form-control"
                       placeholder="admin@company.com" value="<?= set_value('email'); ?>">
            </div>

            <button type="submit" class="btn ag-btn">
                <?= _l('admin_auth_forgot_password_button'); ?>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:17px;height:17px">
                    <path d="M3.105 2.289a.75.75 0 00-.826.95l1.414 4.925A1.5 1.5 0 005.135 9.25h6.115a.75.75 0 010 1.5H5.135a1.5 1.5 0 00-1.442 1.086l-1.414 4.926a.75.75 0 00.826.95 28.896 28.896 0 0015.293-7.154.75.75 0 000-1.115A28.897 28.897 0 003.105 2.289z"/>
                </svg>
            </button>

            <?= form_close(); ?>
        </div>

    </div>
</div>

</body>
</html>