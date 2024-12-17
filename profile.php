<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Sathi - User Profile</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f4f4f4;
            display: flex;
            min-height: 100vh;
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

        .profile-container {
            flex-grow: 1;
            padding: 30px;
            background-color: #f9f9f9;
            overflow-y: auto;
        }

        .profile-header {
            display: flex;
            align-items: center;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 30px;
            border: 4px solid #ff6b00;
        }

        .profile-info h1 {
            color: #333;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .logout-section {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .btn-logout {
            background-color: #f44336;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #d32f2f;
        }

        .profile-section {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .section-title {
            color: #ff6b00;
            border-bottom: 2px solid #ff6b00;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .radio-group {
            display: flex;
            gap: 15px;
        }

        .radio-group label {
            display: flex;
            align-items: center;
        }

        .radio-group input {
            margin-right: 5px;
        }

        .btn-container {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-edit {
            background-color: #ff6b00;
            color: white;
        }

        .btn-delete {
            background-color: #f44336;
            color: white;
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
        <li><a href="#"><i class='bx bx-user'></i> Profile</a></li>
            <li><a href="home.php"><i class='bx bxs-dashboard'></i> Dashboard</a></li>
            <li><a href="membership.php"><i class='bx bx-cart'></i> Membership</a></li>
            <li><a href="notification.php"><i class='bx bx-bell'></i> Notifications</a></li>
            
            <li><a href="#"><i class='bx bx-bowl-hot'></i> Diet Plans</a></li>
        </ul>
    </div>

    <!-- Profile Container -->
    <div class="profile-container">
        <!-- Profile Header -->
        <div class="profile-header">
            <img src="/api/placeholder/150/150" alt="Profile Photo" class="profile-photo">
            <div class="profile-info">
                <h1>John Doe</h1>
                <h2>Fitness Enthusiast</h2>
            </div>
        </div>

        <!-- Personal Information Section -->
        <div class="profile-section">
            <h2 class="section-title">Personal Information</h2>
            <form id="personalInfoForm">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="firstName" value="John" required>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="lastName" value="Doe" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="johndoe@example.com" required>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" value="+1 (555) 123-4567" required>
                </div>
                <div class="btn-container">
                    <button type="button" class="btn btn-edit" onclick="editPersonalInfo()">Edit</button>
                    <button type="button" class="btn btn-delete" onclick="deletePersonalInfo()">Delete</button>
                </div>
            </form>
        </div>

        <!-- Health Information Section -->
        <div class="profile-section">
            <h2 class="section-title">Health Information</h2>
            <form id="healthInfoForm">
                <div class="form-group">
                    <label>Height (cm)</label>
                    <input type="text" name="height" value="175" required>
                </div>
                <div class="form-group">
                    <label>Weight (kg)</label>
                    <input type="text" name="weight" value="70" required>
                </div>
                <div class="form-group">
                    <label>Sex</label>
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="sex" value="male" checked> Male
                        </label>
                        <label>
                            <input type="radio" name="sex" value="female"> Female
                        </label>
                        <label>
                            <input type="radio" name="sex" value="other"> Other
                        </label>
                    </div>
                </div>
                <div class="btn-container">
                    <button type="button" class="btn btn-edit" onclick="editHealthInfo()">Edit</button>
                    <button type="button" class="btn btn-delete" onclick="deleteHealthInfo()">Delete</button>
                </div>
            </form>
        </div>

        <!-- Health Concerns Section -->
        <div class="profile-section">
            <h2 class="section-title">Health Concerns</h2>
            <form id="healthConcernsForm">
                <div class="form-group">
                    <label>Describe Your Health Issues/Concerns (if any)</label>
                    <textarea name="healthConcerns" rows="5" placeholder="Enter your health concerns here..."></textarea>
                </div>
                <div class="btn-container">
                    <button type="button" class="btn btn-edit" onclick="editHealthConcerns()">Edit</button>
                    <button type="button" class="btn btn-delete" onclick="deleteHealthConcerns()">Delete</button>
                </div>
            </form>
        </div>

        <!-- Logout Section -->
        <div class="logout-section">
    <a href="logout.php" class="btn-logout">
        <i class='bx bx-log-out'></i> Logout
    </a>
</div>
    </div>

    <script>
        function logout() {
            // Confirm logout
            if(confirm('Are you sure you want to log out?')) {
                // Clear session storage or cookies (implementation depends on your backend)
                // For example:
                // sessionStorage.clear();
                // document.cookie = "session=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                
                // Redirect to index.php
                window.location.href = 'index.php';
            }
        }

        // Existing functions remain the same
        function editPersonalInfo() {
            const form = document.getElementById('personalInfoForm');
            const inputs = form.querySelectorAll('input');
            inputs.forEach(input => input.disabled = false);
            alert('You can now edit your personal information');
        }

        function deletePersonalInfo() {
            if(confirm('Are you sure you want to delete your personal information?')) {
                // Implement delete logic here
                alert('Personal information deleted');
            }
        }

        function editHealthInfo() {
            const form = document.getElementById('healthInfoForm');
            const inputs = form.querySelectorAll('input');
            inputs.forEach(input => input.disabled = false);
            alert('You can now edit your health information');
        }

        function deleteHealthInfo() {
            if(confirm('Are you sure you want to delete your health information?')) {
                // Implement delete logic here
                alert('Health information deleted');
            }
        }

        function editHealthConcerns() {
            const textarea = document.querySelector('#healthConcernsForm textarea');
            textarea.disabled = false;
            alert('You can now edit your health concerns');
        }

        function deleteHealthConcerns() {
            if(confirm('Are you sure you want to delete your health concerns?')) {
                // Implement delete logic here
                const textarea = document.querySelector('#healthConcernsForm textarea');
                textarea.value = '';
                alert('Health concerns deleted');
            }
        }
    </script>
</body>
</html>