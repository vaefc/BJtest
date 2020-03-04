<div class="container">

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1>Edit Task</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="/task/update" method="post" class="needs-validation" novalidate>

                <div class="form-group">
                    <label for="uname">User Name*</label>
                    <input type="text" class="form-control" id="uname" placeholder="Enter user name" name="uname" value="<?= $_POST['uname'] ?>" required>
                    <div class="valid-feedback feedback-pos">
                        Looks good!
                    </div>
                    <div class="invalid-feedback feedback-pos">
                        Please input User Name
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email address*</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?= $_POST['email'] ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                    <div class="valid-feedback feedback-pos">
                        Looks good!
                    </div>
                    <div class="invalid-feedback feedback-pos">
                        Please input valid email ID
                    </div>
                </div>

                <div class="form-group">
                    <label for="task">Task content</label>
                    <textarea class="form-control" id="task" rows="3" placeholder="Task text here" name="task"><?= $_POST['task'] ?></textarea>
                    <input type="hidden" name="old_task" value="<?= $_POST['task'] ?>">
                </div>

                <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
                <input type="hidden" name="oldedited" value="<?= $_POST['edited'] ?>">

                <div class="form-group">
                    <label for="completed">Completed</label>
                    <input type="checkbox" id="completed" name="completed" value="1" <? echo ($_POST['completed']=='1')?'checked':'' ?>>
                </div>

                <button type="submit" class="btn btn-primary" value="validate">Submit</button>

            </form>
        </div>
    </div>

</div>

<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>