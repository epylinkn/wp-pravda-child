<?
class TriviaQuiz extends Quiz{
  var $result_calculator;

  function TriviaQuiz($id, $post_meta) {
    $this->result_calculator = new TriviaCalculator();
    super($id, $post_meta);
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
    // TODO do something special to randomize ties?

    return $this->results[$rid];
  }
}
