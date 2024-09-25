<?= $this->extend('main') ?>



<?= $this->section('content') ?>
    <div class="container ">

        <?= $this->include('_message')?>

        <div class="my-5 ms-auto">
            <form action="<?=base_url("user")?>"
                  method="post"
                  class="mx-auto" >

                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="user_id" value="<?=!empty($user)?$user->getId():"error id user" ?>">

                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Username</label>
                    <input type="text" class="form-control"
                           id="inputEmail4" value="<?=!empty($user)?$user->getUsername():""?>">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="text" class="form-control"
                           disabled
                           id="inputEmail4" value="<?=!empty($user)?$user->getEmail():""?>">
                </div>
                <div class="col-12">
                    <a class="d-block mb-2" href=""
                       data-bs-toggle="modal" data-bs-target="#exampleModal">
                        change password
                    </a>
                    <button type="submit"
                            class="btn btn-primary">update</button>
                </div>
            </form>
        </div>
    </div>


    <!--UPDATE PASSWORD MODAL-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ubah password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <form   action="<?=base_url("password")?>"
                            method="post"
                            id="form_password">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="user_id" value="<?=!empty($user)?$user->getId():"error id user" ?>">

                        <label for="old_password"
                               class="form-label"
                        >old password</label>
                        <input type="password"
                               id="old_password"
                               class="form-control"
                               name="old_password">

                        <label for="new_password"
                               class="form-label"
                        >new password</label>
                        <input type="password"
                               id="new_password"
                               minlength="5"
                               class="form-control"
                               name="new_password">

                    </form>

                    <input type="checkbox" onclick="showHide()"
                           class="form-check-input border-black"
                           id="exampleCheck1" style="width: 15px;height: 15px">
                    <label class="form-check-label" for="exampleCheck1">show password</label>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">tutup</button>
                    <button type="submit"
                            onclick="document.getElementById('form_password').submit();"
                            class="btn btn-primary">kirim</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showHide() {
            var passwordFields = [document.getElementById("old_password"), document.getElementById("new_password")];
            passwordFields.forEach(function(field) {
                field.type = field.type === "password" ? "text" : "password";
            });
        }
    </script>
<?= $this->endSection('content') ?>