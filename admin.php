<?php
session_start();

require './auth.php';

if (!isAuthorized()) {
    echo '<div style="background-color: #10180D; height: 100vh; display: flex; justify-content: center; align-items: center;">';
    echo '<p style="color: white; font-family: sans-serif; font-size: 24px;">Sorry, this page is only for authorized administrators.</p>';
    echo '</div>';
    exit;
}

require './subscriptions-lib.php';
$subscriptions = allSubscriptions();
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Адмін-панель GreenTrend</title>
    <link rel="stylesheet" href="assets/css/style.css">
    
    <style>
        body { background-color: #10180D; color: white; padding: 40px 20px; font-family: sans-serif; }
        .admin-container { max-width: 1200px; margin: 0 auto; background-color: #1A2216; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        h2 { text-align: center; margin-bottom: 30px; color: #fff; font-size: 32px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #2B384C; padding: 15px; text-align: left; font-size: 16px; }
        th { background-color: #28a745; color: white; font-weight: bold; }
        tr:hover { background-color: #2B384C; }
    </style>
</head>
<body>
    <div class="admin-container">
        <h2>Список клієнтів та замовлень</h2>
        
        <table>
            <thead>
                <tr>
                    <th>№</th>
                    <th>Ім'я</th>
                    <th>Email</th>
                    <th>Бюджет</th>
                    <th>Повідомлення</th>
                    <th>Дата</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($subscriptions as $index => $sub): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo htmlspecialchars($sub['name'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($sub['email'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($sub['budget'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($sub['message'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($sub['timestamp'] ?? ''); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div style="text-align: center; margin-top: 30px;">
            <div style="text-align: center; margin-top: 30px; display: flex; justify-content: center; gap: 20px;">
            <a href="index.php" style="color: #888; text-decoration: none; padding: 10px;">← На головну</a>
            <a href="logout.php" style="background-color: #dc3545; color: white; text-decoration: none; padding: 10px 20px; border-radius: 8px; font-weight: bold;">Вийти з адмінки</a>
        </div>
    </div>
</body>
</html>