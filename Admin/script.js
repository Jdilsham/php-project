// Function to toggle the visibility of forms based on the user's action (Optional)
document.addEventListener('DOMContentLoaded', function () {
    const addUserForm = document.querySelector("#addUserForm");
    const addCourseForm = document.querySelector("#addCourseForm");
    const userTable = document.querySelector("#userTable");
    const courseTable = document.querySelector("#courseTable");

    // Show or hide forms based on tab selection or button click
    const toggleFormVisibility = (form) => {
        if (form.style.display === "none" || form.style.display === "") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    };

    // Simple form validation (optional) for Add User and Add Course
    const validateForm = (form) => {
        const inputs = form.querySelectorAll('input');
        let valid = true;
        
        inputs.forEach(input => {
            if (input.value.trim() === "") {
                input.style.borderColor = "red";
                valid = false;
            } else {
                input.style.borderColor = "";
            }
        });
        
        return valid;
    };

    // Event listeners for form submission
    document.querySelector("#addUserForm button").addEventListener("click", (e) => {
        e.preventDefault();
        if (validateForm(addUserForm)) {
            alert("User added successfully!");
            addUserForm.reset();
        } else {
            alert("Please fill all fields.");
        }
    });

    document.querySelector("#addCourseForm button").addEventListener("click", (e) => {
        e.preventDefault();
        if (validateForm(addCourseForm)) {
            alert("Course added successfully!");
            addCourseForm.reset();
        } else {
            alert("Please fill all fields.");
        }
    });

    // Implement toggle between user and course management
    document.querySelector("#viewUsersBtn").addEventListener("click", () => {
        toggleFormVisibility(userTable);
    });

    document.querySelector("#viewCoursesBtn").addEventListener("click", () => {
        toggleFormVisibility(courseTable);
    });
});
