<div class="container">

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1>Sign in</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="/task/checkuser" method="post" class="needs-validation" novalidate>

                <div class="form-group">
                    <label for="name">User Name*</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter user name" name="name" required>
                    <div class="valid-feedback feedback-pos">
                        Looks good!
                    </div>
                    <div class="invalid-feedback feedback-pos">
                        Please input User Name
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password*</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
                    <div class="valid-feedback feedback-pos">
                        Looks good!
                    </div>
                    <div class="invalid-feedback feedback-pos">
                        Please input Password
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" value="validate">Login</button>

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