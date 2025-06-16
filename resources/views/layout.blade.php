<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog Test Lararvel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            color: #333;
        }
        nav {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        nav a {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 500;
            font-size: 1.1rem;
        }
        nav a:hover {
            text-decoration: underline;
        }
        nav span {
            color: #6c757d;
        }
        nav strong {
            color: #212529;
        }
        nav form {
            margin-left: auto;
        }
        nav button {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 0.375rem 0.75rem;
            border-radius: 0.25rem;
            cursor: pointer;
            font-size: 0.875rem;
        }
        nav button:hover {
            background-color: #0b5ed7;
        }
        .container {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        /* Notification Styles */
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 25px;
        border-radius: 8px;
        color: white;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 1000;
        display: flex;
        align-items: center;
        transform: translateX(150%);
        animation: slideIn 0.5s forwards, fadeOut 0.5s 3.5s forwards;
    }

    .notification.success {
        background: linear-gradient(135deg, #4ade80, #22c55e);
        border-left: 5px solid #16a34a;
    }

    .notification.error {
        background: linear-gradient(135deg, #f87171, #ef4444);
        border-left: 5px solid #dc2626;
    }

    .notification i {
        margin-right: 10px;
        font-size: 1.2rem;
    }

    @keyframes slideIn {
        to { transform: translateX(0); }
    }

    @keyframes fadeOut {
        to { opacity: 0; }
    }

    /* For the close button */
    .notification-close {
        margin-left: 15px;
        cursor: pointer;
        opacity: 0.8;
        transition: opacity 0.2s;
    }

    .notification-close:hover {
        opacity: 1;
    }
    </style>
</head>
<body>
    <nav>
        <a href="/">Home</a>

        @auth
            <span>Logged in as <strong>{{ auth()->user()->name }}</strong></span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endauth

        @guest
            <span>Not logged in</span>
        @endguest
    </nav>

    <div class="container">
        @yield('content')
    </div>
    <i class="fas fa-check-circle"></i>
    <i class="fas fa-exclamation-circle"></i>

    @if(session('success'))
<div class="notification success">
    <i>✓</i>
    <span>{{ session('success') }}</span>
    <span class="notification-close" onclick="this.parentElement.remove()">×</span>
</div>
@endif

@if($errors->any())
<div class="notification error">
    <i>!</i>
    <span>
        @foreach($errors->all() as $error)
            {{ $error }}@if(!$loop->last)<br>@endif
        @endforeach
    </span>
    <span class="notification-close" onclick="this.parentElement.remove()">×</span>
</div>
@endif

<script>
    // Auto-hide notifications after delay
    document.addEventListener('DOMContentLoaded', () => {
        const notifications = document.querySelectorAll('.notification');
        notifications.forEach(notification => {
            setTimeout(() => {
                notification.style.animation = 'fadeOut 0.5s forwards';
                setTimeout(() => notification.remove(), 500);
            }, 3500);
        });
    });

    // Optional: Add this if you want notifications to persist when hovered
    document.querySelectorAll('.notification').forEach(notification => {
        notification.addEventListener('mouseenter', () => {
            notification.style.animationPlayState = 'paused';
        });
        notification.addEventListener('mouseleave', () => {
            notification.style.animationPlayState = 'running';
        });
    });
</script>
</body>
</html>