<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;

class ShoppingListsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // Busca todas as listas sem limite de página, ordenando por data de criação (Decrescente)
        $shoppingLists = $this->ShoppingLists->find('all', [
            'order' => ['created' => 'DESC']
        ])->all();

        $this->set(compact('shoppingLists'));
    }

    /**
     * View method
     *
     * @param string|null $id Shopping List id.
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function view(?string $id = null)
    {
        $list = $this->ShoppingLists->get($id, contain: ['Items']);

        $items = $list->items ?? [];
        $totalCount = count($items);
        $purchasedCount = collection($items)->filter(fn ($item) => (bool)$item->purchased)->count();

        $groupedItems = collection($items)->groupBy(function ($item) {
            return !empty($item->category) ? $item->category : '📦 Outros';
        })->toArray();

        $this->set(compact('list', 'totalCount', 'purchasedCount', 'groupedItems'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $shoppingList = $this->ShoppingLists->newEmptyEntity();
        if ($this->request->is('post')) {
            $shoppingList = $this->ShoppingLists->patchEntity($shoppingList, $this->request->getData());
            if ($this->ShoppingLists->save($shoppingList)) {
                $this->Flash->success('Lista criada com sucesso.');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Não foi possível salvar a lista.');
        }
        $this->set(compact('shoppingList'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Shopping List id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     */
    public function edit(?string $id = null)
    {
        $shoppingList = $this->ShoppingLists->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $shoppingList = $this->ShoppingLists->patchEntity($shoppingList, $this->request->getData());
            if ($this->ShoppingLists->save($shoppingList)) {
                $this->Flash->success('Lista atualizada.');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Não foi possível atualizar a lista.');
        }
        $this->set(compact('shoppingList'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Shopping List id.
     * @return \Cake\Http\Response|null Redirects to index.
     */
    public function delete(?string $id = null): ?Response
    {
        $this->request->allowMethod(['post', 'delete']);
        $shoppingList = $this->ShoppingLists->get($id);
        if ($this->ShoppingLists->delete($shoppingList)) {
            $this->Flash->success('Lista removida.');
        } else {
            $this->Flash->error('Não foi possível remover a lista.');
        }

        return $this->redirect(['action' => 'index']);
    }
}
