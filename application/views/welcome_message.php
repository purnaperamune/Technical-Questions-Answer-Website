<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="2;url=<?php echo site_url('home/signup'); ?>" />
    <title>Welcome to KnowledgeNest</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #000;
            color: white;
            text-align: center;
        }

        .welcome-container {
            padding: 40px;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.1); 
            border: 1px solid #fff; 
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        h1 {
            font-size: 2.8rem;
            margin-bottom: 15px;
        }

        p {
            font-size: 1.4rem;
            margin-top: 10px;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        .emphasis {
            color: #FFF; 
            font-weight: bold; 
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1>Welcome to <span class="emphasis"><b>KnowledgeNest</b></span></h1>
        <p>Your journey to knowledge begins here...</p>
    </div>
</body>
</html>
