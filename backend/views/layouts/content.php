<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

?>
<style>
    .breadcrumb{background-color: #ffffff;}
    .content{padding: 0 8px;}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="box box-cnpo with-border"">
            <?=
            Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]
            ) ?>
        </div>
    </section>
    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>

