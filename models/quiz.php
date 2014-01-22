<?
class Quiz {
  const DEBUG = false;
  var $id;
  var $questions;
  var $results;

  function AbstractQuiz($id, $post_meta) {
    $this->id = $id;
    $this->questions = $post_meta['quiz_questions'];
    $this->results = $post_meta['quiz_results'];
  }

  function get_question($id) {
    return $this->questions[$id-1];
  }

  function get_action_url($id) {
    if (!isset($this->questions[$id])) {
      return "?results=true";
    }
    return "?q=" . $id;
  }

  function display_result($list) {
    $result = $this->get_result($list);
    debug(pr($result));

    echo '
       <h1>' . $result['result_name'] . '</h1>
       <p>' . $result['result_desc'] . '</p>
    ';
  }

  abstract function get_result() {
    $this->result_calculator.get_results();
  } 
}
