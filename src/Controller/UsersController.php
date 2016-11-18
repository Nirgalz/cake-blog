<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['register', 'logout']);
    }

    public function isAuthorized($user)
    {

        // The user can edit and delete its profile
        if (in_array($this->request->action, ['view', 'edit', 'delete'])) {
            $profileId = (int)$this->request->params['pass'][0];
            if ($profileId === $this->Auth->user('id')) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }


    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }


    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($name = null)
    {
        $name = str_replace("-", " ", $name);

        $user = $this->Users->find('all', [
            'contain' => ['Articles', 'Comments.Articles']
        ])->where(['username' => $name])->first();

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {


        $file = $this->Users->Files->newEntity();
        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $picture = $this->Upload->getFile($this->request->data['upload'],'avatar', false);
                $this->request->data['upload'] = $picture;

                $file = $this->Users->Files->patchEntity($file, $this->request->data);
                $file->name = $picture;
                $file->user_id = $user->id;

                if ($this->Users->Files->save($file)) {
                    return $this->redirect($this->referer());
                }
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function changerole($id = null)
    {

        $this->autoRender = false;
        $article = $this->Users->get($id);


        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Users->patchEntity($article, $this->request->data);

            $this->Users->save($article);
        }



    }

    public function register()
    {

        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user->role = 'unconfirmed';

            if ($this->Users->save($user)) {
                $email = new Email('default');
                $email->to($user->email)
                    ->subject('SiteNAme - please confirm your mail ')
                    ->send('Hello, '.$user->username . '<br>'. 'Please confirm your mail by clicking this link : http://nicolash.simplon-epinal.tk/blog/validation/?email=' . $user->email);
                $this->Flash->success(__('Please check your email for validation'));

                return $this->redirect(['controller' => 'Articles', 'action' => 'blogindex']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);


    }

    public function validation() {


            $user = $this->Users->find()->where(['email' => $this->request->query('email')])->first();
            if ($user->role === 'unconfirmed' ) {
                $user = $this->Users->patchEntity($user, $this->request->data);
                $user->role = 'guest';
                $this->Users->save($user);

                $this->Flash->success(__('Email confirmed, thanks for registering.'));

            }




    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
/*
        $status = $this->ImageTool->resize(array(
            'input' => $this->request->data('file'),
            'output' => $output_file,
            'width' => 600,
            'height' => 600,
            'mode' => 'fit',
            'paddings' => false,
            'afterCallbacks' => array(
                array('watermark', array('watermark' => $watermark_file, 'position' => 'bottom-right')),
                array('unsharpMask'),
            )
        ));*/

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
