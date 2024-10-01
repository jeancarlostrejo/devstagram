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
    init: function () {
        if (document.querySelector("[name='image']").value.trim()) {
            const imagePosted = {};
            imagePosted.size = 1111;
            imagePosted.name = document.querySelector("[name='image']").value;
            
            this.options.addedfile.call(this, imagePosted);
            this.options.thumbnail.call(this, imagePosted, `/storage/posts/${imagePosted.name}`)

            imagePosted.previewElement.classList.add('dz-success', 'dz-complete')
        }
    }
});

dropzone.on('success', (file, response) =>{
    document.querySelector("[name='image']").value = response.image;
})

dropzone.on('removedfile', (file) =>{
    document.querySelector("[name='image']").value= ""
})
