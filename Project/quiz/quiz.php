<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Quiz - PHP GROUP 09</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Poppins&family=Raleway&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="../assets/css/main.css" rel="stylesheet">
</head>

<body class="courses-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="../index.php" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">EDUCATE</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
         <li><a href="../../index.php">Home</a></li>               
    <li><a href="../about.html">About</a></li>                
    <li><a href="../courses.html">Courses</a></li>            
    <li><a href="../../To-Do/index.php">To-Do</a></li>         
    <li><a href="quiz.php" class="active">Quiz</a></li>        
    <li><a href="../contact.html">Contact</a></li>  
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="../courses.html">Get Started</a>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>Test Your Skills</h1>
              <p class="mb-0">Test your knowledge across multiple tech topics with our interactive quizzes.</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="../../index.php">Home</a></li>
            <li class="current">Quiz</li>
          </ol>
        </div>
      </nav>
    </div>
    <!-- End Page Title -->

    <!-- Quiz Cards Section -->
    <section id="courses" class="courses section">
      <div class="container">
        <div class="row">

          <!-- Quiz Card 1 -->
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="course-item">
              <img src="../assets/img/quiz/c.jpg" class="img-fluid" alt="C Programming">
              <div class="course-content">
                <h3><a href="quiz-more.php?quiz=c">C# Quiz</a></h3>
                <p class="description">Challenge your C programming fundamentals and syntax knowledge.</p>
              </div>
            </div>
          </div>

          <!-- Quiz Card 2 -->
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="course-item">
              <img src="../assets/img/quiz/cs.jpg" class="img-fluid" alt="Computer Science">
              <div class="course-content">
                <h3><a href="quiz-more.php?quiz=cs">Computer Science Basics Quiz</a></h3>
                <p class="description">General questions covering core CS topics like algorithms, logic, and memory.</p>
              </div>
            </div>
          </div>

          <!-- Quiz Card 3 -->
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="course-item">
              <img src="../assets/img/quiz/azure.jpg" class="img-fluid" alt="Azure">
              <div class="course-content">
                <h3><a href="quiz-more.php?quiz=azure">Azure Fundamentals Quiz</a></h3>
                <p class="description">Brush up your cloud knowledge with beginner Microsoft Azure concepts.</p>
              </div>
            </div>
          </div>

          <!-- Quiz Card 4 -->
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="course-item">
              <img src="../assets/img/quiz/ml.png" class="img-fluid" alt="Machine Learning">
              <div class="course-content">
                <h3><a href="quiz-more.php?quiz=ml">Machine Learning Quiz</a></h3>
                <p class="description">Cover ML basics like models, overfitting, supervised vs unsupervised learning.</p>
              </div>
            </div>
          </div>

          <!-- Quiz Card 5 -->
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="course-item">
              <img src="../assets/img/quiz/web_pro.jpg" class="img-fluid" alt="Web Programming">
              <div class="course-content">
                <h3><a href="quiz-more.php?quiz=web_pro">Web Programming Quiz</a></h3>
                <p class="description">HTML, CSS, JS, frameworks – test your frontend & backend web dev skills.</p>
              </div>
            </div>
          </div>

          <!-- Quiz Card 6 -->
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="course-item">
              <img src="../assets/img/quiz/web.jpg" class="img-fluid" alt="Web Design">
              <div class="course-content">
                <h3><a href="quiz-more.php?quiz=web">Web Design Quiz</a></h3>
                <p class="description">Responsive layouts, colors, fonts — how much do you know about modern design?</p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- End Quiz Cards Section -->

  </main>

  <footer id="footer" class="footer position-relative light-background">
    <div class="container copyright text-center mt-4">
      <p>© <strong class="px-1 sitename">PHP-PROJECT</strong> <span>All Rights Reserved</span></p>
      <div class="credits">Designed by Group 09</div>
    </div>
  </footer>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <!-- JS Files -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/js/main.js"></script>

</body>

</html>
