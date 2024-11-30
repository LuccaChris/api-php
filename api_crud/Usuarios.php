<?php
include 'Conexao.php';

class Usuarios {

    public static function select($id) {
        $conexao = Conexao::conectar();
        $sql = "SELECT id_usuario, nome, email, cargo FROM Usuarios WHERE id_usuario = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            throw new Exception("Usuário não encontrado");
        }
    }

    public static function selectAll() {
        $conexao = Conexao::conectar();
        $sql = "SELECT id_usuario, nome, email, cargo FROM Usuarios";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function insert($dados) {
        $conexao = Conexao::conectar();
        $sql = "INSERT INTO Usuarios (nome, email, senha, cargo) VALUES (:nome, :email, :senha, :cargo)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $dados['nome']);
        $stmt->bindValue(':email', $dados['email']);
        $stmt->bindValue(':senha', password_hash($dados['senha'], PASSWORD_BCRYPT));
        $stmt->bindValue(':cargo', $dados['cargo']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return "Usuário inserido com sucesso";
        } else {
            throw new Exception("Erro ao inserir usuário");
        }
    }

    public static function update($id, $dados) {
        $conexao = Conexao::conectar();
        $sql = "UPDATE Usuarios SET nome = :nome, email = :email, senha = :senha, cargo = :cargo WHERE id_usuario = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $dados['nome']);
        $stmt->bindValue(':email', $dados['email']);
        $stmt->bindValue(':senha', password_hash($dados['senha'], PASSWORD_BCRYPT));
        $stmt->bindValue(':cargo', $dados['cargo']);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return "Usuário atualizado com sucesso";
        } else {
            throw new Exception("Erro ao atualizar usuário");
        }
    }

    public static function delete($id) {
        $conexao = Conexao::conectar();
        $sql = "DELETE FROM Usuarios WHERE id_usuario = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return "Usuário removido com sucesso";
        } else {
            throw new Exception("Erro ao remover usuário");
        }
    }
}
?>
