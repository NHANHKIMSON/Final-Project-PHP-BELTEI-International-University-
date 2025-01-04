// Select the button and the sidebar
const toggleButton = document.querySelector('[data-drawer-toggle="default-sidebar"]');
const sidebar = document.getElementById('default-sidebar');

// Add a click event listener to the button
toggleButton.addEventListener('click', () => {
    // Toggle the "translate-x-0" class on the sidebar to show or hide it
    sidebar.classList.toggle('-translate-x-full');
    sidebar.classList.toggle('sm:translate-x-0'); // Ensures it remains visible in sm: screens
});