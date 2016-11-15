<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 */
class ArticlesController extends AppController
{


    public function isAuthorized($user)
    {
        // All registered users can add articles
        if ($this->request->action === 'add') {
            return true;
        }

        // The owner of an article can edit and delete it
        if (in_array($this->request->action, ['edit', 'delete'])) {
            $articleId = (int)$this->request->params['pass'][0];
            if ($this->Articles->isOwnedBy($articleId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */

    public function search($search = null) {
        $this->paginate = [
            'contain' => ['Users'],
            'conditions' => ['body LIKE' => '%'.$search.'%']
        ];
        $articles = $this->paginate($this->Articles);

        $this->set(compact('articles', 'search'));
        $this->set('_serialize', ['articles']);
    }

    public function adindex()
    {


        $this->paginate = [
            'contain' => ['Users']
        ];
        $articles = $this->paginate($this->Articles);

        $this->set(compact('articles'));
        $this->set('_serialize', ['articles']);
    }

    public function blogindex($tag = null)
    {

        if (isset($tag)) {
            $this->paginate = [
                'contain' => ['Users', 'Comments.Users', 'Tags'],
                'conditions' => ['published' => 1],
                'limit' => 5,
                'order' => [
                    'created' => 'desc'
                ]
            ];
            $articles = $this->paginate($this->Articles->find()->matching('Tags', function(\Cake\ORM\Query $q) use ($tag) {
                return $q->where([
                    'Tags.name' => $tag
                ]);
            }));


        } else {
            $this->paginate = [
                'contain' => ['Users', 'Comments.Users', 'Tags'],
                'conditions' => ['published' => 1],
                'limit' => 5,
                'order' => [
                    'created' => 'desc'
                ]
            ];
            $articles = $this->paginate($this->Articles);


        }
        $comments = $this->Articles->Comments->find()
            ->contain(['Articles'])
            ->order(['Comments.created' => 'DESC'])
            ->limit(10);

        $tags = $this->Articles->Tags->find()->contain(['Articles']);


        $childComments = $this->Articles->Comments->find('all', [
            'contain' => 'Users'
        ])->where(['comment_id IS NOT' => 'NULL'])->toArray();



        $this->set(compact('articles', 'childComments', 'comments', 'tags'));
        $this->set('_serialize', ['articles']);
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($name = null)
    {
        $name = str_replace("-", " ", $name);


        $article = $this->Articles->find('all', [
            'contain' => ['Users', 'Tags', 'Comments.Users']
        ])->where(['title' => $name])->first();

        $childComments = $this->Articles->Comments->find('all', [
            'contain' => 'Users'
        ])->where(['comment_id IS NOT' => 'NULL'])->toArray();

        $this->set(compact('childComments'));
        $this->set('article', $article);
        $this->set('_serialize', ['article']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->data);
            $article->user_id = $this->Auth->user('id');
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The article could not be saved. Please, try again.'));
            }
        }
        $tags = $this->Articles->Tags->find('list', ['limit' => 200]);
        $this->set(compact('article', 'tags'));
        $this->set('_serialize', ['article']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['Tags']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->data);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The article could not be saved. Please, try again.'));
            }
        }
        $users = $this->Articles->Users->find('list', ['limit' => 200]);
        $tags = $this->Articles->Tags->find('list', ['limit' => 200]);
        $this->set(compact('article', 'users', 'tags'));
        $this->set('_serialize', ['article']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


}
