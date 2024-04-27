import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {

    dictDefaultMessage: 'Sube aquí tu imagen',
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,

    init: function() {
        const imagenInput = document.querySelector('[name="imagen"]');
        if (imagenInput && imagenInput.value.trim()) {
            const imagenPublicada = {
                size: 1234, // Tamaño de la imagen (solo un ejemplo, debes definir el tamaño real)
                name: imagenInput.value // Nombre de la imagen obtenido del campo de entrada
            };

            // Agregar la imagen al Dropzone
            this.options.addedfile.call(this, imagenPublicada);

            // Mostrar la miniatura de la imagen
            this.options.thumbnail.call(this, imagenPublicada, '/uploads/' + imagenPublicada.name);

            // Añadir clases para indicar que la carga ha sido exitosa
            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
});



dropzone.on("success", function(file, response){

    document.querySelector('[name="imagen"]').value = response.imagen;
 
});

dropzone.on("removedfile", function(){

    document.querySelector('[name="imagen"]').value = "";

});