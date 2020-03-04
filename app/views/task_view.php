<div class="container">

    <div class="row">
        <div class="col-md-8">
            <h1>Tasks list</h1>
        </div>
        <div class="col-md-4 align-right">
            <a href="/task/create" class="btn btn-success">Add Task</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <? if (isset($_SESSION['sucsess']) && $_SESSION['sucsess']!=null):?>
                <div class="alert alert-success" role="alert">
                    <?= $_SESSION['sucsess'] ?>
                </div>
            <? endif; ?>

            <? if (isset($_SESSION['notsucsess']) && $_SESSION['notsucsess']!=null):?>
                <div class="alert alert-danger" role="alert">
                    <?= $_SESSION['notsucsess'] ?>
                </div>
            <? endif; ?>

            <? $_SESSION['sucsess'] = null; $_SESSION['notsucsess'] = null ?>
        </div>
    </div>

    <div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <?
                        if ($data['order_dir']=='DESC') {
                            $sclass=' sorting_desc';
                        } else {
                            $sclass=' sorting_asc';
                        }
                        $dirs=['uname'=>'ASC', 'email'=>'ASC', 'completed'=>'ASC'];
                        if ($dirs[$data['order_field']] == $data['order_dir']) {
                            $dirs[$data['order_field']] = 'DESC';
                        }
                    ?>
                    <th>#</th>
                    <th<? echo ($data['order_field']=='uname')?' class="active text-success'.$sclass.'"':'' ?>>
                        <a href="/task?field=uname&dir=<?= $dirs['uname'] ?>&page=<?= $data['page']+1?>">User name</a>
                    </th>
                    <th<? echo ($data['order_field']=='email')?' class="active text-success'.$sclass.'"':'' ?>>
                        <a href="/task?field=email&dir=<?= $dirs['email'] ?>&page=<?= $data['page']+1?>">User email</a>
                    </th>
                    <th>Task</th>
                    <th>Edited by admin</th>
                    <th<? echo ($data['order_field']=='completed')?' class="active text-success'.$sclass.'"':'' ?>>
                        <a href="/task?field=completed&dir=<?= $dirs['completed'] ?>&page=<?= $data['page']+1?>">Task complete</a>
                    </th>
                    <?php
                        if ($_SESSION['isadmin']) {
                            echo '<th>Edit</th>
                                  <th>Del</th>';
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
            <? foreach ($data['data'] as $row): ?>

                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['uname'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['task'] ?></td>
                    <td>
                        <input type="checkbox" name="task_edited" <? echo ($row['edited'])?'checked':'' ?> disabled>
                        <?= $row->edited ?>
                    </td>
                    <td>
                        <input type="checkbox" name="task_completed" <? echo ($row['completed'])?'checked':'' ?> disabled>
                        <?= $row->completed ?>
                    </td>

                    <?php
                    if ($_SESSION['isadmin']) {
                    ?>
                        <td>
                            <form action="/task/edit" method="post">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="uname" value="<?= $row['uname'] ?>">
                                <input type="hidden" name="email" value="<?= $row['email'] ?>">
                                <input type="hidden" name="task" value="<?= $row['task'] ?>">
                                <input type="hidden" name="edited" value="<?= $row['edited'] ?>">
                                <input type="hidden" name="completed" value="<?= $row['completed'] ?>">
                                <button class="btn btn-warning" type="submit">edit</button>
                            </form>
                        </td>
                        <td>
                            <form action="/task/delete" method="post">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <button class="btn btn-danger" type="submit">x</button>
                            </form>
                        </td>
                    <?
                    }
                    ?>

                </tr>
            <? endforeach;?>
            </tbody>
        </table>
        <br>

        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?
                    $qsa = array();
                    $qs = '';
                    if (isset($_GET['field'])){
                        $qsa[] = 'field='.$_GET['field'];
                    }
                    if (isset($_GET['dir'])){
                        $qsa[]='dir='.$_GET['dir'];
                    }

                    if (count($qsa)){
                        $qs.='?'.implode('&',$qsa);
                        $page_prefix = '&';
                    } else {
                        $page_prefix = '?';
                    }

                    for ($i = 0; $i < ceil($data['total']/3); $i++){
                        if ($i==0) {
                            $link = '/task'.$qs;
                        } else {
                            $link = '/task'.$qs.$page_prefix.'page='.($i+1);
                        }
                        if ($data['page'] == $i) {
                            $addclass = ' active';
                        } else {
                            $addclass = '';
                        }
                ?>
                    <li class="page-item<?= $addclass ?>"><a class="page-link" href="<?= $link ?>"><?= $i+1 ?></a></li>
                <? } ?>
            </ul>
        </nav>

    </div>
    </div>

</div>
