<?php
session_start();
error_reporting(E_ALL);
require_once('include/config.php');

// Initialize error variables
$nameError = $emailError = $passwordError = $generalError = "";

if(isset($_POST['submit'])) { 
    // Sanitize and validate inputs
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Validation checks
    $isValid = true;

    // Username validation
    if (empty($username)) {
        $nameError = "Please enter a username";
        $isValid = false;
    } elseif (strlen($username) < 3) {
        $nameError = "Username must be at least 3 characters long";
        $isValid = false;
    }

    // Email validation
    if (empty($email)) {
        $emailError = "Please enter an email address";
        $isValid = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format";
        $isValid = false;
    }

    // Password validation
    if (empty($password)) {
        $passwordError = "Please enter a password";
        $isValid = false;
    } elseif (strlen($password) < 8) {
        $passwordError = "Password must be at least 8 characters long";
        $isValid = false;
    } elseif ($password !== $confirmPassword) {
        $passwordError = "Passwords do not match";
        $isValid = false;
    }

    // Check if email or username already exists
    if ($isValid) {
        try {
            // Check for existing email
            $checkUser = $dbh->prepare("SELECT id FROM tbluser WHERE email = :email OR username = :username");
            $checkUser->execute([
                ':email' => $email,
                ':username' => $username
            ]);

            if ($checkUser->rowCount() > 0) {
                $generalError = "Email or username already exists";
                $isValid = false;
            }
        } catch (PDOException $e) {
            $generalError = "Database error: " . $e->getMessage();
            $isValid = false;
        }
    }

    // If all validations pass, proceed with registration
    if ($isValid) {
        try {
            // Use secure password hashing
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Prepare SQL to insert new user
            $sql = "INSERT INTO tbluser (username, email, password, create_date) VALUES (:username, :email, :password, NOW())";
            $query = $dbh->prepare($sql);
            
            // Bind parameters
            $query->bindParam(':username', $username, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

            // Execute the query
            $query->execute();

            // Get the last inserted ID
            $lastInsertId = $dbh->lastInsertId();

            if ($lastInsertId > 0) {
                // Successful registration
                $_SESSION['signup_success'] = "Registration successful. Please login.";
                header("Location: login.php");
                exit();
            } else {
                $generalError = "Registration failed. Please try again.";
            }
        } catch (PDOException $e) {
            $generalError = "Registration error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Hub - Sign Up</title>
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
        .error-text {
            color: red;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8 space-y-6 bg-gray-800 rounded-xl shadow-lg">
        <h1 class="text-center text-4xl font-bold logo-glow">Fitness Hub</h1>
        
        <?php if (!empty($generalError)): ?>
            <p class="text-red-500 text-center"><?php echo htmlspecialchars($generalError); ?></p>
        <?php endif; ?>
        
        <form method="POST" action="" id="signupForm" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium">Username</label>
                <input 
                    type="text" 
                    name="username" 
                    id="username" 
                    required 
                    value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>"
                    class="w-full px-3 py-2 mt-1 bg-gray-700 border border-gray-600 rounded-md text-white"
                >
                <?php if (!empty($nameError)): ?>
                    <p class="error-text"><?php echo htmlspecialchars($nameError); ?></p>
                <?php endif; ?>
            </div>
            
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
                <?php if (!empty($emailError)): ?>
                    <p class="error-text"><?php echo htmlspecialchars($emailError); ?></p>
                <?php endif; ?>
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
            
            <div>
                <label for="confirm-password" class="block text-sm font-medium">Confirm Password</label>
                <input 
                    type="password" 
                    name="confirm-password" 
                    id="confirm-password" 
                    required 
                    class="w-full px-3 py-2 mt-1 bg-gray-700 border border-gray-600 rounded-md text-white"
                >
                <?php if (!empty($passwordError)): ?>
                    <p class="error-text"><?php echo htmlspecialchars($passwordError); ?></p>
                <?php endif; ?>
            </div>
            
            <button 
                type="submit" 
                name="submit"
                class="w-full py-2 mt-4 bg-green-600 hover:bg-green-700 rounded-md transition duration-300"
            >
                Sign Up
            </button>
        </form>
        
        <div class="text-center mt-4">
            <p class="text-sm">
                Already have an account? 
                <a href="login.php" class="text-green-400 hover:text-green-300">Login here</a>
            </p>
        </div>
    </div>
</body>
</html>