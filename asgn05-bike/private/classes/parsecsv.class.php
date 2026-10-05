<?php

class ParseCSV {

  // The delimiter is static because it is shared by all ParseCSV objects, and it is a property
  // instead of a constant so the delimiter can be changed when needed.
  public static $delimiter = ',';

  private $filename;
  private $header;
  private $data=[];
  private $row_count = 0;

  public function __construct($filename='') {
    if($filename != '') {
      $this->file($filename);
    }
  }

  public function file($filename) {
    if(!file_exists($filename)) {
      echo "File does not exist.";
      return false;
    } elseif(!is_readable($filename)) {
      echo "File is not readable.";
      return false;
    }
    $this->filename = $filename;
    return true;
  }

  public function parse() {
    if(!isset($this->filename)) {
      echo "File not set.";
      return false;
    }

    // clear any previous results
    $this->reset();

    $file = fopen($this->filename, 'r');
    while(!feof($file)) {
      $row = fgetcsv($file, 0, self::$delimiter);
      if($row == [NULL] || $row === FALSE) { continue; }
      if(!$this->header) {
     	  $this->header = $row;
      } else {
        $this->data[] = array_combine($this->header, $row);
        $this->row_count++;
     	}
    }
    fclose($file);
    return $this->data;
  }

  // This method is useful when code needs to access the results from the most recent parse()
  // without having to parse the CSV again.
  public function last_results() {
    return $this->data;
  }

  // The parser keeps a row counter while parsing so the page can get the number of rows directly
  // without having to count the parsed data again later.
  public function row_count() {
    return $this->row_count;
  }

  // Reset is private because it is an internal step used by the parser. If outside code could call it,
  // it could erase the current results and reset the parser's state unexpectedly.
  private function reset() {
    $this->header = NULL;
    $this->data = [];
    $this->row_count = 0;
  }

}

?>
