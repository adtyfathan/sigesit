import './bootstrap';
window.toggleFAQ = function(id) {
    const answer = document.getElementById(id);
    const icon = document.getElementById(`icon-${id}`);

    if (answer.classList.contains('hidden')) {
        answer.classList.remove('hidden');
        answer.classList.add('block'); // Show the answer
        icon.classList.remove('rotate-0');
        icon.classList.add('rotate-180'); // Rotate arrow up
    } else {
        answer.classList.remove('block');
        answer.classList.add('hidden'); // Hide the answer
        icon.classList.remove('rotate-180');
        icon.classList.add('rotate-0'); // Rotate arrow down
    }
};