document.getElementById('list').addEventListener('change', () => {
    const selectedValue = document.getElementById('list').value;
    window.location.href = "index.php?level=" + selectedValue;
});

document.querySelectorAll('.card').forEach(card => {
    card.addEventListener('click', () => {
        const val = card.textContent.trim();
        const correct = document.getElementById('correct').value.trim();
        if (val === correct) {
            // Respuesta correcta
            CreateConfetti();
            const congratulation = document.getElementById('congratulation');
            congratulation.classList.remove('not-view');
            document.getElementById('next-level').classList.remove('not-view');
        } else {
            // Respuesta incorrecta
            const failed = document.getElementById('failed');
            failed.classList.remove('not-view');
        }
    });
});
