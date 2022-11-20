<?php

namespace Pablo\ApiProduct\Controllers;

use Pablo\ApiProduct\Entity\User\Access\Access;
use Pablo\ApiProduct\MessageServices\MessageResponseService;
use Pecee\Http\Request;
use Pecee\Http\Response;
use Pecee\SimpleRouter\SimpleRouter as Router;

abstract class  AbstractController implements EntityControllerInterface
{

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var Request
     */
    protected $request;

    protected $access;

    protected $messageResponseService;

    /**
     * Constructor for AbstractController.
     */
    public function __construct()
    {
        $this->request = Router::router()->getRequest();
        $this->response =  new Response($this->request);
        $this->access = new Access();
        $this->messageResponseService = new MessageResponseService();
    }

    /**
     * Set headers for request.
     *
     * @return void
     */
    public function setCors()
    {
        $this->response->header('Access-Control-Allow-Origin: *');
        $this->response->header('Access-Control-Request-Method: GET');
        $this->response->header('Access-Control-Request-Method: *');
        $this->response->header('Access-Control-Allow-Credentials: true');
        $this->response->header('Access-Control-Max-Age: 3600');
    }
}
