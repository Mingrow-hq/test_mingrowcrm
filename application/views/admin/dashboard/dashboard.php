<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<?php
// ──────────────────────────────────────────────────────────────────────────────
// HELPER: parse raw activity description into icon / class / text
// ──────────────────────────────────────────────────────────────────────────────
function parse_activity_item($description) {
    $desc  = strip_tags($description);
    $class = 'purple';
    if (stripos($desc, 'lead')    !== false) { $class = 'purple'; }
    elseif (stripos($desc, 'invoice')  !== false || stripos($desc, 'payment') !== false) { $class = 'success'; }
    elseif (stripos($desc, 'project')  !== false) { $class = 'blue'; }
    elseif (stripos($desc, 'task')     !== false) { $class = 'warning'; }
    elseif (stripos($desc, 'ticket')   !== false) { $class = 'info'; }
    return ['class' => $class, 'text' => $desc];
}
?>

<style>
/* ══════════════════════════════════════════════════════════════
   1. FONT & BASE
══════════════════════════════════════════════════════════════ */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

*, body, #wrapper {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
}

#wrapper {
    background: #FAF8FF !important;
    background-image:
        radial-gradient(at 0% 0%, rgba(109,40,253,.05) 0, transparent 50%),
        radial-gradient(at 100% 100%, rgba(168,85,247,.04) 0, transparent 50%) !important;
}

.content {
    padding: 28px 24px !important;
}

/* ══════════════════════════════════════════════════════════════
   2. PANEL → PREMIUM CARD (the core widget skin)
   These classes wrap ALL widgets rendered by render_dashboard_widgets()
══════════════════════════════════════════════════════════════ */
.panel_s {
    background: rgba(255,255,255,.95) !important;
    backdrop-filter: blur(20px) !important;
    -webkit-backdrop-filter: blur(20px) !important;
    border-radius: 20px !important;
    border: 1px solid rgba(124,58,237,.08) !important;
    box-shadow: 0 4px 24px rgba(109,40,253,.07) !important;
    transition: all .25s ease !important;
    overflow: hidden;
    margin-bottom: 20px !important;
}

.panel_s:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 36px rgba(109,40,253,.11) !important;
    border-color: rgba(124,58,237,.14) !important;
}

.panel-body {
    padding: 22px 24px !important;
}

/* Top stats wrapper inside widgets */
.top_stats_wrapper {
    background: rgba(250,248,255,.55) !important;
    border-radius: 14px !important;
    border: 1px solid rgba(124,58,237,.06) !important;
    padding: 18px !important;
    margin-bottom: 0 !important;
    transition: all .2s ease;
}
.top_stats_wrapper:hover {
    border-color: rgba(124,58,237,.14) !important;
    box-shadow: 0 4px 16px rgba(109,40,253,.06) !important;
}

/* Progress bars → purple brand */
.progress { border-radius: 8px !important; background: #F1F5F9 !important; }
.progress-bar { border-radius: 8px !important; }
.progress-bar-mini { height: 5px !important; }
.progress-bar-danger  { background: linear-gradient(90deg,#EF4444,#F87171) !important; }
.progress-bar-warning { background: linear-gradient(90deg,#F59E0B,#FBBF24) !important; }
.progress-bar-success { background: linear-gradient(90deg,#22C55E,#4ADE80) !important; }
.progress-bar-default { background: linear-gradient(90deg,#6D28FF,#8B5CF6) !important; }
.progress-bar-info    { background: linear-gradient(90deg,#06B6D4,#38BDF8) !important; }

/* ══════════════════════════════════════════════════════════════
   3. WIDGET DRAG HANDLE
══════════════════════════════════════════════════════════════ */
.widget-dragger {
    cursor: grab;
    width: 100%;
    height: 6px;
    margin-bottom: 10px;
    background-image: radial-gradient(circle, rgba(124,58,237,.25) 1px, transparent 1px);
    background-size: 6px 6px;
    border-radius: 6px;
    opacity: .5;
    transition: opacity .2s;
}
.widget-dragger:hover { opacity: 1; }

/* ══════════════════════════════════════════════════════════════
   4. WELCOME HEADER AREA
══════════════════════════════════════════════════════════════ */
.dash-welcome-title {
    font-size: 22px !important;
    font-weight: 700 !important;
    color: #1E1B4B !important;
    margin: 0 !important;
}
.dash-welcome-sub {
    color: #64748B !important;
    margin-top: 4px !important;
    font-size: 13px !important;
}
.dash-date-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #FFFFFF !important;
    border: 1px solid rgba(124,58,237,.12) !important;
    padding: 9px 16px !important;
    border-radius: 12px !important;
    color: #4F46E5 !important;
    font-weight: 500 !important;
    font-size: 13px !important;
    box-shadow: 0 2px 8px rgba(109,40,253,.05) !important;
    cursor: default;
}

/* ══════════════════════════════════════════════════════════════
   5. FINANCE SUMMARY (inside finance_overview widget)
══════════════════════════════════════════════════════════════ */
.home-summary ._total { font-weight: 700 !important; font-size: 18px !important; color: #1E1B4B !important; }
.text-stats-wrapper a { text-decoration: none !important; }
.text-stats-wrapper a:hover { color: #6D28FF !important; }
.progress-finance-status { font-size: 11px !important; font-weight: 600 !important; color: #94A3B8 !important; margin-bottom: 2px !important; }

/* Invoices total inline bar */
.invoices-total-inline { padding-top: 10px !important; }

/* ══════════════════════════════════════════════════════════════
   6. PAYMENTS CHART + CANVAS WIDGETS
══════════════════════════════════════════════════════════════ */
.payments-chart-dashboard { max-height: 280px; }

.chart-toggle-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(250,248,255,.8) !important;
    border: 1px solid rgba(124,58,237,.1) !important;
    padding: 6px 12px !important;
    border-radius: 10px !important;
    color: #4F46E5 !important;
    font-weight: 600 !important;
    font-size: 12px !important;
    text-decoration: none !important;
}
.chart-toggle-btn:hover { background: #FAF8FF !important; border-color: rgba(124,58,237,.2) !important; }

/* ══════════════════════════════════════════════════════════════
   7. CALENDAR OVERRIDES
══════════════════════════════════════════════════════════════ */
.fc { border: none !important; }
.fc-toolbar { margin-bottom: 16px !important; }
.fc-button {
    background: #FFFFFF !important;
    border: 1px solid rgba(124,58,237,.1) !important;
    color: #4F46E5 !important;
    box-shadow: none !important;
    text-shadow: none !important;
    font-weight: 600 !important;
    border-radius: 9px !important;
    padding: 5px 11px !important;
    text-transform: capitalize !important;
    transition: all .2s !important;
}
.fc-button:hover { background: #FAF8FF !important; color: #6D28FF !important; border-color: rgba(124,58,237,.2) !important; }
.fc-state-active, .fc-button-active { background: #6D28FF !important; color: #FFF !important; border-color: #6D28FF !important; }
.fc-widget-header, .fc-head-container { border: none !important; background: #FAF8FF !important; }
.fc-widget-header th { padding: 8px 0 !important; font-weight: 600 !important; color: #475569 !important; text-transform: uppercase; font-size: 10px !important; letter-spacing: .5px; border: none !important; }
.fc-body { border: none !important; }
.fc-day { border: 1px solid rgba(124,58,237,.04) !important; }
.fc-day-number { font-weight: 500 !important; color: #64748B !important; padding: 5px !important; }
.fc-day-today { background: rgba(109,40,253,.03) !important; }
.fc-day-today .fc-day-number { color: #6D28FF !important; font-weight: 700 !important; }
.fc-event { background: #7C3AED !important; border: none !important; border-radius: 5px !important; font-size: 11px !important; font-weight: 500 !important; }

/* Reduce calendar max-height */
#calendar { max-height: 380px !important; overflow: hidden; }
.fc-scroller { overflow: hidden !important; }

/* ══════════════════════════════════════════════════════════════
   8. TODO WIDGET OVERRIDES
══════════════════════════════════════════════════════════════ */
.todo-panel .todo { padding: 0 !important; }
.todo-panel .todo li { border-bottom: 1px solid rgba(124,58,237,.05) !important; padding: 10px 0 !important; }
.todo-panel .todo li:last-child { border-bottom: none !important; }
.todo-title { font-size: 13px !important; font-weight: 600 !important; color: #F59E0B !important; margin-bottom: 12px !important; }

/* ══════════════════════════════════════════════════════════════
   9. CONTRACTS TABLE
══════════════════════════════════════════════════════════════ */
.table-responsive table th {
    background: #FAF8FF !important;
    color: #475569 !important;
    font-weight: 600 !important;
    font-size: 11px !important;
    text-transform: uppercase;
    letter-spacing: .4px;
    padding: 12px 14px !important;
    border: none !important;
    border-bottom: 1px solid rgba(124,58,237,.06) !important;
}
.table-responsive table td {
    padding: 12px 14px !important;
    font-size: 13px !important;
    color: #334155 !important;
    border-bottom: 1px solid rgba(124,58,237,.04) !important;
    vertical-align: middle !important;
}
.table-responsive table tr:last-child td { border-bottom: none !important; }
.table-responsive table td a { color: #6D28FF !important; font-weight: 600; }

/* ══════════════════════════════════════════════════════════════
   10. LEADS / PROJECTS / TICKETS CHART WIDGETS
══════════════════════════════════════════════════════════════ */
.doughnut-chart-wrapper { padding: 10px 0 !important; }

/* ══════════════════════════════════════════════════════════════
   11. SCREEN OPTIONS (Dashboard Options button)
══════════════════════════════════════════════════════════════ */
.screen-options-btn {
    background: rgba(255,255,255,.95) !important;
    border: 1px solid rgba(124,58,237,.1) !important;
    color: #4F46E5 !important;
    border-radius: 12px !important;
    padding: 8px 14px !important;
    font-weight: 600 !important;
    font-size: 13px !important;
    box-shadow: 0 2px 10px rgba(109,40,253,.07) !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px;
    cursor: pointer;
    transition: all .2s;
}
.screen-options-btn:hover { background: #FAF8FF !important; box-shadow: 0 4px 20px rgba(109,40,253,.12) !important; }
.screen-options-area {
    background: rgba(255,255,255,.97) !important;
    border: 1px solid rgba(124,58,237,.08) !important;
    border-radius: 16px !important;
    box-shadow: 0 8px 32px rgba(109,40,253,.08) !important;
    padding: 20px !important;
    margin-bottom: 20px !important;
}
.screen-options-area .checkbox label { color: #334155 !important; font-size: 13px !important; }

/* ══════════════════════════════════════════════════════════════
   12. MINGROW AI – COMING SOON WIDGET
══════════════════════════════════════════════════════════════ */
.ai-coming-soon-card {
    background: linear-gradient(135deg, #6D28FF, #A855F7) !important;
    border-radius: 20px !important;
    border: none !important;
    padding: 24px !important;
    margin-bottom: 20px !important;
    color: #FFFFFF !important;
    box-shadow: 0 8px 32px rgba(109,40,253,.25) !important;
}
.ai-coming-soon-card h3 { color: #FFFFFF !important; font-size: 16px !important; font-weight: 700 !important; margin-top: 0; margin-bottom: 8px; }
.ai-coming-badge {
    background: rgba(255,255,255,.18);
    color: #FFFFFF;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .6px;
    text-transform: uppercase;
}
.ai-coming-soon-card p { font-size: 12px !important; opacity: .9; line-height: 1.5; margin-bottom: 12px; }
.ai-coming-soon-card .ai-feature { font-size: 12px; margin-bottom: 5px; display: flex; align-items: center; gap: 8px; }
.ai-robot-icon {
    width: 52px; height: 52px;
    background: rgba(255,255,255,.15);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 26px;
    margin: 14px auto 12px;
    animation: ai-pulse 2.2s infinite ease-in-out;
}
@keyframes ai-pulse {
    0%   { transform: scale(1);    box-shadow: 0 0 0 0 rgba(255,255,255,.2); }
    70%  { transform: scale(1.06); box-shadow: 0 0 0 10px rgba(255,255,255,0); }
    100% { transform: scale(1);    box-shadow: 0 0 0 0 rgba(255,255,255,0); }
}
.ai-coming-btn {
    background: rgba(255,255,255,.15) !important;
    color: #FFFFFF !important;
    border: 1.5px solid rgba(255,255,255,.35) !important;
    border-radius: 10px !important;
    padding: 9px 0 !important;
    width: 100% !important;
    font-weight: 600 !important;
    font-size: 13px !important;
    cursor: not-allowed;
    opacity: .9;
    margin-top: 6px;
}

/* ══════════════════════════════════════════════════════════════
   13. QUICK ACTIONS CARD
══════════════════════════════════════════════════════════════ */
.dash-card {
    background: rgba(255,255,255,.95) !important;
    border-radius: 20px !important;
    border: 1px solid rgba(124,58,237,.08) !important;
    box-shadow: 0 4px 24px rgba(109,40,253,.07) !important;
    padding: 22px 24px !important;
    margin-bottom: 20px !important;
    transition: all .25s ease;
}
.dash-card:hover { transform: translateY(-2px) !important; box-shadow: 0 8px 36px rgba(109,40,253,.11) !important; }
.dash-card-title {
    font-size: 15px !important;
    font-weight: 700 !important;
    color: #1E1B4B !important;
    margin-top: 0 !important;
    margin-bottom: 18px !important;
    display: flex;
    align-items: center;
    gap: 9px;
}
.dash-card-title i { color: #6D28FF !important; }

.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
}
.quick-action-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 14px 6px;
    background: rgba(250,248,255,.6);
    border: 1px solid rgba(124,58,237,.06);
    border-radius: 14px;
    text-align: center;
    color: #475569 !important;
    font-weight: 600;
    font-size: 11px !important;
    text-decoration: none !important;
    transition: all .2s ease;
}
.quick-action-btn:hover {
    background: #FAF8FF;
    border-color: rgba(124,58,237,.18);
    color: #6D28FF !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 14px rgba(109,40,253,.08);
}
.qa-icon {
    width: 34px; height: 34px;
    border-radius: 50%;
    background: rgba(109,40,253,.07);
    color: #6D28FF;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px;
    margin-bottom: 7px;
    transition: all .2s;
}
.quick-action-btn:hover .qa-icon { background: #6D28FF; color: #FFF; }

/* ══════════════════════════════════════════════════════════════
   14. TIMELINE (recent activities)
══════════════════════════════════════════════════════════════ */
.mg-timeline { position: relative; padding-left: 18px; }
.mg-timeline::before {
    content: '';
    position: absolute;
    left: 3px; top: 6px; bottom: 6px;
    width: 2px;
    background: rgba(124,58,237,.1);
}
.mg-tl-item { position: relative; padding-bottom: 18px; }
.mg-tl-item:last-child { padding-bottom: 0; }
.mg-tl-dot {
    position: absolute; left: -18px;
    width: 10px; height: 10px;
    border-radius: 50%;
    background: #6D28FF;
    border: 2px solid #FFF;
    box-shadow: 0 0 0 3px rgba(109,40,253,.12);
    top: 3px;
}
.mg-tl-dot.success { background: #22C55E; box-shadow: 0 0 0 3px rgba(34,197,94,.12); }
.mg-tl-dot.warning { background: #F59E0B; box-shadow: 0 0 0 3px rgba(245,158,11,.12); }
.mg-tl-dot.blue    { background: #3B82F6; box-shadow: 0 0 0 3px rgba(59,130,246,.12); }
.mg-tl-dot.info    { background: #06B6D4; box-shadow: 0 0 0 3px rgba(6,182,212,.12); }
.mg-tl-time { font-size: 11px !important; color: #94A3B8 !important; font-weight: 500; margin-bottom: 2px; }
.mg-tl-text { font-size: 12.5px !important; color: #334155 !important; font-weight: 500; line-height: 1.4; }
.mg-tl-text a { color: #6D28FF !important; font-weight: 600; }

/* ══════════════════════════════════════════════════════════════
   15. VIEW-ALL LINK
══════════════════════════════════════════════════════════════ */
.dash-view-all {
    font-size: 12px !important;
    font-weight: 600 !important;
    color: #6D28FF !important;
    text-decoration: none !important;
    padding: 4px 10px;
    border-radius: 8px;
    background: rgba(109,40,253,.06);
    transition: background .2s;
}
.dash-view-all:hover { background: rgba(109,40,253,.12) !important; }

/* ══════════════════════════════════════════════════════════════
   16. EMPTY STATE
══════════════════════════════════════════════════════════════ */
.dash-empty {
    padding: 30px 20px;
    text-align: center;
    color: #94A3B8 !important;
}
.dash-empty i { font-size: 36px; color: #C084FC; margin-bottom: 10px; display: block; }
.dash-empty h4 { font-size: 15px !important; font-weight: 600 !important; color: #1E1B4B !important; margin: 0 0 6px; }
.dash-empty p  { font-size: 13px !important; color: #64748B !important; max-width: 280px; margin: 0 auto; }

/* ══════════════════════════════════════════════════════════════
   17. WIDGET PARAGRAPH / HEADER TITLES inside panel_s
══════════════════════════════════════════════════════════════ */
.panel_s .tw-font-semibold,
.panel_s p.tw-font-semibold {
    color: #1E1B4B !important;
    font-size: 14px !important;
}

/* Widget "View all" link style */
.panel_s a.tw-text-sm {
    color: #6D28FF !important;
    font-weight: 600 !important;
}

/* Selectpicker in chart widget */
.bootstrap-select .btn {
    border-radius: 10px !important;
    border: 1px solid rgba(124,58,237,.1) !important;
    background: #FFF !important;
    font-size: 13px !important;
    color: #4F46E5 !important;
}

/* ══════════════════════════════════════════════════════════════
   18. RESPONSIVE
══════════════════════════════════════════════════════════════ */
@media (max-width: 768px) {
    .content { padding: 14px 12px !important; }
    .quick-actions-grid { grid-template-columns: repeat(2, 1fr); }
}
</style>

<div id="wrapper">
    <!-- ▸ Dashboard Options / Screen Options button (Perfex native) -->
    <div class="screen-options-area"></div>
    <div class="screen-options-btn">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" style="width:18px;height:18px;">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <?= _l('dashboard_options'); ?>
    </div>

    <div class="content">
        <!-- Alerts -->
        <div class="row">
            <?php $this->load->view('admin/includes/alerts'); ?>
            <?php hooks()->do_action('before_start_render_dashboard_content'); ?>
            <div class="clearfix"></div>
        </div>

        <!-- ═══════════════════════════════════════════
             WELCOME HEADER
        ════════════════════════════════════════════ -->
        <div class="row" style="margin-bottom:22px;">
            <div class="col-md-12" style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
                <div>
                    <h1 class="dash-welcome-title">
                        <?php
                        $hour = (int)date('G');
                        $greet = $hour < 12 ? 'Good Morning' : ($hour < 17 ? 'Good Afternoon' : 'Good Evening');
                        $full  = get_staff_full_name(get_staff_user_id());
                        $first = explode(' ', $full)[0];
                        echo e($greet . ', ' . $first) . ' 👋';
                        ?>
                    </h1>
                    <p class="dash-welcome-sub">Here's what's happening in your business today.</p>
                </div>
                <div class="dash-date-btn">
                    <i class="fa-regular fa-calendar"></i>
                    <span><?php echo date('F 01') . ' – ' . date('F t, Y'); ?></span>
                </div>
            </div>
        </div>

        <!-- ═══════════════════════════════════════════
             ROW: TOP-12 WIDGETS  (top stats / stats overview)
             Container key: "top-12"
        ════════════════════════════════════════════ -->
        <div class="row" data-container="top-12">
            <?php render_dashboard_widgets('top-12'); ?>
        </div>

        <!-- ═══════════════════════════════════════════
             ROW: LEFT-8 WIDGETS + RIGHT-4 WIDGETS
             (two-column drag-drop area)
        ════════════════════════════════════════════ -->
        <div class="row">
            <!-- LEFT column (8 cols) -->
            <div class="col-md-8" data-container="left-8">
                <?php render_dashboard_widgets('left-8'); ?>
            </div>

            <!-- RIGHT column (4 cols) with sidebar widgets + AI card -->
            <div class="col-md-4">
                <!-- Sidebar drag-drop widgets -->
                <div data-container="right-4">
                    <?php render_dashboard_widgets('right-4'); ?>
                </div>

                <!-- Recent Activities (uses $activity_log from controller) -->
                <div class="dash-card">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
                        <h3 class="dash-card-title" style="margin-bottom:0!important;">
                            <i class="fa-solid fa-list-check"></i> Recent Activities
                        </h3>
                        <a href="<?php echo admin_url('activities'); ?>" class="dash-view-all">View All</a>
                    </div>
                    <div class="mg-timeline">
                        <?php
                        $act_count = 0;
                        if (isset($activity_log) && is_array($activity_log)) {
                            foreach ($activity_log as $log) {
                                if ($act_count >= 8) break;
                                $parsed = parse_activity_item($log['description']);
                                $act_count++;
                        ?>
                        <div class="mg-tl-item">
                            <div class="mg-tl-dot <?php echo $parsed['class']; ?>"></div>
                            <div class="mg-tl-time"><?php echo time_ago($log['date']); ?></div>
                            <div class="mg-tl-text"><?php echo $parsed['text']; ?></div>
                        </div>
                        <?php
                            }
                        }
                        if ($act_count === 0) {
                            echo '<div class="text-center" style="color:#94A3B8;font-size:13px;padding:20px 0;">No recent activities yet.</div>';
                        }
                        ?>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="dash-card">
                    <h3 class="dash-card-title"><i class="fa fa-bolt"></i> Quick Actions</h3>
                    <div class="quick-actions-grid">
                        <a href="<?php echo admin_url('leads'); ?>" class="quick-action-btn">
                            <div class="qa-icon"><i class="fa fa-bullseye"></i></div>
                            <span>Create Lead</span>
                        </a>
                        <a href="<?php echo admin_url('invoices/invoice'); ?>" class="quick-action-btn">
                            <div class="qa-icon"><i class="fa-regular fa-file-lines"></i></div>
                            <span>New Invoice</span>
                        </a>
                        <a href="<?php echo admin_url('clients/client'); ?>" class="quick-action-btn">
                            <div class="qa-icon"><i class="fa fa-user-plus"></i></div>
                            <span>Add Client</span>
                        </a>
                        <a href="<?php echo admin_url('projects/project'); ?>" class="quick-action-btn">
                            <div class="qa-icon"><i class="fa-solid fa-chart-gantt"></i></div>
                            <span>New Project</span>
                        </a>
                        <a href="<?php echo admin_url('tasks'); ?>" class="quick-action-btn">
                            <div class="qa-icon"><i class="fa fa-tasks"></i></div>
                            <span>Add Task</span>
                        </a>
                        <a href="<?php echo admin_url('tickets/open_ticket'); ?>" class="quick-action-btn">
                            <div class="qa-icon"><i class="fa-regular fa-life-ring"></i></div>
                            <span>Open Ticket</span>
                        </a>
                    </div>
                </div>

                <!-- Mingrow AI — Coming Soon -->
                <div class="ai-coming-soon-card">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                        <h3>Discover Mingrow AI</h3>
                        <span class="ai-coming-badge">Coming Soon</span>
                    </div>
                    <p>AI-powered business automation, smart analytics, lead intelligence &amp; workflow automation — all in one dashboard.</p>
                    <div class="ai-feature"><i class="fa fa-check-circle"></i> Revenue forecasting &amp; predictions</div>
                    <div class="ai-feature"><i class="fa fa-check-circle"></i> Smart lead scoring</div>
                    <div class="ai-feature"><i class="fa fa-check-circle"></i> Task prioritization engine</div>
                    <div class="ai-robot-icon"><i class="fa-solid fa-robot"></i></div>
                    <button class="ai-coming-btn" disabled>Explore AI Assistant</button>
                </div>
            </div>
        </div>

        <?php hooks()->do_action('after_dashboard'); ?>
    </div><!-- /.content -->
</div><!-- /#wrapper -->

<script>
    app.calendarIDs = '<?= json_encode($google_ids_calendars); ?>';
</script>

<?php init_tail(); ?>
<?php $this->load->view('admin/utilities/calendar_template'); ?>
<?php $this->load->view('admin/dashboard/dashboard_js'); ?>
</body>
</html>