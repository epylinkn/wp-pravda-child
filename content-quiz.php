<?php
/**
 * The template for displaying individual quizzes
 */
?>

<?php

global $question_id;

$post_meta = get_fields();
$quiz = new PersonalityQuiz($post->ID, $post_meta);

$question_id = (isset($_GET['q'])) ? (int) $_GET['q'] : 1;

// post results
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['results'] == true) {
  $quiz->display_result(array_values($_POST));
  debug(pr($_POST, '$_POST'));
} else {
  debug(pr($_GET, '$_GET'));
  debug(pr($_POST, '$_POST'));
?>

<form class="quiz" action="<?php echo $quiz->get_action_url($question_id+1) ?>" method="POST" data-quiz-id="<?= $quiz->id ?>" data-action-url="?results=true">

  <!-- loop through and output questions -->
  <?php foreach ($quiz->questions as $qid => $question) { ?>
  <div class="question <? if ($qid == $question_id-1) echo 'active'; ?>" data-id="<?= $qid+1 ?>">
    <h3><?php echo $question['question'] ?></h3>

    <div class="question-answers">
      <!-- loop through and output answers -->
      <?php foreach ($question['answers'] as $aid => $answer) { ?>
      <label class="question-answer radio">
        <input type="radio" class="no-js" <?php is_checked($_POST['question_'.$qid], $answer['answer_result_ids']) ?> name="question_<?php echo $qid ?>" id="question_<?php echo $qid ?>_answer_<?php echo $aid ?>" value="<?php echo $answer['answer_result_ids'] ?>"/>
        <?php echo $answer['answer_text'] ?>
      </label>
      <?php } ?>
    </div>
  </div>
  <?php } ?>

  <!-- next button that hides with js -->
  <?php $value = (false) ? "Submit" : "Next &rarr;" ?>
  <div class="quiz-controls">
    <input type="submit" value="<?php echo $value ?>">
  </div>
</form>
<? } ?>
