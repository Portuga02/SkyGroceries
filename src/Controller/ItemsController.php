<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Items Controller
 *
 * @property \App\Model\Table\ItemsTable $Items
 */
class ItemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Items->find()
            ->contain(['ShoppingLists']);
        $items = $this->paginate($query);

        $this->set(compact('items'));
    }

    /**
     * View method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $item = $this->Items->get($id, contain: ['ShoppingLists']);
        $this->set(compact('item'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($shoppingListId = null)
    {
        $item = $this->Items->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['shopping_list_id'] = $shoppingListId;

            // Garante que se a quantidade vier vazia, assume 1
            if (empty($data['quantity'])) {
                $data['quantity'] = 1;
            }

            $item = $this->Items->patchEntity($item, $data);

            if ($this->Items->save($item)) {
                $this->Flash->success(__('Item adicionado com sucesso!'));
                return $this->redirect(['controller' => 'ShoppingLists', 'action' => 'view', $shoppingListId]);
            }
            $this->Flash->error(__('Não foi possível adicionar o item. Tente novamente.'));
        }

        $this->set(compact('item', 'shoppingListId'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $item = $this->Items->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $item = $this->Items->patchEntity($item, $this->request->getData());
            if ($this->Items->save($item)) {
                $this->Flash->success(__('Item salvo com sucesso!'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->success(__('Item removido com sucesso!'));
        }
        $shoppingLists = $this->Items->ShoppingLists->find('list', limit: 200)->all();
        $this->set(compact('item', 'shoppingLists'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $item = $this->Items->get($id);
        if ($this->Items->delete($item)) {
            $this->Flash->success(__('The item has been deleted.'));
        } else {
            $this->Flash->error(__('The item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
