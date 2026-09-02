<?php

declare(strict_types=1);

namespace App\Controller;

class ItemsController extends AppController
{
    /**
     * Add method
     *
     * @param string|null $listId Shopping list id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(?string $listId = null)
    {
        $list = $this->Items->ShoppingLists->get($listId);
        $item = $this->Items->newEmptyEntity();

        if ($this->request->is('post')) {
            $item = $this->Items->patchEntity($item, $this->request->getData());
            $item->shopping_list_id = $listId;

            if ($this->Items->save($item)) {
                $this->Flash->success('Item adicionado!');
                return $this->redirect(['controller' => 'ShoppingLists', 'action' => 'view', $listId]);
            }
            $this->Flash->error('Erro ao adicionar item.');
        }

        $this->set(compact('item', 'list'));
    }
   public function edit(?string $id = null)
    {
        $item = $this->Items->get($id, contain: ['ShoppingLists']);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $item = $this->Items->patchEntity($item, $this->request->getData());
            if ($this->Items->save($item)) {
                $this->Flash->success('Item atualizado!');

                // Redireciona diretamente para a rota amigável
                return $this->redirect('/listas/' . $item->shopping_list_id);
            }
            $this->Flash->error('Erro ao atualizar.');
        }

        $this->set(compact('item'));
    }

    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $item = $this->Items->get($id);
        $listId = $item->shopping_list_id;

        if ($this->Items->delete($item)) {
            $this->Flash->success('Item removido.');
        } else {
            $this->Flash->error('Erro ao remover.');
        }

        return $this->redirect(['controller' => 'ShoppingLists', 'action' => 'view', $listId]);
    }

   public function toggle(?string $id = null)
    {
        $this->request->allowMethod(['post']);
        $item = $this->Items->get($id);
        $item->purchased = $item->purchased ? 0 : 1;
        $saved = $this->Items->save($item);

        if ($this->request->is('ajax') || $this->request->accepts('application/json')) {
            // Recalcula o progresso atualizado da lista
            $total = $this->Items->find()->where(['shopping_list_id' => $item->shopping_list_id])->count();
            $bought = $this->Items->find()->where([
                'shopping_list_id' => $item->shopping_list_id,
                'purchased' => 1
            ])->count();
            $percent = $total > 0 ? round(($bought / $total) * 100) : 0;

            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => (bool)$saved,
                    'purchased' => (bool)$item->purchased,
                    'total' => $total,
                    'bought' => $bought,
                    'percent' => $percent
                ]));
        }

        return $this->redirect(['controller' => 'ShoppingLists', 'action' => 'view', $item->shopping_list_id]);
    }
}
