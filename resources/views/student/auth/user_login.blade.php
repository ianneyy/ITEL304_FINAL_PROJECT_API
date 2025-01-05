<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LSPU - BAO Login</title>
    <link rel="stylesheet" href="{{ asset('css/user_login.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="photo-box">
                <div class="photo-placeholder">
                    <img src="{{ asset('img/bao.jpg') }}" alt="Business Center of LSPU" />
                </div>
            </div>
            <p class="welcome-message">SIGN-IN TO YOUR LSPU ACCOUNT</p>
        </div>

        <div class="login-section">
            <div class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="LSPU Logo" />
            </div>
            <h2 style="color: #FFBD2E;">LSPU - BAO</h2>
            <form method="POST" action="{{ route('student.user-login') }}">
                @csrf
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required />
                    @error('email')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="password" style="margin-top: 15px;">Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" placeholder="Enter your password" required />
                        <span id="toggle-password" class="toggle-password">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    @error('password')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="login-button" style="margin-top: 15px; background-color: #FFBD2E;">Login</button>
            </form>
            <a href="#" class="forgot-password">Forgot Password?</a>
        </div>
    </div>

    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash'); // Eye closed icon
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye'); // Eye open icon
            }
        });
    </script>

    <style>
        .error-message {
            color: red;
            font-size: 0.9rem;
            margin-top: 0.3rem;
        }
    </style>
</body>

</html>