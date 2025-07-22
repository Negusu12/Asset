<?php
session_start();

include("connect.php");
include("backend/functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric(($user_name))) {
        $query = "select * from users where BINARY user_name = '$user_name' limit 1";
        $result = mysqli_query($con, $query);
        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if (password_verify($password, $user_data['password'])) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die;
                }
            }
        }
        echo "<script>
        window.onload = function() {
            // Display a success message using SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Username or Password is incorrect please enter valid information!',
                showConfirmButton: false,
                showDenyButton: true,
                denyButtonText: 'OK'
            });
        }
     </script>";
    } else {
        echo "<script>
        window.onload = function() {
            // Display a success message using SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Please enter valid information!',
                showConfirmButton: false,
                showDenyButton: true,
                denyButtonText: 'OK'
            });
        }
     </script>";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/icon" href="assets/dist/img/logo.png" />
    <title>ABH IT Inventory MS | Login</title>
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/fontawesome_6.7.2/css/all.min.css">

    <link rel="stylesheet" href="assets/dist/css/login.css">
    <link rel="stylesheet" href="assets/dist/css/sweetalert2.min.css">
</head>

<body>
    <canvas class="inventory-particles" id="inventoryParticles"></canvas>

    <div class="inventory-container">
        <div class="inventory-hero">
            <div class="hero-content">
                <img src="assets/dist/img/ABH LOGO white.png" alt="EMU Logo" class="logo" style="height: 200px; margin-bottom: 30px;">
                <h1 class="inventory-title">ABH Inventory System</h1>
                <p class="inventory-subtitle">Comprehensive inventory management solution with advanced features for GRN, asset tracking, and stock control.</p>

                <div class="system-features">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <h4 class="feature-title">GRN Management</h4>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <h4 class="feature-title">Item Returns</h4>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-hand-holding"></i>
                        </div>
                        <h4 class="feature-title">Asset Loans</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-container">
            <div class="form-header">
                <h2 class="form-title">Welcome Back!</h2>
                <p class="form-subtitle">Sign in to access your inventory dashboard</p>
            </div>

            <form method="post" class="inventory-form">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="user_name" class="form-control rounded-left form-input" placeholder="Username" onkeyup="lettersOnly(this)" required>
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <div class="password-container">
                        <input
                            type="password"
                            name="password"
                            class="form-control rounded-left form-input"
                            placeholder="Password"
                            required
                            id="password-field">
                        <button
                            type="button"
                            class="toggle-password"
                            onclick="togglePassword()">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" checked>
                        Remember me
                    </label>
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>

            <div class="social-login">
                <div class="divider">
                    Our Social Medias
                </div>

                <div class="social-buttons">
                    <a href="#" class="social-btn facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-btn twitter">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                    <a href="#" class="social-btn google">
                        <i class="fa-brands fa-linkedin"></i>
                    </a>
                </div>
            </div>

            <p class="register-link">
                Need an account? <a href="#">Contact administrator</a>
            </p>
        </div>
    </div>

    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/popper/popper.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/dist/js/sweetalert2.min.js"></script>

    <script>
        // Password toggle functionality
        function togglePassword() {
            const passwordField = document.getElementById('password-field');
            const toggleBtn = document.querySelector('.toggle-password i');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleBtn.classList.remove('fa-eye');
                toggleBtn.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleBtn.classList.remove('fa-eye-slash');
                toggleBtn.classList.add('fa-eye');
            }
        }

        // Particle animation
        document.addEventListener('DOMContentLoaded', function() {
            const canvas = document.getElementById('inventoryParticles');
            const ctx = canvas.getContext('2d');

            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;

            const particles = [];
            const particleCount = window.innerWidth < 768 ? 30 : 80;

            // Create inventory-themed particles (could represent items)
            for (let i = 0; i < particleCount; i++) {
                const types = ['box', 'circle', 'triangle']; // Different inventory item shapes
                particles.push({
                    x: Math.random() * canvas.width,
                    y: Math.random() * canvas.height,
                    size: Math.random() * 4 + 2,
                    speedX: Math.random() * 1 - 0.5,
                    speedY: Math.random() * 1 - 0.5,
                    color: i % 3 === 0 ? 'rgba(178, 180, 53, 0.7)' : i % 2 === 0 ? 'rgba(3, 148, 155, 0.7)' : 'rgba(77, 125, 191, 0.7)',
                    type: types[Math.floor(Math.random() * types.length)]
                });
            }

            function animateParticles() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                for (let i = 0; i < particles.length; i++) {
                    const p = particles[i];
                    ctx.fillStyle = p.color;

                    if (p.type === 'box') {
                        // Draw box (representing inventory items)
                        ctx.fillRect(p.x - p.size / 2, p.y - p.size / 2, p.size, p.size);
                    } else if (p.type === 'circle') {
                        // Draw circle
                        ctx.beginPath();
                        ctx.arc(p.x, p.y, p.size / 2, 0, Math.PI * 2);
                        ctx.fill();
                    } else {
                        // Draw triangle (representing different item types)
                        ctx.beginPath();
                        ctx.moveTo(p.x, p.y - p.size / 2);
                        ctx.lineTo(p.x + p.size / 2, p.y + p.size / 2);
                        ctx.lineTo(p.x - p.size / 2, p.y + p.size / 2);
                        ctx.closePath();
                        ctx.fill();
                    }

                    p.x += p.speedX;
                    p.y += p.speedY;

                    // Bounce off edges
                    if (p.x < 0 || p.x > canvas.width) p.speedX *= -1;
                    if (p.y < 0 || p.y > canvas.height) p.speedY *= -1;
                }

                requestAnimationFrame(animateParticles);
            }

            animateParticles();

            window.addEventListener('resize', function() {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
            });

            // Input focus effects
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.querySelector('i').style.color = '#03949B';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.querySelector('i').style.color = '#414142';
                    this.parentElement.querySelector('i').style.opacity = '0.7';
                });
            });
        });

        function lettersOnly(input) {
            // Your existing validation function
        }
    </script>
</body>

</html>