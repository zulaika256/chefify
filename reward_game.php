<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Chefify - Chocolate Memory Game</title>
<link rel="stylesheet" href="reward_game.css">

</head>
<body>

<!-- NAV -->
<nav>
  <div class="nav-container">
    <a href="homepage.php" class="logo">
      <img src="img/chefify.jpg" class="logo-img" alt="Chefify">
      <span class="logo-text">Chefify</span>
    </a>
    <div class="nav-links">
      <a href="homepage.php">Home</a>
      <a href="menu.php">Menu</a>
      <a href="cart.php">Cart</a>
      <a href="dashboard.php" class="active">Dashboard</a>
      <a href="locations.php">Locations</a>
      <a href="aboutus.php">About</a>
      <a href="contactus.php">Contact Us</a>
      <a href="feedback.php">Feedback</a>
      <a href="profile.php">Profile</a>
      <a href="login.php">Logout</a>
    </div>
  </div>
</nav>

<!-- BACK TO DASHBOARD -->
<div class="back-container">
  <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>
</div>

<!-- PROMO SECTION -->
<section class="promo-section">
  <h3>Play the Memory Game 🍫</h3>
  <p>Match all the treats in 50 seconds and claim your exclusive Chefify discount!</p>
</section>

<!-- MEMORY GAME -->
<section class="game-section" aria-labelledby="game-title">
  <h2 id="game-title">Chocolate Memory Game 🎮</h2>
  <p>You have 50 seconds to match all pairs. Good luck!</p>

  <div class="game-container" role="region" aria-label="Memory game">
    <div class="game-stats">
      <div class="stat">Moves: <span id="moves">0</span></div>
      <div class="stat">Pairs: <span id="pairs">0</span>/6</div>
      <div class="stat" id="timerStat">Time: <span id="timer">00:50</span></div>
    </div>

    <div class="game-board" id="gameBoard"></div>
  </div>

  <!-- WIN MESSAGE -->
  <div class="win-message" id="winMessage">
    <h2>🎉 Congratulations! 🎉</h2>
    <p><strong>Total moves:</strong> <span id="finalMoves">0</span></p>
    <p><strong>Time taken:</strong> <span id="finalTime">00:00</span></p>
    
    <div class="discount-section">
      <div class="discount-code-display">
        <label>Your Discount Code:</label>
        <div class="code-box" id="discountCode">LOADING...</div>
        <button class="copy-btn" onclick="copyDiscountCode()">📋 Copy Code</button>
      </div>
      
      <div class="discount-details">
        <p class="discount-value" id="discountValue">Get 10% OFF</p>
        <p class="expiry-notice">Valid until: <span id="expiryDate"></span></p>
        <p class="instructions">Screenshot this or copy the code above. Show it at Chefify to claim your discount!</p>
      </div>
    </div>

    <div class="btn-container">
      <button id="playAgainBtn" onclick="resetGame()">Play Again</button>
    </div>
  </div>

  <!-- LOSE MESSAGE -->
  <div class="lose-message" id="loseMessage">
    <h2>⏰ Time's Up! ⏰</h2>
    <p>You ran out of time, but don't give up!</p>
    <p>Try again and beat the clock to win your discount! 💪</p>
    
    <div class="btn-container">
      <button id="tryAgainBtn" onclick="resetGame()">Try Again</button>
    </div>
  </div>
</section>


<!-- FOOTER -->
<footer>
  <div class="footer-container">
    
    <!-- Footer Top -->
    <div class="footer-top">
      
      <!-- Logo & Social Section -->
      <div class="footer-logo-section">
        <div class="footer-logo">
          <img src="img/chefify.jpg" alt="Chefify Logo" onerror="this.src='https://via.placeholder.com/70/4b2e19/FFFFFF?text=C'">
          <span class="footer-logo-text">Chefify</span>
        </div>
        
        <p class="footer-tagline">
          Delicious moments, rewarding experiences. Order now and earn points with every meal!
        </p>
        
        <div class="footer-social">
          <a href="https://www.tiktok.com/@chefifyapp?_r=1&_t=ZS-92RNDS9aRWs" target="_blank" rel="noopener" class="social-icon" title="Follow us on TikTok">
            <img src="img/tiktok.png" alt="TikTok">
          </a>
          <a href="https://www.instagram.com/chefifyapp?igsh=Z3RhMW43dndoN281&utm_source=qr" target="_blank" rel="noopener" class="social-icon" title="Follow us on Instagram">
            <img src="img/instagram.webp" alt="Instagram">
          </a>
        </div>
      </div>
      
      <!-- Contact Info -->
      <div class="footer-section">
        <h3>Get in Touch</h3>
        
        <div class="contact-item">
          <span class="contact-icon">📍</span>
          <div class="contact-text">
            Kuala Lumpur, Malaysia
          </div>
        </div>
        
        <div class="contact-item">
          <span class="contact-icon">📧</span>
          <div class="contact-text">
            <a href="mailto:hello@chefify.com">hello@chefify.com</a>
          </div>
        </div>
        
        <div class="contact-item">
          <span class="contact-icon">📱</span>
          <div class="contact-text">
            <a href="tel:+60123456789">+60 12-345 6789</a>
          </div>
        </div>
      </div>
      
    </div>
    
    <!-- Footer Bottom -->
    <div class="footer-bottom">
      <div>
        © 2025 Chefify. All rights reserved.
      </div>
      <ul class="footer-links-inline">
        <li><a href="privacy.php">Privacy Policy</a></li>
        <li><a href="terms.php">Terms of Service</a></li>
        <li><a href="cookies.php">Cookie Policy</a></li>
      </ul>
    </div>
    
  </div>
</footer>

<script>
(function(){
  const emojis = ['🍫','🍪','🎂','🧁','🍮','🍩'];
  const gameEmojis = [...emojis, ...emojis];
  const board = document.getElementById('gameBoard');
  const TIME_LIMIT = 50; // 50 seconds
  let shuffled = [];
  let flippedCards = [];
  let matched = 0;
  let moves = 0;
  let canFlip = true;
  let gameStartTime = null;
  let timerInterval = null;
  let timeRemaining = TIME_LIMIT;

  function shuffle(a){
    for(let i=a.length-1;i>0;i--){
      const j=Math.floor(Math.random()*(i+1));
      [a[i],a[j]]=[a[j],a[i]];
    }
    return a;
  }

  function createCard(emoji){
    const el = document.createElement('div');
    el.className = 'card';
    el.innerHTML = `<div class="card-inner"><div class="card-front">🎁</div><div class="card-back">${emoji}</div></div>`;
    el.dataset.emoji = emoji;
    el.addEventListener('click', ()=> flipCard(el));
    return el;
  }

  function renderBoard(){
    board.innerHTML = '';
    shuffled = shuffle([...gameEmojis]);
    shuffled.forEach(em => board.appendChild(createCard(em)));
    matched = 0; 
    moves = 0;
    timeRemaining = TIME_LIMIT;
    document.getElementById('moves').textContent = '0';
    document.getElementById('pairs').textContent = '0';
    document.getElementById('timer').textContent = '00:50';
    document.getElementById('winMessage').style.display = 'none';
    document.getElementById('loseMessage').style.display = 'none';
    document.getElementById('timerStat').classList.remove('timer-warning');
    gameStartTime = null;
    if(timerInterval) clearInterval(timerInterval);
  }

  function startTimer(){
    if(!gameStartTime){
      gameStartTime = Date.now();
      timerInterval = setInterval(updateTimer, 1000);
    }
  }

  function updateTimer(){
    const elapsed = Math.floor((Date.now() - gameStartTime) / 1000);
    timeRemaining = TIME_LIMIT - elapsed;
    
    if(timeRemaining <= 0){
      timeRemaining = 0;
      gameLost();
      return;
    }
    
    // Warning visual when under 10 seconds
    if(timeRemaining <= 10){
      document.getElementById('timerStat').classList.add('timer-warning');
    }
    
    const minutes = Math.floor(timeRemaining / 60).toString().padStart(2, '0');
    const seconds = (timeRemaining % 60).toString().padStart(2, '0');
    document.getElementById('timer').textContent = `${minutes}:${seconds}`;
  }

  function flipCard(card){
    if(!canFlip || card.classList.contains('flipped') || card.classList.contains('matched')) return;
    
    startTimer();
    card.classList.add('flipped');
    flippedCards.push(card);
    
    if(flippedCards.length === 2){
      moves++;
      document.getElementById('moves').textContent = moves;
      canFlip = false;
      checkMatch();
    }
  }

  function checkMatch(){
    const [a,b] = flippedCards;
    if(a.dataset.emoji === b.dataset.emoji){
      // Match found - keep cards visible
      a.classList.add('matched'); 
      b.classList.add('matched');
      matched++;
      document.getElementById('pairs').textContent = matched;
      
      if(matched === 6) {
        setTimeout(showWin, 500);
      }
      flippedCards = []; 
      canFlip = true;
    } else {
      // No match - flip back
      setTimeout(()=>{
        a.classList.remove('flipped');
        b.classList.remove('flipped');
        flippedCards = [];
        canFlip = true;
      }, 800);
    }
  }

  function generateDiscountCode(){
    const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
    let code = 'CHEF';
    for(let i=0; i<6; i++){
      code += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return code;
  }

  function showWin(){
    if(timerInterval) clearInterval(timerInterval);
    
    const elapsed = TIME_LIMIT - timeRemaining;
    const minutes = Math.floor(elapsed / 60).toString().padStart(2, '0');
    const seconds = (elapsed % 60).toString().padStart(2, '0');
    
    document.getElementById('finalMoves').textContent = moves;
    document.getElementById('finalTime').textContent = `${minutes}:${seconds}`;
    
    // Call Backend
    const timeStr = `${minutes}:${seconds}`;
    fetch('process_game_win.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ moves: moves, time_taken: timeStr })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            alert("You earned " + data.points + " points!");
        }
    });

    // Generate unique discount code
    const discountCode = generateDiscountCode();
    document.getElementById('discountCode').textContent = discountCode;
    
    // Calculate discount based on performance
    let discountPercent = 10;
    if(moves <= 12) discountPercent = 20;
    else if(moves <= 15) discountPercent = 15;
    
    document.getElementById('discountValue').textContent = `Get ${discountPercent}% OFF`;
    
    // Set expiry date (7 days from now)
    const expiryDate = new Date();
    expiryDate.setDate(expiryDate.getDate() + 7);
    document.getElementById('expiryDate').textContent = expiryDate.toLocaleDateString();
    
    document.getElementById('winMessage').style.display = 'block';
  }

  function gameLost(){
    if(timerInterval) clearInterval(timerInterval);
    canFlip = false;
    document.getElementById('loseMessage').style.display = 'block';
  }

  window.resetGame = function(){
    renderBoard();
    canFlip = true;
  }

  window.copyDiscountCode = function(){
    const code = document.getElementById('discountCode').textContent;
    navigator.clipboard.writeText(code).then(()=>{
      const btn = document.querySelector('.copy-btn');
      const originalText = btn.textContent;
      btn.textContent = '✓ Copied!';
      btn.style.background = '#2E7D32';
      setTimeout(()=>{
        btn.textContent = originalText;
        btn.style.background = '#4b2e19';
      }, 2000);
    }).catch(err => {
      alert('Copy this code: ' + code);
    });
  }

  // Initialize game
  renderBoard();
})();
</script>

</body>
</html>





