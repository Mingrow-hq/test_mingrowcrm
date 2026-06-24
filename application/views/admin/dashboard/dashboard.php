<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<style>
/* Modern SaaS Redesign */
body {
    background-color: #F8FAFC !important;
    background-image: radial-gradient(circle at 15% 50%, rgba(109, 40, 255, 0.03), transparent 25%), radial-gradient(circle at 85% 30%, rgba(124, 58, 237, 0.03), transparent 25%) !important;
}
#wrapper {
    background-color: transparent !important;
}
.content {
    background-color: transparent !important;
}
.panel_s {
    background: #FFFFFF !important;
    border-radius: 16px !important;
    border: 1px solid rgba(109, 40, 255, 0.08) !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03), 0 1px 3px rgba(0,0,0,0.02) !important;
    transition: transform 0.2s ease, box-shadow 0.2s ease !important;
    overflow: hidden !important;
    margin-bottom: 24px !important;
}
.panel_s:hover {
    box-shadow: 0 10px 30px rgba(109, 40, 255, 0.08), 0 4px 6px rgba(0,0,0,0.04) !important;
    transform: translateY(-2px) !important;
}
.panel-body {
    padding: 24px !important;
}
.panel-heading {
    background: transparent !important;
    border-bottom: 1px solid #F6F2FF !important;
    padding: 20px 24px !important;
    font-weight: 600 !important;
    color: #1e293b !important;
}
/* Typography & Colors */
h1, h2, h3, h4, h5, h6 {
    color: #0f172a !important;
    font-family: 'Inter', system-ui, -apple-system, sans-serif !important;
}
.text-success { color: #22C55E !important; }
.text-warning { color: #F59E0B !important; }
.text-danger { color: #EF4444 !important; }
.text-primary, .text-info { color: #6D28FF !important; }
/* Progress Bars */
.progress-bar {
    background-color: #6D28FF !important;
    border-radius: 8px !important;
}
.progress {
    border-radius: 8px !important;
    background-color: #F6F2FF !important;
    box-shadow: none !important;
}
/* Tables */
.table {
    border-collapse: separate !important;
    border-spacing: 0 !important;
}
.table thead th {
    background-color: #F8FAFC !important;
    border-bottom: 1px solid rgba(109, 40, 255, 0.1) !important;
    color: #64748b !important;
    font-weight: 600 !important;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.05em;
    padding: 12px 16px !important;
}
.table tbody td {
    padding: 16px !important;
    border-bottom: 1px solid #F8FAFC !important;
    color: #334155 !important;
}
/* Buttons */
.btn-primary, .btn-info, .btn-success {
    background: linear-gradient(135deg, #6D28FF, #7C3AED) !important;
    border: none !important;
    border-radius: 8px !important;
    box-shadow: 0 4px 10px rgba(109, 40, 255, 0.2) !important;
    transition: all 0.3s ease !important;
    font-weight: 500 !important;
    color: #fff !important;
}
.btn-primary:hover, .btn-info:hover, .btn-success:hover {
    transform: translateY(-1px) !important;
    box-shadow: 0 6px 15px rgba(109, 40, 255, 0.3) !important;
}
/* Badges */
.label {
    border-radius: 6px !important;
    padding: 4px 8px !important;
    font-weight: 600 !important;
}
.label-success { background-color: rgba(34, 197, 94, 0.1) !important; color: #22C55E !important; border: 1px solid rgba(34, 197, 94, 0.2) !important;}
.label-warning { background-color: rgba(245, 158, 11, 0.1) !important; color: #F59E0B !important; border: 1px solid rgba(245, 158, 11, 0.2) !important;}
.label-danger { background-color: rgba(239, 68, 68, 0.1) !important; color: #EF4444 !important; border: 1px solid rgba(239, 68, 68, 0.2) !important;}
.label-primary, .label-info { background-color: rgba(109, 40, 255, 0.1) !important; color: #6D28FF !important; border: 1px solid rgba(109, 40, 255, 0.2) !important;}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}
::-webkit-scrollbar-track {
    background: #F8FAFC; 
}
::-webkit-scrollbar-thumb {
    background: #C084FC; 
    border-radius: 3px;
}
::-webkit-scrollbar-thumb:hover {
    background: #A855F7; 
}
/* Widget overrides */
.widget {
    margin-bottom: 24px !important;
}
.top_stats_wrapper {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
}
.top_stats_wrapper .panel_s {
    border-radius: 20px !important;
    background: linear-gradient(180deg, #FFFFFF 0%, #FAF8FF 100%) !important;
}
.widget-dragger {
    color: #A855F7 !important;
}
/* AI Section */
.ai-coming-soon-banner {
    background: linear-gradient(135deg, #6D28FF, #A855F7);
    border-radius: 20px;
    padding: 24px 32px;
    color: white;
    margin-bottom: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 10px 30px rgba(109, 40, 255, 0.2);
    position: relative;
    overflow: hidden;
}
.ai-coming-soon-banner::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
    border-radius: 50%;
}
.ai-coming-soon-banner h3 {
    color: white !important;
    margin-top: 0;
    margin-bottom: 8px;
    font-size: 1.5rem;
    font-weight: 700;
}
.ai-coming-soon-banner p {
    margin-bottom: 0;
    opacity: 0.9;
    font-size: 1.05rem;
}
.ai-badge {
    background: rgba(255,255,255,0.2);
    padding: 8px 16px;
    border-radius: 30px;
    font-size: 0.9rem;
    font-weight: 600;
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,0.3);
}
</style>
<div id="wrapper">
    <div class="screen-options-area"></div>
    <div class="screen-options-btn">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="tw-w-5 tw-h-5 ltr:tw-mr-1 rtl:tw-ml-1">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>

        <?= _l('dashboard_options'); ?>
    </div>
    <div class="content">
        <div class="row">
            <?php $this->load->view('admin/includes/alerts'); ?>

            <?php hooks()->do_action('before_start_render_dashboard_content'); ?>

            <div class="clearfix"></div>

            <div class="col-md-12">
                <div class="ai-coming-soon-banner">
                    <div>
                        <h3>✨ Mingrow AI Insights (Coming Soon)</h3>
                        <p>Get ready for automated predictive analytics, smart lead scoring, and automated reporting.</p>
                    </div>
                    <div class="ai-badge">Beta Access Opening Soon</div>
                </div>
            </div>

            <div class="col-md-12 mtop20" data-container="top-12">
                <?php render_dashboard_widgets('top-12'); ?>
            </div>

            <?php hooks()->do_action('after_dashboard_top_container'); ?>

            <div class="col-md-6" data-container="middle-left-6">
                <?php render_dashboard_widgets('middle-left-6'); ?>
            </div>
            <div class="col-md-6" data-container="middle-right-6">
                <?php render_dashboard_widgets('middle-right-6'); ?>
            </div>

            <?php hooks()->do_action('after_dashboard_half_container'); ?>

            <div class="col-md-8" data-container="left-8">
                <?php render_dashboard_widgets('left-8'); ?>
            </div>
            <div class="col-md-4" data-container="right-4">
                <?php render_dashboard_widgets('right-4'); ?>
            </div>

            <div class="clearfix"></div>

            <div class="col-md-4" data-container="bottom-left-4">
                <?php render_dashboard_widgets('bottom-left-4'); ?>
            </div>
            <div class="col-md-4" data-container="bottom-middle-4">
                <?php render_dashboard_widgets('bottom-middle-4'); ?>
            </div>
            <div class="col-md-4" data-container="bottom-right-4">
                <?php render_dashboard_widgets('bottom-right-4'); ?>
            </div>

            <?php hooks()->do_action('after_dashboard'); ?>
        </div>
    </div>
</div>
<script>
    app.calendarIDs = '<?= json_encode($google_ids_calendars); ?>';
</script>
<?php init_tail(); ?>
<?php $this->load->view('admin/utilities/calendar_template'); ?>
<?php $this->load->view('admin/dashboard/dashboard_js'); ?>
</body>

</html>