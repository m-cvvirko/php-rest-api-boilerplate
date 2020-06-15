<?php

class News
{
	public $id;
	public $data;


	function __construct($withProps = true) { 
        if ( !$withProps) {
            unset( $this->id );
            unset( $this->data );
        }
    }

    public function mapFromRequest($r) {
		$this->id = isset($r['id']) ? $r['id'] : null;
        $this->data = isset($r['data']) ? $r['data'] : '';
        return $this;
    }

    public static function anonimyze($me) {
        unset( $me['id']);
        unset( $me['data']);
        return $me;
    }
}
?>