<?php
// Inclua todos os serviços necessários
include 'ProdutoService.php';
include 'UsuariosService.php';

// Configuração de cabeçalhos para JSON
header("Content-Type: application/json; charset=UTF-8");

if (isset($_GET['url'])) {
    $url = explode('/', $_GET['url']);

    // Verifica se a URL é da API
    if ($url[0] == 'api') {
        array_shift($url); // Remove "api" da URL

        // Nome do serviço a ser chamado
        $service = ucfirst($url[0]) . 'Service'; // Ex.: "produto" -> "ProdutoService"
        array_shift($url); // Remove o nome do serviço

        // Verifica o método HTTP (GET, POST, etc.)
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        try {
            // Instancia o serviço e chama o método dinamicamente
            if (class_exists($service)) {
                $response = call_user_func_array(array(new $service, $method), $url);
                http_response_code(200);
                echo json_encode(array('status' => 'success', 'data' => $response));
            } else {
                throw new Exception("Serviço '$service' não encontrado.");
            }
        } catch (Exception $e) {
            // Resposta em caso de erro
            http_response_code(400);
            echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        }
    }
} else {
    // Resposta padrão para requisições inválidas
    http_response_code(404);
    echo json_encode(array('status' => 'error', 'message' => 'Recurso não encontrado.'));
}
?>