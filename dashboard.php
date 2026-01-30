<?php
require 'config.php';
requireLogin();

$user = getCurrentUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Subbyte Programming</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --primary: #667eea;
            --primary-dark: #5a6fd8;
            --secondary: #764ba2;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
            --dark: #1a202c;
            --gray: #64748b;
            --light-bg: #f8fafc;
            --card-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--light-bg);
            min-height: 100vh;
        }
        
        /* Navigation Bar */
        .navbar {
            background: white;
            padding: 16px 40px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .logo {
            font-size: 24px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo i {
            -webkit-text-fill-color: var(--primary);
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            background: var(--light-bg);
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .user-info:hover {
            background: #e2e8f0;
        }
        
        .user-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
        }
        
        .user-details {
            text-align: left;
        }
        
        .user-details strong {
            display: block;
            color: var(--dark);
            font-size: 14px;
        }
        
        .user-details small {
            color: var(--gray);
            font-size: 12px;
        }
        
        .btn {
            padding: 10px 20px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }
        
        .btn-logout {
            background: var(--danger);
        }
        
        .btn-logout:hover {
            background: #dc2626;
        }
        
        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px 20px;
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 60px 40px;
            border-radius: 20px;
            color: white;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="40" fill="rgba(255,255,255,0.05)"/></svg>');
            opacity: 0.1;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
        }
        
        .hero-section h1 {
            font-size: 42px;
            margin-bottom: 15px;
            font-weight: 700;
        }
        
        .hero-section p {
            font-size: 20px;
            opacity: 0.95;
            margin-bottom: 25px;
        }
        
        .hero-stats {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }
        
        .hero-stat-item {
            background: rgba(255, 255, 255, 0.15);
            padding: 15px 25px;
            border-radius: 12px;
            backdrop-filter: blur(10px);
        }
        
        .hero-stat-item strong {
            display: block;
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .hero-stat-item span {
            font-size: 14px;
            opacity: 0.9;
        }
        
        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }
        
        .stat-number {
            font-size: 36px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
        }
        
        .stat-label {
            color: var(--gray);
            font-size: 16px;
            font-weight: 500;
        }
        
        .stat-trend {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #d1fae5;
            color: var(--success);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-top: 10px;
        }
        
        /* Section Headers */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .section-header h2 {
            color: var(--dark);
            font-size: 28px;
            font-weight: 700;
        }
        
        .view-all {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .view-all:hover {
            gap: 10px;
        }
        
        /* Courses Grid */
        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .course-card {
            background: white;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s;
            overflow: hidden;
        }
        
        .course-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }
        
        .course-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 30px;
            color: white;
            position: relative;
        }
        
        .course-icon {
            font-size: 48px;
            margin-bottom: 15px;
            opacity: 0.95;
        }
        
        .course-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.25);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            backdrop-filter: blur(10px);
        }
        
        .course-body {
            padding: 25px;
        }
        
        .course-title {
            color: var(--dark);
            margin-bottom: 12px;
            font-size: 22px;
            font-weight: 700;
        }
        
        .course-desc {
            color: var(--gray);
            margin-bottom: 20px;
            line-height: 1.6;
        }
        
        .course-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .course-meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--gray);
            font-size: 14px;
        }
        
        .course-meta-item i {
            color: var(--primary);
        }
        
        .course-btn {
            display: block;
            text-align: center;
            padding: 12px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .course-btn:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }
        
        /* Profile Card */
        .profile-card {
            background: white;
            padding: 35px;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
        }
        
        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            padding-bottom: 25px;
            border-bottom: 2px solid #f1f5f9;
        }
        
        .profile-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        
        .profile-info h3 {
            color: var(--dark);
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .profile-info p {
            color: var(--gray);
        }
        
        .profile-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .profile-detail-item {
            padding: 20px;
            background: var(--light-bg);
            border-radius: 12px;
            border-left: 4px solid var(--primary);
        }
        
        .profile-detail-item label {
            display: block;
            color: var(--gray);
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }
        
        .profile-detail-item .value {
            color: var(--dark);
            font-size: 16px;
            font-weight: 600;
        }
        
        /* Footer */
        .footer {
            text-align: center;
            padding: 40px 20px;
            color: var(--gray);
            border-top: 1px solid #e2e8f0;
            margin-top: 60px;
        }
        
        .footer p {
            margin-bottom: 8px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
            }
            
            .user-menu {
                gap: 10px;
            }
            
            .user-details {
                display: none;
            }
            
            .hero-section {
                padding: 40px 25px;
            }
            
            .hero-section h1 {
                font-size: 32px;
            }
            
            .hero-section p {
                font-size: 16px;
            }
            
            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .courses-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .profile-header {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo">
            <i class="fas fa-code"></i> Subbyte Programming
        </div>
        
        <div class="user-menu">
            <div class="user-info">
                <div class="user-avatar">
                    <?php echo strtoupper(substr($user['name'], 0, 1)); ?>
                </div>
                <div class="user-details">
                    <strong><?php echo htmlspecialchars($user['name']); ?></strong>
                    <small><?php echo htmlspecialchars($user['email']); ?></small>
                </div>
            </div>
            <a href="logout.php" class="btn btn-logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </nav>
    
    <!-- Main Content -->
    <div class="container">
        <!-- Hero Section -->
        <div class="hero-section">
            <div class="hero-content">
                <h1>Welcome back, <?php echo htmlspecialchars(explode(' ', $user['name'])[0]); ?>! 👋</h1>
                <p>Continue your learning journey and master new programming skills</p>
                <div class="hero-stats">
                    <div class="hero-stat-item">
                        <strong>12</strong>
                        <span>Courses Enrolled</span>
                    </div>
                    <div class="hero-stat-item">
                        <strong>8</strong>
                        <span>Certificates Earned</span>
                    </div>
                    <div class="hero-stat-item">
                        <strong>156h</strong>
                        <span>Learning Time</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div>
                        <div class="stat-number">150+</div>
                        <div class="stat-label">Video Tutorials</div>
                        <div class="stat-trend">
                            <i class="fas fa-arrow-up"></i> 12% this month
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-video"></i>
                    </div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-header">
                    <div>
                        <div class="stat-number">5,000+</div>
                        <div class="stat-label">Active Students</div>
                        <div class="stat-trend">
                            <i class="fas fa-arrow-up"></i> 25% growth
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-header">
                    <div>
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Success Rate</div>
                        <div class="stat-trend">
                            <i class="fas fa-arrow-up"></i> Excellent
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-header">
                    <div>
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Expert Support</div>
                        <div class="stat-trend">
                            <i class="fas fa-check-circle"></i> Always On
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recommended Courses -->
        <div class="section-header">
            <h2>🔥 Recommended Courses</h2>
            <a href="#" class="view-all">
                View All <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        
        <div class="courses-grid">
            <div class="course-card">
                <div class="course-header">
                    <span class="course-badge">Popular</span>
                    <div class="course-icon">
                        <i class="fas fa-code"></i>
                    </div>
                </div>
                <div class="course-body">
                    <h3 class="course-title">Web Development Masterclass</h3>
                    <p class="course-desc">Master HTML, CSS, JavaScript, React, and build professional websites from scratch</p>
                    <div class="course-meta">
                        <div class="course-meta-item">
                            <i class="fas fa-clock"></i>
                            <span>42 hours</span>
                        </div>
                        <div class="course-meta-item">
                            <i class="fas fa-signal"></i>
                            <span>Intermediate</span>
                        </div>
                        <div class="course-meta-item">
                            <i class="fas fa-star"></i>
                            <span>4.9</span>
                        </div>
                    </div>
                    <a href="#" class="course-btn">Start Learning</a>
                </div>
            </div>
            
            <div class="course-card">
                <div class="course-header">
                    <span class="course-badge">New</span>
                    <div class="course-icon">
                        <i class="fab fa-python"></i>
                    </div>
                </div>
                <div class="course-body">
                    <h3 class="course-title">Python Programming Pro</h3>
                    <p class="course-desc">Learn Python for web development, data science, automation, and AI applications</p>
                    <div class="course-meta">
                        <div class="course-meta-item">
                            <i class="fas fa-clock"></i>
                            <span>38 hours</span>
                        </div>
                        <div class="course-meta-item">
                            <i class="fas fa-signal"></i>
                            <span>Beginner</span>
                        </div>
                        <div class="course-meta-item">
                            <i class="fas fa-star"></i>
                            <span>4.8</span>
                        </div>
                    </div>
                    <a href="#" class="course-btn">Start Learning</a>
                </div>
            </div>
            
            <div class="course-card">
                <div class="course-header">
                    <span class="course-badge">Trending</span>
                    <div class="course-icon">
                        <i class="fas fa-database"></i>
                    </div>
                </div>
                <div class="course-body">
                    <h3 class="course-title">Database Management</h3>
                    <p class="course-desc">Master SQL, MongoDB, PostgreSQL and database design for modern applications</p>
                    <div class="course-meta">
                        <div class="course-meta-item">
                            <i class="fas fa-clock"></i>
                            <span>28 hours</span>
                        </div>
                        <div class="course-meta-item">
                            <i class="fas fa-signal"></i>
                            <span>Advanced</span>
                        </div>
                        <div class="course-meta-item">
                            <i class="fas fa-star"></i>
                            <span>4.7</span>
                        </div>
                    </div>
                    <a href="#" class="course-btn">Start Learning</a>
                </div>
            </div>
        </div>
        
        <!-- User Profile -->
        <div class="section-header">
            <h2>👤 Your Profile</h2>
        </div>
        
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-avatar">
                    <?php echo strtoupper(substr($user['name'], 0, 1)); ?>
                </div>
                <div class="profile-info">
                    <h3><?php echo htmlspecialchars($user['name']); ?></h3>
                    <p><?php echo htmlspecialchars($user['email']); ?></p>
                </div>
            </div>
            
            <div class="profile-details">
                <div class="profile-detail-item">
                    <label>User ID</label>
                    <div class="value">#<?php echo htmlspecialchars($user['id']); ?></div>
                </div>
                <div class="profile-detail-item">
                    <label>Member Since</label>
                    <div class="value"><?php echo date('F d, Y', strtotime($user['created_at'])); ?></div>
                </div>
                <div class="profile-detail-item">
                    <label>Email Address</label>
                    <div class="value"><?php echo htmlspecialchars($user['email']); ?></div>
                </div>
                <div class="profile-detail-item">
                    <label>Account Status</label>
                    <div class="value" style="color: var(--success);">
                        <i class="fas fa-check-circle"></i> Active
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <div class="footer">
        <p><strong>&copy; 2026 Subbyte Programming & Learning Hub.</strong> All rights reserved.</p>
        <p>Empowering developers worldwide 🚀</p>
    </div>
</body>
</html>