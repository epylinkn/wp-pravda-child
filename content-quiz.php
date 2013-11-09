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
     $result = $quiz->get_result(array_values($_POST));
     pr($_POST);
pr($result);
   } else {
?>

<form class="quiz" action="<?php echo $quiz->get_action_url($question_id+1) ?>" method="POST" data-quiz-id="<?= $quiz->id ?>" data-action-url="?results=true">

  <!-- <?php pr($_GET) ?> -->
  <!-- <?php pr($_POST) ?> -->

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

  <!-- loop through and add -->

  <!-- next button that hides with js -->
  <?php $value = (false) ? "Submit" : "Next &rarr;" ?>
  <div class="quiz-controls">
    <input type="submit" value="<?php echo $value ?>">
  </div>

  <!--       <div class="question">
             <h3>What is your favorite color?</h3>
             <ul>
               <li>
                 <label class="question-answer radio">
                   <input type="radio" name="question_1" id="question_1_answer_1" value="1">
                   asdfasdfasdfasdf
                 </label>
               </li>
               <li>
                 <label class="question-answer radio">
                   <input type="radio" name="question_1" id="question_1_answer_2" value="2">
                   asdfasdfasdfasdf
                 </label>
               </li>
               <li>
                 <label class="question-answer radio">
                   <input type="radio" name="question_1" id="question_1_answer_3" value="3">
                   awlahja;eljglasdkjflakjwef
                 </label>
               </li>
               <li>
                 <label class="question-answer radio">
                   <input type="radio" name="question_1" id="question_1_answer_4" value="4">
                   this a;lksdjf;lawje;fljaa w;lejflawjefl;kajwef;lkjaw;elfjl
                   ;awekjf;lakjdsfansvanw,mn,mn,mn,mrnt,mrntm,
                 </label>
               </li>
               <li>
                 <label class="question-answer radio">
                   <input type="radio" name="question_1" id="question_1_answer_5" value="5">
                   a
                 </label>
               </li>
             </ul>
    </div> -->
</form>
<? } ?>
