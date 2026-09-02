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
    $list = $this->ShoppingLists->get($id, contain: ['Items']);

    $items = $list->items ?? [];
    $totalCount = count($items);
    $purchasedCount = collection($items)->filter(fn($item) => (bool)$item->purchased)->count();

    $groupedItems = collection($items)->groupBy(function ($item) {
        return !empty($item->category) ? $item->category : '📦 Outros';
    })->toArray();

    // groupedItems OBRIGATÓRIO estar aqui dentro:
    $this->set(compact('list', 'totalCount', 'purchasedCount', 'groupedItems'));
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
