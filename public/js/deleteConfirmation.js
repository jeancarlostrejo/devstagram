let form = document.querySelector("#form-delet");

if(form){
    form.addEventListener("submit", (e) => {
        e.preventDefault();
    
        Swal.fire({
            title: "¿Estás seguro?",
            text: "Se eliminará el registro",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "No, cancelar",
            confirmButtonText: "Sí, eliminar",
            
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit();
            }
        });
    });
}
