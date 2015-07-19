<?php
   foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-' . $key . '">' . $message 
    .'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
    . '</div>';
}
    ?>