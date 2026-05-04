<div id="notification-container" class="fixed top-4 right-4 space-y-3 z-50">
</div>

<script>
    // Display Laravel notifications
    document.addEventListener('DOMContentLoaded', function() {
        const notifications = @json(auth()->check() ? auth()->user()->notifications()->latest()->take(5)->get() : []);
        
        notifications.forEach((notification, index) => {
            setTimeout(() => {
                displayNotification(notification.data.message, notification.data.type);
            }, index * 300);
        });
        
        // Auto-refresh notifications every 5 seconds
        setInterval(function() {
            fetch('/api/notifications')
                .then(response => response.json())
                .then(data => {
                    data.forEach(notification => {
                        if (!document.querySelector(`[data-notification-id="${notification.id}"]`)) {
                            displayNotification(notification.data.message, notification.data.type, notification.id);
                        }
                    });
                })
                .catch(error => console.log('Notification fetch error:', error));
        }, 5000);
    });

    function displayNotification(message, type = 'info', id = '') {
        const container = document.getElementById('notification-container');
        
        const notifElement = document.createElement('div');
        notifElement.setAttribute('data-notification-id', id);
        notifElement.className = `notification p-4 rounded-lg text-white shadow-lg animate-slide-in-right`;
        
        // Set background color based on type
        const bgColors = {
            'success': 'bg-green-500',
            'error': 'bg-red-500',
            'warning': 'bg-yellow-500',
            'info': 'bg-blue-500'
        };
        
        notifElement.className += ` ${bgColors[type] || bgColors['info']}`;
        
        notifElement.innerHTML = `
            <div class="flex items-center justify-between">
                <span class="font-medium">${message}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-xl cursor-pointer hover:opacity-70">&times;</button>
            </div>
        `;
        
        container.appendChild(notifElement);
        
        // Auto-remove after 6 seconds
        setTimeout(() => {
            notifElement.classList.add('animate-fade-out');
            setTimeout(() => notifElement.remove(), 500);
        }, 6000);
    }
</script>

<style>
    @keyframes slideInRight {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(400px);
        }
    }

    .animate-slide-in-right {
        animation: slideInRight 0.3s ease-out;
    }

    .animate-fade-out {
        animation: fadeOut 0.3s ease-out;
    }
</style>
