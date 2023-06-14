
  function mostrarImagenAmpliada(src) {
    // Crea un elemento <div> para mostrar la imagen ampliada
    var imagenAmpliada = document.createElement("div");
    imagenAmpliada.className = "imagen-ampliada";

    // Crea un elemento <img> para mostrar la imagen
    var imagen = document.createElement("img");
    imagen.src = src;

    // Crea un elemento <i> para el botón de cerrar
    var botonCerrar = document.createElement("i");
    botonCerrar.className = "cerrar-imagen fas fa-times";
    botonCerrar.onclick = function() {
      document.body.removeChild(imagenAmpliada);
    };

    // Agrega la imagen y el botón de cerrar al elemento <div>
    imagenAmpliada.appendChild(imagen);
    imagenAmpliada.appendChild(botonCerrar);

    // Agrega el elemento <div> al cuerpo del documento
    document.body.appendChild(imagenAmpliada);
  }
