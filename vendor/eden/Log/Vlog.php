<?php

namespace Eden\Log;

/**
 * Vlog
 * View for logger
 *
 */
class VLog
{


  /**
   * Print all timestamp to a table.
   *
   * @return string with a html-table to display all timestamps.
   *
   */
  public function renderTimestampAsTable($timestamps, $memoryPeak, $pageLoadTime) {
    $prev = $first = $timestamps[0]['when'];
    $last = $timestamps[count($timestamps) - 1]['when'];
    $html = "<div class='log' style='background-color:#fff; color:#000; margin-top:50px; padding:20px;'><table class=table><h2>Timestamps</h2><tr><th>Domain</th><th>Where</th><th>When (sec)</th><th>Duration (sec)</th><th>Percent</th><th>Memory (MB)</th><th>Memory peak (MB)</th><th>Comment</th></tr>";
    $right = ' style="text-align: right;"';
    $total = array('domain' => array(), 'where' => array());

    foreach($timestamps as $val) {
      $when     = $val['when'] - $first;
      $duration = isset($val['duration']) ?  round($val['duration'], 3) : null;
      $percent  = round(($when) / ($last - $first) * 100);
      $memory   = round($val['memory'] / 1024 / 1024, 2);
      $peak     = isset($val['memory-peak']) ? round($val['memory-peak'] / 1024 / 1024, 2) : NULL;
      $when     = round($when, 3);
      $html .= "<tr><td>{$val['domain']}</td><td>{$val['where']}</td><td{$right}>{$when}</td><td{$right}>{$duration}</td><td{$right}>{$percent}</td><td{$right}>{$memory}</td><td{$right}>{$peak}</td><td>{$val['comment']}</td></tr>";
      $prev = $val['when'];
      @$total['domain'][$val['domain']] += $duration;
      @$total['where'][$val['where']] += $duration;
    }
    $html .= "</table><table class=table><h2>Duration per domain</h2><tr><th>Domain</th><th>Duration</th><th>Percent</th></tr>";
    arsort($total['domain']);
    foreach($total['domain'] as $key => $val) {
      $percent = round($val / ($last - $first) * 100, 1);
      $html .= "<tr><td>{$key}</td><td>{$val}</td><td>{$percent}</td></tr>";
    }
    $html .= "</table><table class=table><h2>Duration per area</h2><tr><th>Area</th><th>Duration</th><th>Percent</th></tr>";
    arsort($total['where']);
    foreach($total['where'] as $key => $val) {
      $percent = round($val / ($last - $first) * 100, 1);
      $html .= "<tr><td>{$key}</td><td>{$val}</td><td>{$percent}</td></tr>";
    }
    $html .= "</table>";
    $html .= "<p>Peek memory consumption was {$memoryPeak} MB.</p>";
    $html .= "<p>Page was loaded in {$pageLoadTime} secs.</p>";
    $html .= "</div>";
    return $html;
  }



	/*
	* Test if class is loaded
	*/
	public function noLog() {
		$html = "<p>No timestamps have been logged. Log is empty.</p>";
		return $html;
	}


	/*
	* Test if class is loaded
	*/
	public function saySomething($word) {
		echo $word;
	}

}