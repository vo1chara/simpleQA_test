 <?php if (!isset($_SESSION['role']) && $_SESSION['role']) {
        header("Refresh: 0; url=/simpleQA/index/");
    } ?>

 <?php
    if ($flag) {
        unset($_POST);
        header("Refresh: 0; url=/simpleQA/tasks/add");
    } ?>
 <div class="container">
     <table>
         <tr>
             <th>id</th>
             <th>вопрос</th>
             <th>ответ</th>
         </tr>
         <?php if (!empty($tasks)) { ?>
             <?php foreach ($tasks as $task) : ?>
                 <tr>
                     <td><?= $task['id'] ?></td>
                     <td><?= $task['question'] ?></td>
                     <td><?= $task['answer'] ?></td>
                 </tr>
             <?php endforeach; ?>
         <?php } ?>
     </table>
     <div class="row">

         <form method="post" class="col-12 col-md-4">
             <h3>Изменить</h3>
             <?php if (!empty($tasks)) { ?>
                 <select name="id" id="id_task" class="form-control">
                     <?php foreach ($tasks as $task) : ?>
                         <option value="<?= $task['id'] ?>">
                             <?= $task['question'] ?>
                         </option>
                     <?php endforeach; ?>
                 </select>
             <?php } ?>
             <input type="text" name='action' style='display:none' value="update">
             <div class="form-group">
                 <label for="question">Ваш вопрос</label>
                 <textarea class="form-control" id="question" name='question' rows="3"></textarea>
             </div>
             <div class="form-group">
                 <label for="answer">Ваш ответ</label>
                 <textarea class="form-control" id="answer" name='answer' rows="3"></textarea>
             </div>
             <button type="submit" class="btn btn-primary">Изменить</button>
         </form>

         <form method="post" class="col-12 col-md-4">
             <h3>Удалить</h3>
             <?php if (!empty($tasks)) { ?>
                 <select name="id" id="id_task" class="form-control">
                     <?php foreach ($tasks as $task) : ?>
                         <option value="<?= $task['id'] ?>">
                             <?= $task['id'] ?>
                         </option>
                     <?php endforeach; ?>
                 </select>
             <?php } ?>
             <input type="text" name='action' style='display:none' value="delete">
             <button type="submit" class="btn btn-primary">Удалить</button>
         </form>

         <form method="post" class="col-12 col-md-4">
             <h3>Добавить</h3>
             <input type="text" name='action' style='display:none' value="insert">
             <div class="form-group">
                 <label for="question">Ваш вопрос</label>
                 <textarea class="form-control" id="question" name='question' rows="3"></textarea>

             </div>
             <div class="form-group">
                 <label for="answer">Ваш ответ</label>
                 <textarea class="form-control" id="answer" name='answer' rows="3"></textarea>
             </div>
             <button type="submit" class="btn btn-primary">Добавить</button>
         </form>
     </div>
 </div>