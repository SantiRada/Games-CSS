// Variable para almacenar el CSS parcial
let cssBuffer = '';

document.getElementById('list').addEventListener('change', () => {
  // Obtenemos el valor seleccionado en el select
  const selectedValue = document.getElementById('list').value;
  
  // Redireccionamos a una url específica
  window.location.href = "index.php?level=" + selectedValue;
});

document.getElementById('input-1').addEventListener('input', function() {
  // Obtener el código CSS del input
  const cssCode = document.getElementById('input-1').value;

  // Añadir el nuevo contenido al buffer
  cssBuffer += cssCode;

  // Verificar si se ha ingresado un ';' que indica el final de una regla
  if (cssBuffer.includes(';')) {
    cssBuffer = cssCode;
    // Obtener el elemento con id "pirate"
    const pirate = document.getElementById('pirate');

    // Asignar el CSS al atributo style del elemento
    pirate.setAttribute('style', cssBuffer);

    // Limpiar el buffer después de aplicar el estilo
    cssBuffer = '';

    const correct = document.getElementById('correct').value;

    if(verificarCSS(cssCode, limpiarCorrect(correct))){
      CreateConfetti();

      const congratulation = document.getElementById('congratulation');
      congratulation.classList.remove('not-view');
      document.getElementById('next-level').classList.remove('not-view');
    }
  }
});

function verificarCSS(cssCode, correct) {
  const generarRegex = (regla) => {
      const propiedadValor = regla.split(':');
      const propiedad = propiedadValor[0].trim(); // Obtener la propiedad
      const valor = propiedadValor[1].replace(';', '').trim(); // Obtener el valor sin ';'
      // Crear una expresión regular para esa propiedad, sin importar espacios
      return new RegExp(`${propiedad}\\s*:\\s*${valor}\\s*;`);
  };

  // Para cada regla en el array correct[], generamos la expresión regular y comprobamos si está en cssCode
  return correct.every(regla => {
      const regex = generarRegex(regla);
      return regex.test(cssCode);
  });
}

function limpiarCorrect(correct) {
  // Separar el string por el ';' para obtener cada regla
  let reglas = correct.split(';').map(regla => regla.trim()).filter(regla => regla !== '');
  
  // Agregar ';' al final de cada regla para mantener el formato CSS correcto
  return reglas.map(regla => regla + ';');
}