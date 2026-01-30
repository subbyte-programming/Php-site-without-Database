<?php
require 'config.php';

if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validation
    if (empty($name) || empty($email) || empty($password)) {
        $error = 'All fields are required';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters';
    } else {
        // Register user
        $result = addUser($name, $email, $password);
        
        if ($result === true) {
            header('Location: index.php?success=1');
            exit();
        } else {
            $error = $result;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Subbyte Programming</title>
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
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        
        .background-text {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
            opacity: 0.9;
        }
        
        .features-list {
            list-style: none;
            text-align: left;
            margin-top: 30px;
        }
        
        .features-list li {
            padding: 12px 0;
            font-size: 16px;
            display: flex;
            align-items: center;
        }
        
        .features-list li i {
            margin-right: 15px;
            color: #ffd166;
            font-size: 20px;
        }
        
        /* Registration Form Section */
        .form-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            background-color: white;
            overflow-y: auto;
        }
        
        .form-container {
            max-width: 500px;
            width: 100%;
            animation: slideInRight 0.8s ease-out;
        }
        
        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .form-logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            margin-bottom: 20px;
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        
        .form-logo i {
            font-size: 32px;
            color: white;
        }
        
        .form-title {
            color: #1e293b;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .form-subtitle {
            color: #64748b;
            font-size: 16px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            margin-bottom: 10px;
            color: #475569;
            font-weight: 600;
            font-size: 15px;
        }
        
        .input-container {
            position: relative;
            display: flex;
            align-items: center;
        }
        
        .input-icon {
            position: absolute;
            left: 16px;
            color: #667eea;
            font-size: 18px;
            z-index: 2;
        }
        
        input {
            width: 100%;
            padding: 16px 16px 16px 50px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s;
            background-color: white;
        }
        
        input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }
        
        .password-toggle {
            position: relative;
        }
        
        .toggle-btn {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 18px;
            transition: color 0.3s;
            z-index: 2;
        }
        
        .toggle-btn:hover {
            color: #667eea;
        }
        
        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            position: relative;
            overflow: hidden;
        }
        
        .btn i {
            margin-right: 10px;
            font-size: 20px;
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.3);
        }
        
        .btn:active {
            transform: translateY(-1px);
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
        
        .links {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        
        .link-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s;
            text-align: center;
        }
        
        .link-btn i {
            margin-right: 10px;
        }
        
        .home-btn {
            background-color: #f1f5f9;
            color: #1e293b;
        }
        
        .home-btn:hover {
            background-color: #e2e8f0;
            transform: translateY(-2px);
        }
        
        .login-btn {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            color: #667eea;
            border: 2px solid #667eea;
        }
        
        .login-btn:hover {
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.1);
        }
        
        .message {
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 25px;
            animation: slideDown 0.5s ease-out;
        }
        
        .error {
            background: linear-gradient(135deg, #fef2f2, #fee2e2);
            color: #991b1b;
            border-left: 5px solid #ef4444;
        }
        
        .success {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
            border-left: 5px solid #10b981;
        }
        
        /* Terms Checkbox */
        .terms-group {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }
        
        .checkbox-container {
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        
        .checkbox-container input {
            display: none;
        }
        
        .checkmark {
            width: 22px;
            height: 22px;
            border: 2px solid #cbd5e1;
            border-radius: 6px;
            margin-right: 12px;
            position: relative;
            transition: all 0.3s;
        }
        
        .checkbox-container input:checked + .checkmark {
            background-color: #667eea;
            border-color: #667eea;
        }
        
        .checkbox-container input:checked + .checkmark::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 12px;
        }
        
        .terms-text {
            font-size: 14px;
            color: #64748b;
        }
        
        .terms-text a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        
        .terms-text a:hover {
            text-decoration: underline;
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
                font-size: 32px;
            }
            
            .form-section {
                padding: 30px 20px;
            }
        }
        
        @media (max-width: 768px) {
            .background-title {
                font-size: 28px;
            }
            
            .background-text {
                font-size: 16px;
            }
            
            .form-title {
                font-size: 28px;
            }
        }
        
        @media (max-width: 480px) {
            .background-section {
                min-height: 250px;
            }
            
            .background-title {
                font-size: 24px;
            }
            
            .form-title {
                font-size: 24px;
            }
            
            .btn, .link-btn {
                padding: 16px;
            }
        }
        
        /* Password Strength Indicator */
        .password-strength {
            margin-top: 8px;
            height: 6px;
            border-radius: 3px;
            background-color: #e2e8f0;
            overflow: hidden;
            position: relative;
        }
        
        .strength-meter {
            height: 100%;
            width: 0%;
            border-radius: 3px;
            transition: width 0.3s, background-color 0.3s;
        }
        
        .strength-text {
            font-size: 12px;
            margin-top: 4px;
            color: #64748b;
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
            <h1 class="background-title">Join Subbyte Programming Community</h1>
            <p class="background-text">Learn, code, and grow with thousands of developers worldwide. Access premium resources, tutorials, and connect with like-minded programmers.</p>
            
            <ul class="features-list">
                <li><i class="fas fa-check-circle"></i> Access to 1000+ coding tutorials</li>
                <li><i class="fas fa-check-circle"></i> Live coding sessions and webinars</li>
                <li><i class="fas fa-check-circle"></i> Community support and code reviews</li>
                <li><i class="fas fa-check-circle"></i> Project templates and resources</li>
                <li><i class="fas fa-check-circle"></i> Certification programs</li>
            </ul>
        </div>
    </div>
    
    <!-- Right Side - Registration Form -->
    <div class="form-section">
        <div class="form-container">
            <div class="form-header">
                <div class="form-logo">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h1 class="form-title">Create Account</h1>
                <p class="form-subtitle">Join our community of developers</p>
            </div>
            
            <?php if ($error): ?>
                <div class="message error">
                    <strong>Error:</strong> <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="message success">
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="" id="registerForm">
                <div class="form-group">
                    <label>Full Name</label>
                    <div class="input-container">
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <input type="text" name="name" placeholder="Enter your full name" 
                               value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-container">
                        <div class="input-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <input type="email" name="email" placeholder="Enter your email address" 
                               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                    </div>
                </div>
                
                <div class="form-group password-toggle">
                    <label>Password</label>
                    <div class="input-container">
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <input type="password" id="password" name="password" placeholder="Create a strong password" required>
                        <button type="button" class="toggle-btn" onclick="togglePassword('password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="password-strength">
                        <div class="strength-meter" id="strengthMeter"></div>
                    </div>
                    <div class="strength-text" id="strengthText">Password strength: None</div>
                </div>
                
                <div class="form-group password-toggle">
                    <label>Confirm Password</label>
                    <div class="input-container">
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <input type="password" id="confirm_password" name="confirm_password" 
                               placeholder="Re-enter your password" required>
                        <button type="button" class="toggle-btn" onclick="togglePassword('confirm_password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div id="passwordMatch" class="strength-text"></div>
                </div>
                
                <div class="terms-group">
                    <label class="checkbox-container">
                        <input type="checkbox" name="terms" required>
                        <span class="checkmark"></span>
                        <span class="terms-text">
                            I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                        </span>
                    </label>
                </div>
                
                <button type="submit" class="btn">
                    <i class="fas fa-user-plus"></i> Create Account
                </button>
            </form>
            
            <div class="links">
                <a href="index.php" class="link-btn home-btn">
                    <i class="fas fa-home"></i> Back to Homepage
                </a>
                <a href="login.php" class="link-btn login-btn">
                    <i class="fas fa-sign-in-alt"></i> Already have an account? Sign In
                </a>
            </div>
            
            <div style="text-align: center; margin-top: 30px; color: #94a3b8; font-size: 14px;">
                <p>By registering, you agree to our terms and conditions</p>
            </div>
        </div>
    </div>
    
    <script>
        function togglePassword(fieldId) {
            const input = document.getElementById(fieldId);
            const icon = input.parentNode.querySelector('.toggle-btn i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
        
        // Password Strength Indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthMeter = document.getElementById('strengthMeter');
            const strengthText = document.getElementById('strengthText');
            
            let strength = 0;
            let color = '#ef4444'; // Red
            
            // Check password length
            if (password.length >= 6) strength += 20;
            if (password.length >= 8) strength += 20;
            
            // Check for uppercase letters
            if (/[A-Z]/.test(password)) strength += 20;
            
            // Check for numbers
            if (/[0-9]/.test(password)) strength += 20;
            
            // Check for special characters
            if (/[^A-Za-z0-9]/.test(password)) strength += 20;
            
            // Set meter width and color
            strengthMeter.style.width = strength + '%';
            
            if (strength < 40) {
                color = '#ef4444'; // Red
                strengthText.textContent = 'Password strength: Weak';
            } else if (strength < 70) {
                color = '#f59e0b'; // Yellow
                strengthText.textContent = 'Password strength: Medium';
            } else {
                color = '#10b981'; // Green
                strengthText.textContent = 'Password strength: Strong';
            }
            
            strengthMeter.style.backgroundColor = color;
        });
        
        // Password Match Checker
        document.getElementById('confirm_password').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            const matchText = document.getElementById('passwordMatch');
            
            if (confirmPassword.length === 0) {
                matchText.textContent = '';
                matchText.style.color = '#64748b';
            } else if (password === confirmPassword) {
                matchText.textContent = '✓ Passwords match';
                matchText.style.color = '#10b981';
            } else {
                matchText.textContent = '✗ Passwords do not match';
                matchText.style.color = '#ef4444';
            }
        });
        
        // Form validation
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm_password');
            const terms = document.querySelector('input[name="terms"]');
            
            // Password length validation
            if (password.value.length < 6) {
                e.preventDefault();
                password.style.borderColor = '#ef4444';
                password.focus();
                
                // Shake animation
                password.style.animation = 'none';
                setTimeout(() => {
                    password.style.animation = 'shake 0.5s';
                }, 10);
                
                return false;
            }
            
            // Password match validation
            if (password.value !== confirmPassword.value) {
                e.preventDefault();
                confirmPassword.style.borderColor = '#ef4444';
                confirmPassword.focus();
                
                // Shake animation
                confirmPassword.style.animation = 'none';
                setTimeout(() => {
                    confirmPassword.style.animation = 'shake 0.5s';
                }, 10);
                
                return false;
            }
            
            // Terms acceptance validation
            if (!terms.checked) {
                e.preventDefault();
                const checkmark = document.querySelector('.checkmark');
                checkmark.style.borderColor = '#ef4444';
                checkmark.style.backgroundColor = '#fee2e2';
                
                // Shake animation
                checkmark.style.animation = 'none';
                setTimeout(() => {
                    checkmark.style.animation = 'shake 0.5s';
                }, 10);
                
                return false;
            }
        });
        
        // Add shake animation to CSS
        const style = document.createElement('style');
        style.textContent = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                20%, 40%, 60%, 80% { transform: translateX(5px); }
            }
        `;
        document.head.appendChild(style);
        
        // Input focus effects
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.style.borderColor = '#667eea';
                this.style.boxShadow = '0 0 0 4px rgba(102, 126, 234, 0.1)';
            });
            
            input.addEventListener('blur', function() {
                this.style.boxShadow = 'none';
                
                // Reset error styling on valid input
                if (this.value.trim() !== '') {
                    this.style.borderColor = '#e2e8f0';
                }
            });
        });
    </script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</body>
</html>