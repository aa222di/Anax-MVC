<?php

namespace Eden\Log;

/**
 * Clog
 * Controller class for logger extension.
 *
 */
class CLog
{

	private $model;
	private $view;

	public function __construct() {
		$this->model = new Mlog();
		$this->view = new Vlog();
	}


	public function stamp($domain, $where, $comment=null) {
		$this->model->Timestamp($domain, $where, $comment);
	}

	public function renderLog() {

		$timestamps = $this->model->getTimestamps();
		
		if(empty($timestamps)) {
			return $this->view->noLog();
		}

		$memorypeak = $this->model->getMemoryPeak();
		$pageLoadTime = $this->model->getPageLoadTime();

		return $this->view->renderTimestampAsTable($timestamps, $memorypeak, $pageLoadTime);
	}

	/*
	* Test if class is loaded
	*/
	public function saySomething($word) {
		$this->model->saySomething('model:' . $word . "<br>");
		$this->view->saySomething('view:' . $word . "<br>");
		echo ('controller:' . $word);
	}

}