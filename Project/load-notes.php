<?php
$courseId = $_GET['id'] ?? null;

$courseFolders = [
  "csharp" => "csharp",
  "cs" => "cs",
  "azure" => "azure",
  "ml" => "ml",
  "web" => "web",
  "webpython" => "webpython"

];

if ($courseId && isset($courseFolders[$courseId])) {
    $folder = __DIR__ . "/notes/" . $courseFolders[$courseId];
    $webPath = "notes/" . $courseFolders[$courseId];

    if (is_dir($folder)) {
        $files = scandir($folder);
        $pdfs = array_filter($files, fn($f) => strtolower(pathinfo($f, PATHINFO_EXTENSION)) === 'pdf');

        if (count($pdfs) > 0) {
            echo "<div class='card mb-4' style='border: 2px solid #28a745;'>";
            echo "<div class='card-body'>";
            echo "<h5 class='mb-4' style='color: #28a745; font-weight: bold;'>Available Notes</h5>";

            foreach ($pdfs as $pdf) {
                $safePdf = htmlspecialchars($pdf, ENT_QUOTES, 'UTF-8');
                $url = $webPath . "/" . rawurlencode($pdf);
                echo "<div class='d-flex align-items-center mb-3' style='font-size: 1.1rem;'>";
                echo "<i class='bi bi-file-earmark-pdf-fill text-danger me-2' style='font-size: 1.5rem;'></i>";
                echo "<a href='$url' target='_blank' class='text-decoration-none text-dark'>$safePdf</a>";
                echo "</div>";
            }

              echo "</div></div>";
            } else {
              echo "<div class='alert alert-warning'>No notes available for this course.</div>";
            }
    } else {
        echo "<div class='alert alert-danger'>Notes folder not found.</div>";
    }
} else {
    $safeId = htmlspecialchars($courseId ?? 'none', ENT_QUOTES, 'UTF-8');
    echo "<div class='alert alert-danger'>Invalid or missing course ID: <strong>$safeId</strong></div>";
}
?>
