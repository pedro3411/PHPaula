<?php

class UsuarioDAO{

    public  function create(Usuario $usuario){
        try{
            $sql = "INSERT INTO usuario (nome,sobrenome,idade,sexo)
            VALUES(:nome,:sobrenome,:idade,:sexo)";
            
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql ->bindValue(":nome",$usuario->getNome());
            $p_sql ->bindValue(":sobrenome",$usuario->getSobrenome());
            $p_sql ->bindValue(":idade",$usuario->getIdade());
            $p_sql ->bindValue(":sexo",$usuario->getSexo());

            return $p_sql->execute();
        }catch(Exception $e){
            print "Erro ao inserir um usuário <br>".$e.'<br>';
        }
    }

    public function read(){
        try{
            $sql = "SELECT * FROM usuario order by nome asc";
            $result = Conexao::getConexao()->query($sql);
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach($lista as $l){
                $f_lista[] = $this->listaUsuarios($l);
            }

            return $f_lista;
        }catch(Exception $e){
            print "Erro ao buscar usuário <br>".$e.'<br>';
        }
    }
    public function update(Usuario $usuario){
        try{
            $sql = "UPDATE usuario SET

                nome =:nome,
                sobrenome =:sobrenome,
                idade =:idade,
                sexo =:sexo
                
                WHERE id =:id";
             $p_sql = Conexao::getConexao()->prepare($sql);
             $p_sql ->bindValue(":nome",$usuario->getNome());
             $p_sql ->bindValue(":sobrenome",$usuario->getSobrenome());
             $p_sql ->bindValue(":idade",$usuario->getIdade());
             $p_sql ->bindValue(":sexo",$usuario->getSexo());
             $p_sql ->bindValue(":id",$usuario->getId());
 
             return $p_sql->execute();
         }catch(Exception $e){
             print "Erro ao atualizar um usuário <br>".$e.'<br>';
         
        }
    }
    
    public function delete(Usuario $usuario){
        try{
            $sql = "DELETE FROM usuario WHERE id = :id";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":id",$usuario->getId());
            return $p_sql->execute();
        }catch(Exception $e){
            print "Erro ao excluir um usuário <br>".$e.'<br>';
    }
    }

    private function listaUsuarios($row){
        $usuario = new Usuario();
        $usuario->setId($row['id']);
        $usuario->setNome($row['nome']);
        $usuario->setSobrenome($row['sobrenome']);
        $usuario->setIdade($row['idade']);
        $usuario->setSexo($row['sexo']);

        return $usuario;

    }

}

?>