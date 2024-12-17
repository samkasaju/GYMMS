<?php
session_start();

// Check if user is logged in and is a user
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    // Not a user or not logged in, redirect to login
    header("Location: login.php");
    exit();
}

// Rest of the user home page content
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Sathi - Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        .sidebar {
            width: 250px;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .gym-sathi {
            color: #ff6b00;
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 15px;
        }

        .sidebar-menu a {
            text-decoration: none;
            color: #333;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar-menu a:hover {
            background-color: #f0f0f0;
        }

        .sidebar-menu i {
            margin-right: 10px;
            font-size: 20px;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f9f9f9;
            overflow-y: auto;
        }

        .welcome-section {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .health-stats {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat-box {
            flex: 1;
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .stat-box i {
            font-size: 36px;
            margin-bottom: 10px;
            color: #ff6b00;
        }

        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .stat-label {
            color: #666;
            margin-top: 5px;
        }

        .section-title {
            margin: 20px 0;
            font-size: 22px;
            color: #333;
            text-align: center;
        }

        .progress-chart {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .plans-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .plan-box {
            flex: 1;
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .plan-box:hover {
            transform: scale(1.05);
        }

        .plan-title {
            font-size: 18px;
            font-weight: bold;
            color: #ff6b00;
            margin-bottom: 10px;
        }

        .plan-details {
            color: #666;
            margin-bottom: 15px;
        }

        .plan-price {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .btn-select {
            display: inline-block;
            background-color: #ff6b00;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 15px;
            transition: background-color 0.3s;
        }

        .btn-select:hover {
            background-color: #e65100;
        }
    </style>
</head>
<body>
    <!-- Sidebar (Same as previous design) -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2 class="gym-sathi">Gym Sathi</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="profile.php"><i class='bx bx-user'></i> Profile</a></li>
            <li><a href="home.php"><i class='bx bxs-dashboard'></i> Dashboard</a></li>
            <li><a href="membership.php"><i class='bx bx-cart'></i> Membership</a></li>
            <li><a href="notification.php"><i class='bx bx-bell'></i> Notifications</a></li>
            <li><a href="#"><i class='bx bxs-bowl-rice'></i></i> Diet Plans</a></li>
            
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Previous Health Stats Section (Unchanged) -->
        <div class="welcome-section">
            <h1>Welcome back, let's start on a fitness journey!</h1>
            <p>Recommended steps to follow:</p>
        </div>

        <div class="health-stats">
            <div class="stat-box">
                <i class='bx bx-water'></i>
                <div class="stat-value">0.3 L</div>
                <div class="stat-label">Water Intake</div>
            </div>
            <div class="stat-box">
                <i class='bx bx-bowl-hot'></i>
                <div class="stat-value">1800</div>
                <div class="stat-label">Calories</div>
            </div>
            <div class="stat-box">
                <i class='bx bx-walk'></i>
                <div class="stat-value">10,000</div>
                <div class="stat-label">Steps</div>
            </div>
            <div class="stat-box">
                <i class='bx bx-moon'></i>
                <div class="stat-value">8 hrs</div>
                <div class="stat-label">Sleep</div>
            </div>
        </div>

        <!-- Progress Chart Section -->
        <h2 class="section-title">Progress Tracking</h2>
        <div class="progress-chart">
            <canvas id="progressChart"></canvas>
        </div>

        <!-- Membership Plans Section -->
        <h2 class="section-title">Membership Plans</h2>
        <div class="plans-container">
            <div class="plan-box">
                <div class="plan-title">Basic Plan</div>
                <div class="plan-details">
                    Ideal for beginners
                    <br>
                    Gym Access
                    <br>
                    Basic Equipment
                </div>
                <div class="plan-price">$29.99/month</div>
                <a href="#" class="btn-select">Select Plan</a>
            </div>
            <div class="plan-box">
                <div class="plan-title">Pro Plan</div>
                <div class="plan-details">
                    Advanced Training
                    <br>
                    Personal Trainer
                    <br>
                    Nutrition Consultation
                </div>
                <div class="plan-price">$59.99/month</div>
                <a href="#" class="btn-select">Select Plan</a>
            </div>
            <div class="plan-box">
                <div class="plan-title">Premium Plan</div>
                <div class="plan-details">
                    Complete Fitness Solution
                    <br>
                    Unlimited Classes
                    <br>
                    24/7 Support
                </div>
                <div class="plan-price">$99.99/month</div>
                <a href="#" class="btn-select">Select Plan</a>
            </div>
        </div>

        <!-- Diet Plans Section -->
        <h2 class="section-title">Diet Plans</h2>
        <div class="plans-container">
            <div class="plan-box">
                <div class="plan-title">Weight Loss Diet</div>
                <div class="plan-details">
                    Low Calorie
                    <br>
                    High Protein
                    <br>
                    Balanced Nutrition
                </div>
                <a href="#" class="btn-select">View Details</a>
            </div>
            <div class="plan-box">
                <div class="plan-title">Muscle Gain Diet</div>
                <div class="plan-details">
                    High Protein
                    <br>
                    Calorie Surplus
                    <br>
                    Nutrient Dense
                </div>
                <a href="#" class="btn-select">View Details</a>
            </div>
            <div class="plan-box">
                <div class="plan-title">Balanced Nutrition</div>
                <div class="plan-details">
                    Whole Foods
                    <br>
                    Balanced Macros
                    <br>
                    Sustainable Eating
                </div>
                <a href="#" class="btn-select">View Details</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Progress Chart
            const ctx = document.getElementById('progressChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Weight Progress',
                        data: [70, 68, 67, 65, 63, 62],
                        borderColor: '#ff6b00',
                        backgroundColor: 'rgba(255, 107, 0, 0.1)',
                        tension: 0.4
                    }, {
                        label: 'Workout Intensity',
                        data: [5, 6, 7, 8, 9, 10],
                        borderColor: '#4CAF50',
                        backgroundColor: 'rgba(76, 175, 80, 0.1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Monthly Fitness Progress'
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>

