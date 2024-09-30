<?php

require_once "../classes/usuarios.php";
$p = new Usuario("projeto_tcc", "localhost", "root", "");

if (isset($_GET['id_up'])) {
    $id_update = addslashes($_GET['id_up']);
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        // Aqui você pode chamar o método de exclusão ou fazer qualquer outra operação necessária
        $p->excluir_usuario($id_update);
        header("location: http://localhost/Projeto%20TCC/Usuarios/usuarios.php");
        exit;
    }
    ?>
    <div class="modal" tabindex="-1" role="dialog" id="confirmModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar exclusão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja excluir este usuário?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="http://localhost/Projeto%20TCC/Usuarios/alterar.php?id_up=<?php echo $id_update ?>&confirm=true" class="btn btn-danger">Excluir</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#confirmModal').modal('show');
        });
    </script>
<?php
}
?>