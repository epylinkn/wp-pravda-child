// jQuery.noConflict()(function($){
// 	"use strict";
// 	$(document).ready(function() {
// 		var num_questions = $('.question').length;

// 		$('.question-answer').click(function(evt) {
// 			evt.preventDefault(); // a label click triggers twice (one for radio check)
// 			var q_no = $('.question.active').index()+1; // gets question index
// 			$(this).siblings().removeClass('checked');
// 			$(this).addClass('checked');
// 			$(this).find('input[type=radio]').prop('checked', true);
// 			console.log(q_no, num_questions);
// 			if (q_no == num_questions) {
// 				alert('this is the last question. jquery submit form');
// 				$('.quiz').get(0).submit();
// 			} else {
// 				setTimeout(nextQuestion, 500);
// 			}
// 		});

// 		function nextQuestion() {
// 			var current_question = $('.question.active'),
// 				next_question = current_question.next('.question'),
// 				duration = 1000,
// 				width = current_question.width()+40; /* account for .entry-content padding */

// 			current_question.find('.question-answer:even').animate({ left: width }, duration);
// 			current_question.find('.question-answer:odd').animate({ right: width }, duration);

// 			next_question.find('.question-answer:even').css('left', width);
// 			next_question.find('.question-answer:odd').css('right', width);

// 			current_question.fadeOut(duration, function() {
// 				current_question.removeClass('active');
// 				next_question.fadeIn(duration, function() { 
// 					next_question.addClass('active');
// 				});
// 				next_question.find('.question-answer:even').animate({ left: 0 }, duration);
// 				next_question.find('.question-answer:odd').animate({ right: 0 }, duration);
// 			});
// 		};
// 	});
// });


function getHashParameterByName(name) {
  name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
  var regexS = "[\\?&]" + name + "=([^&#]*)";
  var regex = new RegExp(regexS);
  var results = regex.exec("?"+window.location.hash.substr(1));
  if(results == null)
	return "";
  else
	return decodeURIComponent(results[1].replace(/\+/g, " "));
}

function get_current_page() {
	var current_page = parseInt(getHashParameterByName('page'), 10);
	if(isNaN(current_page))
		current_page = 1;
	return current_page;
}
function get_this_page_first_question() {
	return ((get_current_page()-1) * quizdata['questions_per_page']);
}

function quiz_init() {
	
	//var hash = window.location.hash.substr(1);
	//get current page
	//alert(get_current_page());
//	var responses = new Array();
	show_page();
	
}

function show_page() {
	//display questions from quizdata.
	
	//count all questions:
	//var question_count = quizdata['questions'].length;
	
	//for current page, get starting question number (counts starting at 0):
	var this_page_first_question = get_this_page_first_question();
	//alert(this_page_first_question);
	
	//generate html code to show questions:
	var page_html = '';
	for (i=this_page_first_question;i<Math.min(quizdata['questions'].length,this_page_first_question+quizdata['questions_per_page']);i++) {
		page_html += '<strong>'+(i+1)+' '+quizdata['questions'][i]['question']+'</strong><br />';
		//page_html += '<div onClick="document.question_form.radio16001.checked=true;" onMouseOver="this.style.cursor=\'pointer\'" onMouseOut="this.style.cursor=\'default\'"><input id="radio16001" type="radio" class="check" name="question1" value="16001" /><label for="radio16001" style="min-height:15px"> Not really, I actually get excited about cuddling and sometimes kissing though.</label></div>';
		for (j=0;j<quizdata['questions'][i]['answers'].length;j++) {
			page_html += '<input type="radio" name="'+quizdata['questions'][i]['question_id']+'" value="'+quizdata['questions'][i]['answers'][j]['answer_id']+'" id="answer_'+quizdata['questions'][i]['answers'][j]['answer_id']+'" /><label for="answer_'+quizdata['questions'][i]['answers'][j]['answer_id']+'">'+quizdata['questions'][i]['answers'][j]['answer']+'</label>';
		}
	}
	
	//add NEXT or SUBMIT button:
	//is this the last page?
	var this_page_hypothetical_last_question = this_page_first_question+quizdata['questions_per_page'];
	if(quizdata['questions'].length <= this_page_hypothetical_last_question) {
		page_html += '<input type="button" href="/results/" value="Submit" />';
	}
	else {
		page_html += '<input type="button" onClick="next_page();return false;" value="Next" />';
	}
	
	//replace questions div with html:
	jQuery('div#questions_here').html(page_html);
	
}
function hide_question(i) {
	//disappear question i from the page.
}

function next_page() {
	//check that all questions have been answered, store user responses to js array, and go to the next page.
	var this_page_first_question = get_this_page_first_question();
	var max_question_on_page = Math.min(quizdata['questions'].length,this_page_first_question+quizdata['questions_per_page']);
	var checked_counter = 0;
	for (var i=this_page_first_question; i < max_question_on_page; i++) {
		//if (document.question_form.question1[i].checked) {
		//FINISH THIS.
			checked_counter++;
			//alert(checked_counter);
		//}
	}
	if(checked_counter == (max_question_on_page - this_page_first_question))
		window.location = '#page='+(get_current_page()+1);
	else
		alert('Please answer all the questions..');
}