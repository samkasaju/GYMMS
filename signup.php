<?php
session_start();

// Database connection
$host = 'localhost';
$dbUsername = 'your_username';
$dbPassword = 'your_password';
$dbName = 'sam';

$conn = new mysqli('localhost', 'root', '', 'sam');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$firstName = $lastName = $phone = $gender = $email = '';
$errors = [];

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate first name
    if (empty(trim($_POST['first_name']))) {
        $errors['first_name'] = "First name is required";
    } else {
        $firstName = trim($_POST['first_name']);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
            $errors['first_name'] = "Only letters and spaces allowed";
        }
    }

    // Validate last name
    if (empty(trim($_POST['last_name']))) {
        $errors['last_name'] = "Last name is required";
    } else {
        $lastName = trim($_POST['last_name']);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lastName)) {
            $errors['last_name'] = "Only letters and spaces allowed";
        }
    }

    // Validate phone number
    if (empty(trim($_POST['phone']))) {
        $errors['phone'] = "Phone number is required";
    } else {
        $phone = trim($_POST['phone']);
        if (!preg_match("/^[0-9]{10}$/", $phone)) {
            $errors['phone'] = "Invalid phone number. Must be 10 digits.";
        }
    }

    // Validate gender
    if (empty($_POST['gender'])) {
        $errors['gender'] = "Gender selection is required";
    } else {
        $gender = $_POST['gender'];
    }

    // Validate email
    if (empty(trim($_POST['email']))) {
        $errors['email'] = "Email is required";
    } else {
        $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
        if (!$email) {
            $errors['email'] = "Invalid email format";
        } else {
            // Check if email already exists
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $errors['email'] = "Email already exists";
            }
            $stmt->close();
        }
    }

    // Validate password
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);
    if (empty($password)) {
        $errors['password'] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters";
    } elseif ($password !== $confirmPassword) {
        $errors['password'] = "Passwords do not match";
    }

    // If no errors, proceed with registration
    if (empty($errors)) {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, phone, gender, email, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $firstName, $lastName, $phone, $gender, $email, $hashedPassword);

        if ($stmt->execute()) {
            // Redirect to login page or dashboard
            $_SESSION['signup_success'] = "Registration successful! Please log in.";
            header("Location: login.php");
            exit();
        } else {
            $errors['general'] = "Registration failed. Please try again.";
        }
        $stmt->close();
    }
}
$conn->close();
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
        <h1 class="text-center text-4xl font-bold logo-glow">GYM SATHI</h1>
        
        <?php if (!empty($errors['general'])): ?>
            <p class="text-red-500 text-center"><?php echo htmlspecialchars($errors['general']); ?></p>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="signupForm" class="space-y-4">
            <div class="flex space-x-4">
                <div class="w-1/2">
                    <label for="first_name" class="block text-sm font-medium">First Name</label>
                    <input 
                        type="text" 
                        name="first_name" 
                        id="first_name" 
                        required 
                        value="<?php echo htmlspecialchars($firstName); ?>"
                        class="w-full px-3 py-2 mt-1 bg-gray-700 border border-gray-600 rounded-md text-white"
                    >
                    <?php if (!empty($errors['first_name'])): ?>
                        <p class="error-text"><?php echo htmlspecialchars($errors['first_name']); ?></p>
                    <?php endif; ?>
                </div>
                
                <div class="w-1/2">
                    <label for="last_name" class="block text-sm font-medium">Last Name</label>
                    <input 
                        type="text" 
                        name="last_name" 
                        id="last_name" 
                        required 
                        value="<?php echo htmlspecialchars($lastName); ?>"
                        class="w-full px-3 py-2 mt-1 bg-gray-700 border border-gray-600 rounded-md text-white"
                    >
                    <?php if (!empty($errors['last_name'])): ?>
                        <p class="error-text"><?php echo htmlspecialchars($errors['last_name']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            
            <div>
                <label for="phone" class="block text-sm font-medium">Phone Number</label>
                <input 
                    type="tel" 
                    name="phone" 
                    id="phone" 
                    required 
                    pattern="[0-9]{10}"
                    value="<?php echo htmlspecialchars($phone); ?>"
                    class="w-full px-3 py-2 mt-1 bg-gray-700 border border-gray-600 rounded-md text-white"
                >
                <?php if (!empty($errors['phone'])): ?>
                    <p class="error-text"><?php echo htmlspecialchars($errors['phone']); ?></p>
                <?php endif; ?>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Gender</label>
                <div class="flex space-x-4">
                    <label class="inline-flex items-center">
                        <input 
                            type="radio" 
                            name="gender" 
                            value="Male" 
                            class="form-radio"
                            <?php echo ($gender == 'Male') ? 'checked' : ''; ?>
                        >
                        <span class="ml-2">Male</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input 
                            type="radio" 
                            name="gender" 
                            value="Female" 
                            class="form-radio"
                            <?php echo ($gender == 'Female') ? 'checked' : ''; ?>
                        >
                        <span class="ml-2">Female</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input 
                            type="radio" 
                            name="gender" 
                            value="Other" 
                            class="form-radio"
                            <?php echo ($gender == 'Other') ? 'checked' : ''; ?>
                        >
                        <span class="ml-2">Other</span>
                    </label>
                </div>
                <?php if (!empty($errors['gender'])): ?>
                    <p class="error-text"><?php echo htmlspecialchars($errors['gender']); ?></p>
                <?php endif; ?>
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    required 
                    value="<?php echo htmlspecialchars($email); ?>"
                    class="w-full px-3 py-2 mt-1 bg-gray-700 border border-gray-600 rounded-md text-white"
                >
                <?php if (!empty($errors['email'])): ?>
                    <p class="error-text"><?php echo htmlspecialchars($errors['email']); ?></p>
                <?php endif; ?>
            </div>
            
            <div>
                <label for="password" class="block text-sm font-medium">Password</label>
                <div class="relative">
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        required 
                        class="w-full px-3 py-2 mt-1 bg-gray-700 border border-gray-600 rounded-md text-white"
                    >
                    <button 
                        type="button" 
                        id="togglePassword" 
                        class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400"
                    >
                        👁️
                    </button>
                </div>
            </div>
            
            <div>
                <label for="confirm_password" class="block text-sm font-medium">Confirm Password</label>
                <div class="relative">
                    <input 
                        type="password" 
                        name="confirm_password" 
                        id="confirm_password" 
                        required 
                        class="w-full px-3 py-2 mt-1 bg-gray-700 border border-gray-600 rounded-md text-white"
                    >
                    <button 
                        type="button" 
                        id="toggleConfirmPassword" 
                        class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400"
                    >
                        👁️
                    </button>
                </div>
                <?php if (!empty($errors['password'])): ?>
                    <p class="error-text"><?php echo htmlspecialchars($errors['password']); ?></p>
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

    <script>
        // Password visibility toggle
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const confirmPasswordInput = document.getElementById('confirm_password');
            confirmPasswordInput.type = confirmPasswordInput.type === 'password' ? 'text' : 'password';
        });
    </script>
</body>
</html>