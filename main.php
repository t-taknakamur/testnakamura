<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=1042" />
    <title>モバイルオーダー＆モバイルPOS | 全部つながるOkageレジ管理画面</title>
<link href="./bootstrap3.7/css/font-awesome.min.css" rel="stylesheet">
<link href="./css/style_paper_2.css" rel="stylesheet" type="text/css" />
<link href="./css/csv_upload.css" rel="stylesheet" type="text/css" />
<link href="./bootstrap3.7/css/bootstrap.css" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/modaal@0.4.4/dist/css/modaal.min.css">
<!--<script type="text/javascript" src="--><?php //echo Yii::app()->baseUrl; ?><!--/js/jquery/js/jquery-1.8.3.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/bootstrap3.7/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/overlay.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/brajax.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/morris/morris.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/morris/raphael-min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.scrollbar.js"></script>
   
 
<script src="https://cdn.jsdelivr.net/npm/modaal@0.4.4/dist/js/modaal.min.js"></script>
<?php
//	if($this->need_bootstrap){
//		$baseUrl = Yii::app()->baseUrl;
//echo<<<EOF
//	<link href="{$baseUrl}/bootstrap3.7/css/bootstrap.css" rel="stylesheet"></link>
//	<link href="{$baseUrl}/bootstrap3.7/css/bootstrap-responsive.css" rel="stylesheet"></link>
//EOF;
//
//	}

?>


<script type="text/javascript">
    <?php
        $manuals_json = MANUALS;
        $manuals_json = str_replace("\r\n","",$manuals_json);
        $manuals_json = str_replace("\r","",$manuals_json);
        $manuals_json = str_replace("\n","",$manuals_json);
    ?>
    var show_set_table = false;

    var canEditMenucategory = false;
    <?php
        if($this->canEditMenucategory > 0){
            echo  "canEditMenucategory = true;\n";
        }
    ?>
    <?php
        if($this->is_resq != 1){
            echo "show_set_table = true;\n";
        }
        if($this->is_admin_login){
            echo "show_set_table = true;\n";
        }
    ?>

    var manuals = JSON.parse('<?php echo $manuals_json; ?>');
	var service_type = <?php echo $this->service_type; ?>;
	var menuHeights = [];
	var menulist = [];
	var menus = [
		{
			type : "red-menu",
			menus:[
                <?php
                    if($this->is_admin_login){ ?>
                {
                label:"管理者設定",
                type:"menu_leaf",
                link:"managerSetting"
                },
                <?php } ?>
                {
                    label:"カテゴリ設定",
                    type:"menu_leaf",
                    link:"categories"
                },{
                    label:"タイル設定",
                    type:"menu_leaf",
                    link:"tiles"
                },{
					label:"メニュー設定",
					type:"menu_leaf",
					link:"menus"
				},{
					label:"サブメニュー設定",
					type:"menu_leaf",
					link:"menus/sub_menu"
				},{
					label:"サブメニューグループ設定",
					type:"menu_leaf",
					link:"menuGroups"
				},
                <?php
                    $config = Configurations::model()->getParams(array(
                        'USE_WKD_COOKING_PLACE',
                        'USE_PIKAICHI',
                        'NECPF_POSREN_USE',
                        'USE_CODE_COUPON',
                        'USE_POINT_COUPON',
                        'USE_EXPORT_MASTER_EXCEL',
                        'USE_PORTAL',
                        'USE_CALL_MONITOR',
                        'USE_MOBILEORDER',
                        'USE_RESERVED',
                        'USE_MOBILEORDER_CODE_COUPON_PAGE',
                        'USE_MOBILEORDER_POINT_PAGE',
                        'USE_TIMEZONE_DISCOUNT',
                    ), $this->store_id);
                ?>
                <?php if ($config['USE_WKD_COOKING_PLACE'] == 1): ?>
                {
                    label:"調理場設定(WKD)",
                    type:"menu_leaf",
                    link:"cookingPlace"
                },
                <?php endif; ?>
                <?php if ($config['USE_PIKAICHI'] == 1): ?>
                {
                    label:"ぴかいちナビ連携設定",
                    type:"menu_leaf",
                    link:"pikaichi"
                },
                <?php endif; ?>
                <?php if ($config['NECPF_POSREN_USE'] != null): ?>
                {
                    label:"NECPF連携設定",
                    type:"menu_leaf",
                    link:"necPf/setting"
                },
                {
                    label:"NECPF メニュー同期",
                    type:"menu_leaf",
                    link:"necPf/menusync"
                },
                <?php endif; ?>
                <?php if($this->kitchenDisplayMax()>0): ?>
                {
					label:"キッチンカテゴリ設定",
					type:"menu_leaf",
					link:"kitchenCategory"
				},
                <?php endif; ?>
                {
                    label:"時間メニュー設定",
                    type:"menu_leaf",
                    link:"menuTimes",
                    service:2
                },
                {
                    label:"外国語メニュー設定",
                    type:"menu_leaf",
                    link:"menuLanguages",
                    service:2
                },{
					label:"放題設定",
					type:"menu_leaf",
					link:"setHoudai",
					service:2
				},{
					label:"オーダー制約",
					type:"menu_leaf",
					link:"orderConstraints",
				},{
				    label:"メニュー属性設定",
				    type:"menu_leaf",
				    link:"menuProperties"
				},{
				    label:"客層設定",
				    type:"menu_leaf",
				    link:"visitorTypes"
				},{
					label:"店舗情報設定",
					type:"small_menu_leaf",
					link:"setSettings"
				},{
					label:"ログイン端末管理",
					type:"small_menu_leaf",
					link:"setSettings/devices"
				},{
                    label:"店舗支払い設定",
                    type:"small_menu_leaf",
                    link:"setStorePayment"
                },/*{
                    label:"GMO設定",
                    type:"small_menu_leaf",
                    link:"gmo"
                },{
					label:"店舗グループ設定",
					type:"small_menu_leaf",
					link:"setStoreGroup"
				},*/{
					label:"テーブル設定",
					type:"small_menu_leaf",
					link:"setTables"
				},{
					label:"プリンタ設定",
					type:"small_menu_leaf",
					link:"setPrinters"
				},{
					label:"役割権限設定",
					type:"small_menu_leaf",
					link:"setPosts"
				},{
					label:"スタッフ設定",
					type:"small_menu_leaf",
					link:"setStaffs"
				},{
					label:"在庫設定",
					type:"small_menu_leaf",
					link:"setStock",
					service:2
				},{
					label:"印刷設定",
					type:"small_menu_leaf",
					link:"setReceiptLayout"
				},{
                    label:"顧客情報",
                    type:"small_menu_leaf",
                    link:"customers"
                },{
                    label:"削除メニュー復旧",
                    type:"small_menu_leaf",
                    link:"menus/restore"
                },{
					label:"アプリダウンロード",
					type:"small_menu_leaf",
					link:"downloads"
				},
				{
					label:"メニュープリンタマッピング設定",
					type:"menu_leaf",
					link:"MenuPrinterMapping"
				},
				{
					label:"メニュー価格一括設定",
					type:"menu_leaf",
					link:"menuPrices"
				},
                <?php if ($config['USE_WKD_COOKING_PLACE'] == 1): ?>
                {
                    label:"メニュー調理場一括設定(WKD)",
                    type:"menu_leaf",
                    link:"menuCookingPlace"
                },
                <?php endif; ?>
                <?php if ($config['USE_CODE_COUPON'] == 1): ?>
                // {
                //     label: "コードクーポン設定",
                //     type: "menu_leaf",
                //     link: "codeCoupon"
                // },
                <?php endif; ?>
                <?php if ($config['USE_TIMEZONE_DISCOUNT'] == 1): ?>
                {
                    label: "時間帯割引設定",
                    type: "menu_leaf",
                    link: "timezoneCoupon"
                },
                <?php endif; ?>
                <?php if ($config['USE_MOBILEORDER_CODE_COUPON_PAGE'] == 1 || $config['USE_MOBILEORDER_POINT_PAGE'] == 1): ?>
                {
                    label: "割引設定",
                    type: "menu_leaf",
                    link: "coupon"
                },
                <?php endif; ?>
                <?php if ($config['USE_POINT_COUPON'] == 1): ?>
                // {
                //     label:"ポイントクーポン設定",
                //     type:"menu_leaf",
                //     link:"pointCoupon"
                // },
                {
                    label:"ポイント設定",
                    type:"menu_leaf",
                    link:"point"
                },
                <?php endif; ?>
                <?php if ($config['USE_EXPORT_MASTER_EXCEL'] == 1): ?>
                {
                    label:"部門設定",
                    type:"menu_leaf",
                    link:"menuDepartment"
                },
                {
                    label:"メニュー部門設定",
                    type:"menu_leaf",
                    link:"pikaichi/menu_department"
                },
                {
                    label:"分類設定",
                    type:"menu_leaf",
                    link:"menuClassifications"
                },
                {
                    label:"メニュー分類設定",
                    type:"menu_leaf",
                    link:"pikaichi/menu_classifications"
                },
                {
                    label:"Excelダウンロード",
                    type:"menu_leaf",
                    link:"Export"
                },
                <?php endif; ?>
                <?php if ($config['USE_PORTAL'] == 1): ?>
                {
					label:"ポータル環境設定",
					type:"menu_leaf",
					link:"portal"
                },
                <?php endif; ?>
                {
					label:"CSV登録",
					type:"menu_leaf",
					link:"csvUpload"
				},
                <?php if ($config['USE_CALL_MONITOR'] == 1): ?>
                {
                    label:"呼び出しモニター設定",
                    type:"menu_leaf",
                    link:"callMonitor"
                },
                <?php endif; ?>
                {
					label:"ホワイトリストIP設定",
					type:"menu_leaf",
					link:"whiteIpList"
				},
			]
		},
		{
			type : "blue-menu",
			menus:[
				{
					label:"日次",
					type:"menu_leaf",
					link:"analyzes/cutoff"
				},{
					label:"月次",
					type:"menu_leaf",
					link:"analyzes/monthlyCutoff"
				},{
					label:"速報",
					type:"menu_leaf",
					link:"analyzes/report",
					service:2
				},
                <?php if ($config['USE_MOBILEORDER'] == 1): ?>
                {
                    label:"モバイル伝票管理",
                    type:"menu_leaf",
                    link:"vauchers/mobile"
                },
                <?php endif; ?>
                {
					label:"伝票管理",
					type:"menu_leaf",
					link:"analyzes/vouchers"
				},{
					label:"オーダー管理",
					type:"menu_leaf",
					link:"analyzes/orders"
				},{
					label:"掛売一覧",
					type:"menu_leaf",
					link:"analyzes/bill"
				},{
                    label:"監査レポート",
                    type:"menu_leaf",
                    link:"analyzes/audit_report"
                },{
                    label:"締めキャンセル",
                    type:"menu_leaf",
                    link:"vauchers"
                },{
                    label:"締めキャンセル履歴",
                    type:"menu_leaf",
                    link:"vauchers/histories"
                },{
                    label:"締め履歴",
                    type:"menu_leaf",
                    link:"cutoffHistories"
                },
            <?php if(isset($_SESSION["eit_auth"]) && $_SESSION["eit_auth"] ==1) { ?>
                {
                    label:"締め修正",
                    type:"menu_leaf",
                    link:"cutoff/changeDates"
                },
            <?php } ?>
            <?php if(Yii::app()->controller->isTechtouchTrial()): ?>
                {
					label:"時間帯分析",
					type:"lock_leaf",
					link:"analyzes/analyze_by_time"
				},{
					label:"日別分析",
					type:"lock_leaf",
					link:"analyzes/analyze_by_date"
				},{
					label:"週別分析",
					type:"lock_leaf",
					link:"analyzes/analyze_by_week"
				},{
					label:"月別分析",
					type:"lock_leaf",
					link:"analyzes/analyze_by_month"
				},{
					label:"曜日別分析",
					type:"lock_leaf",
					link:"analyzes/analyze_by_day_of_week"
				},{
                    label:"メニュー属性分析",
                    type:"lock_leaf",
                    link:"analyzes/menu_property"
                },{
                    label:"客層別分析",
                    type:"lock_leaf",
                    link:"analyzes/analyze_by_visitor"
                },{
                    label:"従業員別分析",
                    type:"lock_leaf",
                    link:"analyzes/employees"
                },{
                    label:"カテゴリ別分析",
                    type:"lock_leaf",
                    link:"analyzes/categories"
                },{
                    label:"ABC分析",
                    type:"lock_leaf",
                    link:"analyzes/analyze_by_abc"
                },{
					label:"分析設定",
					type:"lock_leaf",
					link:"analyzes/analyze_setting"
				}
            <?php else:?>
                {
					label:"時間帯分析",
					type:"small_menu_leaf",
					link:"analyzes/analyze_by_time"
				},{
					label:"日別分析",
					type:"small_menu_leaf",
					link:"analyzes/analyze_by_date"
				},{
					label:"週別分析",
					type:"small_menu_leaf",
					link:"analyzes/analyze_by_week"
				},{
					label:"月別分析",
					type:"small_menu_leaf",
					link:"analyzes/analyze_by_month"
				},{
                    label:"曜日別分析",
					type:"small_menu_leaf",
					link:"analyzes/analyze_by_day_of_week"
				},{
                    label:"メニュー属性分析",
                    type:"small_menu_leaf",
                    link:"analyzes/menu_property"
                },{
                    label:"客層別分析",
                    type:"small_menu_leaf",
                    link:"analyzes/analyze_by_visitor"
                },{
                    label:"従業員別分析",
                    type:"small_menu_leaf",
                    link:"analyzes/employees"
                },{
                    label:"カテゴリ別分析",
                    type:"small_menu_leaf",
                    link:"analyzes/categories"
                },{
                    label:"ABC分析",
                    type:"small_menu_leaf",
                    link:"analyzes/analyze_by_abc"
                },{
					label:"分析設定",
					type:"small_menu_leaf",
					link:"analyzes/analyze_setting"
				}
            <?php endif; ?>
			]
		}
	];

    //  menusにmanualを加える
    var  manual_obj = {
        type:"yellow-menu",
        menus:[]
    };
    for(var i in manuals){
        manual_obj.menus.push({
            label:manuals[i].label,
            urlpath:manuals[i].urlpath,
            type:manuals[i].type
        });
    }
    menus.push(manual_obj);


	function openMenu(num){


		var obj = $("#menu_"+num);
		if(parseInt(obj.css("height"))<1){
			$("#menu_"+num).animate({
				height:menuHeights[num]
			}, 200);
		}else{
			$("#menu_"+num).animate({
				height:0
			}, 200);
		}
		for(var row in menulist){
			if(obj != $("#menu_"+row)){
				var obj2 = $("#menu_"+row);
				if(parseInt(obj2.css("height"))>0){
					obj2.animate({
						height:0
					}, 200);
				}
			}
		}
	}

	function menuInit(){
         var num=1;
		for(var row in menus){
		    var _class = menus[row].type;
			var menu = menus[row].menus;
//			var _div = $("<div/>").attr("id","menu_"+num).attr("class", "menu-view "+menus[row].type);
            var _div = $("." + _class);
			for(var i in menu){
                var m = menu[i];

                if(!show_set_table && m.link == "setTables"){
                    continue;
                }
//                if(!canEditMenucategory && m.link =="kitchenCategory") continue;

				if(m.service && service_type < m.service){
					_div.append(
						$("<li/>").attr("class", m.type)
                            .append(
                                $("<i/>").attr("class", "glyphicon glyphicon-menu-right primary-color")
                            )
                            .append(
                                $("<a/>").html(m.label).attr("href", "javascript:authError();")
                            )
					);
				}
                else if(m.urlpath){
					_div.append(
						$("<li/>").attr("class", m.type).append(
                            $("<i/>").attr("class", "glyphicon glyphicon-menu-right primary-color")
                        ).append(
                            $("<a/>").html(m.label).attr("href", m.urlpath).attr("target","_blank")
                        )
					);
                }
                else{
					_div.append(
						$("<li/>").attr("class", m.type).append(
                            $("<i/>").attr("class", "glyphicon glyphicon-menu-right primary-color")
                        ).append(
                            $("<a/>").html(m.label).attr("href", "./index.php?r=" + m.link)
                        )
					);
				}
			}
//			$("#menu_holder").append(_div);
			menuHeights[num] = _div.css("height");
//			_div.css("height", 0);
//			_div.css("overflow", "hidden");
			menulist[num] = _div;
			num++;
            jQuery('.scrollbar-inner').scrollbar();
		}
	}

	function changeClientByHeader(sel){
        var selectedIndex = sel.selectedIndex;
        var selectedOption = sel.options[selectedIndex];

        // hiddenフィールドにstore_idをセットする
        document.client_change_form.change_client_cd_store_id.value = selectedOption.getAttribute("store_id");
        document.client_change_form.submit();
	}

	function changeStoreByHeader(sel){
        document.store_change_form.submit();
	}

	function authError(){
		alert("Miniでは使用できません。");
	}

	function backTop(){
        if ($('#back-to-top').length) {
            var scrollTrigger = 100, // px
                backToTop = function () {
                    var scrollTop = $(window).scrollTop();
                    if (scrollTop > scrollTrigger) {
                        $('#back-to-top').addClass('show');
                    } else {
                        $('#back-to-top').removeClass('show');
                    }
                };
            backToTop();
            $(window).on('scroll', function () {
                backToTop();
            });
            $('#back-to-top').on('click', function (e) {
                e.preventDefault();
                $('html,body').animate({
                    scrollTop: 0
                }, 700);
            });
        }
    }
    $(document).ready(function(){
        $('.dropdown-toggle').dropdown();
    });
</script>

</head>

<body>
<div id="contenter">
    <?php $isTrial = $this->isTrial()?>
    <?php if($isTrial):?>
    <div style="position: fixed;background:red;height:50px;top:0;left:0;right:0;z-index:9;text-align: center;color:white">
        <p style="margin-top:15px">無料トライアル期間は2017年○○月○○日です。本登録のお申込みは<a href="<?php echo Yii::app()->createUrl('account/active')?>" style="width: 1024px;margin: 0 auto;color:white;text-decoration: underline">こちら</a>から</p>
    </div>
    <?php endif?>
  	<div id="header" class="navbar navbar-default navbar-fixed-top" <?php echo ($isTrial)?"style=\"top:50px\"":""?>>
  		<div id="header-inner" style="margin: auto; width:1024px;">
            <div class=" col-md-12">
                <div class="row">
                <div class="col-md-5 slogan">
                    <h2 style="font-size:22pt">
                        管理画面
                    </h2>
                    <p class="primary-color" style="font-size:14pt;margin-top: 10px">
                        
                    </p>
                </div>
                <a href="<?php echo Yii::app()->createUrl("/issues/taxrate2019");?>" class="btn btn-danger" style="position: absolute; top:60px; right:10px;">!!!!増税・軽減税率対応はこちら!!!!</a>
                <div class="col-md-7 store_change_form text-right">
                    <a href="./Logout.php"  ><img src="img/logout-icon.png" /><span>ログアウト</span></a>
                    <a target="_blank"href="<?php  echo HELP_PAGE; ?>"><img src="img/icon_inquiry.png"  width="20px" rel="noopener noreferrer"/><span>ヘルプページ</span></a>
                    <form name="client_change_form" class="" method="POST" >
                        <input name="change_client_cd_store_id" type="hidden" />
                        <div class="menus-styled-select">
                        <?php
                        if($this->need_bootstrap){
                            echo '<select class="form-control" name="change_client_cd" style="width:250px; font-size:12px;" onchange="changeClientByHeader(this);">';
                        }else{
                            echo '<select class="form-control" name="change_client_cd" style="width:250px;  font-size:12px;  border: 1px solid #cccccc; border-radius: 3px; " onchange="changeClientByHeader(this);">';
                        }
                        ?>
                        <?php
                        foreach($this->child_accounts as $ca){
                            $client_cd = $ca['client_cd'];
                            $store_id = $ca['store_id'];
                            $store_name = (isset($ca['client_store_name']) && strlen($ca['client_store_name']) > 0)
                                ? $ca['client_store_name']." ({$client_cd})"
                                : $client_cd;
                            if($client_cd == $_SESSION["client_cd"] && $store_id == $this->store_id){
                                echo "<option selected='selected' store_id='{$store_id}' value='{$client_cd}'>{$store_name}</option>";
                            }else{
                                echo "<option store_id='{$store_id}' value='{$client_cd}'>{$store_name}</option>";
                            }
                        }
                        ?>
                        </select>
                        </div>
                    </form>
                </div>
                </div>
            </div>
            <div class=" col-md-12 top-nav">

            <div class="col-md-3 item" >
                <div class="dropdown col-md-12 " >
                    <p id="menu1" class=" dropdown-toggle" type="button" data-toggle="dropdown">
                        <span>設定</span>
                    </p>
                    <ul class="dropdown-menu red-menu scrollbar-inner" style="max-height: 350px;overflow: hidden">
                    </ul>
                </div>
            </div>
            <div class="col-md-3 item">
                <div class="dropdown col-md-12 " >
                    <p id="menu2"  class=" dropdown-toggle" type="button" data-toggle="dropdown"><span>分析</span></p>
                    <ul class="dropdown-menu blue-menu scrollbar-inner">
                    </ul>
                </div>
            </div>
            <div class="col-md-3 item">
                <div id="menu4" class=" col-md-12 dropdown <?php echo ($this->getId() == 'notifications')?"open":""?>" >
                    <a href="<?php echo Yii::app()->baseUrl; ?>/index.php?r=notifications">お知らせ</a>
                    <?php if($this->countUnreadMessage()>0):?>
                        <span class="new-msg">重要</span>
                    <?php endif?>
                </div>
            </div>
            <div class="col-md-3 item">
                <div class=" col-md-12 " >
                    <a href="<?php echo Yii::app()->baseUrl; ?>/index.php?r=contact" id="menu3" ><span>お問い合わせ</span></a>
                </div>
            </div>

            <div id="menu_holder">
            </div>
        </div>

		</div>
  	</div>

    <!---コンテンツ--->
  <div id="content" class="container">


  	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>


    </div>
    <!---コンテンツ--->



</div>

<!---下画像固定部分--->
<div id="footer" >
    <div class="container">
        OkageSystem v<?php echo Yii::app()->params["SERVER_APPLICATION_VERSION"]; ?>
    </div>
</div>
<a href="#" id="back-to-top" title="Back to top"><i class="glyphicon glyphicon-menu-up"></i></a>
<script type="text/javascript">
menuInit();
backTop();
    <?php
        if(isset($this->js_alert_message) && strlen($this->js_alert_message)>0){
            echo "alert('{$this->js_alert_message}');";
        }
    ?>

</script>
</body>
</html>
