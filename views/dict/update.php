<?php
/**
 * Created by PhpStorm.
 * User: liuyao
 * Date: 2016/3/9
 * Time: 12:10
 */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;


?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?><!--生成一个替换字符，表示css和js的引用代码在这里显示-->

        <!--核心CSS-->
        <link href="css/reset.css" rel="stylesheet" type="text/css">
        <link href="css/system.css" rel="stylesheet" type="text/css">
        <link href="css/public.css" rel="stylesheet" type="text/css">
        <link href="css/table_form.css" rel="stylesheet" type="text/css">
        <!--TAB样式-->
        <link href="css/tabpanel/core.css" rel="stylesheet" type="text/css">
        <link href="css/tabpanel/TabPanel.css" rel="stylesheet" type="text/css">
        <link href="css/tabpanel/Toolbar.css" rel="stylesheet" type="text/css">
        <link href="css/tabpanel/WindowPanel.css" rel="stylesheet" type="text/css">

        <script type="text/javascript" src="js/jquery.min.js"></script>
        <!--弹窗-->
        <script type="text/javascript" src="js/dialog/dialog.js"></script>
        <script type="text/javascript" src="js/styleswitch.js"></script>
        <script type="text/javascript" src="js/hotkeys.js"></script>
        <script type="text/javascript" src="js/jquery.sGallery.js"></script>
        <!--表单验证-->
        <script language="javascript" type="text/javascript" src="js/formvalidatorregex.js" charset="utf-8"></script>
        <script language="javascript" type="text/javascript" src="js/formvalidator.js" charset="utf-8"></script>
        <!--TAB JS-->
        <script type="text/javascript" src="js/tabpanel/Fader.js"></script>
        <script type="text/javascript" src="js/tabpanel/TabPanel.js"></script>
        <script type="text/javascript" src="js/tabpanel/Math.uuid.js"></script>
        <script type="text/javascript" src="js/tabpanel/Toolbar.js"></script>
        <script type="text/javascript" src="js/tabpanel/WindowPanel.js"></script>
        <script type="text/javascript" src="js/tabpanel/Drag.js"></script>
        <!--弹出图片-->
        <script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
        <script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
        <script type="text/javascript">
            var state = "<?=$dict->state?>";
            var listdictUrl = '<?=yii::$app->urlManager->createUrl('dict/listdict')?>';
            var findidUrl = '<?=yii::$app->urlManager->createUrl('dict/findid')?>';
            var updateUrl = '<?=yii::$app->urlManager->createUrl('dict/update')?>';
            var deleteUrl = '<?=yii::$app->urlManager->createUrl('dict/delete')?>';
        </script>
        <script language="javascript" type="text/javascript" src="js/admin/dict/update.js" charset="utf-8"></script>
    </head>
    <body>
        <div class="pad-lr-10">
            <form action="<?=yii::$app->urlManager->createUrl('dict/update')?>" id="dictForm" name="dictForm" method="post" target="iframeId">
                <div class="pad_10">
                    <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                        <table width="100%" cellspacing="0" class="table_form contentWrap">
                            <tr>
                                <th width="100">字典组标识</th>
                                <td>
                                    <?=$dict->dictCode?><input type="hidden" id="dictCode" value="<?=$dict->dictCode?>"/>
                                </td>
                            </tr>
                            <tr>
                                <th width="100">字典名称</th>
                                <td><input type="text" style="width:370px;" name="dictName"  value="<?=$dict->dictName?>"  id="dictName" class="input-text"/></td>
                            </tr>
                            <tr>
                                <th width="100">字典简介</th>
                                <td><textarea style="width:370px;height:80px;" id="intro"     name="intro"><?=$dict->intro?></textarea></td>
                            </tr>
                            <tr>
                                <th>是否可用</th>
                                <td>
                                    <select id="state" name="state" style="width:100px"></select>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="bk10"></div>
                </div>
                <!--列表-->
                <div class="table-list">
                    <table id="modelTplTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th align="left">字典排序</th>
                            <th align="left">字典项值</th>
                            <th align="left">字典项名称</th>
                            <th align="left">操作</th>
                        </tr>
                        </thead>
                        <tbody id="modelTplTB">
                            <?php if(!is_null($dictItems)){?>
                                <?php foreach ($dictItems as $index => $dictitem){?>
                                    <tr id="<?=$index?>">
                                        <td align="left">
                                            <input name="dictItemOrders" class="input-text" type="text" value="<?=$dictitem->orderBy?>" size="5" />
                                            <input name="dictItemIds" value="<?=$dictitem->id?>" type="hidden"/>
                                        </td>
                                        <td align="left"><input name="dictItemCodes" class="input-text" type="text" value="<?=$dictitem->dictItemCode?>" size="25" /></td>
                                        <td align="left"><input name="dictItemValues" class="input-text" type="text" value="<?=$dictitem->dictItemName?>" size="25" /></td>
                                        <td align="left"><a href="javascript:delrow('<?=$index?>','<?=$dictitem->id?>')">[删除]</a></td>
                                    </tr>
                                <?}?>
                            <?}?>
                        </tbody>
                    </table>
                    <div class="btn">
                        <!--  <label for="check_box">全选/取消</label>-->
                        <input type="button" class="buttonadd" name="dosubmit" value="增加" onclick="addrow()"/>
                        <input type="button" class="buttonsave" name="dosubmit" value="保存" onclick="update()"/>
                        <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('dict_edit').close();"/>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>