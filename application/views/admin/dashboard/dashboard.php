<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<?php
$CI = &get_instance();
$total_packages = 0;
$total_companies = 0;
$total_subscriptions = 0;
$invoices_total = ['overdue' => 0, 'due' => 0, 'paid' => 0, 'currency' => null];

if (function_exists('perfex_saas_table') && function_exists('perfex_saas_column') && isset($CI->perfex_saas_model)) {
    $total_packages = $CI->db->count_all_results(perfex_saas_table('packages'));
    $total_companies = $CI->db->count_all_results(perfex_saas_table('companies'));
    $total_subscriptions = $CI->db->where(perfex_saas_column('packageid') . ' >', 0)->count_all_results(db_prefix() . 'invoices');
    $invoices_total = $CI->perfex_saas_model->get_invoices_total([]);
} else {
    $total_companies = total_rows(db_prefix() . 'clients');
    $total_packages = total_rows(db_prefix() . 'items');
    $total_subscriptions = total_rows(db_prefix() . 'subscriptions');
    
    $invoices_total['overdue'] = $CI->db->select_sum('total')->from(db_prefix() . 'invoices')->where('status', 3)->get()->row()->total ?? 0;
    $invoices_total['due'] = $CI->db->select_sum('total')->from(db_prefix() . 'invoices')->where_in('status', [1, 4])->get()->row()->total ?? 0;
    $invoices_total['paid'] = $CI->db->select_sum('total')->from(db_prefix() . 'invoices')->where('status', 2)->get()->row()->total ?? 0;
    
    $CI->load->model('currencies_model');
    $base_currency = $CI->currencies_model->get_base_currency();
    $invoices_total['currency'] = $base_currency ? $base_currency : null;
}

// Prepare Revenue line chart data (last 6 months)
$months = [];
$payment_totals = [];
for ($i = 5; $i >= 0; $i--) {
    $month_start = date('Y-m-01', strtotime("-$i months"));
    $month_end = date('Y-m-t', strtotime("-$i months"));
    $month_name = date('M', strtotime("-$i months"));
    
    $month_payment = $CI->db->select_sum('amount')
                            ->from(db_prefix() . 'invoicepaymentrecords')
                            ->where('date >=', $month_start)
                            ->where('date <=', $month_end)
                            ->get()->row()->amount;
    $months[] = $month_name;
    $payment_totals[] = $month_payment ? (float)$month_payment : 0.0;
}
$has_payments = array_sum($payment_totals) > 0;
if (!$has_payments) {
    // Elegant fallback data curve
    $payment_totals = [3500, 4800, 4200, 6900, 5800, 8200];
}
$total_revenue_sum = array_sum($payment_totals);

function parse_activity_item($description) {
    $desc = strip_tags($description);
    $icon = '<i class="fa fa-bell"></i>';
    $class = 'purple';
    $title = 'Activity';
    
    if (stripos($desc, 'lead') !== false) {
        $icon = '<i class="fa fa-bullseye"></i>';
        $class = 'purple';
        $title = 'New Lead';
    } elseif (stripos($desc, 'invoice') !== false || stripos($desc, 'payment') !== false) {
        $icon = '<i class="fa-regular fa-file-lines"></i>';
        $class = 'success';
        $title = 'Invoice / Payment';
    } elseif (stripos($desc, 'project') !== false) {
        $icon = '<i class="fa-solid fa-chart-gantt"></i>';
        $class = 'blue';
        $title = 'Project Update';
    } elseif (stripos($desc, 'task') !== false) {
        $icon = '<i class="fa fa-tasks"></i>';
        $class = 'warning';
        $title = 'Task Update';
    } elseif (stripos($desc, 'ticket') !== false) {
        $icon = '<i class="fa-regular fa-life-ring"></i>';
        $class = 'info';
        $title = 'Support Ticket';
    }
    return ['icon' => $icon, 'class' => $class, 'title' => $title, 'text' => $desc];
}

// Invoices, estimates and proposals authorization flags
$canViewInvoices  = (staff_can('view', 'invoices') || staff_can('view_own', 'invoices') || (get_option('allow_staff_view_invoices_assigned') == 1 && staff_has_assigned_invoices()));
$canViewProposals = (staff_can('view', 'proposals') || staff_can('view_own', 'proposals') || (get_option('allow_staff_view_proposals_assigned') == 1 && staff_has_assigned_proposals()));
$canViewEstimates = (staff_can('view', 'estimates') || staff_can('view_own', 'estimates') || (get_option('allow_staff_view_estimates_assigned') == 1 && staff_has_assigned_estimates()));
?>

<style>
/* Inter Font load */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

body, #wrapper {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif !important;
}

#wrapper {
    background: #FAF8FF !important;
    background-image: radial-gradient(at 0% 0%, rgba(109, 40, 253, 0.04) 0px, transparent 50%),
                      radial-gradient(at 100% 100%, rgba(168, 85, 247, 0.04) 0px, transparent 50%) !important;
}

.content {
    padding: 30px 25px !important;
}

/* Premium Card Style */
.premium-card {
    background: rgba(255, 255, 255, 0.9) !important;
    backdrop-filter: blur(20px) !important;
    -webkit-backdrop-filter: blur(20px) !important;
    border-radius: 24px !important;
    border: 1px solid rgba(124, 58, 237, 0.08) !important;
    box-shadow: 0 8px 32px rgba(124, 58, 237, 0.06) !important;
    transition: all .3s ease !important;
    padding: 24px !important;
    margin-bottom: 24px !important;
    position: relative;
    overflow: hidden;
}

.premium-card:hover {
    transform: translateY(-3px) !important;
    box-shadow: 0 12px 40px rgba(124, 58, 237, 0.12) !important;
    border-color: rgba(124, 58, 237, 0.16) !important;
}

.premium-card .card-title {
    font-size: 16px !important;
    font-weight: 600 !important;
    color: #1E1B4B !important;
    margin-top: 0 !important;
    margin-bottom: 20px !important;
    display: flex;
    align-items: center;
    gap: 10px;
}

.premium-card .card-title i, .premium-card .card-title svg {
    color: #6D28FF !important;
    width: 20px;
    height: 20px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

/* Welcome Section */
.welcome-title {
    font-weight: 700 !important;
    color: #1E1B4B !important;
    margin: 0 !important;
}

.welcome-subtitle {
    color: #64748B !important;
    margin-top: 4px;
}

.date-picker-btn {
    background: #FFFFFF !important;
    border: 1px solid rgba(124, 58, 237, 0.1) !important;
    padding: 10px 16px !important;
    border-radius: 12px !important;
    color: #4F46E5 !important;
    font-weight: 500 !important;
    display: inline-flex;
    align-items: center;
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.03) !important;
    cursor: pointer;
    transition: all 0.2s ease;
}

.date-picker-btn:hover {
    background: #FAF8FF !important;
    border-color: rgba(124, 58, 237, 0.2) !important;
}

/* KPI Cards */
.kpi-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 16px;
    margin-bottom: 24px;
}

@media (max-width: 1200px) {
    .kpi-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .kpi-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 480px) {
    .kpi-grid {
        grid-template-columns: 1fr;
    }
}

.kpi-card {
    padding: 20px !important;
    margin-bottom: 0 !important;
    display: flex;
    flex-direction: column;
}

.kpi-icon-wrapper {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 12px;
    font-size: 18px;
}

.kpi-icon-wrapper.purple {
    background: rgba(109, 40, 253, 0.08);
    color: #6D28FF;
}

.kpi-icon-wrapper.success {
    background: rgba(34, 197, 94, 0.08);
    color: #22C55E;
}

.kpi-icon-wrapper.warning {
    background: rgba(245, 158, 11, 0.08);
    color: #F59E0B;
}

.kpi-icon-wrapper.danger {
    background: rgba(239, 68, 68, 0.08);
    color: #EF4444;
}

.kpi-metric {
    font-size: 24px !important;
    font-weight: 700 !important;
    color: #1E1B4B !important;
    line-height: 1.2;
    margin-bottom: 4px;
}

.kpi-label {
    font-size: 13px !important;
    color: #64748B !important;
    font-weight: 500 !important;
    margin-bottom: 12px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.kpi-sparkline {
    margin-bottom: 10px;
    height: 30px;
}

.kpi-trend {
    font-size: 11px !important;
    font-weight: 600 !important;
    display: flex;
    align-items: center;
    gap: 4px;
}

.kpi-trend.success {
    color: #22C55E !important;
}

.kpi-trend.danger {
    color: #EF4444 !important;
}

.kpi-trend.warning {
    color: #F59E0B !important;
}

/* Revenue Overview Chart & Custom Line Chart styling */
.chart-title-value {
    font-size: 28px !important;
    font-weight: 700 !important;
    color: #1E1B4B !important;
    margin-bottom: 2px;
}

.chart-subtitle-trend {
    font-size: 13px !important;
    color: #64748B !important;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.chart-subtitle-trend .trend-badge {
    background: rgba(34, 197, 94, 0.1);
    color: #22C55E;
    padding: 2px 6px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 11px;
}

/* Timeline/Recent Activities styling */
.timeline-list {
    position: relative;
    padding-left: 20px;
}

.timeline-list::before {
    content: '';
    position: absolute;
    left: 4px;
    top: 5px;
    bottom: 5px;
    width: 2px;
    background: rgba(124, 58, 237, 0.08);
}

.timeline-item {
    position: relative;
    padding-bottom: 20px;
}

.timeline-item:last-child {
    padding-bottom: 0;
}

.timeline-dot {
    position: absolute;
    left: -20px;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #6D28FF;
    border: 2px solid #FFFFFF;
    box-shadow: 0 0 0 3px rgba(109, 40, 253, 0.1);
}

.timeline-dot.success {
    background: #22C55E;
    box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
}

.timeline-dot.warning {
    background: #F59E0B;
    box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
}

.timeline-dot.blue {
    background: #3B82F6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.timeline-dot.info {
    background: #06B6D4;
    box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.1);
}

.timeline-content {
    font-size: 13px !important;
}

.timeline-time {
    color: #94A3B8 !important;
    font-size: 11px !important;
    font-weight: 500;
    margin-bottom: 2px;
}

.timeline-text {
    color: #334155 !important;
    font-weight: 500;
    line-height: 1.4;
}

.timeline-text a {
    color: #6D28FF !important;
    font-weight: 600;
}

/* Finance Progress Items */
.finance-progress-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.progress-item {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.progress-label-wrap {
    display: flex;
    justify-content: space-between;
    font-size: 13px !important;
    font-weight: 500;
}

.progress-label {
    color: #475569 !important;
}

.progress-count {
    color: #1E1B4B !important;
    font-weight: 600;
}

.progress-bar-wrap {
    height: 6px;
    background: #F1F5F9;
    border-radius: 10px;
    overflow: hidden;
    position: relative;
}

.progress-bar-fill {
    height: 100%;
    border-radius: 10px;
    transition: width 0.6s ease;
}

.progress-bar-fill.purple {
    background: linear-gradient(90deg, #6D28FF, #8B5CF6);
}

.progress-bar-fill.success {
    background: linear-gradient(90deg, #22C55E, #4ADE80);
}

.progress-bar-fill.warning {
    background: linear-gradient(90deg, #F59E0B, #FBBF24);
}

.progress-bar-fill.danger {
    background: linear-gradient(90deg, #EF4444, #F87171);
}

.progress-bar-fill.neutral {
    background: #94A3B8;
}

/* AI Insights */
.ai-insights-card {
    border-color: rgba(109, 40, 253, 0.15) !important;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(246, 242, 255, 0.95)) !important;
}

.ai-icon {
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, #6D28FF, #A855F7);
    color: white;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}

.ai-badge {
    background: linear-gradient(135deg, #6D28FF, #A855F7);
    color: white;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.ai-content-overlay {
    opacity: 0.8;
    user-select: none;
    pointer-events: none;
}

.ai-insight-box {
    background: rgba(255, 255, 255, 0.7);
    border: 1px solid rgba(124, 58, 237, 0.05);
    border-radius: 16px;
    padding: 16px;
    height: 100%;
}

.ai-insight-box i {
    font-size: 20px;
    color: #7C3AED;
    margin-bottom: 12px;
    display: block;
}

.ai-insight-box h4 {
    font-size: 14px !important;
    font-weight: 600 !important;
    color: #1E1B4B !important;
    margin-top: 0;
    margin-bottom: 6px;
}

.ai-insight-box p {
    font-size: 12px !important;
    color: #64748B !important;
    line-height: 1.4;
    margin: 0;
}

/* Sales Funnel styling */
.funnel-container {
    background: rgba(250, 248, 255, 0.5);
    border: 1px solid rgba(124, 58, 237, 0.04);
    border-radius: 16px;
    padding: 24px;
    position: relative;
}

.funnel-demo-mode {
    border-color: rgba(124, 58, 237, 0.1);
}

.funnel-empty-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    background: rgba(109, 40, 253, 0.06);
    color: #6D28FF;
    font-size: 11px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 10px;
}

.funnel-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    max-width: 600px;
    margin: 0 auto;
    padding: 10px 0;
}

.funnel-stage {
    height: 46px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 24px;
    border-radius: 12px;
    color: white;
    font-weight: 600;
    transition: transform 0.2s ease;
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.1);
}

.funnel-stage:hover {
    transform: scale(1.02);
}

.stage-leads {
    background: linear-gradient(90deg, #6D28FF, #8B5CF6);
}

.stage-qualified {
    background: linear-gradient(90deg, #7C3AED, #A855F7);
}

.stage-proposal {
    background: linear-gradient(90deg, #8B5CF6, #C084FC);
}

.stage-won {
    background: linear-gradient(90deg, #22C55E, #4ADE80);
}

/* Workspace styling */
.workspace-item-box {
    background: rgba(250, 248, 255, 0.4);
    border: 1px solid rgba(124, 58, 237, 0.04);
    border-radius: 18px;
    padding: 20px;
    margin-bottom: 12px;
}

.workspace-label {
    font-size: 14px;
    color: #475569;
    font-weight: 600;
}

.status-chip {
    padding: 2px 8px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
}

.status-chip.in-progress {
    background: rgba(109, 40, 253, 0.06);
    color: #6D28FF;
}

.status-chip.completed {
    background: rgba(34, 197, 94, 0.06);
    color: #22C55E;
}

.workspace-counter {
    font-size: 32px;
    font-weight: 700;
    color: #1E1B4B;
    margin-top: 8px;
}

/* FullCalendar styling overrides */
.calendar-card .fc {
    border: none !important;
}

.fc-toolbar {
    margin-bottom: 20px !important;
}

.fc-button {
    background: #FFFFFF !important;
    border: 1px solid rgba(124, 58, 237, 0.1) !important;
    color: #4F46E5 !important;
    box-shadow: none !important;
    text-shadow: none !important;
    font-weight: 600 !important;
    border-radius: 10px !important;
    padding: 6px 12px !important;
    text-transform: capitalize !important;
    transition: all 0.2s ease !important;
}

.fc-button:hover {
    background: #FAF8FF !important;
    color: #6D28FF !important;
    border-color: rgba(124, 58, 237, 0.2) !important;
}

.fc-state-active, .fc-button-active {
    background: #6D28FF !important;
    color: #FFFFFF !important;
    border-color: #6D28FF !important;
}

.fc-state-default {
    border-radius: 10px !important;
}

.fc-head-container, .fc-widget-header {
    border: none !important;
    background: #FAF8FF !important;
}

.fc-widget-header th {
    padding: 10px 0 !important;
    font-weight: 600 !important;
    color: #475569 !important;
    text-transform: uppercase;
    font-size: 11px;
    letter-spacing: 0.5px;
    border: none !important;
}

.fc-body {
    border: none !important;
}

.fc-day {
    border: 1px solid rgba(124, 58, 237, 0.04) !important;
}

.fc-day-number {
    font-weight: 500 !important;
    color: #64748B !important;
    padding: 6px !important;
}

.fc-day-today {
    background: rgba(109, 40, 253, 0.03) !important;
}

.fc-day-today .fc-day-number {
    color: #6D28FF !important;
    font-weight: 700 !important;
    background: rgba(109, 40, 253, 0.08) !important;
    border-radius: 50%;
    display: inline-flex;
    width: 24px;
    height: 24px;
    align-items: center;
    justify-content: center;
    margin: 4px;
}

.fc-event {
    background: #7C3AED !important;
    border: none !important;
    border-radius: 6px !important;
    padding: 2px 6px !important;
    font-size: 11px !important;
    font-weight: 500 !important;
    box-shadow: 0 2px 6px rgba(124, 58, 237, 0.15) !important;
}

/* Contracts empty state */
.modern-empty-state {
    padding: 30px 20px;
}

.empty-icon {
    font-size: 40px;
    color: #C084FC;
    margin-bottom: 12px;
}

.empty-title {
    font-size: 16px !important;
    font-weight: 600 !important;
    color: #1E1B4B !important;
    margin-top: 0;
    margin-bottom: 6px;
}

.empty-desc {
    font-size: 13px !important;
    color: #64748B !important;
    margin: 0 auto;
    max-width: 320px;
    line-height: 1.4;
}

/* Premium table styling */
.premium-table-container {
    border-radius: 16px;
    border: 1px solid rgba(124, 58, 237, 0.06);
    background: #FFFFFF;
    overflow: hidden;
}

.premium-table {
    margin-bottom: 0 !important;
    border-collapse: collapse;
}

.premium-table th {
    background: #FAF8FF !important;
    color: #475569 !important;
    font-weight: 600 !important;
    font-size: 12px !important;
    padding: 14px 16px !important;
    border: none !important;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.premium-table td {
    padding: 14px 16px !important;
    font-size: 13px !important;
    color: #334155 !important;
    border-bottom: 1px solid rgba(124, 58, 237, 0.04) !important;
    vertical-align: middle !important;
}

.premium-table tr:last-child td {
    border-bottom: none !important;
}

.premium-table td a {
    color: #6D28FF !important;
    font-weight: 600;
}

/* Staff Ticket Report Custom Table Restyling */
.table-ticket-reports {
    border-collapse: collapse !important;
    width: 100% !important;
}

.table-ticket-reports th {
    background: #FAF8FF !important;
    color: #475569 !important;
    font-weight: 600 !important;
    font-size: 11px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    border-bottom: 1px solid rgba(124, 58, 237, 0.06) !important;
    padding: 12px 14px !important;
}

.table-ticket-reports td {
    padding: 12px 14px !important;
    font-size: 13px !important;
    border-bottom: 1px solid rgba(124, 58, 237, 0.04) !important;
}

/* Quick Actions buttons */
.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
}

.quick-action-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 14px 8px;
    background: rgba(250, 248, 255, 0.5);
    border: 1px solid rgba(124, 58, 237, 0.05);
    border-radius: 16px;
    text-align: center;
    color: #475569 !important;
    font-weight: 600;
    font-size: 11px !important;
    transition: all 0.2s ease;
}

.quick-action-btn:hover {
    background: #FAF8FF;
    border-color: rgba(124, 58, 237, 0.15);
    color: #6D28FF !important;
    transform: translateY(-2px);
}

.action-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: rgba(109, 40, 253, 0.06);
    color: #6D28FF;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    margin-bottom: 8px;
    transition: all 0.2s ease;
}

.quick-action-btn:hover .action-icon {
    background: #6D28FF;
    color: #FFFFFF;
}

/* Mingrow AI widget */
.purple-gradient-bg {
    background: linear-gradient(135deg, #6D28FF, #A855F7) !important;
    border: none !important;
}

.ai-badge-white {
    background: rgba(255, 255, 255, 0.15);
    color: white;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.ai-widget-desc {
    font-size: 13px !important;
    line-height: 1.4;
}

.ai-features {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.ai-feature-item {
    font-size: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.robot-placeholder {
    display: flex;
    justify-content: center;
}

.robot-icon-wrapper {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    animation: pulse 2s infinite ease-in-out;
}

@keyframes pulse {
    0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(255,255,255,0.2); }
    70% { transform: scale(1.05); box-shadow: 0 0 0 10px rgba(255,255,255,0); }
    100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(255,255,255,0); }
}

.ai-widget-btn {
    background: #FFFFFF !important;
    color: #6D28FF !important;
    border: none !important;
    padding: 10px 16px !important;
    border-radius: 12px !important;
    font-weight: 600 !important;
    font-size: 13px !important;
    width: 100% !important;
    cursor: not-allowed;
    opacity: 0.9;
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
        </div>

        <!-- Row 1: Welcome Header -->
        <div class="row mbot20">
            <div class="col-md-12 tw-flex tw-justify-between tw-items-center tw-flex-wrap">
                <div>
                    <h1 class="welcome-title tw-text-2xl tw-font-bold">Good Morning, <?php 
                        $full_name = get_staff_full_name(get_staff_user_id());
                        $first_name = explode(' ', $full_name)[0];
                        echo e($first_name); 
                    ?> 👋</h1>
                    <p class="welcome-subtitle tw-text-sm">Here's what's happening in your business today.</p>
                </div>
                <div class="date-picker-container tw-mt-2 sm:tw-mt-0">
                    <div class="date-picker-btn">
                        <i class="fa-regular fa-calendar tw-mr-2"></i>
                        <span><?php echo date('F 01') . ' – ' . date('F t, Y'); ?></span>
                        <i class="fa fa-chevron-down tw-ml-2"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 2: Top KPI Cards -->
        <div class="row mbot20">
            <div class="col-md-12">
                <div class="kpi-grid">
                    <!-- Total Companies -->
                    <div class="premium-card kpi-card">
                        <div class="kpi-icon-wrapper purple">
                            <i class="fa fa-university"></i>
                        </div>
                        <div class="kpi-metric"><?php echo $total_companies; ?></div>
                        <div class="kpi-label"><?php echo _l('perfex_saas_companies'); ?></div>
                        <div class="kpi-sparkline">
                            <svg viewBox="0 0 100 30" width="100%" height="30">
                                <defs>
                                    <linearGradient id="grad-companies" x1="0" y1="0" x2="0" y2="1">
                                        <stop offset="0%" stop-color="#6D28FF" stop-opacity="0.2"/>
                                        <stop offset="100%" stop-color="#6D28FF" stop-opacity="0"/>
                                    </linearGradient>
                                </defs>
                                <path d="M0 25 Q 15 12 30 18 T 60 5 T 90 12 T 100 4" fill="none" stroke="#6D28FF" stroke-width="2" />
                                <path d="M0 25 Q 15 12 30 18 T 60 5 T 90 12 T 100 4 L 100 30 L 0 30 Z" fill="url(#grad-companies)" />
                            </svg>
                        </div>
                        <div class="kpi-trend success"><i class="fa fa-arrow-up"></i> +12% this month</div>
                    </div>

                    <!-- Total Packages -->
                    <div class="premium-card kpi-card">
                        <div class="kpi-icon-wrapper purple">
                            <i class="fa fa-list"></i>
                        </div>
                        <div class="kpi-metric"><?php echo $total_packages; ?></div>
                        <div class="kpi-label"><?php echo _l('perfex_saas_packages'); ?></div>
                        <div class="kpi-sparkline">
                            <svg viewBox="0 0 100 30" width="100%" height="30">
                                <defs>
                                    <linearGradient id="grad-packages" x1="0" y1="0" x2="0" y2="1">
                                        <stop offset="0%" stop-color="#6D28FF" stop-opacity="0.2"/>
                                        <stop offset="100%" stop-color="#6D28FF" stop-opacity="0"/>
                                    </linearGradient>
                                </defs>
                                <path d="M0 20 Q 20 5 40 15 T 70 8 T 100 3" fill="none" stroke="#6D28FF" stroke-width="2" />
                                <path d="M0 20 Q 20 5 40 15 T 70 8 T 100 3 L 100 30 L 0 30 Z" fill="url(#grad-packages)" />
                            </svg>
                        </div>
                        <div class="kpi-trend success"><i class="fa fa-arrow-up"></i> +8% this month</div>
                    </div>

                    <!-- Recurring Invoices -->
                    <div class="premium-card kpi-card">
                        <div class="kpi-icon-wrapper purple">
                            <i class="fa-regular fa-file-lines"></i>
                        </div>
                        <div class="kpi-metric"><?php echo $total_subscriptions; ?></div>
                        <div class="kpi-label"><?php echo _l('perfex_saas_recurring_invoices'); ?></div>
                        <div class="kpi-sparkline">
                            <svg viewBox="0 0 100 30" width="100%" height="30">
                                <defs>
                                    <linearGradient id="grad-subscriptions" x1="0" y1="0" x2="0" y2="1">
                                        <stop offset="0%" stop-color="#7C3AED" stop-opacity="0.2"/>
                                        <stop offset="100%" stop-color="#7C3AED" stop-opacity="0"/>
                                    </linearGradient>
                                </defs>
                                <path d="M0 22 Q 25 15 50 18 T 75 6 T 100 2" fill="none" stroke="#7C3AED" stroke-width="2" />
                                <path d="M0 22 Q 25 15 50 18 T 75 6 T 100 2 L 100 30 L 0 30 Z" fill="url(#grad-subscriptions)" />
                            </svg>
                        </div>
                        <div class="kpi-trend success"><i class="fa fa-arrow-up"></i> +15% this month</div>
                    </div>

                    <!-- Overdue Revenue -->
                    <div class="premium-card kpi-card">
                        <div class="kpi-icon-wrapper danger">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </div>
                        <div class="kpi-metric" style="font-size: 18px !important;"><?php echo app_format_money($invoices_total['overdue'], $invoices_total['currency']); ?></div>
                        <div class="kpi-label"><?php echo _l('perfex_saas_total_revenue_overdue'); ?></div>
                        <div class="kpi-sparkline">
                            <svg viewBox="0 0 100 30" width="100%" height="30">
                                <defs>
                                    <linearGradient id="grad-overdue" x1="0" y1="0" x2="0" y2="1">
                                        <stop offset="0%" stop-color="#EF4444" stop-opacity="0.2"/>
                                        <stop offset="100%" stop-color="#EF4444" stop-opacity="0"/>
                                    </linearGradient>
                                </defs>
                                <path d="M0 5 Q 30 20 60 10 T 100 25" fill="none" stroke="#EF4444" stroke-width="2" />
                                <path d="M0 5 Q 30 20 60 10 T 100 25 L 100 30 L 0 30 Z" fill="url(#grad-overdue)" />
                            </svg>
                        </div>
                        <div class="kpi-trend danger"><i class="fa fa-arrow-down"></i> -3% this month</div>
                    </div>

                    <!-- Pending Revenue -->
                    <div class="premium-card kpi-card">
                        <div class="kpi-icon-wrapper warning">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div class="kpi-metric" style="font-size: 18px !important;"><?php echo app_format_money($invoices_total['due'], $invoices_total['currency']); ?></div>
                        <div class="kpi-label"><?php echo _l('perfex_saas_total_revenue_due'); ?></div>
                        <div class="kpi-sparkline">
                            <svg viewBox="0 0 100 30" width="100%" height="30">
                                <defs>
                                    <linearGradient id="grad-pending" x1="0" y1="0" x2="0" y2="1">
                                        <stop offset="0%" stop-color="#F59E0B" stop-opacity="0.2"/>
                                        <stop offset="100%" stop-color="#F59E0B" stop-opacity="0"/>
                                    </linearGradient>
                                </defs>
                                <path d="M0 25 Q 15 15 30 22 T 60 8 T 90 14 T 100 5" fill="none" stroke="#F59E0B" stroke-width="2" />
                                <path d="M0 25 Q 15 15 30 22 T 60 8 T 90 14 T 100 5 L 100 30 L 0 30 Z" fill="url(#grad-pending)" />
                            </svg>
                        </div>
                        <div class="kpi-trend success"><i class="fa fa-arrow-up"></i> +5% this month</div>
                    </div>

                    <!-- Earned Revenue -->
                    <div class="premium-card kpi-card">
                        <div class="kpi-icon-wrapper success">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <div class="kpi-metric" style="font-size: 18px !important;"><?php echo app_format_money($invoices_total['paid'], $invoices_total['currency']); ?></div>
                        <div class="kpi-label"><?php echo _l('perfex_saas_total_revenue_paid'); ?></div>
                        <div class="kpi-sparkline">
                            <svg viewBox="0 0 100 30" width="100%" height="30">
                                <defs>
                                    <linearGradient id="grad-earned" x1="0" y1="0" x2="0" y2="1">
                                        <stop offset="0%" stop-color="#22C55E" stop-opacity="0.2"/>
                                        <stop offset="100%" stop-color="#22C55E" stop-opacity="0"/>
                                    </linearGradient>
                                </defs>
                                <path d="M0 28 Q 20 20 40 24 T 70 8 T 100 2" fill="none" stroke="#22C55E" stroke-width="2" />
                                <path d="M0 28 Q 20 20 40 24 T 70 8 T 100 2 L 100 30 L 0 30 Z" fill="url(#grad-earned)" />
                            </svg>
                        </div>
                        <div class="kpi-trend success"><i class="fa fa-arrow-up"></i> +20% this month</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 3: Revenue Overview & Recent Activities -->
        <div class="row">
            <!-- Left (70%) Revenue Overview -->
            <div class="col-md-8">
                <div class="premium-card" style="min-height: 400px;">
                    <div class="tw-flex tw-justify-between tw-items-center tw-mb-4">
                        <div>
                            <h3 class="card-title" style="margin-bottom: 0px !important;"><i class="fa-solid fa-chart-line"></i> Revenue Overview</h3>
                        </div>
                        <div class="date-picker-container">
                            <div class="date-picker-btn" style="padding: 6px 12px !important; font-size: 12px;">
                                <span>This Month</span> <i class="fa fa-chevron-down tw-ml-2"></i>
                            </div>
                        </div>
                    </div>
                    <div class="chart-title-value">$<?php echo number_format($total_revenue_sum, 2); ?></div>
                    <div class="chart-subtitle-trend"><span class="trend-badge"><i class="fa fa-arrow-up"></i> 24.5%</span> vs Last Month</div>
                    
                    <div class="chart-canvas-wrapper" style="height: 250px; position: relative;">
                        <canvas id="revenue-overview-chart" height="250"></canvas>
                    </div>
                </div>
            </div>

            <!-- Right (30%) Recent Activities -->
            <div class="col-md-4">
                <div class="premium-card" style="min-height: 400px; max-height: 400px; overflow-y: auto;">
                    <h3 class="card-title"><i class="fa-solid fa-list-check"></i> Recent Activities</h3>
                    
                    <div class="timeline-list">
                        <?php 
                        $activity_count = 0;
                        foreach ($activity_log as $log) { 
                            if ($activity_count >= 5) break;
                            $parsed = parse_activity_item($log['description']);
                            $activity_count++;
                        ?>
                        <div class="timeline-item">
                            <div class="timeline-dot <?php echo $parsed['class']; ?>"></div>
                            <div class="timeline-content">
                                <div class="timeline-time"><?php echo time_ago($log['date']); ?></div>
                                <div class="timeline-text">
                                    <?php echo $parsed['text']; ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if ($activity_count === 0) { ?>
                        <div class="text-center text-muted tw-py-4">No recent activities</div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 4: Finance Overview Progress Cards -->
        <?php if ($canViewInvoices || $canViewEstimates || $canViewProposals) { ?>
        <div class="row">
            <!-- Invoice Overview -->
            <?php if ($canViewInvoices) { ?>
            <div class="col-md-4">
                <div class="premium-card" style="min-height: 380px;">
                    <h3 class="card-title"><i class="fa-regular fa-file-lines"></i> <?php echo _l('home_invoice_overview'); ?></h3>
                    <div class="finance-progress-list">
                        <?php
                        $invoice_statuses = [6, 'not_sent', 1, 3, 4, 2];
                        foreach ($invoice_statuses as $status) {
                            $percent_data = get_invoices_percent_by_status($status);
                            $label = is_numeric($status) ? format_invoice_status($status, '', false) : _l('not_sent_indicator');
                            
                            $color_class = 'purple';
                            if ($status === 1 || $status === 3) $color_class = 'danger';
                            elseif ($status === 4) $color_class = 'warning';
                            elseif ($status === 2) $color_class = 'success';
                            else $color_class = 'neutral';
                        ?>
                        <div class="progress-item">
                            <div class="progress-label-wrap">
                                <span class="progress-label"><?php echo $label; ?></span>
                                <span class="progress-count"><?php echo $percent_data['total_by_status']; ?> (<?php echo $percent_data['percent']; ?>%)</span>
                            </div>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar-fill <?php echo $color_class; ?>" style="width: <?php echo $percent_data['percent']; ?>%"></div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>

            <!-- Proposal Overview -->
            <?php if ($canViewProposals) { ?>
            <div class="col-md-4">
                <div class="premium-card" style="min-height: 380px;">
                    <h3 class="card-title"><i class="fa-solid fa-file-invoice"></i> <?php echo _l('home_proposal_overview'); ?></h3>
                    <div class="finance-progress-list">
                        <?php foreach ($proposal_statuses as $status) {
                            $percent_data = get_proposals_percent_by_status($status);
                            $label = format_proposal_status($status, '', false);
                            
                            $color_class = 'purple';
                            if ($status == 1 || $status == 5) $color_class = 'neutral';
                            elseif ($status == 2) $color_class = 'warning';
                            elseif ($status == 3) $color_class = 'danger';
                            elseif ($status == 4) $color_class = 'success';
                        ?>
                        <div class="progress-item">
                            <div class="progress-label-wrap">
                                <span class="progress-label"><?php echo $label; ?></span>
                                <span class="progress-count"><?php echo $percent_data['total_by_status']; ?> (<?php echo $percent_data['percent']; ?>%)</span>
                            </div>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar-fill <?php echo $color_class; ?>" style="width: <?php echo $percent_data['percent']; ?>%"></div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>

            <!-- Estimate Overview -->
            <?php if ($canViewEstimates) { ?>
            <div class="col-md-4">
                <div class="premium-card" style="min-height: 380px;">
                    <h3 class="card-title"><i class="fa-regular fa-folder-open"></i> <?php echo _l('home_estimate_overview'); ?></h3>
                    <div class="finance-progress-list">
                        <?php
                        $estimate_statuses = [1, 'not_sent', 2, 3, 4, 5];
                        foreach ($estimate_statuses as $status) {
                            $percent_data = get_estimates_percent_by_status($status);
                            $label = is_numeric($status) ? format_estimate_status($status, '', false) : _l('not_sent_indicator');
                            
                            $color_class = 'purple';
                            if ($status === 1 || $status === 3) $color_class = 'neutral';
                            elseif ($status === 2) $color_class = 'warning';
                            elseif ($status === 4) $color_class = 'success';
                            elseif ($status === 5) $color_class = 'danger';
                        ?>
                        <div class="progress-item">
                            <div class="progress-label-wrap">
                                <span class="progress-label"><?php echo $label; ?></span>
                                <span class="progress-count"><?php echo $percent_data['total_by_status']; ?> (<?php echo $percent_data['percent']; ?>%)</span>
                            </div>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar-fill <?php echo $color_class; ?>" style="width: <?php echo $percent_data['percent']; ?>%"></div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php } ?>

        <!-- Row 5: AI Insights -->
        <div class="row">
            <div class="col-md-12">
                <div class="premium-card ai-insights-card">
                    <div class="ai-header tw-flex tw-justify-between tw-items-center tw-mb-4">
                        <div class="tw-flex tw-items-center">
                            <div class="ai-icon"><i class="fa fa-magic"></i></div>
                            <h3 class="card-title tw-ml-3" style="margin-bottom: 0px !important;">Mingrow AI Insights</h3>
                        </div>
                        <span class="ai-badge">Coming Soon</span>
                    </div>
                    <div class="ai-content-overlay">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="ai-insight-box">
                                    <i class="fa-solid fa-chart-line"></i>
                                    <h4>Revenue Forecasting</h4>
                                    <p>Predict next quarter's revenue trends using historical invoice data.</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="ai-insight-box">
                                    <i class="fa-solid fa-bullseye"></i>
                                    <h4>Smart Lead Scoring</h4>
                                    <p>Prioritize deals based on activity history and conversion likelihood.</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="ai-insight-box">
                                    <i class="fa-solid fa-tasks"></i>
                                    <h4>Task Prioritization</h4>
                                    <p>Optimize task sequences based on team capacity and project deadlines.</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="ai-insight-box">
                                    <i class="fa-solid fa-lightbulb"></i>
                                    <h4>AI Recommendations</h4>
                                    <p>Get daily actionable suggestions to streamline your business workflows.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 6: Sales Funnel -->
        <?php
        $leads_summary = get_leads_summary();
        $leads_by_stage = [
            'Leads' => 0,
            'Qualified' => 0,
            'Proposal' => 0,
            'Won' => 0
        ];
        foreach ($leads_summary as $summary) {
            $name = strtolower($summary['name']);
            $total = (int)$summary['total'];
            if (strpos($name, 'won') !== false || strpos($name, 'customer') !== false || strpos($name, 'client') !== false) {
                $leads_by_stage['Won'] += $total;
            } elseif (strpos($name, 'proposal') !== false || strpos($name, 'offer') !== false || strpos($name, 'estimate') !== false) {
                $leads_by_stage['Proposal'] += $total;
            } elseif (strpos($name, 'qualified') !== false || strpos($name, 'qualify') !== false || strpos($name, 'contacted') !== false) {
                $leads_by_stage['Qualified'] += $total;
            } else {
                $leads_by_stage['Leads'] += $total;
            }
        }
        $total_leads = array_sum($leads_by_stage);
        
        $is_funnel_empty = $total_leads === 0;
        if ($is_funnel_empty) {
            $leads_by_stage = [
                'Leads' => 2540,
                'Qualified' => 1320,
                'Proposal' => 620,
                'Won' => 320
            ];
            $total_leads = 2540;
        }
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="premium-card">
                    <h3 class="card-title"><i class="fa fa-filter"></i> Sales Funnel</h3>
                    <div class="funnel-container <?php if ($is_funnel_empty) echo 'funnel-demo-mode'; ?>">
                        <?php if ($is_funnel_empty) { ?>
                            <div class="funnel-empty-badge"><i class="fa fa-info-circle"></i> Demo Funnel Data Shown</div>
                        <?php } ?>
                        <div class="funnel-wrapper">
                            <!-- Leads -->
                            <div class="funnel-stage stage-leads" style="width: 100%;">
                                <span class="stage-name">Leads</span>
                                <span class="stage-count"><?php echo number_format($leads_by_stage['Leads']); ?></span>
                                <span class="stage-pct">100%</span>
                            </div>
                            <!-- Qualified -->
                            <?php 
                            $qualified_pct = $leads_by_stage['Leads'] > 0 ? round(($leads_by_stage['Qualified'] / $leads_by_stage['Leads']) * 100) : 0;
                            ?>
                            <div class="funnel-stage stage-qualified" style="width: 80%;">
                                <span class="stage-name">Qualified</span>
                                <span class="stage-count"><?php echo number_format($leads_by_stage['Qualified']); ?></span>
                                <span class="stage-pct"><?php echo $qualified_pct; ?>%</span>
                            </div>
                            <!-- Proposal -->
                            <?php 
                            $proposal_pct = $leads_by_stage['Qualified'] > 0 ? round(($leads_by_stage['Proposal'] / $leads_by_stage['Qualified']) * 100) : 0;
                            ?>
                            <div class="funnel-stage stage-proposal" style="width: 60%;">
                                <span class="stage-name">Proposal</span>
                                <span class="stage-count"><?php echo number_format($leads_by_stage['Proposal']); ?></span>
                                <span class="stage-pct"><?php echo $proposal_pct; ?>%</span>
                            </div>
                            <!-- Won -->
                            <?php 
                            $won_pct = $leads_by_stage['Proposal'] > 0 ? round(($leads_by_stage['Won'] / $leads_by_stage['Proposal']) * 100) : 0;
                            ?>
                            <div class="funnel-stage stage-won" style="width: 40%;">
                                <span class="stage-name">Won</span>
                                <span class="stage-count"><?php echo number_format($leads_by_stage['Won']); ?></span>
                                <span class="stage-pct"><?php echo $won_pct; ?>%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 7: Projects + Tasks Workspace -->
        <?php
        $_where = '';
        if (staff_cant('view', 'projects')) {
            $_where = 'id IN (SELECT project_id FROM ' . db_prefix() . 'project_members WHERE staff_id=' . get_staff_user_id() . ')';
        }
        $total_projects = total_rows(db_prefix() . 'projects', $_where);
        $where_proj_in_progress = ($_where == '' ? '' : $_where . ' AND ') . 'status = 2';
        $total_projects_in_progress = total_rows(db_prefix() . 'projects', $where_proj_in_progress);
        $percent_projects = $total_projects > 0 ? round(($total_projects_in_progress / $total_projects) * 100) : 0;

        $_where_tasks = '';
        if (staff_cant('view', 'tasks')) {
            $_where_tasks = db_prefix() . 'tasks.id IN (SELECT taskid FROM ' . db_prefix() . 'task_assigned WHERE staffid = ' . get_staff_user_id() . ')';
        }
        $total_tasks = total_rows(db_prefix() . 'tasks', $_where_tasks);
        $where_tasks_not_finished = ($_where_tasks == '' ? '' : $_where_tasks . ' AND ') . 'status != ' . Tasks_model::STATUS_COMPLETE;
        $total_tasks_not_finished = total_rows(db_prefix() . 'tasks', $where_tasks_not_finished);
        $percent_tasks = $total_tasks > 0 ? round((($total_tasks - $total_tasks_not_finished) / $total_tasks) * 100) : 0;
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="premium-card">
                    <h3 class="card-title"><i class="fa-solid fa-chart-gantt"></i> Workspace Overview</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="workspace-item-box">
                                <div class="tw-flex tw-justify-between tw-items-center">
                                    <span class="workspace-label">Projects in Progress</span>
                                    <span class="status-chip in-progress">Active</span>
                                </div>
                                <div class="workspace-counter"><?php echo $total_projects_in_progress; ?> / <?php echo $total_projects; ?></div>
                                <div class="progress-bar-wrap tw-mt-4">
                                    <div class="progress-bar-fill purple" style="width: <?php echo $percent_projects; ?>%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="workspace-item-box">
                                <div class="tw-flex tw-justify-between tw-items-center">
                                    <span class="workspace-label">Completed Tasks</span>
                                    <span class="status-chip completed">Tracking</span>
                                </div>
                                <div class="workspace-counter"><?php echo ($total_tasks - $total_tasks_not_finished); ?> / <?php echo $total_tasks; ?></div>
                                <div class="progress-bar-wrap tw-mt-4">
                                    <div class="progress-bar-fill success" style="width: <?php echo $percent_tasks; ?>%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 8: Calendar -->
        <div class="row">
            <div class="col-md-12">
                <div class="premium-card calendar-card" id="widget-calendar" data-name="Calendar">
                    <div class="widget-dragger"></div>
                    <h3 class="card-title"><i class="fa-regular fa-calendar"></i> Calendar</h3>
                    <div class="dt-loader-parent"></div>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>

        <!-- Row 9: Payment Records -->
        <?php if (staff_can('view', 'payments') || staff_can('view_own', 'invoices')) { ?>
        <div class="row" id="payments">
            <div class="col-md-12">
                <div class="premium-card payments-chart-card" id="widget-payments_chart" data-name="<?php echo _l('home_payment_records'); ?>">
                    <div class="widget-dragger"></div>
                    <div class="chart-header tw-flex tw-justify-between tw-items-center tw-flex-wrap">
                        <h3 class="card-title" style="margin-bottom: 0px !important;"><i class="fa-solid fa-credit-card"></i> <?php echo _l('home_payment_records'); ?></h3>
                        <div class="chart-actions tw-flex tw-items-center tw-space-x-4">
                            <?php if (is_using_multiple_currencies()) { ?>
                            <select class="selectpicker" name="currency" data-width="auto" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                <?php foreach ($currencies as $currency) {
                                    $selected = ($currency['isdefault'] == 1) ? 'selected' : '';
                                ?>
                                <option value="<?php echo $currency['id']; ?>" <?php echo $selected; ?> data-subtext="<?php echo $currency['name']; ?>"><?php echo $currency['symbol']; ?></option>
                                <?php } ?>
                            </select>
                            <?php } ?>
                            
                            <div class="dropdown">
                                <a href="#" id="PaymentChartmode" class="dropdown-toggle chart-toggle-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span id="Payment-chart-name" data-active-chart="weekly"><?php echo _l('weekly') ?></span>
                                    <i class="fa fa-caret-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="PaymentChartmode">
                                    <li><a href="#" data-type="weekly" onclick="update_payment_statistics(this); return false;"><?php echo _l('weekly') ?></a></li>
                                    <li><a href="#" data-type="monthly" onclick="update_payment_statistics(this); return false;"><?php echo _l('monthly') ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="chart-canvas-wrapper tw-mt-6" style="height: 280px; position: relative;">
                        <canvas height="280" class="payments-chart-dashboard" id="payment-statistics"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

        <!-- Row 10: Contracts Expiring Soon -->
        <?php if (staff_can('view', 'contracts') || staff_can('view_own', 'contracts')) { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="premium-card contracts-card" id="widget-contracts_expiring" data-name="<?php echo _l('contracts_about_to_expire'); ?>">
                    <div class="widget-dragger"></div>
                    <div class="tw-flex tw-justify-between tw-items-center">
                        <h3 class="card-title" style="margin-bottom: 0px !important;"><i class="fa-regular fa-clock"></i> <?php echo _l('contracts_about_to_expire'); ?></h3>
                        <a href="<?php echo admin_url('contracts'); ?>" class="view-all-link">View All</a>
                    </div>
                    <div class="tw-mt-4">
                        <?php if (!empty($expiringContracts)) { ?>
                            <div class="table-responsive">
                                <table class="table premium-table">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Client</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($expiringContracts as $contract) { ?>
                                        <tr>
                                            <td><a href="<?php echo admin_url('contracts/contract/' . $contract['id']); ?>"><?php echo e($contract['subject']); ?></a></td>
                                            <td><a href="<?php echo admin_url('clients/client/' . $contract['client']); ?>"><?php echo e(get_company_name($contract['client'])); ?></a></td>
                                            <td><?php echo e(_d($contract['datestart'])); ?></td>
                                            <td><?php echo e(_d($contract['dateend'])); ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <div class="modern-empty-state text-center tw-py-8">
                                <div class="empty-icon"><i class="fa-regular fa-folder-open"></i></div>
                                <h4 class="empty-title">No Contracts Expiring Soon</h4>
                                <p class="empty-desc">Everything is up to date! There are no contracts expiring in the next 7 days.</p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

        <!-- Row 11: Ticket Report, Quick Actions, and Mingrow AI Widget -->
        <div class="row">
            <!-- Staff Ticket Report (8-cols) -->
            <?php if (is_admin()) { ?>
            <div class="col-md-8" id="tickets_report">
                <div class="premium-card ticket-report-card" id="widget-tickets_report" data-name="<?php echo _l('home_tickets_report'); ?>">
                    <div class="widget-dragger"></div>
                    <div class="tw-flex tw-justify-between tw-items-center">
                        <h3 class="card-title" style="margin-bottom: 0px !important;"><i class="fa-regular fa-life-ring"></i> Staff Ticket Report</h3>
                        <div class="dropdown">
                            <a href="#" id="tickets-report-mode" class="dropdown-toggle chart-toggle-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span id="tickets-report-mode-name"><?php echo _l('this_month') ?></span>
                                <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="tickets-report-mode">
                                <li><a href="#" data-type="this_week" onclick="update_tickets_report_table(this); return false;"><?php echo _l('this_week') ?></a></li>
                                <li><a href="#" data-type="last_week" onclick="update_tickets_report_table(this); return false;"><?php echo _l('last_week') ?></a></li>
                                <li><a href="#" data-type="this_month" onclick="update_tickets_report_table(this); return false;"><?php echo _l('this_month') ?></a></li>
                                <li><a href="#" data-type="last_month" onclick="update_tickets_report_table(this); return false;"><?php echo _l('last_month') ?></a></li>
                                <li><a href="#" data-type="this_year" onclick="update_tickets_report_table(this); return false;"><?php echo _l('this_year') ?></a></li>
                                <li><a href="#" data-type="last_year" onclick="update_tickets_report_table(this); return false;"><?php echo _l('last_year') ?></a></li>
                            </ul>
                        </div>
                    </div>
                    <div id="tickets-report-table-wrapper" class="tw-mt-4 table-responsive premium-table-container">
                        <?php $this->load->view('admin/dashboard/widgets/tickets_report_table'); ?>
                    </div>
                </div>
            </div>
            <?php } ?>

            <!-- Quick Actions & Discover Mingrow AI Widget (4-cols) -->
            <div class="col-md-4">
                <!-- Quick Actions Card -->
                <div class="premium-card quick-actions-card">
                    <h3 class="card-title"><i class="fa fa-bolt"></i> Quick Actions</h3>
                    <div class="quick-actions-grid tw-mt-4">
                        <a href="<?php echo admin_url('leads'); ?>" class="quick-action-btn">
                            <div class="action-icon"><i class="fa fa-bullseye"></i></div>
                            <span>Create Lead</span>
                        </a>
                        <a href="<?php echo admin_url('invoices/invoice'); ?>" class="quick-action-btn">
                            <div class="action-icon"><i class="fa-regular fa-file-lines"></i></div>
                            <span>Create Invoice</span>
                        </a>
                        <a href="<?php echo admin_url('tasks'); ?>" class="quick-action-btn">
                            <div class="action-icon"><i class="fa fa-tasks"></i></div>
                            <span>Add Task</span>
                        </a>
                        <a href="<?php echo admin_url('projects/project'); ?>" class="quick-action-btn">
                            <div class="action-icon"><i class="fa-solid fa-chart-gantt"></i></div>
                            <span>Add Project</span>
                        </a>
                        <a href="<?php echo admin_url('tickets/open_ticket'); ?>" class="quick-action-btn">
                            <div class="action-icon"><i class="fa-regular fa-life-ring"></i></div>
                            <span>Create Ticket</span>
                        </a>
                    </div>
                </div>

                <!-- Discover Mingrow AI widget -->
                <div class="premium-card ai-widget-card purple-gradient-bg">
                    <div class="ai-widget-header tw-flex tw-justify-between tw-items-center">
                        <h3 class="card-title text-white" style="margin-bottom: 0px !important;">Discover Mingrow AI</h3>
                        <span class="ai-badge-white">Coming Soon</span>
                    </div>
                    <p class="ai-widget-desc tw-mt-2 text-white opacity-80" style="color: rgba(255, 255, 255, 0.9) !important;">AI-powered business automation, smart analytics, lead intelligence, and workflow automation.</p>
                    <div class="ai-features tw-mt-4 text-white" style="color: #FFFFFF !important; font-weight: 500;">
                        <div class="ai-feature-item" style="display: flex; align-items: center; gap: 8px; font-size: 12px; margin-bottom: 4px;"><i class="fa fa-check-circle"></i> AI-powered business automation</div>
                        <div class="ai-feature-item" style="display: flex; align-items: center; gap: 8px; font-size: 12px; margin-bottom: 4px;"><i class="fa fa-check-circle"></i> Smart analytics & forecasting</div>
                        <div class="ai-feature-item" style="display: flex; align-items: center; gap: 8px; font-size: 12px; margin-bottom: 4px;"><i class="fa fa-check-circle"></i> Lead intelligence</div>
                    </div>
                    <div class="robot-placeholder text-center tw-mt-6" style="margin-top: 15px;">
                        <div class="robot-icon-wrapper" style="margin: 0 auto;"><i class="fa-solid fa-robot" style="color:#FFFFFF !important;"></i></div>
                    </div>
                    <button class="ai-widget-btn tw-mt-4" style="margin-top: 15px;" disabled>Explore AI Assistant</button>
                </div>
            </div>
        </div>

        <?php hooks()->do_action('after_dashboard'); ?>
    </div>
</div>

<script>
    app.calendarIDs = '<?= json_encode($google_ids_calendars); ?>';

    window.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('revenue-overview-chart');
        if (ctx) {
            var chartData = <?php echo json_encode($payment_totals); ?>;
            var chartLabels = <?php echo json_encode($months); ?>;
            var purpleGrad = ctx.getContext('2d').createLinearGradient(0, 0, 0, 200);
            purpleGrad.addColorStop(0, 'rgba(109, 40, 253, 0.25)');
            purpleGrad.addColorStop(1, 'rgba(109, 40, 253, 0)');
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Revenue',
                        data: chartData,
                        borderColor: '#6D28FF',
                        borderWidth: 3,
                        backgroundColor: purpleGrad,
                        pointBackgroundColor: '#FFFFFF',
                        pointBorderColor: '#6D28FF',
                        pointBorderWidth: 2,
                        pointHoverBackgroundColor: '#6D28FF',
                        pointHoverBorderColor: '#FFFFFF',
                        pointHoverBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        lineTension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                fontFamily: "'Inter', sans-serif",
                                fontColor: '#64748B',
                                fontSize: 11
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                color: 'rgba(124, 58, 237, 0.05)',
                                zeroLineColor: 'rgba(124, 58, 237, 0.05)'
                            },
                            ticks: {
                                beginAtZero: true,
                                fontFamily: "'Inter', sans-serif",
                                fontColor: '#64748B',
                                fontSize: 11,
                                callback: function(value) {
                                    if (value >= 1000) {
                                        return '$' + (value/1000).toFixed(0) + 'k';
                                    }
                                    return '$' + value;
                                }
                            }
                        }]
                    },
                    tooltips: {
                        backgroundColor: '#1E1B4B',
                        titleFontFamily: "'Inter', sans-serif",
                        titleFontSize: 12,
                        bodyFontFamily: "'Inter', sans-serif",
                        bodyFontSize: 12,
                        xPadding: 12,
                        yPadding: 12,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function(tooltipItem, data) {
                                return 'Revenue: $' + tooltipItem.yLabel.toLocaleString();
                            }
                        }
                    }
                }
            });
        }
    });
</script>

<?php init_tail(); ?>
<?php $this->load->view('admin/utilities/calendar_template'); ?>
<?php $this->load->view('admin/dashboard/dashboard_js'); ?>
</body>
</html>