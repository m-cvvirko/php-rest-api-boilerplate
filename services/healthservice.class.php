<?php

require_once(__DIR__ . '/../repositories/repository.class.php');
require_once(__DIR__ . '/../utils/helperutils.class.php');

class HealthService {

    private $repository;

	function __construct() {
		$this->repository = new Repository();
    }

    public function getStatus() {
		$row = $this->repository->getStatus();
    }
}
