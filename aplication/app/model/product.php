<?php 

namespace app\model; 
use app\db; 

class product { 

 
    /**
     * Salva no banco de dados um novo usuário
     */
    public static function save($nome, $descricao, $categoria, $preco, $foto, $opcao, $quantMin, $quantMax, $frete)
    {
        // validação (bem simples, só pra evitar dados vazios)
        if (empty($nome) || empty($descricao) || empty($categoria) || empty($preco) || empty($foto) || empty($opcao) || empty($quantMin) || empty($quantMax) || empty($frete))
        {
            echo "Volte e preencha todos os campos";
            return false;
        }
          
        // insere no banco
        $DB = db_connect();
        $sql = "INSERT INTO produto(nome, descricao, categoria, preco, foto, opcao, quantMin, quantMax, frete) VALUES(:nome, :descricao, :categoria, :preco, :foto, :opcao, :quantMin, :quantMax, :frete)";
        $stmt = $DB->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':foto', $foto);
        $stmt->bindParam(':opcao', $opcao);
        $stmt->bindParam(':quantMin', $quantMin);
        $stmt->bindParam(':quantMax', $quantMax);
        $stmt->bindParam(':frete', $frete);
 
        if ($stmt->execute())
        {
            return true;
        }
        else
        {
            echo "Erro ao cadastrar";
            print_r($stmt->errorInfo());
            return false;
        }
    }
 
 






        
    public static function selectAll($id = null) { 
        $where = ''; 

        if (!empty($id)) { 
            $where = 'WHERE id = :id'; 
        } 

        $sql = sprintf("SELECT id, name, email, gender, birthdate FROM users %s ORDER BY name ASC", $where);
        $DB = new DB; 
        $stmt = $DB->prepare($sql);
 
        if (!empty($where))
        {
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        }
 
        $stmt->execute();
 
        $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);
 
        return $products;
    }

 
    /**
     * Altera no banco de dados um usuário
     */
    public static function update($id, $name, $email, $gender, $birthdate)
    {
        // validação (bem simples, só pra evitar dados vazios)
        if (empty($name) || empty($email) || empty($gender) || empty($birthdate))
        {
            echo "Volte e preencha todos os campos";
            return false;
        }
          
        // a data vem no formato dd/mm/YYYY
        // então precisamos converter para YYYY-mm-dd
        $isoDate = dateConvert($birthdate);
          
        // insere no banco
        $DB = new DB;
        $sql = "UPDATE users SET name = :name, email = :email, gender = :gender, birthdate = :birthdate WHERE id = :id";
        $stmt = $DB->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':birthdate', $isoDate);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
 
        if ($stmt->execute())
        {
            return true;
        }
        else
        {
            echo "Erro ao cadastrar";
            print_r($stmt->errorInfo());
            return false;
        }
    }
 
 
    public static function remove($id)
    {
        // valida o ID
        if (empty($id))
        {
            echo "ID não informado";
            exit;
        }
          
        // remove do banco
        $DB = new DB;
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $DB->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
          
        if ($stmt->execute())
        {
            return true;
        }
        else
        {
            echo "Erro ao remover";
            print_r($stmt->errorInfo());
            return false;
        }
    }
}