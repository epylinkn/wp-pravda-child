<?
class PersonalityQuiz {
  var $id;
  var $questions;
  var $results;

  function PersonalityQuiz($id, $post_meta) {
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

  function render_question($qid) {
    echo '
       <label class="question-answer radio">
         <input type="radio" class="no-js" name="question_' . $qid . '" id="question_'. $qid . '_answer_' . $aid . '" value="' . $answer['answer_result_ids'] . '"/>
        ' . $answer['answer_text'] . '
       </label>
          ';
  }

  function get_result($list) {
    $values = array_count_values($list);
    $rid = (array_search(max($values), $values));

    return $this->results[$rid];
    // TODO do something special to randomize ties?
  }
}