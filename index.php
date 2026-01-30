<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subbyte Programming | Home</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            background-color: #f8fafc;
            overflow-x: hidden;
        }
        
        /* Background Image Section */
        .background-section {
            flex: 1;
            background-image: url('https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            color: white;
        }
        
        .background-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
            z-index: 1;
        }
        
        .background-content {
            position: relative;
            z-index: 2;
            max-width: 600px;
            text-align: center;
            animation: fadeInUp 1s ease-out;
        }
        
        .logo-large {
            font-size: 80px;
            margin-bottom: 20px;
            color: white;
            animation: pulse 2s infinite;
        }
        
        .background-title {
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            line-height: 1.2;
        }
        
        .background-text {
            font-size: 20px;
            line-height: 1.6;
            margin-bottom: 30px;
            opacity: 0.9;
        }
        
        .stats-container {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 40px;
            flex-wrap: wrap;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 16px;
            opacity: 0.9;
        }
        
        /* Content Section */
        .content-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            background-color: white;
            overflow-y: auto;
        }
        
        .content-container {
            max-width: 500px;
            width: 100%;
            animation: slideInRight 0.8s ease-out;
        }
        
        .content-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .content-logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            margin-bottom: 20px;
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.3);
        }
        
        .content-logo i {
            font-size: 36px;
            color: white;
        }
        
        .content-title {
            color: #1e293b;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .content-subtitle {
            color: #64748b;
            font-size: 18px;
        }
        
        .message {
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            animation: slideDown 0.5s ease-out;
            border-left: 5px solid transparent;
        }
        
        .success {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
            border-left-color: #10b981;
        }
        
        .error {
            background: linear-gradient(135deg, #fef2f2, #fee2e2);
            color: #991b1b;
            border-left-color: #ef4444;
        }
        
        .info {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af;
            border-left-color: #3b82f6;
        }
        
        .welcome-message {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #92400e;
            border-left-color: #f59e0b;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
        }
        
        .welcome-icon {
            font-size: 24px;
            margin-right: 15px;
        }
        
        .welcome-text {
            flex: 1;
        }
        
        .welcome-text strong {
            display: block;
            font-size: 18px;
            margin-bottom: 5px;
        }
        
        .buttons-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 40px;
        }
        
        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        
        .btn i {
            margin-right: 12px;
            font-size: 22px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.3);
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            color: #667eea;
            border: 2px solid #667eea;
        }
        
        .btn-secondary:hover {
            background: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.1);
        }
        
        .btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.7s;
        }
        
        .btn:hover::after {
            left: 100%;
        }
        
        .stats-card {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            margin-top: 30px;
        }
        
        .stats-title {
            color: #475569;
            font-size: 16px;
            margin-bottom: 10px;
        }
        
        .stats-count {
            color: #1e293b;
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .stats-subtitle {
            color: #64748b;
            font-size: 14px;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 30px;
        }
        
        .feature-item {
            background: #f8fafc;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            transition: all 0.3s;
        }
        
        .feature-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }
        
        .feature-icon {
            color: #667eea;
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .feature-text {
            color: #475569;
            font-size: 14px;
            font-weight: 600;
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
        
        /* Responsive Design */
        @media (max-width: 1024px) {
            body {
                flex-direction: column;
            }
            
            .background-section {
                min-height: 300px;
                padding: 30px 20px;
            }
            
            .background-title {
                font-size: 36px;
            }
            
            .content-section {
                padding: 30px 20px;
            }
            
            .stats-container {
                gap: 30px;
            }
        }
        
        @media (max-width: 768px) {
            .background-title {
                font-size: 30px;
            }
            
            .background-text {
                font-size: 18px;
            }
            
            .content-title {
                font-size: 30px;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .stat-number {
                font-size: 36px;
            }
        }
        
        @media (max-width: 480px) {
            .background-section {
                min-height: 250px;
            }
            
            .background-title {
                font-size: 26px;
            }
            
            .content-title {
                font-size: 26px;
            }
            
            .btn {
                padding: 18px;
                font-size: 16px;
            }
            
            .stats-container {
                flex-direction: column;
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Left Side - Background Image with Content -->
    <div class="background-section">
        <div class="background-overlay"></div>
        <div class="background-content">
            <div class="logo-large">
                <i class="fas fa-code"></i>
            </div>
            <h1 class="background-title">Master Programming with Subbyte</h1>
            <p class="background-text">Join thousands of developers learning, building, and growing together. From beginner to advanced, we have everything you need to succeed.</p>
            
            <div class="stats-container">
                <div class="stat-item">
                    <div class="stat-number"><?php echo count(getUsers()); ?>+</div>
                    <div class="stat-label">Active Members</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">1000+</div>
                    <div class="stat-label">Tutorials</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Support</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Right Side - Content Section -->
    <div class="content-section">
        <div class="content-container">
            <div class="content-header">
                <div class="content-logo">
                    <i class="fas fa-code"></i>
                </div>
                <h1 class="content-title">Subbyte Programming</h1>
                <p class="content-subtitle">Your coding journey starts here</p>
            </div>
            
            <?php if (isLoggedIn()): ?>
                <!-- User is logged in -->
                <div class="welcome-message">
                    <div class="welcome-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="welcome-text">
                        <strong>Welcome back, <?php echo $_SESSION['user_name']; ?>!</strong>
                        You are now logged in and ready to continue your coding journey.
                    </div>
                </div>
                
                <div class="buttons-container">
                    <a href="dashboard.php" class="btn btn-primary">
                        <i class="fas fa-tachometer-alt"></i> Go to Dashboard
                    </a>
                    <a href="logout.php" class="btn btn-secondary">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
                
                <div class="features-grid">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="feature-text">Continue Learning</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <div class="feature-text">Your Projects</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="feature-text">Community</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <div class="feature-text">Certifications</div>
                    </div>
                </div>
                
            <?php else: ?>
                <!-- User is not logged in -->
                <?php
                if (isset($_GET['success']) && $_GET['success'] == '1') {
                    echo '<div class="message success">
                            <strong>🎉 Registration Successful!</strong><br>
                            Your account has been created. You can now login with your credentials.
                          </div>';
                }
                
                if (isset($_GET['logout']) && $_GET['logout'] == '1') {
                    echo '<div class="message info">
                            <strong>👋 Logged out successfully!</strong><br>
                            You have been logged out of your account.
                          </div>';
                }
                ?>
                
                <div class="buttons-container">
                    <a href="register.php" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Create New Account
                    </a>
                    <a href="login.php" class="btn btn-secondary">
                        <i class="fas fa-sign-in-alt"></i> Login to Account
                    </a>
                </div>
                
                <div class="stats-card">
                    <div class="stats-title">Join Our Growing Community</div>
                    <div class="stats-count"><?php echo count(getUsers()); ?></div>
                    <div class="stats-subtitle">Developers already learning with us</div>
                </div>
                
                <div class="features-grid">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="feature-text">Learn to Code</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <div class="feature-text">Build Projects</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="feature-text">Join Community</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="feature-text">Get Certified</div>
                    </div>
                </div>
                
            <?php endif; ?>
            
            <div style="text-align: center; margin-top: 40px; color: #94a3b8; font-size: 14px;">
                <p>© <?php echo date('Y'); ?> Subbyte Programming. All rights reserved.</p>
                <p style="margin-top: 10px;">
                    <a href="#" style="color: #667eea; text-decoration: none; margin: 0 10px;">Terms</a> | 
                    <a href="#" style="color: #667eea; text-decoration: none; margin: 0 10px;">Privacy</a> | 
                    <a href="#" style="color: #667eea; text-decoration: none; margin: 0 10px;">Contact</a>
                </p>
            </div>
        </div>
    </div>
    
    <script>
        // Add animation to elements when they come into view
        document.addEventListener('DOMContentLoaded', function() {
            // Animate stat numbers
            const statNumbers = document.querySelectorAll('.stat-number');
            statNumbers.forEach(stat => {
                const finalNumber = parseInt(stat.textContent);
                if (!isNaN(finalNumber)) {
                    animateCounter(stat, 0, finalNumber, 1500);
                }
            });
            
            // Animate main stats count
            const statsCount = document.querySelector('.stats-count');
            if (statsCount) {
                const finalCount = parseInt(statsCount.textContent);
                if (!isNaN(finalCount)) {
                    animateCounter(statsCount, 0, finalCount, 2000);
                }
            }
            
            // Add hover effect to feature items
            const featureItems = document.querySelectorAll('.feature-item');
            featureItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    const icon = this.querySelector('.feature-icon');
                    icon.style.transform = 'scale(1.2)';
                    icon.style.transition = 'transform 0.3s';
                });
                
                item.addEventListener('mouseleave', function() {
                    const icon = this.querySelector('.feature-icon');
                    icon.style.transform = 'scale(1)';
                });
            });
        });
        
        function animateCounter(element, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const currentNumber = Math.floor(progress * (end - start) + start);
                element.textContent = currentNumber + (element.classList.contains('stat-number') ? '+' : '');
                
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }
    </script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</body>
</html>