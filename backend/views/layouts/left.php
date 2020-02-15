<aside class="main-sidebar">

    <section class="sidebar" >

        <?php if(Yii::$app->user->identity->username == 'admin'){?>
            <?= \backend\components\Menu::widget(
                \backend\models\admin\Permission::takeMenuByAdmin()
            ) ?>
        <?php }else{ ?>
        <?= \backend\components\Menu::widget(
            \backend\models\admin\Permission::takeMenuByPermission(Yii::$app->user->identity->role_id)
        )?>
        <?php }?>
    </section>

</aside>
