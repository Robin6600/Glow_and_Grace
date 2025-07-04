// script.js

document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('theme-toggle');
    const currentTheme = localStorage.getItem('theme');

    // Apply the saved theme on page load
    if (currentTheme === 'dark') {
        document.documentElement.classList.add('dark-mode');
        themeToggle.textContent = '☀️'; // Sun icon
    }

    themeToggle.addEventListener('click', () => {
        // Toggle the .dark-mode class on the <html> element
        document.documentElement.classList.toggle('dark-mode');

        // Update the button icon and save the theme preference
        let theme = 'light';
        if (document.documentElement.classList.contains('dark-mode')) {
            themeToggle.textContent = '☀️';
            theme = 'dark';
        } else {
            themeToggle.textContent = '🌙'; // Moon icon
        }
        localStorage.setItem('theme', theme);
    });
});