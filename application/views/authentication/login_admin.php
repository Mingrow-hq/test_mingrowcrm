<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $this->load->view('authentication/includes/head.php'); ?>
<body class="auth-page login_admin">

<!-- ===== ANIMATED BACKGROUND ===== -->
<div class="ag-bg">
    <div class="ag-blob ag-blob-1"></div>
    <div class="ag-blob ag-blob-2"></div>
    <div class="ag-blob ag-blob-3"></div>
    <div class="ag-blob ag-blob-4"></div>
</div>

<!-- ===== CONTENT ROOT ===== -->
<div class="ag-root">
    <div class="ag-container">

        <!-- ============================
             LEFT — FLOATING BRAND TEXT
        ============================= -->
        <div class="ag-brand">

            <div class="ag-brand-logo">
    <img src="https://mingrow.cloud/uploads/company/light-logo.png" alt="Mingrow" style="max-height:46px; width:auto; display:block; filter: none !important;">
</div>

            <div class="ag-brand-badge">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:10px;height:10px">
                    <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd"/>
                </svg>
                Admin Portal
            </div>

            <h1 class="ag-brand-heading">
    The AI<br>
    <span class="ag-gold">Business OS</span>
</h1>

<p class="ag-brand-sub">
    Manage clients, projects, invoices, teams and AI workflows
    from one intelligent platform.
</p>

            <ul class="ag-feature-list">
                <li class="ag-feature-item">
                    <span class="ag-feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                        </svg>
                    </span>
                    Complete client &amp; contact management
                </li>
                <li class="ag-feature-item">
                    <span class="ag-feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                        </svg>
                    </span>
                    Invoices, estimates &amp; smart payments
                </li>
                <li class="ag-feature-item">
                    <span class="ag-feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3"/>
                        </svg>
                    </span>
                    Real-time analytics &amp; reports
                </li>
                <li class="ag-feature-item">
                    <span class="ag-feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                        </svg>
                    </span>
                    Secure, role-based access control
                </li>
            </ul>
        </div>
      

        <!-- ============================
             RIGHT — GLASS CARD
        ============================= -->
       <div class="ag-glass">

    <span class="ag-border-light"></span>

    <span class="ag-corner-glow-top"></span>
    <span class="ag-corner-glow-bottom"></span>

            <h2 class="ag-card-heading"><?= _l('admin_auth_login_heading'); ?></h2>
            <p class="ag-card-sub"><?= _l('welcome_back_sign_in'); ?></p>

            <div class="ag-alerts">
                <?php $this->load->view('authentication/includes/alerts'); ?>
            </div>

            <?= form_open($this->uri->uri_string()); ?>

            <?php if (validation_errors()): ?>
            <div class="alert alert-danger"><?= validation_errors(); ?></div>
            <?php endif; ?>

            <?php hooks()->do_action('after_admin_login_form_start'); ?>

            <!-- Email -->
            <div class="ag-field">
                <label for="email"><?= _l('admin_auth_login_email'); ?></label>
                <input type="email" id="email" name="email" class="form-control"
                       placeholder="admin@company.com" autofocus="1">
            </div>

            <!-- Password -->
            <div class="ag-field">
                <div class="ag-label-row">
                    <label for="password"><?= _l('admin_auth_login_password'); ?></label>
                    <a href="<?= admin_url('authentication/forgot_password'); ?>"><?= _l('admin_auth_login_fp'); ?></a>
                </div>
                <div class="ag-pw-wrap">
                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••">
                    <button type="button" class="ag-eye-btn" onclick="agTogglePw('password',this)" aria-label="Toggle password">
                        <svg id="ag-eye-password" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- reCAPTCHA -->
            <?php if (show_recaptcha()) { ?>
            <div class="ag-recaptcha">
                <div class="g-recaptcha" data-sitekey="<?= get_option('recaptcha_site_key'); ?>"></div>
            </div>
            <?php } ?>

            <!-- Remember me -->
            <div class="ag-check-row">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember"><?= _l('admin_auth_login_remember_me'); ?></label>
            </div>

            <button type="submit" class="btn ag-btn">
    <?= _l('admin_auth_login_button'); ?>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px">
        <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd"/>
    </svg>
</button>

<div class="ag-security-note">

    <svg class="ag-security-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M12 3l7 3v6c0 5-3.5 8.5-7 9-3.5-.5-7-4-7-9V6l7-3z"/>
    </svg>

    <span>Your data is protected with enterprise-grade security.</span>

</div>

<?php hooks()->do_action('before_admin_login_form_close'); ?>
        </div><!-- /ag-glass -->

    </div><!-- /ag-container -->
</div><!-- /ag-root -->

<script>
function agTogglePw(id, btn) {
    var inp  = document.getElementById(id);
    var icon = document.getElementById('ag-eye-' + id);
    var show = inp.type === 'password';
    inp.type = show ? 'text' : 'password';
    icon.innerHTML = show
        ? '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>'
        : '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>';
}
</script>

</body>
</html>