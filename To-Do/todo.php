<?php
// Include the database connection
include('../connection.php');

// Start the session to get the logged-in user
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header("Location: Login/login.php");
    exit();
}

// Add a new task
if (isset($_POST['todoi'])) {
    // Sanitize input
    $task = $conn->real_escape_string(trim($_POST['task']));
    $user_id = $_SESSION['user_id'];  // Get the logged-in user's ID

    if (!empty($task)) {
        // Insert the task into the database
        $stmt = $conn->prepare("INSERT INTO todo_list (task, mark, user_id) VALUES (?, ?, ?)");
        $mark = 'Uncome'; // Default mark
        $stmt->bind_param("ssi", $task, $mark, $user_id); // Bind user_id
        $stmt->execute();
        $stmt->close();
    }

    // Redirect back to the index page after adding
    header("Location: index.php");
    exit;
}

// Delete a task
if (isset($_POST['delete_task'])) {
    // Get the task ID
    $task_id = $_POST['task_id'];
    $user_id = $_SESSION['user_id']; // Get the logged-in user's ID

    // Delete the task from the database, ensuring it's the logged-in user's task
    $stmt = $conn->prepare("DELETE FROM todo_list WHERE todo_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $task_id, $user_id); // Bind task_id and user_id to ensure task belongs to the user
    $stmt->execute();
    $stmt->close();

    // Redirect back to the index page after deleting
    header("Location: index.php");
    exit;
}
?>
