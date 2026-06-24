<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<style>
/* Modern SaaS Redesign - EXACT Reference Match */
body {
    background-color: #F8FAFC !important;
    font-family: 'Inter', system-ui, -apple-system, sans-serif !important;
}
#wrapper {
    background-color: transparent !important;
}
.content {
    background-color: transparent !important;
}

/* Premium Card Design for all panels */
.panel_s {
    background: #FFFFFF !important;
    border-radius: 16px !important;
    border: 1px solid #F1F5F9 !important;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.02) !important;
    transition: transform 0.2s ease, box-shadow 0.2s ease !important;
    overflow: hidden !important;
    margin-bottom: 24px !important;
    position: relative;
}
.panel_s:hover {
    box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.04) !important;
    transform: translateY(-2px) !important;
}
.panel-body {
    padding: 24px !important;
    position: relative;
}
.panel-heading, .panel-body > p.tw-font-semibold {
    background: transparent !important;
    border-bottom: 1px solid #F8FAFC !important;
    padding: 16px 24px !important;
    font-weight: 600 !important;
    color: #475569 !important;
    font-size: 14px !important;
    position: relative;
    display: flex !important;
    align-items: center;
    margin: -24px -24px 24px -24px !important;
}

/* Visual Drag Handle */
.widget {
    position: relative;
}
.widget-dragger {
    z-index: 50 !important;
    cursor: grab !important;
}
.widget-dragger:active {
    cursor: grabbing !important;
}
.widget-dragger::before {
    content: '';
    position: absolute;
    top: 10px;
    left: 50%;
    transform: translateX(-50%);
    width: 32px;
    height: 12px;
    background-image: radial-gradient(circle, #CBD5E1 1.5px, transparent 2px);
    background-size: 6px 6px;
    background-position: center;
    background-repeat: repeat;
    opacity: 0;
    transition: opacity 0.2s ease;
    pointer-events: none;
    border-radius: 4px;
}
.widget:hover .widget-dragger::before, .panel_s:hover .widget-dragger::before {
    opacity: 1;
}

/* Typography & Colors */
h1, h2, h3, h4, h5, h6 {
    color: #0f172a !important;
}
.text-success { color: #22C55E !important; }
.text-warning { color: #F59E0B !important; }
.text-danger { color: #EF4444 !important; }
.text-primary, .text-info { color: #6D28FF !important; }

/* KPI Widgets (top_stats) */
.quick-stats-invoices, .quick-stats-leads, .quick-stats-projects, .quick-stats-tasks {
    padding: 0 12px;
}
.top_stats_wrapper {
    background: #FFFFFF !important;
    border-radius: 16px !important;
    padding: 24px !important;
    border: 1px solid #F1F5F9 !important;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.02) !important;
    transition: all 0.3s ease !important;
    height: 100%;
    position: relative;
}
.top_stats_wrapper:hover {
    box-shadow: 0px 10px 25px rgba(109, 40, 255, 0.06) !important;
}
.top_stats_wrapper .tw-text-neutral-800 {
    display: flex;
    flex-direction: column;
    align-items: flex-start !important;
}
.top_stats_wrapper .tw-font-medium {
    color: #64748b !important;
    font-size: 13px !important;
    font-weight: 500 !important;
    margin-bottom: 8px;
}
.top_stats_wrapper .tw-font-semibold.tw-shrink-0 {
    font-size: 24px !important;
    color: #0f172a !important;
    font-weight: 700 !important;
    margin-top: 4px !important;
}
.top_stats_wrapper svg {
    background: #F4EFFF !important;
    color: #6D28FF !important;
    padding: 10px !important;
    border-radius: 12px !important;
    width: 44px !important;
    height: 44px !important;
    position: absolute;
    right: 24px;
    top: 24px;
    margin: 0 !important;
}

/* Constrain Payment Records / Chart Heights */
canvas#payment-statistics, .payments-chart-dashboard {
    max-height: 280px !important;
    width: 100% !important;
}
.widget #payments .panel-body {
    max-height: 380px !important;
    overflow: hidden;
}

/* Activity Timeline */
.activity-feed {
    padding-left: 20px;
    border-left: 2px solid #F1F5F9;
    margin-left: 10px;
}
.feed-item {
    position: relative;
    padding-bottom: 24px;
}
.feed-item::before {
    content: '';
    position: absolute;
    left: -27px;
    top: 4px;
    width: 12px;
    height: 12px;
    background: #FFFFFF;
    border: 2px solid #6D28FF;
    border-radius: 50%;
}
.feed-item .date {
    color: #64748b;
    font-size: 0.8rem;
    font-weight: 500;
    margin-bottom: 4px;
}
.feed-item .text {
    color: #334155;
    font-size: 0.9rem;
}

/* Calendar */
div#calendar {
    max-height: 400px;
    overflow-y: hidden;
}
.fc-scroller {
    max-height: 350px !important;
    overflow-y: auto !important;
}
.fc-button-primary {
    background: #FFFFFF !important;
    border: 1px solid #E2E8F0 !important;
    color: #475569 !important;
    border-radius: 8px !important;
    box-shadow: none !important;
    text-transform: capitalize !important;
    font-weight: 500 !important;
}
.fc-button-primary:hover, .fc-button-primary:not(:disabled).fc-button-active {
    background: #F8FAFC !important;
    color: #6D28FF !important;
    border-color: #6D28FF !important;
}

/* Tables */
.table-responsive {
    border-radius: 12px;
    overflow-y: auto;
    max-height: 400px;
}
.table {
    border-collapse: separate !important;
    border-spacing: 0 !important;
}
.table thead th {
    background-color: #F8FAFC !important;
    border-bottom: 1px solid #F1F5F9 !important;
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
    vertical-align: middle !important;
}
.table tbody tr:hover {
    background-color: #F8FAFC !important;
}

/* Progress Bars */
.progress-bar {
    background-color: #6D28FF !important;
    border-radius: 8px !important;
}
.progress {
    border-radius: 8px !important;
    background-color: #F1F5F9 !important;
    box-shadow: none !important;
    height: 8px !important;
}

/* Mingrow AI Card */
.ai-coming-soon-banner {
    background: linear-gradient(135deg, #6D28FF, #8B5CF6);
    border-radius: 16px;
    padding: 24px 32px;
    color: white;
    margin-bottom: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 10px 25px rgba(109, 40, 255, 0.2);
    position: relative;
    overflow: hidden;
}
.ai-coming-soon-banner h3 {
    color: white !important;
    margin-top: 0;
    margin-bottom: 6px;
    font-size: 1.5rem;
    font-weight: 700;
}
.ai-coming-soon-banner p {
    margin-bottom: 0;
    opacity: 0.9;
    font-size: 1rem;
}
.btn-ai-coming-soon {
    background: #FFFFFF !important;
    color: #6D28FF !important;
    padding: 10px 20px !important;
    border-radius: 8px !important;
    font-size: 0.9rem !important;
    font-weight: 600 !important;
    text-decoration: none !important;
    transition: all 0.2s ease !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
}
.btn-ai-coming-soon:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
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
                        <h3>✨ Mingrow AI</h3>
                        <p>Get ready for automated predictive analytics, smart lead scoring, and automated reporting.</p>
                    </div>
                    <a href="#" class="btn-ai-coming-soon">Coming Soon</a>
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