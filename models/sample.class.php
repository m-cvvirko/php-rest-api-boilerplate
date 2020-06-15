<?php

require_once(__DIR__ . '/../utils/helperutils.class.php');

class Sample
{
    private const DEFAULT = 'Sample';

	public $id;
	public $data;
	public $code;

	function __construct($withProps = true) { 
        if ( !$withProps) {
            unset( $this->id );
            unset( $this->data );
            unset( $this->code );
        }
    }

    public function mapFromRequest($r) {
        $this->data = isset($r['data']) ? $r['data'] : self::DEFAULT;
		$this->id = isset($r['id']) ? $r['id'] : null;
		$this->code = isset($r['code']) ? $r['code'] : HelperUtils::generateMD5($this->data);
        return $this;
    }

    public static function anonimyze($me) {
        unset( $me['id']);
        unset( $me['data']);
        unset( $me['code']);
        return $me;
    }
}
?>