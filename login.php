<?php
session_start();
error_reporting(E_ALL);

// Database connection
$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'sam';

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$msg = "";

if(isset($_POST['submit'])) {
    // Sanitize inputs
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate inputs
    if(empty($email)) {
        $msg = "Please enter your email";
    } elseif(empty($password)) {
        $msg = "Please enter your password";
    } else {
        // Separate queries for user and admin
        $user_stmt = $conn->prepare("SELECT id, first_name, email, password, 'user' as role FROM users WHERE email = ?");
        $admin_stmt = $conn->prepare("SELECT id, username, email, password, 'admin' as role FROM tbladmin WHERE email = ?");
        
        $user_stmt->bind_param("s", $email);
        $admin_stmt->bind_param("s", $email);
        
        $user_stmt->execute();
        $admin_stmt->execute();
        
        $user_result = $user_stmt->get_result();
        $admin_result = $admin_stmt->get_result();
        
        // Check user credentials
        if($row = $user_result->fetch_assoc()) {
            if(password_verify($password, $row['password'])) {
                // Successful user login
                $_SESSION['uid'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['first_name'];
                $_SESSION['role'] = $row['role'];

                // Redirect to user home page
                header("location: home.php");
                exit();
            } else {
                // Check admin credentials if user login fails
                $admin_result = $admin_stmt->get_result();
                if($admin_row = $admin_result->fetch_assoc()) {
                    if(password_verify($password, $admin_row['password'])) {
                        // Successful admin login
                        $_SESSION['admin_id'] = $admin_row['id'];
                        $_SESSION['email'] = $admin_row['email'];
                        $_SESSION['username'] = $admin_row['username'];
                        $_SESSION['role'] = $admin_row['role'];

                        // Redirect to admin dashboard
                        header("location: admin_dashboard.php");
                        exit();
                    }
                }
                
                $msg = "Invalid email or password!";
            }
        } else {
            // Check admin credentials
            if($admin_row = $admin_result->fetch_assoc()) {
                if(password_verify($password, $admin_row['password'])) {
                    // Successful admin login
                    $_SESSION['admin_id'] = $admin_row['id'];
                    $_SESSION['email'] = $admin_row['email'];
                    $_SESSION['username'] = $admin_row['username'];
                    $_SESSION['role'] = $admin_row['role'];

                    // Redirect to admin dashboard
                    header("location: admin_dashboard.php");
                    exit();
                } else {
                    $msg = "Invalid email or password!";
                }
            } else {
                $msg = "No account found with this email!";
            }
        }
        
        $user_stmt->close();
        $admin_stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Hub - Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: black;
            color: white;
        }
        .logo-glow {
            text-shadow: 0 0 10px #4CAF50, 0 0 20px #4CAF50, 0 0 30px #4CAF50;
            transition: text-shadow 0.3s ease-in-out;
        }
        .logo-glow:hover {
            text-shadow: 0 0 20px #4CAF50, 0 0 40px #4CAF50, 0 0 60px #4CAF50;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8 space-y-6 bg-gray-800 rounded-xl shadow-lg">
        <h1 class="text-center text-4xl font-bold logo-glow">GYM SATHI</h1>
        
        <?php if(!empty($msg)): ?>
            <p class="text-red-500 text-center"><?php echo htmlspecialchars($msg); ?></p>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['signup_success'])): ?>
            <p class="text-green-500 text-center"><?php echo htmlspecialchars($_SESSION['signup_success']); ?></p>
            <?php unset($_SESSION['signup_success']); ?>
        <?php endif; ?>
        
        <form method="POST" action="" id="loginForm" class="space-y-4">
            <div>
                <label for="email" class="block text-sm font-medium">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    required 
                    value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>"
                    class="w-full px-3 py-2 mt-1 bg-gray-700 border border-gray-600 rounded-md text-white"
                >
            </div>
            
            <div>
                <label for="password" class="block text-sm font-medium">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    required 
                    class="w-full px-3 py-2 mt-1 bg-gray-700 border border-gray-600 rounded-md text-white"
                >
            </div>
            
            <button 
                type="submit" 
                name="submit"
                class="w-full py-2 mt-4 bg-green-600 hover:bg-green-700 rounded-md transition duration-300"
            >
                Login
            </button>
        </form>
        
        <div class="text-center mt-4">
            <p class="text-sm">
                Don't have an account? 
                <a href="signup.php" class="text-green-400 hover:text-green-300">Register here</a>
            </p>
        </div>
    </div>
</body>
</html>