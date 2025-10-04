<?php
// Include the database connection
include('../connection.php');

// Start the session to get the logged-in user
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login/login.php");
    exit();
}

// Fetch tasks for the logged-in user from the database
$query = "SELECT * FROM todo_list WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']); // Bind the logged-in user's ID
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="todo-container">
        <h1>To-Do List</h1>

        <!-- Form to add a new task -->
        <form method="POST" action="todo.php" class="todo-form">
            <input type="text" name="task" placeholder="Add a new task" class="todo-input" required>
            <button type="submit" name="todoi" class="todo-btn">Add Task</button>
        </form>

        <h2>Task List</h2>
        <ul class="todo-list">
            <?php
            // Display tasks from the database
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<li class="todo-item">';
                    echo '<span>' . htmlspecialchars($row['task']) . ' (' . $row['mark'] . ')</span>';

                    echo '<form method="POST" action="todo.php" style="display:inline;">
                            <input type="hidden" name="task_id" value="' . $row['todo_id'] . '">
                            <button type="submit" name="delete_task" class="remove-btn">Delete</button>
                        </form>';
                    echo '</li>';
                }
            } else {
                echo '<li>No tasks available</li>';
            }
            ?>
        </ul>
    </div>

    <script src="script.js"></script>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
