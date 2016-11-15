<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\Mailer\Email;

class ContactForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('name', 'string')
            ->addField('email', ['type' => 'string'])
            ->addField('body', ['type' => 'text']);
    }

    protected function _buildValidator(Validator $validator)
    {
        return $validator->add('name', 'length', [
            'rule' => ['minLength', 4],
            'message' => 'A name is required'
        ])->add('email', 'format', [
            'rule' => 'email',
            'message' => 'A valid email address is required',
        ]);
    }

    protected function _execute(array $data)
    {

        $email = new Email('default');
        $email->to('znirgal@gmail.com')
            ->subject('message sent from the blog by ' . $data['name'])
            ->send('Content : '.$data['body'] . '<br>'. 'mail : ' . $data['email']);
        // Send an email.
        return true;
    }
}