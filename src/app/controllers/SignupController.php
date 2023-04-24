<?php

use Phalcon\Mvc\Controller;

// signup controller
class SignupController extends Controller
{

    public function IndexAction()
    {
        // this is the default action
    }

    public function registerAction()
    {
        $user = new Users();
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $values = array(
            'name' => $this->escaper->escapeHtml($name),
            'email' => $this->escaper->escapeHtml($email),
            'password' => $this->escaper->escapeHtml($password),
        );
        $user->assign(
            $values,
            [
                'name',
                'email',
                'password'
            ]
        );
        if ($name != strip_tags($name)) {
            $this->logger->info($name);
        }
        if ($email != strip_tags($email)) {
            $this->logger->info($email);
        }
        if ($password != strip_tags($password)) {
            $this->logger->info($password);
        }

        $success = $user->save();

        $this->view->success = $success;

        if ($success) {
            $this->view->message = "Register succesfully";
        } else {
            $this->view->message = "Not Register succesfully due to following reason: <br>" .
                implode("<br>", $user->getMessages());
        }
    }
}
