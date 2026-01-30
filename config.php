<?php
// Start session
session_start();

// Define file paths
define('USERS_FILE', 'users.json');

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Redirect if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

// Get all users
function getUsers() {
    if (!file_exists(USERS_FILE)) {
        return [];
    }
    $data = file_get_contents(USERS_FILE);
    return json_decode($data, true) ?: [];
}

// Save users
function saveUsers($users) {
    $data = json_encode($users, JSON_PRETTY_PRINT);
    file_put_contents(USERS_FILE, $data);
}

// Add a user
function addUser($name, $email, $password) {
    $users = getUsers();
    
    // Check if email already exists
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            return 'Email already exists';
        }
    }
    
    // Create new user
    $newUser = [
        'id' => uniqid(),
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    $users[] = $newUser;
    saveUsers($users);
    
    return true;
}

// Login user
function loginUser($email, $password) {
    $users = getUsers();
    
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                return true;
            }
        }
    }
    
    return false;
}

// Logout user
function logoutUser() {
    session_destroy();
    header('Location: index.php');
    exit();
}

// Get current user
function getCurrentUser() {
    if (!isLoggedIn()) {
        return null;
    }
    
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['id'] === $_SESSION['user_id']) {
            return $user;
        }
    }
    
    return null;
}
?>