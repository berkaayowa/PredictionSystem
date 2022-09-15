<?php

namespace Controller\Component;
use BerkaPhp\Controller\component\BerkaPhpComponent;

class EmailComponent extends BerkaPhpComponent {

	private $email;

	function __construct()
	{
		parent::__construct();
		$this->setName('Email');
		$this->setAuthor('berka');
		$this->setDescription('');
		$this->email = new \Email();

	}

    function initialize() {
        $this->email = new \Email();
        return $this;
    }

	function send($name,$subject, $title,$message, $to) {
		if(!empty ($to)) {
			if($this->email->sendEmail($name,$title." ".$subject,$to,$message)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public function addAttachment($content, $name) {
		$this->email->addAttachment($content, $name);
	}

}

?>