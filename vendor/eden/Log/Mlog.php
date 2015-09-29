<?php

namespace Eden\Log;

/**
 * Mlog
 * Model for logger
 *
 */
class MLog
{

 /**
   * Properties
   *
   */
  private $timestamp = array();
  private $pos = 0;


  /**
   * Constructor
   *
   */
  public function __construct() {


  }


  /**
   * Timestamp, log a event with a time.
   *
   * @param string $domain is the module or class.
   * @param string $where a more specific place in the domain.
   * @param string $comment on the timestamp.
   *
   */
  public function Timestamp($domain, $where, $comment=null) {

    $now = microtime(true);
    $this->timestamp[] = array(
      'domain'  => $domain,
      'where'   => $where,
      'comment' => $comment,
      'when'    => $now,
      'memory'  => memory_get_usage(true),
    );
    if($this->pos) {
      $this->timestamp[$this->pos - 1]['memory-peak'] = memory_get_peak_usage(true);
      $this->timestamp[$this->pos - 1]['duration']    = $now - $this->timestamp[$this->pos - 1]['when'];
    }
    $this->pos++;
  }

   /**
   * Get timestamps
   */
  public function getTimestamps() {
    return $this->timestamp;
  }

  /**
   * Print page load time.
   *
   * @return string with the page load time.
   *
   */
  public function getPageLoadTime() {
    $first = $this->timestamp[0]['when'];
    $last = $this->timestamp[count($this->timestamp) - 1]['when'];
    $loadtime = round($last - $first, 3);
    return $loadtime;
  }
  /**
   * Print memory peak.
   *
   * @return string with the memory peak.
   *
   */
  public function getMemoryPeak() {
    $peak = round(memory_get_peak_usage(true) / 1024 / 1024, 2);
    //$html = "<p>Peek memory consumption was {$peek} MB.</p>";
    return $peak;
  }



	/*
	* Test if class is loaded
	*/
	public function saySomething($word) {
		echo $word;
	}

}