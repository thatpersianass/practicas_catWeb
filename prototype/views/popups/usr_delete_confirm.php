<link rel="stylesheet" href="../style/login.css">

<div class="modal fade" id="insertdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="insertdataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="insertdataLabel">¿Seguro que quieres eliminar este usuario?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">

                <div class="modal-footer">
                    <button type="button" class="button-secundary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="save_data" class="button-primary">Crear carpeta</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
function mostrarContrasenia() {
    var x = document.getElementById("passwd");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>