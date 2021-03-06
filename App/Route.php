<?php
    namespace App;
    use MF\Init\Bootstrap;

    class Route extends Bootstrap {

        protected function initRoutes() {

            $routes['home'] = [
                'route' => '/',
                'controller' => 'indexController',
                'action' => 'index'

            ];
            
            $routes['inscreverse'] = [
                'route' => '/inscreverse',
                'controller' => 'indexController',
                'action' => 'inscreverse'

            ];
            
            $routes['registrar'] = [
                'route' => '/registrar',
                'controller' => 'indexController',
                'action' => 'registrar'

            ];

            $routes['email'] = [
                'route' => '/getEmail',
                'controller' => 'indexController',
                'action' => 'getEmail'
            ];
            
            $routes['autenticar'] = [
                'route' => '/autenticar',
                'controller' => 'AuthController',
                'action' => 'autenticar'
            ];

            $routes['timeline'] = [
                'route' => '/timeline',
                'controller' => 'AppController',
                'action' => 'timeline'
            ];

            $routes['sair'] = [
                'route' => '/sair',
                'controller' => 'AuthController',
                'action' => 'sair'
            ];

            $routes['tweet'] = [
                'route' => '/tweet',
                'controller' => 'AppController',
                'action' => 'tweet'
            ];
            
            $routes['conteudo'] = [
                'route' => '/conteudo',
                'controller' => 'AppController',
                'action' => 'conteudo'
            ];

            $routes['quem_seguir'] = [
                'route' => '/quem_seguir',
                'controller' => 'AppController',
                'action' => 'quemSeguir'
            ];

            $routes['pesquisar_usuarios'] = [
                'route' => '/pesquisar_usuarios',
                'controller' => 'AppController',
                'action' => 'pesquisarUsuarios'
            ];

            $routes['acao'] = [
                'route' => '/acao',
                'controller' => 'AppController',
                'action' => 'acao'
            ];

            $routes['remover'] = [
                'route' => '/remover',
                'controller' => 'AppController',
                'action' => 'remover'
            ];
            
            $routes['removerTweet'] = [
                'route' => '/remover_tweet',
                'controller' => 'AppController',
                'action' => 'removerTweet'
            ];
            
            $this->setRoutes($routes);
        }

        // /remover_tweet

        
        
    }

?>