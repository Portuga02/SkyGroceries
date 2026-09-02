<?php

declare(strict_types=1);

namespace App\Controller;

class ShoppingListsController extends AppController
{
    public function index()
    {
        $lists = $this->ShoppingLists->find()
            ->contain('Items')
            ->orderBy(['ShoppingLists.created' => 'DESC'])
            ->all();

        $this->set(compact('lists'));
    }

    public function view($id = null)
    {
        $list = $this->ShoppingLists->get($id, contain: ['Items' => function ($q) {
            return $q->orderBy(['Items.purchased' => 'ASC', 'Items.name' => 'ASC']);
        }]);

        $purchasedCount = $list->items ? count(array_filter(
            $list->items,
            fn ($i) => $i->purchased
        )) : 0;

        $totalCount = $list->items ? count($list->items) : 0;

        $this->set(compact('list', 'purchasedCount', 'totalCount'));
    }

    public function add()
    {
        $list = $this->ShoppingLists->newEmptyEntity();

        if ($this->request->is('post')) {
            $list = $this->ShoppingLists->patchEntity($list, $this->request->getData());
            if ($this->ShoppingLists->save($list)) {
                $this->Flash->success('Lista criada com sucesso!');
                return $this->redirect(['action' => 'view', $list->id]);
            }
            $this->Flash->error('Não foi possível criar a lista.');
        }

        $this->set(compact('list'));
    }

    public function edit($id = null)
    {
        $list = $this->ShoppingLists->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $list = $this->ShoppingLists->patchEntity($list, $this->request->getData());
            if ($this->ShoppingLists->save($list)) {
                $this->Flash->success('Lista atualizada!');
                return $this->redirect(['action' => 'view', $list->id]);
            }
            $this->Flash->error('Erro ao atualizar.');
        }

        $this->set(compact('list'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $list = $this->ShoppingLists->get($id);

        if ($this->ShoppingLists->delete($list)) {
            $this->Flash->success('Lista excluída.');
        } else {
            $this->Flash->error('Erro ao excluir.');
        }

        return $this->redirect(['action' => 'index']);
    }
}
