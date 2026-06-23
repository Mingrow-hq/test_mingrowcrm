
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<style>
body.customers.forgot-password{
    background:linear-gradient(135deg,#f5f3ff 0%,#ffffff 100%)!important;
    font-family:'Inter',sans-serif;
}
body.customers.forgot-password .container{
    max-width:650px!important;
    margin:30px auto 60px auto!important;
}
  body.customers.forgot-password{
    padding-top:0 !important;
}

body.customers.forgot-password .container{
    margin-top:20px !important;
}

.cfp-card{
    background:#fff;
    border-radius:24px;
       padding:20px 40px 40px 40px;
    box-shadow:0 20px 60px rgba(89,20,176,.12);
    border:1px solid rgba(89,20,176,.08);
    position:relative;
    overflow:hidden;
     margin-top:60px;
}

.cfp-card:before{
    content:"";
    position:absolute;
    top:-100px;
    right:-100px;
    width:220px;
    height:220px;
    background:radial-gradient(circle,#5914b020,transparent 70%);
}

.cfp-logo{
    text-align:center;
    margin-bottom:20px;
}

.cfp-logo img{
    height:42px;
}

.cfp-badge{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:10px 18px;
    border-radius:999px;

    background:rgba(255,193,7,0.08);
    border:1px solid rgba(255,193,7,0.35);

    color:#FFC107;
    font-size:13px;
    font-weight:700;
    letter-spacing:1px;
    text-transform:uppercase;

    margin:0 auto 25px;
}

.cfp-badge svg{
    width:12px;
    height:12px;
    fill:#FFC107;
}

.cfp-header{
    text-align:center;
}

.cfp-title{
    font-size:34px;
    font-weight:800;
    color:#111827;
    line-height:1.1;
    margin-bottom:12px;
}

.cfp-title span{
    color:#5914b0;
}
.cfp-sub{
    color:#6b7280;
    font-size:15px;
    line-height:1.7;
    max-width:480px;
    margin:0 auto 30px;
}

.cfp-steps{
    background:#faf7ff;
    border:1px solid #ece5ff;
    border-radius:18px;
    padding:12px 20px;
    margin-bottom:20px;
}

.cfp-step{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:6px;
    color:#4b5563;
    font-size:14px;
}
.cfp-step:last-child{
    margin-bottom:0;
}
.cfp-num{
    width:24px;
    height:24px;
    border-radius:50%;
    background:#ede9fe;
    color:#5914b0;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
}

.cfp-num.active{
    background:#5914b0;
    color:#ffffff;
}

.cfp-field{
    margin-bottom:20px;
}

.cfp-field label{
    display:block;
    margin-bottom:8px;
    font-size:13px;
    font-weight:600;
    color:#374151;
}

.cfp-field .form-control{
    height:52px!important;
    border-radius:14px!important;
    border:1px solid #ddd6fe!important;
    background:#fafafa!important;
}

.cfp-field .form-control:focus{
    border-color:#5914b0!important;
    box-shadow:0 0 0 4px rgba(89,20,176,.15)!important;
}

.cfp-btn{
    width:100%;
    height:54px;
    border:none;
    border-radius:14px;
      background:#FFC107 !important;
    color:#111827 !importantmportant;
    font-weight:700;
    font-size:15px;
      box-shadow:0 8px 25px rgba(255,193,7,.35);
    transition:.3s;
}

.cfp-btn:hover{
    background:#e6ac00 !important;
    color:#111827 !important;
}

.cfp-back{
    display:block;
    text-align:center;
    margin-top:24px;
    color:#5914b0;
    font-weight:600;
    text-decoration:none;
}

.cfp-back:hover{
    text-decoration:none;
}
  body.customers.forgot-password .container{
    margin-top:0 !important;
    padding-top:0 !important;
}

body.customers.forgot-password .row{
    margin-top:0 !important;
}

body.customers.forgot-password .cfp-card{
    margin-top:-25px;
}

@media(max-width:768px){
    .cfp-card{
        padding:25px;
    }

    .cfp-title{
        font-size:28px;
    }
}
</style>

<div class="cfp-card">

    <div class="cfp-logo">
        <img src="https://mingrow.cloud/uploads/company/dark-logo.png" alt="Mingrow">
    </div>

    <div class="cfp-header">

        <div class="cfp-badge">
    <svg xmlns="http://www.w3.org/2000/svg"
         viewBox="0 0 20 20"
         fill="currentColor"
         style="width:10px;height:10px">
        <path fill-rule="evenodd"
              d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
              clip-rule="evenodd"/>
    </svg>

    Account Recovery
</div>

        <h1 class="cfp-title">
            Reset Your <span>Password</span>
        </h1>

        <p class="cfp-sub">
            Enter your registered email address and we'll send you a secure password reset link.
        </p>

    </div>

    <div class="cfp-steps">

        <div class="cfp-step">
    <div class="cfp-num active">1</div>
    Enter your registered email address
</div>

<div class="cfp-step">
    <div class="cfp-num">2</div>
    Check your inbox for the reset email
</div>

<div class="cfp-step">
    <div class="cfp-num">3</div>
    Create a new password and sign in
</div>

    </div>

    <?php get_template_part('alerts'); ?>

    <?= form_open($this->uri->uri_string()); ?>

    <?php if (validation_errors()): ?>
    <div class="alert alert-danger">
        <?= validation_errors(); ?>
    </div>
    <?php endif; ?>

    <div class="cfp-field">
        <label><?= _l('customer_forgot_password_email'); ?></label>

        <input type="email"
               name="email"
               class="form-control"
               placeholder="you@example.com"
               value="<?= set_value('email'); ?>">
    </div>

    <button type="submit" class="cfp-btn">
        Send Reset Link
    </button>

    <?= form_close(); ?>

    <a href="<?= site_url('authentication/login'); ?>" class="cfp-back">
        ← Back to Sign In
    </a>

</div>

