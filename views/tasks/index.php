 <?php if (!isset($_SESSION['id'])) {
        header("Refresh: 0; url=/simpleQA/index/");
    } ?>

 <?php
    if ($flag) {
        unset($_POST);
         header("Refresh: 0; url=/simpleQA/tasks/");
    } ?>
 <div class="container">

     <?php if($count < 10):?>
         <table>
             <tr>
                 <th>вопрос</th>
                 <th>ответ</th>
                 <th>правильно?</th>
                 <th>Пользователь</th>
             </tr>
             <?php if (!empty($tasks)) { ?>
                 <?php foreach ($tasks as $task) : ?>
                     <tr>
                         <td><?= $task['question'] ?></td>
                         <td><?= $task['answer'] ?></td>
                         <td><?= $task['result'] ?></td>
                         <td><?= $_SESSION['first_name'] ?> <?= $_SESSION['last_name']  ?></td>
                     </tr>
                 <?php endforeach; ?>
             <?php } ?>
         </table>
     <div class="row">
         <form method="post" class="col-12 col-md-4">
             <h3>Добавить</h3>
             <div class="form-group">
                 <label for="question">Ваш вопрос</label>
                 <br>
                 <label id="question"><?= $randQues['question'] ?></label>
                 <input type="text" name='id_task' style='display:none' value="<?= $randQues['id'] ?>">
             </div>

             <div class="form-group">
                 <label for="answer">Ваш ответ</label>
                 <textarea class="form-control" id="answer" name='answer' rows="3"></textarea>
             </div>
             <button type="submit" class="btn btn-primary">Добавить</button>
         </form>
     </div>
     <?php else: ?>
     <h2 style="text-align: center">Ваш результат : <?=$score?> из <?=$count?></h2>
     <h1 style="text-align: center">Оценка <?=$score/$count*5?></h1>
     <?php endif;?>
 </div>