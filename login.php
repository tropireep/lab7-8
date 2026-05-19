<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вхід - GreenTrend</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background-color: #10180D; color: white; display: flex; justify-content: center; align-items: center; height: 100vh;">
    
    <div style="background-color: #1A2216; padding: 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); width: 100%; max-width: 400px; text-align: center;">
        <h2 style="margin-bottom: 30px; font-size: 28px;">Вхід для адміністратора</h2> 
        
        <form class="signin-form" style="display: flex; flex-direction: column; gap: 20px;">
            <input type="text" placeholder="Логін" required style="background: transparent; border: none; border-bottom: 1px solid #888; color: white; padding: 10px 0; font-size: 16px; outline: none;">
            
            <input type="password" placeholder="Пароль" required style="background: transparent; border: none; border-bottom: 1px solid #888; color: white; padding: 10px 0; font-size: 16px; outline: none;">
            
            <button type="submit" class="loginBtn" style="background-color: #28a745; color: white; border: none; padding: 15px; font-size: 16px; font-weight: bold; border-radius: 8px; cursor: pointer; margin-top: 10px;">Увійти</button>
        </form>
        
        <div style="margin-top: 20px;">
            <a href="index.php" style="color: #888; text-decoration: none; font-size: 14px;">← На головну</a>
        </div>
    </div>

    <script src="assets/js/login.js"></script> 
</body>
</html>