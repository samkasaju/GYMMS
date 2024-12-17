<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Sathi - Notifications</title>
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

        .sidebar-menu a:hover, .sidebar-menu a.active {
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

        .notifications-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 20px;
        }

        .notifications-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #f0f0f0;
            padding-bottom: 10px;
        }

        .notifications-header h2 {
            color: #ff6b00;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .notifications-header .badge {
            background-color: #ff6b00;
            color: white;
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 0.8em;
        }

        .notification-filters {
            display: flex;
            gap: 10px;
        }

        .notification-filters button {
            background-color: transparent;
            border: 1px solid #ff6b00;
            color: #ff6b00;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .notification-filters button.active {
            background-color: #ff6b00;
            color: white;
        }

        .notification-list {
            max-height: 500px;
            overflow-y: auto;
        }

        .notification-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.3s ease;
        }

        .notification-item:hover {
            background-color: #f9f9f9;
        }

        .notification-icon {
            margin-right: 15px;
            display: flex;
            align-items: center;
            font-size: 24px;
        }

        .notification-icon.workout {
            color: #ff6b00;
        }

        .notification-icon.diet {
            color: #4CAF50;
        }

        .notification-icon.membership {
            color: #2196F3;
        }

        .notification-content {
            flex-grow: 1;
        }

        .notification-content h3 {
            margin-bottom: 5px;
            color: #333;
        }

        .notification-content p {
            color: #666;
            font-size: 0.9em;
        }

        .notification-time {
            color: #999;
            font-size: 0.8em;
            margin-left: 10px;
        }

        .notification-actions {
            display: flex;
            gap: 10px;
        }

        .notification-actions button {
            background: none;
            border: none;
            cursor: pointer;
            color: #666;
            transition: color 0.3s ease;
        }

        .notification-actions button:hover {
            color: #ff6b00;
        }

        .empty-notifications {
            text-align: center;
            padding: 20px;
            color: #666;
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
            <li><a href="#"><i class='bx bx-cart'></i> Membership</a></li>
            <li><a href="notification.php" class="active"><i class='bx bx-bell'></i> Notifications</a></li>
            <li><a href="#"><i class='bx bxs-bowl-rice'></i> Diet Plans</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="notifications-container">
            <div class="notifications-header">
                <h2>
                    <i class='bx bx-bell'></i> 
                    Notifications 
                    <span id="unreadBadge" class="badge">0</span>
                </h2>
                <div class="notification-filters">
                    <button class="active" data-filter="all">All</button>
                    <button data-filter="unread">Unread</button>
                    <button data-filter="read">Read</button>
                </div>
            </div>

            <div id="notificationList" class="notification-list">
                <!-- Notifications will be dynamically added here -->
            </div>
        </div>
    </div>

    <script>
        class NotificationManager {
            constructor() {
                this.notifications = [];
                this.currentFilter = 'all';
                
                this.notificationList = document.getElementById('notificationList');
                this.unreadBadge = document.getElementById('unreadBadge');
                
                this.setupEventListeners();
                this.loadInitialNotifications();
            }

            setupEventListeners() {
                // Filter buttons
                document.querySelectorAll('.notification-filters button').forEach(button => {
                    button.addEventListener('click', () => {
                        document.querySelectorAll('.notification-filters button').forEach(btn => btn.classList.remove('active'));
                        button.classList.add('active');
                        this.currentFilter = button.dataset.filter;
                        this.renderNotifications();
                    });
                });
            }

            loadInitialNotifications() {
                // Simulated initial notifications
                const initialNotifications = [
                    {
                        id: 1,
                        title: 'Workout Reminder',
                        message: 'Your leg day workout is scheduled for tomorrow',
                        type: 'workout',
                        timestamp: this.formatTime(new Date(Date.now() - 3600000)), // 1 hour ago
                        read: false
                    },
                    {
                        id: 2,
                        title: 'Diet Plan Update',
                        message: 'New muscle gain diet plan available',
                        type: 'diet',
                        timestamp: this.formatTime(new Date(Date.now() - 86400000)), // 1 day ago
                        read: true
                    },
                    {
                        id: 3,
                        title: 'Membership Expiry',
                        message: 'Your current membership expires in 7 days',
                        type: 'membership',
                        timestamp: this.formatTime(new Date(Date.now() - 172800000)), // 2 days ago
                        read: false
                    }
                ];

                this.notifications = initialNotifications;
                this.renderNotifications();
            }

            formatTime(date) {
                return date.toLocaleString('en-US', {
                    hour: 'numeric',
                    minute: 'numeric',
                    hour12: true,
                    month: 'short',
                    day: 'numeric'
                });
            }

            renderNotifications() {
                const filteredNotifications = this.filterNotifications();
                
                // Update unread badge
                const unreadCount = this.notifications.filter(n => !n.read).length;
                this.unreadBadge.textContent = unreadCount;

                // Render notifications
                if (filteredNotifications.length === 0) {
                    this.notificationList.innerHTML = `
                        <div class="empty-notifications">
                            No notifications to display
                        </div>
                    `;
                    return;
                }

                this.notificationList.innerHTML = filteredNotifications.map(notification => `
                    <div class="notification-item ${!notification.read ? 'unread' : ''}">
                        <div class="notification-icon ${notification.type}">
                            ${this.getNotificationIcon(notification.type)}
                        </div>
                        <div class="notification-content">
                            <h3>${notification.title}</h3>
                            <p>${notification.message}</p>
                        </div>
                        <span class="notification-time">${notification.timestamp}</span>
                        ${!notification.read ? `
                        <div class="notification-actions">
                            <button onclick="notificationManager.markAsRead(${notification.id})">
                                <i class='bx bx-check'></i>
                            </button>
                            <button onclick="notificationManager.dismissNotification(${notification.id})">
                                <i class='bx bx-x'></i>
                            </button>
                        </div>
                        ` : ''}
                    </div>
                `).join('');
            }

            getNotificationIcon(type) {
                const icons = {
                    'workout': '<i class="bx bx-dumbbell"></i>',
                    'diet': '<i class="bx bxs-bowl-rice"></i>',
                    'membership': '<i class="bx bx-cart"></i>'
                };
                return icons[type] || '<i class="bx bx-bell"></i>';
            }

            filterNotifications() {
                return this.notifications.filter(notification => {
                    if (this.currentFilter === 'all') return true;
                    if (this.currentFilter === 'unread') return !notification.read;
                    if (this.currentFilter === 'read') return notification.read;
                });
            }

            markAsRead(id) {
                const notification = this.notifications.find(n => n.id === id);
                if (notification) {
                    notification.read = true;
                    this.renderNotifications();
                }
            }

            dismissNotification(id) {
                this.notifications = this.notifications.filter(n => n.id !== id);
                this.renderNotifications();
            }
        }

        // Initialize the notification manager
        const notificationManager = new NotificationManager();
    </script>
</body>
</html>