<?php
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
	return "?p=" . $this->id . "&results=true";
    }
    return "?p=" . $this->id . "&q=" . $id;
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


// function to pretty print arrays
function pr($array=null) {
	print "<pre><code>"; print_r($array); print "</code></pre>";
}

/*-----------------------------------------------------------------------------------*/
/*  Enqueues scripts for front-end
/*-----------------------------------------------------------------------------------*/
add_action('wp_enqueue_scripts', 'child_add_scripts');

function is_checked($a, $b) {
  echo ($a == $b) ? 'checked=checked' : '';
}

function child_add_scripts() {
	wp_register_script(
		'brainfall',
		get_stylesheet_directory_uri() . '/js/brainfall.js',
		false,
		null,
		true
	);
	wp_enqueue_script( 'brainfall', array('jquery') );
}

function get_action_url($quiz_id, $question_id) {
	return "?p=" . $quiz_id . "&q=" . $question_id;
}

?>