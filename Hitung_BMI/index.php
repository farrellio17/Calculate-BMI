<?php
// Fungsi untuk menghitung BMI
function calculateBMI($weight, $height) {
    $height_m = $height / 100;
    return $weight / ($height_m * $height_m);
}

$bmi = null;
$category = '';
$color = '';
$advice = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $weight = (float)($_POST['weight'] ?? 0);
    $height = (float)($_POST['height'] ?? 0);
    
    if ($weight > 0 && $height > 0) {
        $bmi = calculateBMI($weight, $height);
        
        if ($bmi < 18.5) {
            $category = 'Underweight';
            $color = 'from-blue-400 to-blue-600';
            $advice = 'You may need to gain some weight';
        } elseif ($bmi < 25) {
            $category = 'Normal';
            $color = 'from-green-400 to-emerald-600';
            $advice = 'Great! Maintain your healthy weight';
        } elseif ($bmi < 30) {
            $category = 'Overweight';
            $color = 'from-orange-400 to-amber-600';
            $advice = 'Consider some light exercise';
        } else {
            $category = 'Obese';
            $color = 'from-red-400 to-rose-600';
            $advice = 'Consult with a health professional';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Visualizer | Health Check</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Background Particles -->
    <div id="particles-js"></div>
    
    <div class="glass-container animate__animated animate__fadeIn">
        <div class="header">
            <div class="logo">🧬</div>
            <h1 class="title">BMI <span>Visualizer</span></h1>
            <p class="subtitle">Discover your body mass index in style</p>
        </div>
        
        <form method="POST" class="bmi-form">
            <div class="input-group floating">
                <input type="number" id="weight" name="weight" step="0.1" required>
                <label for="weight">Weight (kg)</label>
                <div class="icon">⚖️</div>
            </div>
            
            <div class="input-group floating">
                <input type="number" id="height" name="height" required>
                <label for="height">Height (cm)</label>
                <div class="icon">📏</div>
            </div>
            
            <button type="submit" class="calculate-btn">
                <span>Calculate BMI</span>
                <div class="liquid"></div>
            </button>
        </form>
        
        <?php if ($bmi !== null): ?>
        <div class="result-container animate__animated animate__zoomIn <?php echo $color ?>">
            <div class="bmi-value">
                <span>Your BMI</span>
                <h2><?php echo number_format($bmi, 1) ?></h2>
                <div class="category"><?php echo $category ?></div>
            </div>
            
            <div class="bmi-scale">
                <div class="scale-bar">
                    <div class="progress" style="width: <?php echo min(100, max(5, ($bmi/40)*100)) ?>%"></div>
                </div>
                <div class="scale-markers">
                    <span>Under</span>
                    <span>Normal</span>
                    <span>Over</span>
                    <span>Obese</span>
                </div>
            </div>
            
            <div class="advice">💡 <?php echo $advice ?></div>
        </div>
        <?php endif; ?>
        
        <div class="footer">
            <div class="health-tip animate__animated animate__fadeInUp animate__delay-1s">
                💪 Did you know? Regular exercise can improve your BMI!
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="script.js"></script>
</body>
</html>