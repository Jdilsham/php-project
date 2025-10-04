<?php
session_start();

$quizzes = [
    'c' => ['file' => 'data/c.json', 'title' => 'C# Quiz'],
    'cs' => ['file' => 'data/cs.json', 'title' => 'Computer Science Basics Quiz'],
    'azure' => ['file' => 'data/azure.json', 'title' => 'Azure Fundamentals Quiz'],
    'ml' => ['file' => 'data/ml.json', 'title' => 'Machine Learning Quiz'],
    'web_pro' => ['file' => 'data/web_pro.json', 'title' => 'Web Programming Quiz'],
    'web' => ['file' => 'data/web.json', 'title' => 'Web Design Quiz'],
];

// Validate quiz param
if (!isset($_GET['quiz']) || !array_key_exists($_GET['quiz'], $quizzes)) {
    die("Invalid quiz selected.");
}

$quiz_key = $_GET['quiz'];
$quiz_data_file = __DIR__ . '/' . $quizzes[$quiz_key]['file'];
$quiz_title = $quizzes[$quiz_key]['title'];

if (!file_exists($quiz_data_file)) {
    die("Quiz data file not found.");
}

$questions_json = file_get_contents($quiz_data_file);
$questions = json_decode($questions_json, true);

if (!$questions) {
    die("Invalid quiz data format.");
}

$num_questions = count($questions); // Show ALL questions
$question_keys = range(0, $num_questions - 1); // all indexes in order

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = 0;
    for ($i = 0; $i < $num_questions; $i++) {
        $qid = $_POST['qid'][$i];
        $selected = $_POST['answer'][$i] ?? '';
        if ($selected === $questions[$qid]['answer']) {
            $score++;
        }
    }
    $percentage = round(($score / $num_questions) * 100);

    if ($percentage >= 80) {
        $feedback = "Excellent! You really know your stuff.";
        $alert_class = "alert-success";
    } elseif ($percentage >= 50) {
        $feedback = "Good job! A little more practice and you'll master it.";
        $alert_class = "alert-warning";
    } else {
        $feedback = "Keep practicing! Don't give up.";
        $alert_class = "alert-danger";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title><?php echo htmlspecialchars($quiz_title); ?> - PHP GROUP 09</title>

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon" />
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect" />
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Poppins&family=Raleway&display=swap"
    rel="stylesheet"
  />

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet" />
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

  <!-- Main CSS File -->
  <link href="../assets/css/main.css" rel="stylesheet" />

  <style>
    /* Question card styles */
    .question-card {
      background: linear-gradient(135deg, #f0f4ff, #d9e7ff);
      border-radius: 12px;
      box-shadow: 0 8px 15px rgba(0, 85, 255, 0.15);
      padding: 25px 30px;
      margin-bottom: 30px;
      transition: transform 0.3s ease;
    }
    .question-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 20px rgba(0, 85, 255, 0.3);
    }
    .question-card h5 {
      font-weight: 700;
      color: #004aad;
      margin-bottom: 20px;
      font-family: 'Poppins', sans-serif;
      font-size: 1.25rem;
    }

    /* Options */
    .form-check {
      margin-bottom: 12px;
      border: 2px solid transparent;
      border-radius: 8px;
      padding: 8px 15px;
      cursor: pointer;
      transition: background-color 0.25s ease, border-color 0.25s ease;
      background: white;
    }
    .form-check:hover {
      background-color: #e1e9ff;
      border-color: #004aad;
    }
    .form-check-input:checked + .form-check-label {
      color: #004aad;
      font-weight: 600;
    }
    .form-check-input {
      cursor: pointer;
    }

    /* Submit button */
    button[type="submit"] {
      padding: 12px 35px;
      font-size: 1.2rem;
      font-weight: 600;
      border-radius: 50px;
      transition: background-color 0.3s ease;
    }
    button[type="submit"]:hover {
      background-color: #003399;
      color: white;
    }

    /* Result styles */
    .result-card {
      background: linear-gradient(135deg, #d9f7be, #52c41a);
      border-radius: 15px;
      box-shadow: 0 12px 25px rgba(82, 196, 26, 0.5);
      padding: 30px 40px;
      color: #1a3e00;
      font-family: 'Poppins', sans-serif;
      font-size: 1.5rem;
      font-weight: 700;
      animation: fadeInScale 0.8s ease forwards;
      max-width: 600px;
      margin: 30px auto 20px;
      text-align: center;
    }

    .alert-success.result-card {
      background: linear-gradient(135deg, #d9f7be, #52c41a);
      color: #1a3e00;
      box-shadow: 0 12px 25px rgba(82, 196, 26, 0.5);
    }
    .alert-warning.result-card {
      background: linear-gradient(135deg, #fff4e5, #faad14);
      color: #663c00;
      box-shadow: 0 12px 25px rgba(250, 173, 20, 0.5);
    }
    .alert-danger.result-card {
      background: linear-gradient(135deg, #ffd6d6, #ff4d4f);
      color: #5c0000;
      box-shadow: 0 12px 25px rgba(255, 77, 79, 0.5);
    }

    @keyframes fadeInScale {
      0% {
        opacity: 0;
        transform: scale(0.85);
      }
      100% {
        opacity: 1;
        transform: scale(1);
      }
    }

    .result-actions {
      margin-top: 25px;
      text-align: center;
    }
    .result-actions .btn {
      font-size: 1.15rem;
      padding: 10px 28px;
      border-radius: 40px;
      font-weight: 600;
      margin: 0 12px;
      transition: transform 0.3s ease;
    }
    .result-actions .btn:hover {
      transform: scale(1.1);
    }
  </style>
</head>

<body class="courses-page">
  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="../index.php" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">EDUCATE</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="../index.php">Home</a></li>
          <li><a href="../about.html">About</a></li>
          <li><a href="../courses.html">Courses</a></li>
          <li><a href="quiz.php">Quiz</a></li>
          <li><a href="../To-Do/index.php">To-Do</a></li>
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
              <h1><?php echo htmlspecialchars($quiz_title); ?></h1>
              <p class="mb-0">Test your knowledge with this interactive quiz.</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="../../index.php">Home</a></li>
            <li><a href="quiz.php">Quiz</a></li>
            <li class="current"><?php echo htmlspecialchars($quiz_title); ?></li>
          </ol>
        </div>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="courses section">
      <div class="container">
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
          <div class="alert <?php echo $alert_class; ?> result-card" role="alert">
            <div>Your Score: <?php echo $score; ?> / <?php echo $num_questions; ?> (<?php echo $percentage; ?>%)</div>
            <div style="margin-top: 12px; font-size: 1.2rem;"><?php echo $feedback; ?></div>
          </div>
          <div class="result-actions">
            <a href="quiz-more.php?quiz=<?php echo urlencode($quiz_key); ?>" class="btn btn-primary btn-lg">
              Try Again
            </a>
            <a href="quiz.php" class="btn btn-outline-secondary btn-lg ms-2">
              Back to Quiz List
            </a>
          </div>
        <?php else: ?>
          <form method="post" action="">
            <?php foreach ($question_keys as $i => $key): ?>
              <?php $q = $questions[$key]; ?>
              <div class="question-card" data-aos="zoom-in" data-aos-delay="<?php echo 100 + ($i * 100); ?>">
                <h5>Q<?php echo $i + 1; ?>. <?php echo htmlspecialchars($q['question']); ?></h5>
                <input type="hidden" name="qid[]" value="<?php echo $key; ?>" />
                <?php foreach ($q['options'] as $option): ?>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="answer[<?php echo $i; ?>]"
                      id="q<?php echo $i; ?>_<?php echo htmlspecialchars($option); ?>"
                      value="<?php echo htmlspecialchars($option); ?>"
                      required
                    />
                    <label class="form-check-label" for="q<?php echo $i; ?>_<?php echo htmlspecialchars($option); ?>">
                      <?php echo htmlspecialchars($option); ?>
                    </label>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-success btn-lg">Submit Answers</button>
          </form>
        <?php endif; ?>
      </div>
    </section>
  </main>

  <footer id="footer" class="footer position-relative light-background">
    <div class="container copyright text-center mt-4">
      <p>© <strong class="px-1 sitename">PHP-PROJECT</strong> <span>All Rights Reserved</span></p>
      <div class="credits">Designed by Group 09</div>
    </div>
  </footer>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"
    ><i class="bi bi-arrow-up-short"></i
  ></a>
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
