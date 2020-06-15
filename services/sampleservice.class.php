<?php

require_once(__DIR__ . '/../repositories/samplerepository.class.php');
require_once(__DIR__ . '/../models/sample.class.php');
require_once(__DIR__ . '/../utils/helperutils.class.php');

class SampleService {

    private $repository;

	function __construct() {
		$this->repository = new SampleRepository();
    }

    public function get($id) {
        if(isset($id)) {
			$obj = null;
			if(is_numeric($id)) {
				$obj = $this->repository->get($id);
			} else {
				$obj = $this->repository->getByCode($id);
			}
			return $obj;
		} else {
			$objs = $this->repository->getAll();
			if(!isset($objs)) {
				$objs = [];
			}
			return $objs;
		}
    }
    
    public function save($sample) {
        return $this->repository->insert($sample);
    }

	public function delete($id) {
        return $this->repository->delete($id);
    }

    public function update($id, $sampleUpdate) {
		$sample = null;
		$obj = $this->repository->get($id);
		if(isset($dbRow)) {
			$sample = new Sample();
			$sample = HelperUtils::mergeObjectWithArray($sample, $obj);
			$sampleUpdated = HelperUtils::mergeObjectWithArray( $sample, $sampleUpdate);
			$sample = $this->repository->update($sampleUpdated);
        }
        return $sample;
    }
}

?>