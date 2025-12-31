<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chefify - Rewards Hub</title>
    <link rel="stylesheet" href="rewards_overview.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="rewards-container">
    <header class="rewards-header">
        <div class="user-meta">
            <h1>Welcome back, Chef!</h1>
            <p>Ready to turn your points into tasty rewards?</p>
        </div>
        <div class="points-display">
            <i class="fas fa-coins"></i>
            <div class="points-text">
                <span class="count">2,450</span>
                <span class="label">Total Points</span>
            </div>
        </div>
    </header>

    <section class="rewards-grid">
        
        <div class="reward-card" onclick="location.href='points_per_order.php'">
            <div class="card-icon" style="background: #fdf2f2; color: #e57373;">
                <i class="fas fa-receipt"></i>
            </div>
            <div class="card-body">
                <h3>Points Per Order</h3>
                <p>Check how many points you've earned from your recent meals.</p>
                <span class="btn-link">View History <i class="fas fa-arrow-right"></i></span>
            </div>
        </div>

        <div class="reward-card highlight" onclick="location.href='minigame.php'">
            <div class="card-icon" style="background: #fff9db; color: #fab005;">
                <i class="fas fa-gamepad"></i>
            </div>
            <div class="card-body">
                <h3>Discount Mini-Game</h3>
                <p>Play our chef challenge and win up to 50% off coupons!</p>
                <span class="btn-link">Play Now <i class="fas fa-arrow-right"></i></span>
            </div>
        </div>

        <div class="reward-card" onclick="location.href='random_spin.php'">
            <div class="card-icon" style="background: #e7f5ff; color: #228be6;">
                <i class="fas fa-dharmachakra"></i>
            </div>
            <div class="card-body">
                <h3>Daily Lucky Spin</h3>
                <p>Spin the wheel once a day for free points or secret desserts.</p>
                <span class="btn-link">Spin Wheel <i class="fas fa-arrow-right"></i></span>
            </div>
        </div>

        <div class="reward-card" onclick="location.href='profile.php'">
            <div class="card-icon" style="background: #f3f0ff; color: #7950f2;">
                <i class="fas fa-user-tag"></i>
            </div>
            <div class="card-body">
                <h3>Unlock Avatars</h3>
                <p>Use your points to unlock exclusive Chef avatars and badges.</p>
                <span class="btn-link">Change Avatar <i class="fas fa-arrow-right"></i></span>
            </div>
        </div>

    </section>
</div>

</body>
</html>