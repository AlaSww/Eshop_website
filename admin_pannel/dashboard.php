<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="pannel" >
    <div class="sidebarcontainer">
        <?php include 'sidebar.php'; ?>
    </div>
    <div id="content">
    <div class="dashboard">
        <!-- Main Content -->
        <main class="main-content">
            <!-- Stats Cards -->
            <section class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon revenue">💰</div>
                    <div class="stat-content">
                        <h3 class="stat-title">Total Revenue</h3>
                        <p class="stat-value">TND 45,231</p>
                        <p class="stat-change positive">+20.1% from last month</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon orders">📦</div>
                    <div class="stat-content">
                        <h3 class="stat-title">Total Orders</h3>
                        <p class="stat-value">8</p>
                        <p class="stat-change positive">+15% from last month</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon customers">👥</div>
                    <div class="stat-content">
                        <h3 class="stat-title">New Customers</h3>
                        <p class="stat-value">3</p>
                        <p class="stat-change positive">+10% from last month</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon products">📊</div>
                    <div class="stat-content">
                        <h3 class="stat-title">Total Products</h3>
                        <p class="stat-value">6</p>
                        <p class="stat-change negative">-5% from last month</p>
                    </div>
                </div>
            </section>

            <!-- Charts Section -->
            <section class="charts-section">
                <div class="chart-container">
                    <div class="chart-header">
                        <h3>Sales Overview</h3>
                        <select class="chart-filter">
                            <option>Last 7 days</option>
                            <option>Last 30 days</option>
                            <option>Last 3 months</option>
                        </select>
                    </div>
                    <div class="chart-placeholder">
                        <div class="chart-bars">
                            <div class="bar" style="height: 60%"></div>
                            <div class="bar" style="height: 80%"></div>
                            <div class="bar" style="height: 45%"></div>
                            <div class="bar" style="height: 90%"></div>
                            <div class="bar" style="height: 70%"></div>
                            <div class="bar" style="height: 85%"></div>
                            <div class="bar" style="height: 95%"></div>
                        </div>
                        <div class="chart-labels">
                            <span>Mon</span>
                            <span>Tue</span>
                            <span>Wed</span>
                            <span>Thu</span>
                            <span>Fri</span>
                            <span>Sat</span>
                            <span>Sun</span>
                        </div>
                    </div>
                </div>
                
                <div class="chart-container">
                    <div class="chart-header">
                        <h3>Top Categories</h3>
                    </div>
                    <div class="pie-chart">
                        <div class="pie-slice electronics"></div>
                        <div class="pie-slice clothing"></div>
                        <div class="pie-slice accessories"></div>
                        <div class="pie-slice home"></div>
                    </div>
                    <div class="pie-legend">
                        <div class="legend-item">
                            <span class="legend-color electronics"></span>
                            bars & parallettes (40%)
                        </div>
                        <div class="legend-item">
                            <span class="legend-color clothing"></span>
                            accessories (30%)
                        </div>
                        <div class="legend-item">
                            <span class="legend-color accessories"></span>
                            rings and bands(20%)
                        </div>
                        <div class="legend-item">
                            <span class="legend-color home"></span>
                            weighted gear (10%)
                        </div>
                    </div>
                </div>
            </section>

            <!-- Recent Orders Table -->
            <section class="table-section">
                <div class="table-header">
                    <h3>Recent Orders</h3>
                    <button class="btn-primary">View All Orders</button>
                </div>
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>items</th>
                                <th>total price</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Ala</td>
                                <td><strong>3</strong> wooden gymnastics rings</td>
                                <td>$999.00</td>
                                <td><span class="status delivered">Delivered</span></td>
                                <td>2024-01-15</td>
                                <td>
                                    <button class="btn-action">View</button>
                                    <button class="btn-action">Edit</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Ala</td>
                                <td><strong>3</strong> wooden gymnastics rings</td>
                                <td>$999.00</td>
                                <td><span class="status delivered">Delivered</span></td>
                                <td>2024-01-15</td>
                                <td>
                                    <button class="btn-action">View</button>
                                    <button class="btn-action">Edit</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Ala</td>
                                <td><strong>3</strong> wooden gymnastics rings</td>
                                <td>$999.00</td>
                                <td><span class="status delivered">Delivered</span></td>
                                <td>2024-01-15</td>
                                <td>
                                    <button class="btn-action">View</button>
                                    <button class="btn-action">Edit</button>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Ala</td>
                                <td><strong>3</strong> wooden gymnastics rings</td>
                                <td>$999.00</td>
                                <td><span class="status delivered">Delivered</span></td>
                                <td>2024-01-15</td>
                                <td>
                                    <button class="btn-action">View</button>
                                    <button class="btn-action">Edit</button>
                                </td>
                            </tr>
                            <tr>
                                <td>77</td>
                                <td>Ala</td>
                                <td><strong>3</strong> wooden gymnastics rings</td>
                                <td>$999.00</td>
                                <td><span class="status delivered">Delivered</span></td>
                                <td>2024-01-15</td>
                                <td>
                                    <button class="btn-action">View</button>
                                    <button class="btn-action">Edit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
    </div>
</body>
</html>