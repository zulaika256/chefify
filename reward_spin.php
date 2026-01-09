<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chefify's Free Spin</title>
    <link rel="icon" href="img/chefify.jpg" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --chef-brown: #4b2e19;
            --peach-1: #ffd6c8;
            --peach-2: #ffb7a1;
            --btn-peach: #ff9e85;
            --btn-peach-hover: #ff6f8a;
            --white: #ffffff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('img/wallpaper4.jpg') no-repeat center/cover fixed;
            color: var(--chef-brown);
            min-height: 100vh;
        }

        body::before {
            content: ""; position: fixed; inset: 0;
            background: rgba(255, 170, 150, 0.45); z-index: -1;
        }

        /* HEADER KONSISTEN */
        .header {
            max-width: 1200px;
            margin: 2rem auto 1rem;
            padding: 1rem 1.5rem;
            background: #F4F4F4;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(75, 46, 25, 0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h2 { font-size: 1.6rem; display: flex; align-items: center; gap: 10px; }
        
        .back-link {
            text-decoration: none;
            color: var(--chef-brown);
            font-weight: 700;
            background: var(--peach-1);
            padding: 8px 18px;
            border-radius: 20px;
            transition: 0.3s;
            font-size: 0.9rem;
        }

        .back-link:hover {
            background: var(--peach-2);
            color: white;
            transform: translateX(-5px);
        }

        /* MAIN CONTAINER */
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .wheel-wrapper {
            position: relative;
            margin-top: 20px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        }

        /* Pointer / Anak Panah */
        .pointer {
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 0; 
            height: 0; 
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-top: 35px solid var(--chef-brown);
            z-index: 10;
            filter: drop-shadow(0 4px 5px rgba(0,0,0,0.2));
        }

        canvas {
            display: block;
            border-radius: 50%;
            border: 8px solid white;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        /* SPIN BUTTON */
        #spinBtn {
            margin-top: 30px;
            padding: 15px 50px;
            font-size: 1.2rem;
            font-weight: 800;
            color: white;
            background: linear-gradient(45deg, var(--btn-peach), var(--btn-peach-hover));
            border: none;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(255, 111, 138, 0.4);
            transition: 0.3s;
        }

        #spinBtn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 15px 25px rgba(255, 111, 138, 0.6);
        }

        #spinBtn:active { transform: translateY(0); }

        #spinBtn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* POPUP MODAL */
        .popup {
            position: fixed; inset: 0;
            background: rgba(75, 46, 25, 0.7);
            display: none; align-items: center; justify-content: center;
            z-index: 1000; backdrop-filter: blur(8px);
        }

        .popup-content {
            background: white;
            padding: 40px;
            border-radius: 30px;
            text-align: center;
            max-width: 400px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: popIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes popIn {
            from { transform: scale(0.5); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .popup-content h2 { color: var(--btn-peach-hover); margin-bottom: 10px; }
        .popup-content p { font-size: 1.5rem; font-weight: 800; margin-bottom: 25px; color: var(--chef-brown); }
        
        #closePopup {
            background: var(--chef-brown);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
        }

        #closePopup:hover { background: #000; }
    </style>
</head>
<body>

    <div class="header">
        <h2><i class="fa-solid fa-gift"></i> Free Spin Rewards</h2>
        <a href="dashboard.php" class="back-link">← Back to Dashboard</a>
    </div>

    <div class="container">
        <div class="wheel-wrapper">
            <div class="pointer"></div>
            <canvas id="wheel" width="450" height="450"></canvas>
        </div>
        <button id="spinBtn"><i class="fa-solid fa-play"></i> SPIN NOW</button>
    </div>

    <div id="popup" class="popup">
        <div class="popup-content">
            <i class="fa-solid fa-circle-check" style="font-size: 4rem; color: #2ecc71; margin-bottom: 15px;"></i>
            <h2>Congratulations!</h2>
            <p id="resultText"></p>
            <button id="closePopup">Redeem Now</button>
        </div>
    </div>

    <audio id="spinSound" src="audio/spin.mp3"></audio>

    <script>
        const wheel = document.getElementById("wheel");
        const ctx = wheel.getContext("2d");
        const spinBtn = document.getElementById("spinBtn");
        const popup = document.getElementById("popup");
        const resultText = document.getElementById("resultText");
        const closePopup = document.getElementById("closePopup");
        const spinSound = document.getElementById("spinSound");

        const segments = [
            "Free Voucher 50%",
            "Free Tiramisu",
            "Free Matcha Latte",
            "Free Cookies",
            "Free Voucher 20%",
            "Mystery Gift" // Ditambah satu segmen supaya roda lebih seimbang
        ];

        const colors = ["#f8a1b3", "#f28fa5", "#ec7f98", "#e66f8b", "#df5f7d", "#d85072"];

        const size = wheel.width;
        const center = size / 2;
        const radius = center;
        let startAngle = 0;
        let spinning = false;

        function drawWheel() {
            const angle = (2 * Math.PI) / segments.length;
            ctx.clearRect(0, 0, size, size);

            for (let i = 0; i < segments.length; i++) {
                const start = startAngle + i * angle;
                const end = start + angle;

                // Lukis Segmen
                ctx.beginPath();
                ctx.moveTo(center, center);
                ctx.arc(center, center, radius, start, end);
                ctx.fillStyle = colors[i];
                ctx.fill();
                ctx.strokeStyle = "rgba(255,255,255,0.2)";
                ctx.stroke();

                // Lukis Teks
                ctx.save();
                ctx.translate(center, center);
                ctx.rotate(start + angle / 2);
                ctx.textAlign = "right";
                ctx.fillStyle = "#fff";
                ctx.font = "bold 16px Arial";
                ctx.shadowBlur = 4;
                ctx.shadowColor = "rgba(0,0,0,0.3)";
                ctx.fillText(segments[i], radius - 30, 8);
                ctx.restore();
            }

            // Lukis Bulatan Tengah
            ctx.beginPath();
            ctx.arc(center, center, 40, 0, 2 * Math.PI);
            ctx.fillStyle = "white";
            ctx.fill();
            ctx.strokeStyle = varGet('--chef-brown');
            ctx.lineWidth = 2;
            ctx.stroke();

            // Label "CHEFIFY" di tengah
            ctx.fillStyle = "#4b2e19";
            ctx.font = "bold 10px Arial";
            ctx.textAlign = "center";
            ctx.fillText("CHEFIFY", center, center + 5);
        }

        // Helper untuk CSS Variable dalam JS
        function varGet(name) {
            return getComputedStyle(document.documentElement).getPropertyValue(name);
        }

        function spinWheel() {
            if (spinning) return;
            spinning = true;
            spinBtn.disabled = true;

            try {
                spinSound.currentTime = 0;
                spinSound.play();
            } catch(e) { console.log("Sound play failed"); }

            const spinAngle = Math.random() * 3000 + 3000;
            const duration = 5000;
            const start = performance.now();

            function animate(time) {
                const progress = Math.min((time - start) / duration, 1);
                // Ease out cubic
                const ease = 1 - Math.pow(1 - progress, 3);
                const angle = ease * spinAngle;

                startAngle = (angle * Math.PI / 180) % (2 * Math.PI);
                drawWheel();

                if (progress < 1) {
                    requestAnimationFrame(animate);
                } else {
                    const segmentAngle = 2 * Math.PI / segments.length;
                    const pointerAngle = (3 * Math.PI / 2); // Bahagian Atas
                    const normalized = (pointerAngle - startAngle + 2 * Math.PI) % (2 * Math.PI);
                    const index = Math.floor(normalized / segmentAngle);

                    resultText.textContent = segments[index];
                    popup.style.display = "flex";
                    spinning = false;
                    spinBtn.disabled = false;
                }
            }
            requestAnimationFrame(animate);
        }

        drawWheel();
        spinBtn.onclick = spinWheel;
        closePopup.onclick = () => popup.style.display = "none";
    </script>
</body>
</html>




