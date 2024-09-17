document.getElementById('button-1').addEventListener('click', () => {
    VerificarRespuesta(document.getElementById('text-1').textContent);
});

document.getElementById('button-2').addEventListener('click', () => {
    VerificarRespuesta(document.getElementById('text-2').textContent);
});

function VerificarRespuesta(value){
    console.time("VerificarRespuesta");
    const correct = document.getElementById('correct').value;

    if(value === correct){
        const congrat = document.getElementById('congrat');
        congrat.classList.remove('not-view');
        CreateConfetti();
    }
    else{
        const failed = document.getElementById('failed');
        failed.classList.remove('not-view');
    }

    console.timeEnd("VerificarRespuesta");
}

document.getElementById('list').addEventListener('change', () => {
    // Obtenemos el valor seleccionado en el select
    const selectedValue = document.getElementById('list').value;
    
    // Redireccionamos a una url específica
    window.location.href = "index.php?level=" + selectedValue;
});