<?php
include __DIR__ . '/Usuarios.php';

class UsuariosService {

    public function get($id = null) {
        if ($id) {
            return Usuarios::select($id);
        } else {
            return Usuarios::selectAll();
        }
    }

    public function post() {
        $dados = json_decode(file_get_contents('php://input'), true);
        return Usuarios::insert($dados);
    }

    public function put($id) {
        $dados = json_decode(file_get_contents('php://input'), true);
        return Usuarios::update($id, $dados);
    }

    public function delete($id) {
        return Usuarios::delete($id);
    }
}
?>
