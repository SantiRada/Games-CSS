document.getElementById('list').addEventListener('change', () => {
    // Obtenemos el valor seleccionado en el select
    const selectedValue = document.getElementById('list').value;
    
    // Redireccionamos a una url específica
    window.location.href = "index.php?level=" + selectedValue;
  });

document.getElementById('input-1').addEventListener('input', () => {
    let codeEmmet = document.getElementById('input-1').value;

    VerificarResultado(codeEmmet);
});

function VerificarResultado(codeEmmet){
    const correct = document.getElementById('correct').value;

    console.log("Correct: " + correct);
    console.log("Emmet: " + codeEmmet);
    if(codeEmmet == correct){
        console.log("SIIII!!");
        CreateConfetti();

        const congratulation = document.getElementById('congratulation');
        congratulation.classList.remove('not-view');
        document.getElementById('next-level').classList.remove('not-view');
    }
}