<?php

use backend\models\image\ProjectImage;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $model ProjectImage */
$this->title = '数据详情';
$this->params['breadcrumbs'][] = ['label' => '数据管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/js/autocomplete/easy-autocomplete.css",['position'=>$this::POS_BEGIN]);
$this->registerCssFile("@web/js/autocomplete/easy-autocomplete.themes.css",['position'=>$this::POS_BEGIN]);
$this->registerCssFile("@web/css/jquery.selectareas.css",['position'=>$this::POS_BEGIN]);
$this->registerJsFile("@web/js/jquery.selectareas.js",['position'=>$this::POS_BEGIN]);
$this->registerJsFile("@web/js/autocomplete/jquery.easy-autocomplete.js",['position'=>$this::POS_BEGIN])
?>
<div class="content">
    <div class="row">
        <div class="col-lg-8 col-md-8">
            <img alt="标注图片" style="align-self: center;" id="image_to_process"  />
        </div>
        <div class="col-lg-4 col-md-8">

            <div class="box">
                <div class="box-header">
                    <div style="padding-top: 4px" class="ae_small_90">
                        <!-- -->	<span id="status">从图片中选择一个区域.</span>
                    </div>
                </div>
                <div class="box-body">

                    <?=Select2::widget([
                        'name'=>'tag_input',
                        'data' => [
                            'safeHat'=>'safeHat',
                            'withoutSafeHat'=>'withoutSafeHat'
                        ],
                        'theme' => Select2::THEME_KRAJEE,
                        'options' => ['id'=>'tag_input','width'=>'80px','placeholder' => '请标注类型','multiple' => false],
                        'pluginOptions' => [
                            'width'=>'60%',
                            'allowClear' => true
                        ],
                    ])?>

                    <?=Html::button('设置标注',['id'=>"add_region",'class'=>'btn btn-success','style'=>'margin-top:20px;'])?>


                </div>

            </div>

            <div class="box box-solid bg-teal-gradient">
                <div class="box-header ui-sortable-handle" style="cursor: move;">
                    <i class="fa fa-th"></i>

                    <h3 class="box-title">标注信息</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>序号</th>
                                <th>标签</th>
                                <th>区域坐标点</th>
                                <th>区域宽*高</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody id="label-info">

                            </tbody>
                        </table>
                    </div>


                </div>
                <?php $form = ActiveForm::begin([
                    'options' => ['style' =>'background:white;padding:20px','id'=>'frm'],
                    'action'=>['view']
                ]); ?>

                <?= $form->field($model, 'image_annotation')->hiddenInput(['maxlength' => true,'id'=>'image_annotation']) ?>
                <div class="box-footer">
                    <?=Html::button('验证保存',['id'=>"validate_button",'class'=>'btn btn-success'])?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>

        </div>
    </div>
</div>

<script>
    let selection_xy = [];
    let tag_error_raised = false;
    let new_zone_created = false;
    let init_finished = false;
    let current_area = null;
    MESSAGE_EMPTY_TAG = "你需要在这里输入tag";
    RED_COLOR = "#C70039";
    GREEN_COLOR = "#80A60E";
    let changeStatusMessage = false;
    let json_annotations = [];
    let list_of_tags = [];
    let current_visible_area_id = -1;
    let user_id = "";
    let image_info = {
        url: "",
        id:"",
        folder: "",
        width: 0,
        height: 0,
        annotations: [],
    };
    let lastLoadedWidth  = 0;
    let lastLoadedHeight = 0;
    let firstWidth = 0;

    $(document).ready(function ()
    {
        //读取图片
        $('#image_to_process').attr("src",'<?=Url::to("@web".$model->image_url)?>');
        <?php if(!empty($model->image_annotation)){?>
        json_annotations = [<?=Json::encode(unserialize($model->image_annotation))?>];
        <?php }?>
        console.log(json_annotations);
        //加载图片
        $('#image_to_process').on("load", function()
        {
            changeStatusMessage = false;
            //获取图片长宽
            lastLoadedWidth = $(this).get(0).naturalWidth;
            lastLoadedHeight = $(this).get(0).naturalHeight;
            //赋值给image——info
            image_info.width  = lastLoadedWidth;
            image_info.height = lastLoadedHeight;

            console.log("INFO: " + "image_info.width = "  + image_info.width);
            console.log("INFO: " + "image_info.height = " + image_info.height);

            if (firstWidth == 0)
            {
                firstWidth = $('#image_to_process').get(0).width;
            }

            let ratio = lastLoadedWidth / lastLoadedHeight;

            let col2_width = 2*$(window).width() / 3;
            // Image is to large
            if (image_info.width < col2_width)
            {
                col2_width = image_info.width;
            }

            let image_screen_width = col2_width;
            let image_screen_height = image_screen_width/ratio;

            // Image is to high
            if (image_screen_height > $(window).height()*0.75)

            {
                image_screen_height = parseInt($(window).height()*0.75,10);
                image_screen_width = parseInt(image_screen_height*ratio,10);
                col2_width = image_screen_width;

            }

            // alert("New image size = " + image_screen_width + "px , " + image_screen_height + "px");

            remaining_x_space = $(window).width() - col2_width;
            col1_width = 1*remaining_x_space /6;
            col3_width = 4*remaining_x_space /6;
            col4_width = 1*remaining_x_space /6;

            $("#image_to_process").attr({width:image_screen_width+"px"});
            $("#image_to_process").attr({height:image_screen_height+"px"});
            $("#col1").css("width",col1_width+"px");
            $("#col2").css("width",col2_width+"px");
            $("#col3").css("width",col3_width+"px");
            $("#col4").css("width",col4_width+"px");


            let ratio_original_to_screen_x = image_screen_width / lastLoadedWidth;
            let ratio_original_to_screen_y = image_screen_height / lastLoadedHeight;

            // Loop on tag info
            json_annotations.forEach(function(element) {
                let areaOptions = {
                    x: (element.x * ratio_original_to_screen_x),
                    y: (element.y * ratio_original_to_screen_y),
                    width: (element.width * ratio_original_to_screen_x),
                    height: (element.height * ratio_original_to_screen_y),
                    tag:element.tag, };

                // We have to convert x, y and size to image in the HTML page
                $('#image_to_process').selectAreas('add', areaOptions);
            });

            // Get list of areas
            let areas = $('#image_to_process').selectAreas('areas');

            if (areas.length>0)
            {
                // Selected area is the first one
                current_area = areas[0];
                // Select first area
                onAreaChanged(null, current_area.id, areas)
                $('#image_to_process').selectAreas('set', current_area.id);
            }
            else
            {

                current_area = null;
            }

        });
        //删除标注
        // $('#image_to_process').selectAreas('delete',function (event,id,area) {
        //     console.log('标注区域改变')
        // });
        $('#image_to_process').selectAreas({
            onChanging : test,
        });


        //进入及二个阶段
        console.log('js  number 2')
        $('#image_to_process').on("changed", function(event, id, areas)
        {
            //console.log("信息: " + "index.html on(changed)");
            for (var i = 0; i < areas.length; i++)
            {
                //console.log("INFO: " + "area " + areas[i].id);
                //console.log(areas[i]);
                if (areas[i].id === id)
                {
                    area = areas[i];
                    current_area = area;
                    addInfoByChange(area);
                }

            }

            if (area == null)
            {
                console.log("INFO: area is null return");
                current_area = null;
                return;
            }

            // Add the top/left offset of the image position in the page
            var region_tag_length = $("#tag_input").val().length;

            // Set back the area tag if stored
            var stored_tag = area.tag;
            if (stored_tag.length >= 3)
            {
                setValidInputTag(stored_tag);
                region_tag_length = area.tag.length;
            }
            else
            {
                // Set en empty tag
                setNotYetValidInputTag("");
                region_tag_length = 0;
            }

            // Do not focus if tag is not empty and at begining or after new zone creation
            if ( (init_finished) && (region_tag_length===0) )
            {
                $("#tag_input").focus();
            }
            else
            {
                $("#tag_input").focusout();
            }
            new_zone_created = false

            // Check region size
            if (isAreaTooSmall(area))
            {
                setStatusAndColor("The region is too small (must be >80px).", RED_COLOR)

                newWidth = area.width;
                newHeight = area.height;

                if (newWidth < 80)
                {
                    newWidth = 80;
                }

                if (newHeight < 80)
                {
                    newHeight = 80;
                }
                console.log("selectAreas"+ current_area.id)
                $('#image_to_process').selectAreas('resizeArea', current_area.id, newWidth, newHeight);
            }
            else
            {
                if (changeStatusMessage)
                {
                    setStatus("Region has been selected.");
                }
            }
            //console.log("标注信息")
            //console.log(image_info)
        });

        new_zone_created = false
        //设置标注
        $('#add_region').click(function(e) {
            // Sets a random selection
            setTagAndRegion();
        });
        //验证标注信息
        $('#validate_button').click(function(e) {
            // Sets a random selection
            validateTagsAndRegions();
        });



        $("#tag_input").focus(function() {

            if (tag_error_raised)
            {
                tag_error_raised = false
                $("#tag_input").val("");
                $('#tag_input').css({'color':'#000'});
            }
        });

        $("#tag_input").focusout(function() {
            isTagInAuthorizedList()
        });

        $("#tag_input").on('keyup', function (e) {
            if (e.keyCode == 13)
            {
                // alert("Entering #13");
                var region_tag = $("#tag_input").val();
                if (region_tag.length >= 3)
                {
                    setTagAndRegion();
                }
            }
        });

        init_finished = true;
    });

    function setValidInputTag(_tag)
    {
        $("#tag_input").val(_tag);
        isTagInAuthorizedList();
    }

    function setNotYetValidInputTag(_tag)
    {
        $("#tag_input").val(_tag);
        isTagInAuthorizedList();
    }
    //判断标签是否存在
    function isTagInAuthorizedList()
    {
        let region_tag = $("#tag_input").val();

        let list_of_tags = [];
        $("#tag_input option").each(function (k,v) {
            if(k===0) return;
            list_of_tags.push($(this).val())
        });
        // console.log('tags list');
        //console.log(list_of_tags)
        if (list_of_tags.indexOf(region_tag)>=0)
        {
            $('#tag_input').css({'color':'#14AEE1'});
            return true;
        }
        else
        {
            $('#tag_input').css({'color':'#000'});
            return false;
        }

    }
    //监视标注区域的删除
    function onAreaDeleted(event, id, areas)
    {
        console.log('进入标注区域删除');
        if (current_area !=null)
        {
            if (current_area.id === id)
            {
                current_area = null;
                setNotYetValidInputTag("");
                $("#l"+id).remove();
            }
        }
        // if current unset tag @todo later
    }

    //监控标注区域变化
    function onAreaChanged(event, id, areas)
    {
        console.log('changed')
        // Find area by id
        for (var i = 0; i < areas.length; i++)
        {
            // console.log("INFO: " + "area " + areas[i].id);
            if (areas[i].id === id)
            {
                let area = areas[i];
                current_area = area;
            }
        }

        if (area == null)
        {
            console.log("INFO: area is null return");
            current_area = null;
            return;
        }

        // Add the top/left offset of the image position in the page
        var region_tag_length = $("#tag_input").val().length;

        // Set back the area tag if stored
        var stored_tag = area.tag
        if (stored_tag.length >= 3)
        {
            setValidInputTag(stored_tag);
            region_tag_length = area.tag.length;
        }
        else
        {
            // Set en empty tag
            setNotYetValidInputTag("");
            region_tag_length = 0;
        }

        // Do not focus if tag is not empty and at begining or after new zone creation
        if ( (init_finished) && (region_tag_length===0) )
        {
            $("#tag_input").focus();
        }
        else
        {
            $("#tag_input").focusout();
        }
        new_zone_created = false

        // Check region size
        if (isAreaTooSmall(area))
        {
            setStatusAndColor("The region is too small (must be >80px).", RED_COLOR)

            newWidth = area.width;
            newHeight = area.height;

            if (newWidth < 50)
            {
                newWidth = 30;
            }

            if (newHeight < 50)
            {
                newHeight = 50;
            }

            $('#image_to_process').selectAreas('resizeArea', current_area.id, newWidth, newHeight);
        }
        else
        {
            if (changeStatusMessage)
            {
                setStatus("已选择区域.");
            }
        }
    }
    //判断标注区域是否太小
    function isAreaTooSmall(area)
    {
        if ((area.width<30) || (area.height<30))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function px(n) {return Math.round(n) + 'px';	}
    //设置状态和颜色
    function setStatusAndColor(status_text, color)
    {
        $('#status').css('color', color);
        $("#status").text(status_text);
    }

    // 默认提示信息颜色是黑色
    function setStatus(status_text)
    {
        setStatusAndColor(status_text, "#000");
    }

    //设置标签以及区域
    function setTagAndRegion()
    {

        changeStatusMessage = true;

        if (tag_error_raised)
        {
            return false;
        }

        if (current_area == null)
        {
            onAreaChanged(null, current_area.id, areas);
        }

        if (isAreaTooSmall(current_area))
        {
            setStatusAndColor("Tag was not set, the region is too small.", RED_COLOR)
            return false;
        }

        var region_tag = $("#tag_input").val();

        if (region_tag.length < 3)
        {
            // Display an alert
            tag_error_raised = true
            $("#tag_input").val(MESSAGE_EMPTY_TAG);
            $('#tag_input').css({'color':'#999'});

            return false;
        }

        if (!isTagInAuthorizedList())
        {
            setStatusAndColor("This tag is not in the predefined list.", RED_COLOR);
            return false;
        }

        // Just change the tag, get area, id, ...
        $('#image_to_process').selectAreas('setTag', current_area.id, region_tag);
        $("#l"+current_area.id).find("td").eq(1).text(region_tag)
        setStatus("Tag has been set.（标注已经设置）");

        // Selection another box
        new_zone_created = true	;

        // Init text
        $("#tag_input").focusout();

        return true;
    }
    //验证标签和标注区域并提交标注信息
    function validateTagsAndRegions()
    {

        // Process the list of tags
        var areas = $('#image_to_process').selectAreas('areas');

        if (areas.length === 0)
        {
            setStatusAndColor("在提交之前，至少创建一个带有标记的区域.", RED_COLOR);
            return false;
        }

        let index_tag = 0;
        let ratioX = lastLoadedWidth/$('#image_to_process').width();
        let ratioY = lastLoadedHeight/$('#image_to_process').height();
        let tmp_annotations = [];

        let error_occurs = false;
        $.each(areas, function (id, area) {
            var tag_info = {tag:"",x:0,y:0,width:0,height:0};
            tag_info.tag = area.tag;
            tag_info.x = area.x * ratioX;
            tag_info.y = area.y * ratioY;
            tag_info.width = area.width * ratioX;
            tag_info.height = area.height * ratioY;
            // To be checked
            tmp_annotations.push(tag_info);
            // image_info.annotations[index_tag] = tag_info;
            index_tag = index_tag + 1;

            if (area.tag.length<3)
            {
                if (areas.length==1)
                {
                    setStatusAndColor("你应该在区域中添加一个标记.", RED_COLOR);
                }
                else
                {
                    setStatusAndColor("您应该为每个区域添加一个标记.", RED_COLOR);
                }
                error_occurs = true;
                return false;
            }

        });

        if (error_occurs) return false;

        // image_info.annotations = JSON.stringify(tmp_annotations);
        image_info.annotations = tmp_annotations;
        //alert(image_info.annotations);
        console.log("INFO: annotations : " + image_info.annotations);
        console.log("INFO: annotations : " + JSON.stringify(image_info));

        $("#image_annotation").val(JSON.stringify(image_info));
        $("#frm").submit();

    }
    //根据标注区域在右侧添加、更新标注信息
    function addInfoByChange(areaObj) {
        if($('#l'+areaObj.id).length>0){
            $('#l'+areaObj.id).find("td").eq(2).text("x:" + areaObj.x + "y:" + areaObj.y);
            $('#l'+areaObj.id).find("td").eq(3).text( areaObj.width + "*" + areaObj.height);
        }else {
            let html = "<tr id='l" + areaObj.id + "'><td>" + areaObj.id + "</td>" + "<td></td>" +
                "<td>x:" + areaObj.x + "y:" + areaObj.y + "</td><td>" + areaObj.width + "*" + areaObj.height + "</td>" +
                "<td><a class='label label-success' onclick='deleteObj("+areaObj.id+")'>删除</td></tr>";
            $("#label-info").append(html);
        }
    }

    function deleteObj(obj) {
        $("#l"+obj).remove();
    }
    function test(event, id, areas) {
        console.log('test changed')
    }

</script>

