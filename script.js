document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        const title = document.querySelector('input[name="title"]').value;
        const content = document.querySelector('textarea[name="content"]').value;
        if (title.trim() === '' || content.trim() === '') {
            alert('Please fill out all fields.');
            event.preventDefault();
        }
    });
});
