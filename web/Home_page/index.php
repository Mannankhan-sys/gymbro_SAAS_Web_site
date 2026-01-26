<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GymBro - Home</title>
  <link rel="stylesheet" href="../assets/Home.css" />
</head>
<body>
  <!-- Navigation Bar -->
  <header>
    <nav class="navbar">
      <h2 class="logo">Gym<span>Bro</span></h2>
      <ul class="nav-links">
        <li><a href="../Home_page/index.php" class="active">Home</a></li>
      <li><a href="#plans">Plans</a></li>
        <li><a href="../Meal_page/index.html">Meals</a></li>
        <li><a href="../tutorial_page/index.html">Tutorials</a></li>
        <li><a href="../dashboard.php">Profile</a></li>
         <li><a href="../auth/logout.php">Logout</a></li>


      </ul>
    </nav>
  </header>

  <!-- Hero Section with Slider -->
  <section class="hero">
    <div class="hero-slider">
      <div class="slide" style="background-image: url('../assets/Home_images/slide1.webp');"></div>
      <div class="slide" style="background-image: url('../assets/Home_images/slide2.webp');"></div>
      <div class="slide" style="background-image: url('../assets/Home_images/slide3.webp');"></div>
      <div class="slide" style="background-image: url('../assets/Home_images/slide4.webp');"></div>
    </div>
    <div class="hero-content">
      <h1>Welcome to <span>GymBro</span></h1>
      <p>Your ultimate fitness companion — choose your plan and transform today!</p>
      
    </div>
  </section>

  <!-- Membership Plans with Video Background -->
  <section id="plans" class="plans">

    <!-- Background Video -->
    <video autoplay muted loop playsinline class="bg-video">
      <source src="../assets/Home_videos/gym_bg.mp4" type="video/mp4" />
      <img src="../assets/Home_images/slide1.webp" alt="Gym Background" />
    </video>

    <div class="overlay">
      <h2>Membership Plans</h2>
      <div class="plan-container">
        <div class="plan-card silver">
          <h3>Silver Plan</h3>
          <p>Access to all gym equipment, meal plans, and exercise tutorials.</p>
          <h4>PKR 3000/month</h4>
       <a href="../subscribe/index.php?plan=silver">Join Silver</a>



        </div>

        <div class="plan-card gold">
          <h3>Gold Plan</h3>
          <p>Includes everything in Silver + Personal Trainer + Hot Sauna Access.</p>
          <h4>PKR 5000/month</h4>
        <a href="../subscribe/index.php?plan=gold">Join Gold</a>

        </div>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="features">
    <h2>Why Choose GymBro?</h2>
    <div class="feature-container">
      <div class="feature">
        <h3>🏋️‍♂️ Equipment</h3>
        <p>World-class machines and training setups for every fitness level.</p>
      </div>
      <div class="feature">
        <h3>🥗 Meal Plans</h3>
        <p>Custom nutrition plans for muscle gain, fat loss, or endurance.</p>
      </div>
      <div class="feature">
        <h3>🎥 Tutorials</h3>
        <p>HD video tutorials to help you master form and technique.</p>
      </div>
      <div class="feature">
        <h3>🔥 Sauna</h3>
        <p>Relax and recover after intense workouts with our hot sauna access (Gold only).</p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 GymBro. All Rights Reserved.</p>
  </footer>

  <!-- Background Slider Script -->
  <script>
    let index = 0;
    const slides = document.querySelectorAll(".slide");

    function showNextSlide() {
      slides.forEach((slide, i) => {
        slide.style.opacity = i === index ? "1" : "0";
      });
      index = (index + 1) % slides.length;
    }

    // Show the first image right away
    showNextSlide();

    // Change every 4 seconds
    setInterval(showNextSlide, 4000);
  </script>

  <script>
    // Animate both plan cards together when scrolled into view
    const planCards = document.querySelectorAll(".slide-together");

    function showPlansOnScroll() {
      const triggerPoint = window.innerHeight * 0.8;
      planCards.forEach((el) => {
        const rect = el.getBoundingClientRect();
        if (rect.top < triggerPoint) {
          el.classList.add("active");
        }
      });
    }

    window.addEventListener("scroll", showPlansOnScroll);
    window.addEventListener("load", showPlansOnScroll);
  </script>
</body>
</html>
