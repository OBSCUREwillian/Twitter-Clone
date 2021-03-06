<?php
    namespace App\Models;
    use MF\Model\Model;
use PDOException;

class Usuario extends Model{
        private $id;
        private $nome;
        private $email;
        private $senha;


        public function __get($atributo) {
            return $this->$atributo;
        }

        public function __set($atributo, $valor) {
            $this->$atributo = $valor;
        }


        //. Salvar 


        public function salvar() {

            //*query que vai ser encaminhada para o banco de dados
            $query = "insert into 
                        usuarios(nome, email, senha) 
                    values 
                        (:nome, :email, :senha)
            ";

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':nome', $this->__get('nome'));
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':senha', $this->__get('senha'));
            $stmt->execute();

            return $this;        
        }


        //. Validar se um cadastro pode ser feito 
        public function validarCadastro() {

            $valido = true;            
            $nome = $this->__get('nome');            
            $senha = $this->__get('senha');
            $email = $this->__get('email');

            $naoTemArroba = false;
            $usuarioNull = false;

            if(strpos($email, '@') === false){
                $naoTemArroba = true;
            }

            if(strlen($nome) < 5) {
                $valido = false;
            }

            if($email === null){
                $usuarioNull = true;
            }

            if(strlen($senha) < 5) {            
                $valido =false;    
                
            }           
            

            $erros = ['usuarioNull'=>$usuarioNull, 'valido'=>$valido, 'naotemArroba'=>$naoTemArroba];
            
            return $erros;
        }

        //. Recuperar um usuário por e-mail para verificar se ja existe 
        public function getUsuarioPorEmail($email) {
            $query = 'select 
                        nome, email 
                    from 
                        usuarios 
                    where 
                        email = :email                   
            ';

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $soma = $stmt->rowCount();   

            $resultado = 0;
            if($soma > 0) {
                $resultado = 'Encontrado';
            }else {
                $resultado = 'email valido';
            }

            return $resultado;            
        }


        public function autenticar(){

            $query= 'select 
                        id, nome, email
                    from 
                        usuarios
                    where 
                        email = :email and senha = :senha
            ';

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':senha', $this->__get('senha'));
            $stmt->execute();
            $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

            if(!empty($usuario['id']) && !empty($usuario['nome'])){
                $this->__set('id', $usuario['id']);
                $this->__set('nome', $usuario['nome']);
            }

            return $this;
            
        }

        public function getAll(){
            $query = 'select 
                        u.id, 
                        u.nome,
                        u.email,
                        (
                            select
                                count(*)
                            from
                                usuarios_seguidores as us
                            where
                                us.id_usuario = :id_usuario and us.id_usuario_seguindo = u.id

                        ) as seguindo_sn
                    from 
                        usuarios as u
                    where 
                        u.nome like :nome and u.id != :id_usuario
            ';

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':nome', '%' . $this->__get('nome') . '%');
            $stmt->bindValue(':id_usuario', $this->__get('id'));
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        
        public function getInfoUsuario(){
            $query = 'select 
                        nome 
                    from 
                        usuarios
                    where
                        id = :id_usuario
            ';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function getTotalTeets(){
            $query = 'select 
                        count(*) as total_tweets
                    from 
                        tweets
                    where
                        id_usuario = :id_usuario
            ';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }


        public function getTotalSeguindo(){
            $query = 'select 
                        count(*) as total_seguindo
                    from 
                        usuarios_seguidores
                    where
                        id_usuario = :id_usuario
            ';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }



        public function getTotalSeguidores(){
            $query = 'select 
                        count(*) as total_seguidores
                    from 
                        usuarios_seguidores
                    where
                        id_usuario_seguindo = :id_usuario
            ';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        
    }    
    

?>