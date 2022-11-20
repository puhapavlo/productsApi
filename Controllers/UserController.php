<?php

namespace Pablo\ApiProduct\Controllers;

use Pablo\ApiProduct\Entity\User\User;
use Pablo\ApiProduct\Entity\User\Access\Access;

/**
 * Controller for User Entity.
 */
class UserController extends AbstractController
{

    /**
     * @var User
     */
    protected $user;



    public function __construct()
    {
        $this->user = new User();
        parent::__construct();
    }

    public function getUsers()
    {
        if ($this->access->viewUserAccessCheck()) {
            $this->messageResponseService::setMessage();
        } else {
            $this->response->httpCode(403);
        }
    }

    public function deleteUser($id)
    {
        if ($this->access->deleteUserAccessCheck()) {
            $this->response->json($this->user->delete($id));
        } else {
            $this->response->httpCode(403);
        }
    }

    public function updateUser($id) {
        if ($this->access->editUserAccessCheck()) {
            $this->user->username = $this->request->username;
            if (isset($this->request->password)) {
                $this->user->password = $this->request->password;
            }
            $this->response->json([$this->user->update($id)]);
        } else {
            $this->response->httpCode(403);
        }
    }

    public function createUser() {
            $this->user->username = $this->request->username;
            $this->user->password = $this->request->password;
            $this->user->role = $this->request->role;
            $this->response->json([$this->user->create()]);
    }

}
