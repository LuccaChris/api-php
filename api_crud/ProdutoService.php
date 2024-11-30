<?php
include __DIR__ . '/Produto.php';

class ProdutoService {

    public function get($id = null) {
        if ($id) {
            return Produto::select($id);
        } else {
            return Produto::selectAll();
        }
    }

    public function post() {
        $dados = json_decode(file_get_contents('php://input'), true);
        return Produto::insert($dados);
    }

    public function put($id) {
        $dados = json_decode(file_get_contents('php://input'), true);
        return Produto::update($id, $dados);
    }

    public function delete($id) {
        return Produto::delete($id);
    }
}
?>