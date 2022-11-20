<?php

namespace Pablo\ApiProduct\Controllers;

use Pablo\ApiProduct\Term\Status;

class StatusTermController extends AbstractController {
    public function addTerm() {
        if ($this->access->addTermAccessCheck()) {
            $status = new Status();
            $status->name = $this->request->name;
            $status->create();
        } else {
            $this->response->httpCode(403);
        }
    }
}