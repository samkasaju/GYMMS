<?php
session_start();
error_reporting(E_ALL);
require_once('include/config.php');

// Check if user is already logged in
if(isset($_SESSION['uid'])) {
    header("location: index.php");
    exit();
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
        try {
            // Fetch user with email
            $query = "SELECT id, fname, email, password FROM tbluser WHERE email = :email";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row) {
                // Verify password
                if(password_verify($password, $row['password'])) {
                    // Successful login
                    $_SESSION['uid'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['name'] = $row['fname'];

                    // Redirect to dashboard or home page
                    header("location: index.php");
                    exit();
                } else {
                    $msg = "Invalid email or password!";
                }
            } else {
                $msg = "No account found with this email!";
            }
        } catch (PDOException $e) {
            $msg = "Database error: " . $e->getMessage();
        }
    }
}
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
        <h1 class="text-center text-4xl font-bold logo-glow">Fitness Hub</h1>
        
        <?php if(!empty($msg)): ?>
            <p class="text-red-500 text-center"><?php echo htmlspecialchars($msg); ?></p>
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