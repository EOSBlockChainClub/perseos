<?php

class Messages extends BaseClass
{
	private $messages;
	
	public static $type2BootstrapClass = array(
		'info'		=> 'success',
		'warning'	=> 'warning',
		'error'		=> 'danger',
		'tip'			=> 'info',
	);
		
	function __construct()
	{		
		$this->messages = array
		(
			'info'		=> $this->getArray($_SESSION['messages']['info']),
			'warning'	=>	$this->getArray($_SESSION['messages']['warning']),
			'error'		=> $this->getArray($_SESSION['messages']['error']),
			'tip'			=> $this->getArray($_SESSION['messages']['tip']),
		);
		unset($_SESSION['messages']['info'], $_SESSION['messages']['warning'], $_SESSION['messages']['error'], $_SESSION['messages']['tip']);
	}	
	
	public function update()
	{		
		$this->messages['info'] 	+= $this->getArray($_SESSION['messages']['info']);
		$this->messages['warning']	+= $this->getArray($_SESSION['messages']['warning']);
		$this->messages['error']	+= $this->getArray($_SESSION['messages']['error']);
		$this->messages['tip']		+= $this->getArray($_SESSION['messages']['tip']);
		
		unset($_SESSION['messages']['info'], $_SESSION['messages']['warning'], $_SESSION['messages']['error'], $_SESSION['messages']['tip']);
	}
	
	private function getMessages($type, $group)
	{
		if(in_array($type, array('info', 'warning', 'error', 'tip')))
		{
			$out = array();
			$class = 'alert alert-'.self::$type2BootstrapClass[$type].' alert-dismissible';
			$dismiss = '<button type="button" class="close" data-dismiss="alert" aria-label="[TR#Close]"><span aria-hidden="true">&times;</span></button>';
			
			foreach($this->messages[$type] as $msg)
			{
				$out[] = $group ? '<span>'.$msg.'</span>' : '<p class="'.$class.'">'.$dismiss.$msg.'</p>';
			}
			
			if($out) {
				$this->out .= $group ? '<p class="'.$class.'">'.$dismiss.join('<br>', $out).'</p>' : join('', $out);	
			}
		}
		return true;
	}	
	
	public function toString($type = '', $group = true)
	{
		$this->out = '';
		
		if($type)
		{
			$this->getMessages($type, $group);
		}
		else
		{
			$this->getMessages('info', $group);
			$this->getMessages('warning', $group);
			$this->getMessages('error', $group);
			$this->getMessages('tip', $group);
		}	
		
		return $this->out;
	}
	
	public function error($msg = '') 	{ $this->setMessage($msg, 'error'); }	
	public function warning($msg = '') 	{ $this->setMessage($msg, 'warning'); }	
	public function info($msg = '')		{ $this->setMessage($msg, 'info'); }	
	public function tip($msg = '')		{ $this->setMessage($msg, 'tip'); }	
	
	public function isError() 		{ return $this->isFilled($_SESSION['messages']['error']); }
	public function isWarning() 	{ return $this->isFilled($_SESSION['messages']['warning']); }
	
	private function setMessage($msg, $type) { $_SESSION['messages'][$type][] = $msg; }
}