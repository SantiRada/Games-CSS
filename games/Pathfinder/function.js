document.getElementById('list').addEventListener('change', () => {
    // Obtenemos el valor seleccionado en el select
    const selectedValue = document.getElementById('list').value;
    
    // Redireccionamos a una url específica
    window.location.href = "index.php?level=" + selectedValue;
});

const correct = document.getElementById('correct').value;

document.getElementById('input-1').addEventListener('input', () => {
    const value = document.getElementById('input-1').value;

    console.log("Correct: " + correct);
    console.log("Value: " + value);
    if(value === correct){
        CreateConfetti();

        const congratulation = document.getElementById('congratulation');
        congratulation.classList.remove('not-view');
        document.getElementById('next-level').classList.remove('not-view');
    }
});