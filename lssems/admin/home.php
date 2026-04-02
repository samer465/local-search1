<?php include('db_connect.php') ?>
<style>
    /* Modern Dashboard Styles */
    .dashboard-stats {
        margin-bottom: 30px;
    }
    
    /* Stats Cards */
    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 20px;
        margin-bottom: 25px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(192, 57, 43, 0.15);
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #c0392b, #e74c3c);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .stat-card:hover::before {
        transform: scaleX(1);
    }
    
    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
    }
    
    .stat-title {
        font-size: 14px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #c0392b, #e74c3c);
    }
    
    .stat-icon i {
        font-size: 24px;
        color: white;
    }
    
    .stat-value {
        font-size: 36px;
        font-weight: 800;
        color: #1e293b;
        margin: 10px 0;
        line-height: 1;
    }
    
    .stat-footer {
        border-top: 1px solid #e2e8f0;
        padding-top: 12px;
        margin-top: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .stat-change {
        font-size: 13px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .stat-change.positive {
        color: #10b981;
    }
    
    .stat-change.negative {
        color: #ef4444;
    }
    
    .stat-period {
        font-size: 12px;
        color: #94a3b8;
    }
    
    /* Chart Cards */
    .chart-card {
        background: white;
        border-radius: 20px;
        padding: 20px;
        margin-bottom: 25px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f1f5f9;
    }
    
    .chart-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
    }
    
    .chart-title i {
        color: #c0392b;
        margin-right: 8px;
    }
    
    .chart-date {
        font-size: 12px;
        color: #94a3b8;
        background: #f8fafc;
        padding: 5px 12px;
        border-radius: 20px;
    }
    
    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }
    
    /* Activity List */
    .activity-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .activity-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #f1f5f9;
        transition: all 0.3s ease;
    }
    
    .activity-item:hover {
        transform: translateX(5px);
        background: #f8fafc;
        padding-left: 10px;
    }
    
    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: linear-gradient(135deg, #c0392b, #e74c3c);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .activity-icon i {
        font-size: 18px;
        color: white;
    }
    
    .activity-content {
        flex: 1;
    }
    
    .activity-title {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 5px;
    }
    
    .activity-time {
        font-size: 11px;
        color: #94a3b8;
    }
    
    /* Welcome Card */
    .welcome-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 20px;
        padding: 25px;
        color: white;
        margin-bottom: 25px;
        position: relative;
        overflow: hidden;
    }
    
    .welcome-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(192, 57, 43, 0.1) 1%, transparent 1%);
        background-size: 50px 50px;
        animation: shimmer 20s linear infinite;
    }
    
    @keyframes shimmer {
        0% { transform: translate(0, 0); }
        100% { transform: translate(50px, 50px); }
    }
    
    .welcome-card h2 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 10px;
        position: relative;
        z-index: 1;
    }
    
    .welcome-card p {
        opacity: 0.8;
        margin: 0;
        position: relative;
        z-index: 1;
    }
    
    .welcome-card .date-time {
        margin-top: 15px;
        font-size: 14px;
        display: flex;
        gap: 15px;
        position: relative;
        z-index: 1;
    }
    
    /* Quick Actions */
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-bottom: 25px;
    }
    
    .action-btn {
        background: white;
        border-radius: 15px;
        padding: 15px;
        text-align: center;
        transition: all 0.3s ease;
        text-decoration: none;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .action-btn:hover {
        transform: translateY(-5px);
        background: linear-gradient(135deg, #c0392b, #e74c3c);
        text-decoration: none;
    }
    
    .action-btn:hover .action-icon i,
    .action-btn:hover .action-text {
        color: white;
    }
    
    .action-icon {
        width: 50px;
        height: 50px;
        margin: 0 auto 10px;
        background: rgba(192, 57, 43, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .action-btn:hover .action-icon {
        background: rgba(255,255,255,0.2);
    }
    
    .action-icon i {
        font-size: 24px;
        color: #c0392b;
        transition: all 0.3s ease;
    }
    
    .action-text {
        font-size: 13px;
        font-weight: 600;
        color: #1e293b;
        transition: all 0.3s ease;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .stat-value {
            font-size: 28px;
        }
        
        .welcome-card h2 {
            font-size: 22px;
        }
        
        .chart-container {
            height: 250px;
        }
        
        .quick-actions {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<?php if($_SESSION['login_type'] == 1): ?>
    <!-- Welcome Section -->
    <div class="welcome-card">
        <h2>Welcome back, Admin!</h2>
        <p>Here's what's happening with your platform today</p>
        <div class="date-time">
            <span><i class="fas fa-calendar"></i> <?php echo date('F j, Y'); ?></span>
            <span><i class="fas fa-clock"></i> <span id="liveClock">--:--:--</span></span>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row dashboard-stats">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">Total Service Categories</span>
                    <div class="stat-icon">
                        <i class="fas fa-th-list"></i>
                    </div>
                </div>
                <div class="stat-value">
                    <?php echo $conn->query("SELECT * FROM services")->num_rows; ?>
                </div>
                <div class="stat-footer">
                    <span class="stat-change positive">
                        <i class="fas fa-arrow-up"></i> 12%
                    </span>
                    <span class="stat-period">vs last month</span>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">Freelancers & Companies</span>
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="stat-value">
                    <?php echo $conn->query("SELECT * FROM persons_companies")->num_rows; ?>
                </div>
                <div class="stat-footer">
                    <span class="stat-change positive">
                        <i class="fas fa-arrow-up"></i> 8%
                    </span>
                    <span class="stat-period">vs last month</span>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">Service Areas</span>
                    <div class="stat-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                </div>
                <div class="stat-value">
                    <?php echo $conn->query("SELECT * FROM areas")->num_rows; ?>
                </div>
                <div class="stat-footer">
                    <span class="stat-change positive">
                        <i class="fas fa-arrow-up"></i> 5%
                    </span>
                    <span class="stat-period">vs last month</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <a href="index.php?page=services" class="action-btn">
            <div class="action-icon">
                <i class="fas fa-plus-circle"></i>
            </div>
            <div class="action-text">Add New Service</div>
        </a>
        <a href="index.php?page=new_persons_companies" class="action-btn">
            <div class="action-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <div class="action-text">Add Provider</div>
        </a>
        <a href="index.php?page=areas" class="action-btn">
            <div class="action-icon">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="action-text">Manage Areas</div>
        </a>
        <a href="index.php?page=messages" class="action-btn">
            <div class="action-icon">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="action-text">View Messages</div>
        </a>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="chart-card">
                <div class="chart-header">
                    <h4 class="chart-title">
                        <i class="fas fa-chart-line"></i> Provider Growth
                    </h4>
                    <span class="chart-date">Last 12 months</span>
                </div>
                <div class="chart-container">
                    <canvas id="providerChart"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="chart-card">
                <div class="chart-header">
                    <h4 class="chart-title">
                        <i class="fas fa-chart-pie"></i> Service Distribution
                    </h4>
                    <span class="chart-date">By Category</span>
                </div>
                <div class="chart-container">
                    <canvas id="serviceChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Top Services -->
    <div class="row">
        <div class="col-lg-6">
            <div class="chart-card">
                <div class="chart-header">
                    <h4 class="chart-title">
                        <i class="fas fa-clock"></i> Recent Activity
                    </h4>
                    <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <ul class="activity-list">
                    <?php
                    // Get recent services added
                    $recent_services = $conn->query("SELECT * FROM services ORDER BY date_created DESC LIMIT 3");
                    while($service = $recent_services->fetch_assoc()):
                    ?>
                    <li class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-th-list"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">New service added: <?php echo ucwords($service['service']); ?></div>
                            <div class="activity-time"><?php echo date('M d, Y h:i A', strtotime($service['date_created'])); ?></div>
                        </div>
                    </li>
                    <?php endwhile; ?>
                    
                    <?php
                    // Get recent providers added
                    $recent_providers = $conn->query("SELECT * FROM persons_companies ORDER BY date_created DESC LIMIT 2");
                    while($provider = $recent_providers->fetch_assoc()):
                    ?>
                    <li class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">New <?php echo $provider['type'] == 1 ? 'Freelancer' : 'Company'; ?>: <?php echo ucwords($provider['name']); ?></div>
                            <div class="activity-time"><?php echo date('M d, Y h:i A', strtotime($provider['date_created'])); ?></div>
                        </div>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="chart-card">
                <div class="chart-header">
                    <h4 class="chart-title">
                        <i class="fas fa-trophy"></i> Top Service Categories
                    </h4>
                    <a href="index.php?page=services" class="btn btn-sm btn-outline-primary">Manage</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Service Category</th>
                                <th>Providers</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $top_services = $conn->query("SELECT s.*, COUNT(pc.id) as provider_count 
                                                          FROM services s 
                                                          LEFT JOIN persons_companies pc ON pc.service_id = s.id 
                                                          GROUP BY s.id 
                                                          ORDER BY provider_count DESC 
                                                          LIMIT 5");
                            while($service = $top_services->fetch_assoc()):
                            ?>
                            <tr>
                                <td>
                                    <strong><?php echo ucwords($service['service']); ?></strong>
                                </td>
                                <td>
                                    <span class="badge badge-primary"><?php echo $service['provider_count']; ?> providers</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Live Clock
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', { 
                hour: '2-digit', 
                minute: '2-digit', 
                second: '2-digit' 
            });
            const clockElement = document.getElementById('liveClock');
            if (clockElement) {
                clockElement.textContent = timeString;
            }
        }
        updateClock();
        setInterval(updateClock, 1000);
        
        // Provider Growth Chart
        const providerCtx = document.getElementById('providerChart').getContext('2d');
        new Chart(providerCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Providers',
                    data: [12, 19, 15, 25, 22, 30, 35, 40, 45, 52, 58, 65],
                    borderColor: '#c0392b',
                    backgroundColor: 'rgba(192, 57, 43, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#c0392b',
                    pointBorderColor: '#fff',
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleColor: '#fff',
                        bodyColor: '#94a3b8'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#e2e8f0'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
        
        // Service Distribution Chart
        const serviceCtx = document.getElementById('serviceChart').getContext('2d');
        new Chart(serviceCtx, {
            type: 'doughnut',
            data: {
                labels: ['Freelancers', 'Companies'],
                datasets: [{
                    data: [
                        <?php echo $conn->query("SELECT * FROM persons_companies WHERE type = 1")->num_rows; ?>,
                        <?php echo $conn->query("SELECT * FROM persons_companies WHERE type = 2")->num_rows; ?>
                    ],
                    backgroundColor: ['#c0392b', '#e74c3c'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleColor: '#fff',
                        bodyColor: '#94a3b8'
                    }
                },
                cutout: '60%'
            }
        });
    </script>

<?php else: ?>
    <div class="welcome-card">
        <h2>Welcome back, <?php echo $_SESSION['login_name'] ?>! 👋</h2>
        <p>We're glad to see you again. Here's what's happening with your account.</p>
        <div class="date-time">
            <span><i class="fas fa-calendar"></i> <?php echo date('F j, Y'); ?></span>
            <span><i class="fas fa-clock"></i> <span id="liveClockUser">--:--:--</span></span>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">My Services</span>
                    <div class="stat-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                </div>
                <div class="stat-value">
                    <?php 
                    $my_services = $conn->query("SELECT COUNT(*) as cnt FROM persons_companies WHERE user_id = {$_SESSION['login_id']}")->fetch_assoc();
                    echo $my_services['cnt'];
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">Total Views</span>
                    <div class="stat-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                </div>
                <div class="stat-value">1,234</div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">Response Rate</span>
                    <div class="stat-icon">
                        <i class="fas fa-reply-all"></i>
                    </div>
                </div>
                <div class="stat-value">98%</div>
            </div>
        </div>
    </div>
    
    <script>
        function updateClockUser() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', { 
                hour: '2-digit', 
                minute: '2-digit', 
                second: '2-digit' 
            });
            const clockElement = document.getElementById('liveClockUser');
            if (clockElement) {
                clockElement.textContent = timeString;
            }
        }
        updateClockUser();
        setInterval(updateClockUser, 1000);
    </script>
<?php endif; ?>