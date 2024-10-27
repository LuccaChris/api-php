<?php
include 'Conexao.php';

class Produto {

    public static function select($id) {
        $conexao = Conexao::conectar();
        $sql = "SELECT * FROM Produto WHERE id_produto = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            throw new Exception("Produto não encontrado");
        }
    }

    public static function selectAll() {
        $conexao = Conexao::conectar();
        $sql = "SELECT * FROM Produto";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function insert($dados) {
        $conexao = Conexao::conectar();
        $sql = "INSERT INTO Produto (nome, descricao, preco, quantidade_estoque, id_fornecedor) VALUES (:nome, :descricao, :preco, :quantidade_estoque, :id_fornecedor)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $dados['nome']);
        $stmt->bindValue(':descricao', $dados['descricao']);
        $stmt->bindValue(':preco', $dados['preco']);
        $stmt->bindValue(':quantidade_estoque', $dados['quantidade_estoque']);
        $stmt->bindValue(':id_fornecedor', $dados['id_fornecedor']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return "Produto inserido com sucesso";
        } else {
            throw new Exception("Erro ao inserir produto");
        }
    }

    public static function update($id, $dados) {
        $conexao = Conexao::conectar();
        $sql = "UPDATE Produto SET nome = :nome, descricao = :descricao, preco = :preco, quantidade_estoque = :quantidade_estoque, id_fornecedor = :id_fornecedor WHERE id_produto = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $dados['nome']);
        $stmt->bindValue(':descricao', $dados['descricao']);
        $stmt->bindValue(':preco', $dados['preco']);
        $stmt->bindValue(':quantidade_estoque', $dados['quantidade_estoque']);
        $stmt->bindValue(':id_fornecedor', $dados['id_fornecedor']);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return "Produto atualizado com sucesso";
        } else {
            throw new Exception("Erro ao atualizar produto");
        }
    }

    public static function delete($id) {
        $conexao = Conexao::conectar();
        $sql = "DELETE FROM Produto WHERE id_produto = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return "Produto removido com sucesso";
        } else {
            throw new Exception("Erro ao remover produto");
        }
    }
}
?>
