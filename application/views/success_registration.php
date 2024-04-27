<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .signup-success {
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        h2 {
            color: #333;
        }

        p {
            color: #666;
            font-size: 16px;
        }

        .login-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #5c67f2;
            border-radius: 4px;
            text-decoration: none;
        }

        .login-button:hover {
            background-color: #4a50e0;
            color: black;
        }
    </style>
</head>
<body>
    <div class="signup-success">
        <h2>Thank You for Signing Up!</h2>
        <p>Your account has been created successfully.</p>
        <a href="<?= base_url() ?>index.php/authentication/signin" class="login-button">Click Here to Login</a>
    </div>
</body>
</html>
