<?php
/**
 * The template for displaying individual quizzes
 */
?>

<?php

global $question_id;

// post results
if ($_SERVER['REQUEST_METHOD'] == 'POST' && false) {
	pr($_POST);
} else {
	// get current question index (question index will always be in the url)
	// $question_id = ((int) $_GET['Q']) || 1;
	
	$question_id = (isset($_GET['Q'])) ? (int) $_GET['Q'] : 1;

	// git all questions and put into appropriate arrays
	$post_meta = array_filter(get_fields(), "trim");
	$results_array = array();
	$questions_array = array();
	foreach ($post_meta as $key => $text) {
		if (preg_match("/^result_(\d)/", $key,  $matches)) {
			$results_array[$matches[1]] = $text;
		}
		if (preg_match("/^question.*/", $key)) {
			if (preg_match("/^question_(\d)$/", $key, $matches)) {
				$qid = $matches[1];
				$questions_array[$qid]['question'] = $text;
			} else if (preg_match("/^question_\d_answer_(\d)$/", $key, $matches)) {
				$questions_array[$qid]['answers'][$matches[1]] = $text;
			}
		}
	}

	// pr($results_array);
	sort($questions_array);
	// pr($questions_array);
	// echo '<hr/>';

?>

<form class="quiz" action="<?php echo get_action_url($question_id+1) ?>" method="POST">
	<!-- loop through and output questions -->
	<?php pr($_GET) ?>
	<?php pr($_POST) ?>
	<?php pr($question_id) ?>
	<?php foreach ($questions_array as $qid => $question) { ?>
	<div class="question <? if ($qid+1 == $question_id) echo 'active'; ?>">
		<h3><?php echo $question['question'] ?></h3>
		
		<div class="question-answers">
			<!-- loop through and output answers! -->
			<?php foreach ($question['answers'] as $aid => $answer) { ?>
				<label class="question-answer radio">
					<input type="radio" class="no-js" name="question_<?php echo $qid ?>" id="question_<?php echo $qid ?>_answer_<?php echo $aid ?>" value="<?php echo $aid ?>">
					<?php echo $answer ?>
				</label>
			<?php } ?>
		</div>
	</div>
	<?php } ?>

	<!-- loop through and add -->

	<!-- next button that hides with js -->
	<?php $value = (false) ? "Submit" : "Next &rarr;" ?>
	<div class="quiz-controls no-js">
		<input type="submit" value="<?php echo $value ?>">
	</div>

<!-- 	<div class="question">
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