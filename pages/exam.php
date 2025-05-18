<script type="text/javascript" >
   function preventBack(){window.history.forward();}
    setTimeout("preventBack()", 0);
    window.onunload=function(){null};
</script>
 <?php 
    $examId = $_GET['id'];
    $selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$examId' ")->fetch(PDO::FETCH_ASSOC);
    $selExamTimeLimit = $selExam['ex_time_limit'];
    $exDisplayLimit = $selExam['ex_questlimit_display'];
 ?>


<div class="app-main__outer">
<div class="app-main__inner">
    <div class="col-md-12">
         <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div style="font-size: 35px;">
                            <?php echo $selExam['ex_title']; ?>
                            <div class="page-title-subheading">
                              <?php echo $selExam['ex_description']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="page-title-actions mr-5">
                        <form name="cd">
                          <input type="hidden" name="" id="timeExamLimit" value="<?php echo $selExamTimeLimit; ?>">
                          <label style="font-size: 25px; margin-left: 50px;;">Remaining Time : </label>
                          <input style="border:none;background-color: transparent;color:red;font-size: 40px; margin-left:20px;" type="text" class="clock" id="countdown" value="00:00" size="5" readonly="true" disabled/>
                      </form> 
                    </div>   
                 </div>
            </div>  
    </div>

    <div class="col-md-12 p-0 mb-4" style="font-size: 20px;">
        <form method="post" id="submitAnswerFrm">
            <input type="hidden" name="exam_id" id="exam_id" value="<?php echo $examId; ?>">
            <input type="hidden" name="examAction" id="examAction" >
        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
        <?php 
            $selQuest = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_id='$examId' ORDER BY rand() LIMIT $exDisplayLimit ");
            if($selQuest->rowCount() > 0)
            {
                $i = 1;
                while ($selQuestRow = $selQuest->fetch(PDO::FETCH_ASSOC)) { ?>
                      <?php $questId = $selQuestRow['eqt_id']; ?>
                    <tr>
                        <td>
                            <p style="margin: 10px 20px;"><b><?php echo $i++ ; ?>. <?php echo $selQuestRow['exam_question']; ?></b></p>
                            <div class="col-md-4 float-left">
                              <div class="form-group pl-4 ">
                                <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch1']; ?>" class="form-check-input" type="radio" id=<?php echo $selQuestRow['exam_ch1']; ?>  >
                               
                                <label class="form-check-label" for=<?php echo $selQuestRow['exam_ch1']; ?>>
                                    <?php echo $selQuestRow['exam_ch1']; ?>
                                </label>
                              </div>  

                              <div class="form-group pl-4">
                                <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch2']; ?>" class="form-check-input" type="radio" id=<?php echo $selQuestRow['exam_ch2']; ?>  >
                               
                                <label class="form-check-label" for=<?php echo $selQuestRow['exam_ch2']; ?>>
                                    <?php echo $selQuestRow['exam_ch2']; ?>
                                </label>
                              </div>   
                            </div>
                            <div class="col-md-8 float-left">
                             <div class="form-group pl-4">
                                <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch3']; ?>" class="form-check-input" type="radio" id=<?php echo $selQuestRow['exam_ch3']; ?>  >
                               
                                <label class="form-check-label" for=<?php echo $selQuestRow['exam_ch3']; ?>>
                                    <?php echo $selQuestRow['exam_ch3']; ?>
                                </label>
                              </div>  

                              <div class="form-group pl-4">
                                <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch4']; ?>" class="form-check-input" type="radio" id=<?php echo $selQuestRow['exam_ch4']; ?>  >
                               
                                <label class="form-check-label" for=<?php echo $selQuestRow['exam_ch4']; ?>>
                                    <?php echo $selQuestRow['exam_ch4']; ?>
                                </label>
                              </div>   
                            </div>
                            </div>
                        </td>
                    </tr>

                <?php }
                ?>
                    <tr>
                         <td style="padding: 20px;">
                             <button type="button" class="btn btn-xlg btn-warning px-4 mt-4" style="font-size: 25px;" id="resetExamFrm">Reset</button>
                             <input name="submitBtn" type="submit" value="Submit" class="btn btn-xlg btn-primary px-4 mt-4 float-right" style="font-size: 25px;" id="submitAnswerFrmBtn">
                         </td>
                    </tr>

                <?php
            }
            else
            { ?>
                <b>No question at this moment</b>
            <?php }
         ?>   
              </table>

        </form>
    </div>
</div>
 
<script>
document.addEventListener("DOMContentLoaded", function () {
    const timeLimitInput = document.getElementById("timeExamLimit");
    const examIdInput = document.getElementById("exam_id");
    const display = document.getElementById("countdown");

    const timeLimitMinutes = parseInt(timeLimitInput?.value);
    const examId = examIdInput?.value;

    // Validate time limit
    let timeLimit = (!isNaN(timeLimitMinutes) && timeLimitMinutes > 0) ? timeLimitMinutes : 10;

    // Use a unique key for each exam
    const storageKey = `exam_end_time_${examId}`;

    let endTime = localStorage.getItem(storageKey);

    // Set end time if not found
    if (!endTime) {
        const now = Date.now();
        endTime = now + timeLimit * 60 * 1000;
        localStorage.setItem(storageKey, endTime);
    } else {
        endTime = parseInt(endTime);
    }

    // Countdown timer
    const timer = setInterval(function () {
        const now = Date.now();
        const distance = endTime - now;

        if (distance <= 0) {
            clearInterval(timer);
            display.value = "00:00";
            alert("Time is up! Your exam is being submitted automatically.");
            localStorage.removeItem(storageKey);
            document.getElementById("submitAnswerFrmBtn").click();
            return;
        }

        const minutes = Math.floor((distance / 1000 / 60));
        const seconds = Math.floor((distance / 1000) % 60);
        display.value = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    }, 1000);
});
</script>

<script>
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });
</script>
