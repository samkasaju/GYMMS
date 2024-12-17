<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Sathi - Membership Plans</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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

        .section-title {
            margin: 20px 0;
            font-size: 22px;
            color: #333;
            text-align: center;
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

        .plan-price {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }

        .plan-features {
            text-align: left;
            margin-bottom: 15px;
        }

        .plan-feature {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .plan-feature i {
            margin-right: 10px;
        }

        .bx-check {
            color: #4CAF50;
        }

        .bx-x {
            color: #F44336;
        }

        .btn-subscribe {
            display: inline-block;
            background-color: #ff6b00;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-subscribe:hover {
            background-color: #e65100;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2 class="gym-sathi">Gym Sathi</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="profile.php"><i class='bx bx-user'></i> Profile</a></li>
            <li><a href="home.php"><i class='bx bxs-dashboard'></i> Dashboard</a></li>
            <li><a href="membership.php" class="active"><i class='bx bx-cart'></i> Membership</a></li>
            <li><a href="notification.php"><i class='bx bx-bell'></i> Notifications</a></li>
            <li><a href="#"><i class='bx bxs-bowl-rice'></i> Diet Plans</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2 class="section-title">Membership Plans</h2>
        <div class="plans-container">
            <!-- Basic Package -->
            <div class="plan-box">
                <div class="plan-title">Basic Package</div>
                <div class="plan-price">₹3,500/month</div>
                <div class="plan-features">
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Gym Access
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Equipments
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Changing Rooms
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Toiletries
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Cardio
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Weight Lifting
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-x'></i> Zumba
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-x'></i> Aerobics
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-x'></i> Personal Trainer
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-x'></i> Pool Access
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-x'></i> Personal Diet Plan
                    </div>
                </div>
                <a href="#" class="btn-subscribe">Subscribe</a>
            </div>

            <!-- Pro Package -->
            <div class="plan-box">
                <div class="plan-title">Pro Package</div>
                <div class="plan-price">₹2,000/month</div>
                <div class="plan-features">
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Gym Access
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Equipments
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Changing Rooms
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Toiletries
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Cardio
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Weight Lifting
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Zumba
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Aerobics
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-x'></i> Personal Trainer
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-x'></i> Pool Access
                    </div>
                </div>
                <a href="#" class="btn-subscribe">Subscribe</a>
            </div>

            <!-- Premium Package -->
            <div class="plan-box">
                <div class="plan-title">Premium Package</div>
                <div class="plan-price">₹5,000/month</div>
                <div class="plan-features">
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Gym Access
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Equipments
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Changing Rooms
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Toiletries
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Cardio
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Weight Lifting
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Zumba
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Aerobics
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Personal Trainer
                    </div>
                    <div class="plan-feature">
                        <i class='bx bx-check'></i> Pool Access
                    </div>
                </div>
                <a href="#" class="btn-subscribe">Subscribe</a>
            </div>
        </div>
    </div>
</body>
</html>