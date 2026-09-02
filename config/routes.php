<?php

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return function (RouteBuilder $routes): void {

    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {
        $builder->connect('/', ['controller' => 'ShoppingLists', 'action' => 'index']);

        $builder->connect('/listas', ['controller' => 'ShoppingLists', 'action' => 'index']);
        $builder->connect('/listas/nova', ['controller' => 'ShoppingLists', 'action' => 'add']);

        // Uso correto: encadeando ->setPass(['id'])
        $builder->connect('/listas/{id}', ['controller' => 'ShoppingLists', 'action' => 'view'])
            ->setPass(['id'])
            ->setPatterns(['id' => '\d+']);

        $builder->connect('/listas/{id}/editar', ['controller' => 'ShoppingLists', 'action' => 'edit'])
            ->setPass(['id'])
            ->setPatterns(['id' => '\d+']);

        $builder->connect('/listas/{id}/excluir', ['controller' => 'ShoppingLists', 'action' => 'delete'])
            ->setPass(['id'])
            ->setPatterns(['id' => '\d+']);

        // Uso correto: encadeando ->setPass(['listId'])
        $builder->connect('/itens/adicionar/{listId}', ['controller' => 'Items', 'action' => 'add'])
            ->setPass(['listId'])
            ->setPatterns(['listId' => '\d+']);

        $builder->connect('/itens/{id}/editar', ['controller' => 'Items', 'action' => 'edit'])
            ->setPass(['id'])
            ->setPatterns(['id' => '\d+']);

        $builder->connect('/itens/{id}/excluir', ['controller' => 'Items', 'action' => 'delete'])
            ->setPass(['id'])
            ->setPatterns(['id' => '\d+']);

        $builder->connect('/itens/{id}/marcar', ['controller' => 'Items', 'action' => 'toggle'])
            ->setPass(['id'])
            ->setPatterns(['id' => '\d+']);

        $builder->fallbacks();

    });
};