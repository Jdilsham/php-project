document.addEventListener('DOMContentLoaded', () => {
    // Handle Delete Button Clicks
    const deleteButtons = document.querySelectorAll('.remove-btn');
    deleteButtons.forEach((button) => {
        button.addEventListener('click', function (e) {
            const confirmDelete = confirm("Are you sure you want to delete this task?");
            if (!confirmDelete) {
                e.preventDefault();
            }
        });
    });

    // Smooth fade-in effect for new tasks
    const taskList = document.querySelector('.todo-list');
    if (taskList) {
        taskList.addEventListener('DOMNodeInserted', (event) => {
            event.target.style.opacity = 0;
            let opacity = 0;
            const fadeIn = setInterval(() => {
                opacity += 0.1;
                event.target.style.opacity = opacity;
                if (opacity >= 1) {
                    clearInterval(fadeIn);
                }
            }, 50);
        });
    }
});
