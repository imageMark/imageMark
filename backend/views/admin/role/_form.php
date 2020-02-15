<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model \backend\models\admin\Permission*/
/* @var $form yii\widgets\ActiveForm */
//\backend\assets\AppAsset::register($this);
//$this->registerJsFile("@web/js/echarts.min.js",['position'=>$this::POS_END]);
?>
<div class="box-body">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxLength' => true])->label("角色名称") ?>

    <?= $form->field($model, 'remark')->textarea(['maxLength' => true])->label("角色说明") ?>
    <div class="box box-success box-solid">

        <div class="box-header with-border">
            <h3 class="box-title">创建角色权限</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" name="closeAction" ><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
        <?php
        $tops = \backend\models\admin\Permission::takePermissionForSelect();
        foreach($tops as $k=> $top){?>
            <div class="col-md-12 bg-gray" >
                <label><input type="checkbox" name="Permission[]" value="<?=$top['id']?>" class="top" data-key="<?=$k?>" ><?php echo $top['name']; ?></label>
            </div>
            <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;">
                <input type="checkbox" class="flat-red" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
            <div class="help-block"></div>
            <?php if(isset($top['child'])){foreach($top["child"] as $key=> $one){?>
                <div class="col-md-1"></div>
                <div class="col-md-11">
                    <label style="width: 100px;">
                        <input type="checkbox" name="Permission[]"  value="<?=$one["id"]?>" class="one" data-key="<?=$k?>"  id="limit-<?=$k?>-<?=$key?>" ><?php echo $one['name']; ?>
                    </label>
                    <?php if(isset($one['child'])){foreach($one["child"] as $two){?>
                        <label style="font-weight: inherit"> <input type="checkbox" name="Permission[]" value="<?=$two['id']?>" class="limit-<?=$k?>-<?=$key?>" data-tag="two" data-key="<?=$k?>"  style="margin-left: 20px;"><?php echo $two['name']; ?></label>
                    <?php }
                    } ?>
                </div>
                <div class="help-block"></div>
            <?php } ?>
            <?php } ?>
        <?php } ?>
        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    $(document).ready(function () {
        //顶级权限选择
        $("input[type=checkbox][class=top]").change(function(){
            var val = $(this).attr("data-key");
            if($(this).prop('checked')==true) {
                $("input[type=checkbox][data-key="+val+"]").prop('checked',true);
            }else{
                $("input[type=checkbox][data-key="+val+"]").prop('checked',false);
            }
        });
        //次级权限选择
        $("input[type=checkbox][class=one]").change(function(){
            var name = $(this).attr("id");
            var val=$(this).attr("data-key");
            if($(this).prop('checked')==true) {
                $('.'+name).prop('checked',true);
                $("input[class=top][data-key="+val+"]").prop('checked',true);
            }else{
                $('.'+name).prop('checked',false);
            }
        });
        //三级权限选择
        $("input[type=checkbox][data-tag=two]").change(function(){
            var name = $(this).attr("class");
            var val=$(this).attr("data-key");
            if($(this).prop('checked')==true) {
                $('#'+name).prop('checked',true);
                $("input[class=top][data-key="+val+"]").prop('checked',true);
            }
        }) ;
    });
</script>