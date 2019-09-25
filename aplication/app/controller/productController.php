<?php 

namespace app\dontroller; 
use \app\model\product;

class productController { 
 
    /**
     * Exibe o formulário de criação de usuário
     */
    public function create()
    {
        \app\view::make('users.create');
    }
 
 
    /**
     * Processa o formulário de criação de usuário
     */
    public function store()
    {
        // pega os dados do formuário
        $nome = isset($_POST['name']) ? $_POST['name'] : null;
        $descricao = isset($_POST['email']) ? $_POST['email'] : null;
        $categoria = isset($_POST['gender']) ? $_POST['gender'] : null;
        $preco = isset($_POST['birthdate']) ? $_POST['birthdate'] : null;
        $foto = isset($_POST['email']) ? $_POST['email'] : null;
        $opcao = isset($_POST['gender']) ? $_POST['gender'] : null;
        $quant = isset($_POST['birthdate']) ? $_POST['birthdate'] : null;
 
        if (product::save($nome, $descricao, $categoria, $preco, $foto, $opcao, $quantMin, $quantMax, $frete))
        {
            header('Location: /');
            exit;
        }
    }
 
 

    /** * Listagem de usuários */ 
    public function index() { 
        $users = User::selectAll(); 
        \App\View::make('users.index', [ 'users' => $users,]);
    }
 
    /**
     * Exibe o formulário de edição de usuário
     */
    public function edit($id)
    {
        $user = User::selectAll($id)[0];
 
        \App\View::make('users.edit',[
            'user' => $user,
        ]);
    }
 
 
    /**
     * Processa o formulário de edição de usuário
     */
    public function update()
    {
        // pega os dados do formuário
        $id = $_POST['id'];
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
        $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : null;
 
        if (User::update($id, $name, $email, $gender, $birthdate))
        {
            header('Location: /');
            exit;
        }
    }
 
 
    /**
     * Remove um usuário
     */
    public function remove($id)
    {
        if (User::remove($id))
        {
            header('Location: /');
            exit;
        }
    }
}