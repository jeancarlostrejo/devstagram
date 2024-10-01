import './bootstrap';
import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

let dropzone = new Dropzone(".dropzone", {
    dictDefaultMessage: "Sube tu imagen aquí",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,
});

dropzone.on('sending', (file, xhr, formData) => {
    console.log(formData);
})

dropzone.on('success', (file, response) =>{
    console.log(response)
})

dropzone.on('error', (file, message) =>{
    console.log(message)
})

dropzone.on('removedfile', ()=>{
    console.log('Archivo eliminado')
})