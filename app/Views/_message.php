<?php
if(session()->getFlashdata("message") !== NULL) {
    $message = session()->getFlashdata('message');
    echo <<<HTML
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong class="font-medium">Info!</strong> $message
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        HTML;
}elseif (session()->getFlashdata('validation') !== NULL) {
    $messages = session()->getFlashdata('validation');
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="sr-only">Error Validation</span>
        <div>
            <ul class="list-group list-group-numbered">
                <?php foreach ($messages as $message): ?>
                    <li class="list-group-item"><?= htmlspecialchars($message) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
}elseif(!empty($message)){
    $messages = $message;
    echo <<<HTML
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <span class="font-medium">Info!</span> $message
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        HTML;
}elseif(!empty($error)){
    $messages = $error;
    echo <<<HTML
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="font-medium">Info!</span> $messages
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        HTML;
}elseif(session()->getFlashdata("error") !== NULL){
    $message = session()->getFlashdata('error');
    echo <<<HTML
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="font-medium">Info!</span> $message
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        HTML;
}
?>