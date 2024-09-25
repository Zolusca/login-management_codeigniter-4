<?= $this->extend('main') ?>



<?= $this->section('content') ?>
    <div class="container-lg my-5">

        <?= $this->include('_message')?>

        <form action="<?=base_url('')?>"
              class="mx-auto" style="width: 350px"
              method="post">
            <h4 class="fs-5 text-center">register</h4>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">email</label>
                <input type="email"
                       name="email"
                       autocomplete="off"
                       required
                       class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">username</label>
                <input type="text"
                       name="username"
                       autocomplete="off"
                       required
                       class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password"
                       required
                       name="password"
                       class="form-control"
                       id="password">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" onclick="showHide()" class="form-check-input border-black"
                       id="exampleCheck1" style="width: 15px;height: 15px">
                <label class="form-check-label" for="exampleCheck1">show password</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>
        // show password
        function showHide() {
            var inputan = document.getElementById("password");
            if (inputan.type === "password") {
                inputan.type = "text";
            } else {
                inputan.type = "password";
            }
        }
    </script>

<?= $this->endSection('content') ?>