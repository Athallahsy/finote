<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Finote</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
}
      body {
    background-color: #0a0a0a;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
} 
        .card {
    background-color: #161616;
    border-radius: 12px;
    padding: 40px;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.6);
    border: 1px solid #232323;
}

        .title {
            text-align: center;
            color: #ffffff;
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .subtitle {
            text-align: center;
            color: white;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 32px;
        }

        .error-box {
            background-color: #2a1a1a;
            border: 1px solid #ef4444;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 20px;
        }

        .error-box p {
            color: #ef4444;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .error-box p:last-child {
            margin-bottom: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: #ffffff;
            font-size: 13px;
            margin-bottom: 8px;
        }

        label span {
            color: #ef4444;
        }

        input {
            width: 100%;
            background-color: #111111;
            border: 1px solid #2d2d2d;
            border-radius: 8px;
            padding: 12px 16px;
            color: #ffffff;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }

        input:focus {
            border-color: #f59e0b;
        }

        button {
            width: 100%;
            background-color: #f59e0b;
            color: #000000;
            border: none;
            border-radius: 8px;
            padding: 14px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 8px;
            transition: background-color 0.2s;
        }

        button:hover {
            background-color: #d97706;
        }

        .login-link {
            text-align: center;
            margin-top: 24px;
            color: #6b7280;
            font-size: 13px;
        }

        .login-link a {
            color: #f59e0b;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="card">
        <p class="title">Finote</p>
        <p class="subtitle">Create account</p>

        
        <?php if($errors->any()): ?>
            <div class="error-box">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p><?php echo e($error); ?></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/register">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label>Full name <span>*</span></label>
                <input
                    type="text"
                    name="name"
                    value="<?php echo e(old('name')); ?>"
                    placeholder="John Doe"
                >
            </div>

            <div class="form-group">
                <label>Email address <span>*</span></label>
                <input
                    type="email"
                    name="email"
                    value="<?php echo e(old('email')); ?>"
                    placeholder="john@example.com"
                >
            </div>

            <div class="form-group">
                <label>Password <span>*</span></label>
                <input
                    type="password"
                    name="password"
                    placeholder="Min. 6 characters"
                >
            </div>

            <div class="form-group">
                <label>Confirm password <span>*</span></label>
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Repeat your password"
                >
            </div>

            <button type="submit">Create account</button>
        </form>

        <div class="login-link">
            Already have an account?
            <a href="/admin/login">Sign in</a>
        </div>
    </div>

</body>
</html>
<?php /**PATH C:\Users\user\Downloads\finote-patched\finote-main\resources\views/auth/register.blade.php ENDPATH**/ ?>