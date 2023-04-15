<style>
.payTable.payTableButton {
	display: none;
}

.modal-dialog {
	overflow-y: initial !important;
	width: 70% !important;
	height: 750px;
}

.modal-body {
	height: 750px;
	overflow-y: auto;
	overflow-x: hidden;

}

#menuGroupTable tbody td {
	padding: 10px 15px 20px 15px !important;
}

#categoryTable tbody td {
	padding: 10px 15px 20px 15px !important;
}

table.dataTable td {
    /*word-wrap:break-word;*/
    line-break:normal;
}
.subitem{
    display:inline-block
}

#hintmodal .modal-dialog {
	height: 100px;
    margin-top: 350px;
}

#hintmodal .modal-body {
	height: 100px;
}
.hint-text {
    font-size: 1.1em;
    margin: 25px 0;
    line-height: 1.6rem;
    color: #333;
}

.modal-backdrop {
  background-color: rgba(0, 0, 0, 8); /* 半透明の黒 */
}

.modal {
 display: none;
}
.modal-open {
  overflow: hidden;
  position: fixed;
  width: 100%;
}




* {
  box-sizing: border-box;
}

.section {
  height: 100vh;
}
.section1 {
  background-color: #ccccff;
  display: flex;
  justify-content: center;
  align-items: center;
}
.section2 {
  background-color: #99ccff;
}
.section3 {
  background-color: #ffccff;
}

/**************************\
  Basic Modal Styles
\**************************/

.modal {
  font-family: -apple-system, BlinkMacSystemFont, avenir next, avenir,
    helvetica neue, helvetica, ubuntu, roboto, noto, segoe ui, arial, sans-serif;
}

.modal__overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.6);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal__container {
  background-color: #fff;
  padding: 30px;
  max-width: 500px;
  max-height: 100vh;
  border-radius: 4px;
  overflow-y: auto;
  box-sizing: border-box;
}

@media screen and (max-width: 480px) {
  .modal__container {
    max-height: 90vh;
    max-width: 300px;
  }
}

.modal__header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.modal__title {
  margin-top: 0;
  margin-bottom: 0;
  font-weight: 600;
  font-size: 1.25rem;
  line-height: 1.25;
  color: #00449e;
  box-sizing: border-box;
}

.modal__close {
  background: transparent;
  border: 0;
}

.modal__header .modal__close:before {
  content: "\2715";
}

.modal__content {
  margin-top: 2rem;
  margin-bottom: 2rem;
  line-height: 1.5;
  color: rgba(0, 0, 0, 0.8);
}

.modal__btn {
  font-size: 0.875rem;
  padding-left: 1rem;
  padding-right: 1rem;
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
  background-color: #e6e6e6;
  color: rgba(0, 0, 0, 0.8);
  border-radius: 0.25rem;
  border-style: none;
  border-width: 0;
  cursor: pointer;
  -webkit-appearance: button;
  text-transform: none;
  overflow: visible;
  line-height: 1.15;
  margin: 0;
  will-change: transform;
  -moz-osx-font-smoothing: grayscale;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  -webkit-transform: translateZ(0);
  transform: translateZ(0);
  transition: -webkit-transform 0.25s ease-out;
  transition: transform 0.25s ease-out;
  transition: transform 0.25s ease-out, -webkit-transform 0.25s ease-out;
}

.modal__btn:focus,
.modal__btn:hover {
  -webkit-transform: scale(1.05);
  transform: scale(1.05);
}

.modal__btn-primary {
  background-color: #00449e;
  color: #fff;
}

/**************************\
  Demo Animation Style
\**************************/
@keyframes mmfadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

@keyframes mmfadeOut {
  from {
    opacity: 1;
  }
  to {
    opacity: 0;
  }
}

@keyframes mmslideIn {
  from {
    transform: translateY(15%);
  }
  to {
    transform: translateY(0);
  }
}

@keyframes mmslideOut {
  from {
    transform: translateY(0);
  }
  to {
    transform: translateY(-10%);
  }
}

.micromodal-slide {
  display: none;
}

.micromodal-slide.is-open {
  display: block;
}

.micromodal-slide[aria-hidden="false"] .modal__overlay {
  animation: mmfadeIn 0.3s cubic-bezier(0, 0, 0.2, 1);
}

.micromodal-slide[aria-hidden="false"] .modal__container {
  animation: mmslideIn 0.3s cubic-bezier(0, 0, 0.2, 1);
}

.micromodal-slide[aria-hidden="true"] .modal__overlay {
  animation: mmfadeOut 0.3s cubic-bezier(0, 0, 0.2, 1);
}

.micromodal-slide[aria-hidden="true"] .modal__container {
  animation: mmslideOut 0.3s cubic-bezier(0, 0, 0.2, 1);
}

.micromodal-slide .modal__container,
.micromodal-slide .modal__overlay {
  will-change: transform;
}










</style>
<link href="<?php echo Yii::app()->baseUrl; ?>/css/datatable/jquery.dataTables.min.css" rel='stylesheet' />
<link href="<?php echo Yii::app()->baseUrl; ?>/css/datatable/style.css" rel='stylesheet' />
<script type="text/javascript">

// 全置換：全ての文字列 org を dest に置き換える
   String.prototype.replaceAll = function(org, dest) {
      return this.split(org).join(dest);
   }

   var use_edit_menugroups_minmax = parseInt("<?php echo Configurations::model()->getParam("USE_EDIT_MENUGROUP_MINMAX", $this->store_id); ?>", 0);
   var is_submenu = false;
   var hidemenus = [];
   var necpfMenuCode;
   var storageUnitPrice;
   var storageNotaxUnitPrice;
   window.onload = function() {
      loadData();

<?php
if ($product_mode == "sub") {
    echo ' $("#search_category_box").css("display","none");';
    echo 'is_submenu=true;';
}
?>

        $("#checkAll").bind("click", function(e){
            var totalLen = $(".menu_check_box").length;
            var checkedLen = $(".menu_check_box:checked").length;
            if (e.target.checked){
                $(".menu_check_box").prop("checked", true);
            }else{
                $(".menu_check_box").prop("checked", false);
                // $(".menu_check_box").removeAttr("checked");
            }
        });

        $("#btnCopyKeigen").bind("click", function(e){

            const checked = $(".menu_check_box:checked").prop("checked", true);
            let menus = [];
            let groups = [];
            let menu_names = [];
            let group_names = [];
            for (let box of checked) {
                let mobj = {
                    menu_id: $(box).attr("menu_id"),
                    menu_name: $(box).attr("menu_name"),
                    menu_classe_id: $(box).attr("menu_classe_id"),
                    tax_include: $(box).attr("tax_include"),
                    amount: $(box).attr("amount"),
                    fraction_method: $(box).attr("fraction_method"),
                };
                menu_names.push(mobj.menu_name);
                menus.push(mobj);

                if (parseInt($(box).attr("menu_classe_id"), 0) == 3) {
                    groups.push(mobj);
                    group_names.push(mobj.menu_name);
                }
            }
            if (menus.length < 1) {
                alert("メニューが選択されていません。");
                return;
            }
            const prefix = $("#textCopyPrefix").val();
            if (prefix.length > 2) {
                alert("コピー後のメニューの先頭につける言葉 は2文字以内でお願い致します。");
                return;
            }
            if (prefix.length < 1 && !window.confirm("コピー後のメニューの先頭につける言葉 が設定されていません。同じ名称でコピーされますがよろしいですか？")) {
                return;
            }
            if (!window.confirm(menu_names.join(",")+" をコピーします。よろしいですか？")) {
                return;
            }
            if (group_names.length > 0 && !window.confirm(group_names.join(",") + "は展開メニューです。展開メニューは単品メニューとしてコピーされますので、コピー後はサブメニューの設定が必要です。コピーしてよろしいですか？")) {
                return;
            }

            let form = $("<form/>");
            form.attr("action", "./index.php?r=menus/copy");
            form.attr("method", "POST");
            form.append($("<input/>").attr("name", "prefix").val(prefix));
            for (let m of menus){
                form.append($("<input/>").attr("name", "menu_ids[]").val(m.menu_id));
                form.append($("<input/>").attr("name", "settings[]").val(m.menu_id + ',' + m.tax_include + ',' + m.amount + ',' + m.fraction_method));
            }
            $(document.body).append(form);
            console.log(form);
            form.submit();
        });

        $('#tax_include').on('change', function() {
            let taxInclude = $(this).val();
            let amount = $('#amount').val();
            if (amount !== '') {
                amount = parseInt(amount, 0);
                let tax = $('#tax').val();
                let rate = (tax == 2) ? 110: 108;
                let fraction_method = $('#fraction_method').val(); // 1:切り捨て, 2:切り上げ, 3:四捨五入
                let unit_price = 0;
                let notax_unit_price = 0;

                if (taxInclude == 1) {
                    // 税込
                    notax_unit_price = (amount / rate) * 100;
                    notax_unit_price = getPriceByFractionMethod(notax_unit_price, fraction_method);
                    unit_price = amount;
                } else if (taxInclude == 2) {
                    // 税抜
                    unit_price = (amount * rate) / 100;
                    unit_price = getPriceByFractionMethod(unit_price, fraction_method);
                    notax_unit_price = amount;
                }

                $('input[name="data[unit_price]"]').val(unit_price);
                $('input[name="data[notax_unit_price]"]').val(notax_unit_price);
                customstorage.setItem('unit_price', JSON.stringify(unit_price));
                customstorage.setItem('notax_unit_price', JSON.stringify(notax_unit_price));
            }
        });

        $('#amount').on('input', function() {
            let amount = $(this).val();
            let unit_price = 0;
            let notax_unit_price = 0;
            if (amount !== '') {
                amount = parseInt(amount, 0);
                let taxInclude = $('#tax_include').val();
                let tax = $('#tax').val();
                let rate = (tax == 2) ? 110: 108;
                let fraction_method = $('#fraction_method').val(); // 1:切り捨て, 2:切り上げ, 3:四捨五入

                if (taxInclude == 1) {
                    // 税込
                    notax_unit_price = (amount / rate) * 100;
                    notax_unit_price = getPriceByFractionMethod(notax_unit_price, fraction_method);
                    unit_price = amount;
                } else if (taxInclude == 2) {
                    // 税抜
                    unit_price = (amount * rate) / 100;
                    unit_price = getPriceByFractionMethod(unit_price, fraction_method);
                    notax_unit_price = amount;
                }
            } else {
                unit_price = '';
                notax_unit_price = '';
            }
            $('input[name="data[unit_price]"]').val(unit_price);
            $('input[name="data[notax_unit_price]"]').val(notax_unit_price);
            customstorage.setItem('unit_price', JSON.stringify(unit_price));
            customstorage.setItem('notax_unit_price', JSON.stringify(notax_unit_price));
        });

        $('#tax').on('change', function() {
            let tax = $(this).val();
            let amount = $('#amount').val();
            if (amount !== '') {
                amount = parseInt(amount, 0);
                let taxInclude = $('#tax_include').val();
                let rate = (tax == 2) ? 110: 108;
                let fraction_method = $('#fraction_method').val(); // 1:切り捨て, 2:切り上げ, 3:四捨五入
                let unit_price = 0;
                let notax_unit_price = 0;

                if (taxInclude == 1) {
                    // 税込
                    notax_unit_price = (amount / rate) * 100;
                    notax_unit_price = getPriceByFractionMethod(notax_unit_price, fraction_method);
                    unit_price = amount;
                } else if (taxInclude == 2) {
                    // 税抜
                    unit_price = (amount * rate) / 100;
                    unit_price = getPriceByFractionMethod(unit_price, fraction_method);
                    notax_unit_price = amount;
                }

                $('input[name="data[unit_price]"]').val(unit_price);
                $('input[name="data[notax_unit_price]"]').val(notax_unit_price);
                customstorage.setItem('unit_price', JSON.stringify(unit_price));
                customstorage.setItem('notax_unit_price', JSON.stringify(notax_unit_price));
            }
        });

        $('#fraction_method').on('change', function() {
            let fraction_method = $(this).val(); // 1:切り捨て, 2:切り上げ, 3:四捨五入
            let amount = $('#amount').val();
            if (amount !== '') {
                amount = parseInt(amount, 0);
                let taxInclude = $('#tax_include').val();
                let tax = $('#tax').val();
                let rate = (tax == 2) ? 110: 108;
                let unit_price = 0;
                let notax_unit_price = 0;

                if (taxInclude == 1) {
                    // 税込
                    notax_unit_price = (amount / rate) * 100;
                    notax_unit_price = getPriceByFractionMethod(notax_unit_price, fraction_method);
                    unit_price = amount;
                } else if (taxInclude == 2) {
                    // 税抜
                    unit_price = (amount * rate) / 100;
                    unit_price = getPriceByFractionMethod(unit_price, fraction_method);
                    notax_unit_price = amount;
                }

                $('input[name="data[unit_price]"]').val(unit_price);
                $('input[name="data[notax_unit_price]"]').val(notax_unit_price);
                customstorage.setItem('unit_price', JSON.stringify(unit_price));
                customstorage.setItem('notax_unit_price', JSON.stringify(notax_unit_price));
            }
        });
    }

   var datalist;
   var base_datalist;
   var textValue;
   //Used to handle menu group required check
   var menuGroupRequiredObj = {};
   var service_type = <?php echo $this->service_type; ?>;

   var menu_type_labels = {
      1: "<span style='font-weight:bold;'>[単]</span>",
      2: "<span style='font-weight:bold;'>[グ]</span>",
      3: "<span style='font-weight:bold; color:blue;'>[展]</span>",
      4: "<span style='font-weight:bold;'>[放]</span>",
      5: "<span style='font-weight:bold; color:red; '>[サブ]</span>"
   };

    /* 端数計算方法から金額取得 */
    function getPriceByFractionMethod(price, fractionMethod) {
        if (fractionMethod == 1) {
            return Math.floor(price)
        } else if (fractionMethod == 2) {
            return Math.ceil(price)
        } else {
            return Math.round(price)
        }
    }

   /* ローディング表示 */
   function showLoading() {

      var loading_view = $("<div/>").attr("id", "loading_view")
              .css("background-color", "black")
              .css("opacity", 0.7)
              .css("position", "absolute")
              .css("top", 0).css("left", 0)
              .css("text-align", "center")
              .css("z-index", 2000)
              .css("width", "100%").css("height", $("#contenter").height())

      loading_view.append(
              $("<div/>").css("margin-top", $(document.body).height() / 2).append(
              $("<div/>").html("通信中").css("color", "white"),
              $("<img/>").attr("src", "<?php echo Yii::app()->baseUrl; ?>/img/loading_indi.gif")
              )
              );

      $(document.body).append(loading_view);

   }
   /* ローディング非表示 */
   function hideLoading() {

      $("#loading_view").remove();
   }


   /* フォームをリセットする */
   function resetForm() {
      document.getElementsByName("data[menu_id]")[0].value = "";
      document.getElementsByName("data[menu_name]")[0].value = "";
      document.getElementsByName("data[menu_limit_in_order]")[0].value = "";
      document.getElementsByName("data[price_type]")[0].value = "0";
      document.getElementsByName("data[menu_code]")[0].value = "";
      if (document.getElementsByName("data[coupon_code]").length > 0){
          document.getElementsByName("data[coupon_code]")[0].value = "";
      }
      document.getElementsByName("data[unit_price]")[0].value = "";
      document.getElementsByName("data[notax_unit_price]")[0].value="";
      document.getElementsByName("data[cost_price]")[0].value = "";
      //document.getElementsByName("data[menu_tax]")[0].value="";
      $(document.form_insert["data[menu_tax]"]).css("display", "none");
      document.getElementsByName("checkUseDefaultTax")[0].checked = true;
      $("#span_notax_unit_price").html("");
      $("#span_unit_price").html("");
      $('#tax_include').val(1);
      $('#amount').val('');
      $('#tax').val(2);
      $('#fraction_method').val(1);

      $("#culculated_price").html("");

      setMenuGroups([]);
      setCategoryForm([], []);

      $("#select_printer_1").val("");
      $("#select_printer_2").val("");
      $("#select_printer_3").val("");

      for (var row in document.getElementsByName("data[category_type_id]")) {
         document.getElementsByName("data[category_type_id]")[row].checked = false;
      }
      for (var row in document.getElementsByName("data[menu_property_id]")) {
         document.getElementsByName("data[menu_property_id]")[row].checked = false;
      }
       $("#menu_colors_id").val(0);
       var style = "display: inline-block;width: 33px; height: 33px;background: transparent";
       $("#previewColor").attr('style', style );

       $("[name='data[ignore_receipt_flag]']")[0].checked = false;
       $("[name='data[ignore_customer_voucher_flag]']")[0].checked = false;

       document.getElementsByName("data[as_topping]")[0].checked = false;
       if (document.getElementsByName("data[hide_at_mobileorder]") &&
       document.getElementsByName("data[hide_at_mobileorder]").length > 0
       ){
        document.getElementsByName("data[hide_at_mobileorder]")[0].checked = false;
       }

       if ($("#necpf_menucode").length > 0){
           $("#necpf_menucode").html("");
       }

       //Used clear the menu grouprequired object
       resetMenuGroupRequiredObj();
   }

   /* データ表示 */
   function makeDataList(opt) {
      var res = datalist;

      var table_html = "";
      for (var i in res) {

         var print_str = "";
         for (var num in res[i]["printers"]) {
            print_str += res[i]["printers"][num].printer_name + ",";
         }
         if (print_str.length > 0)
            print_str = print_str.substr(0, print_str.length - 1);


         var category_str = "";
         for (var num in res[i]["categories_label"]) {

            var cname = res[i]["categories_label"][num];
            cname = cname.replaceAll("<", "&lt;");
            cname = cname.replaceAll(">", "&gt;");

            category_str += cname + ",";
         }
         if (category_str.length > 0)
            category_str = category_str.substr(0, category_str.length - 1);

         // resultのkey[menuProperties]でproperties name get
         var menu_attribute = "";
         menu_attribute += res[i]["menuProperties"];

         var sub_info = '【プリンタ】' + print_str + '<br>【カテゴリ】' + category_str + '<br>【メニュー属性】' + menu_attribute;
         if (is_submenu) {
            sub_info = '【プリンタ】' + print_str + '<br>【メニュー属性】' + menu_attribute;
         }

        <?php if (Configurations::model()->find("configuration_name = 'NECPF_POSREN_USE' and store_id = {$this->store_id}") != null): ?>
            sub_info += '<br>【NECPF連携】';
            sub_info += (res[i]["externalMenu"] && res[i]["externalMenu"]["media"] == "necpf")
            ? res[i]["externalMenu"]["code"]
            : "未連携";
        <?php endif;?>

<?php if ($this->kitchenDisplayMax() > 0): ?>
            if (res[i]["categoryType"]) {
               sub_info += "<br>【キッチンカテゴリ属性】" + res[i]["categoryType"]["category_type_name"];
            } else {
               sub_info += "<br>【キッチンカテゴリ属性】所属カテゴリに従う";
            }
<?php endif; ?>


          var toppingMark = (res[i]["as_topping"] && parseInt(res[i]["as_topping"], 0) > 0)
              ? " <span style='color:gray; font-size:10px;'>[トッピング]</span>"
              : "";


         var dname = res[i]["menu_name"];
         dname = dname.replaceAll("<", "&lt;");
         dname = dname.replaceAll(">", "&gt;");

         table_html += '\
                  <tr>\
                    <td>&nbsp;</td>\
                    <td style=""><input type="checkbox" class="menu_check_box" menu_name="'+res[i]["menu_name"]+'" menu_classe_id="'+res[i]["menu_classe_id"]
                        +'" menu_id="'+res[i]["menu_id"]+'" tax_include="'+res[i]["tax_include"]+'" amount="'+res[i]["amount"]+'" fraction_method="'+res[i]["fraction_method"]+'"></td>\
                    <td style="">' + menu_type_labels[res[i]["menu_classe_id"]] + ' ' + dname + toppingMark + '</td>\
                    <td style="font-size:12px;">価格：' + res[i]["unit_price"] + '<br />\
原価：' + res[i]["cost_price"] + '</td>\
                    <td style="font-size:12px;">' + sub_info + '</td>\
                    <td width="90">\
                       <button   type="button" class="btn-gray btn-gray-pl-15" onclick="javascript:setDataToForm(' + i + ');">編集</span></button></td>\
                    <td width="50"><span class="menus-btn-delete" onclick="javascript:deleteData(' + res[i]["menu_id"] + ');">削除</span></td>\
              </tr>\
                        ';



      }
      $("#datalist_table").html(table_html);
      if (opt && opt.isFromSearch) {
      } else {
         doSearch();
      }
   }

    /* データ取得 */
    function loadData() {
        showLoading();
        $.ajax({
            url: "<?php echo Yii::app()->baseUrl; ?>/index.php?r=menus/ajax_get",
            type: "GET",
            data: "mode=<?php echo $product_mode; ?>",
            dataType: "json",
            success: function(json) {
               if (parseInt(json.status) != 1000) {
                  alert(json.error_message);
                  return;
               }

               datalist = json.result;
               base_datalist = json.result;
               hidemenus = json.hidemenus;
               makeDataList();
               //Used to load the data from storage based on menu_id
               loadFromLocal();
               hideLoading();
            },
            error: function() {
               hideLoading();
            },
            complete: function() {
               hideLoading();
            }
        });
    }


    function insertData() {
        if ($('#amount').val() == '') {
            alert('金額が入力されていません');
            return;
        }
        let divergence = getDivergence() / 10;
        let check = checkDivergence();

        if (check){
            insertDataExec();
            return;
        }

        if (window.confirm("設定された金額と税率に、"+divergence+"%の乖離があります。本当に登録してもよろしいですか？")){
            insertDataExec();
        }
    }

   /* データ登録 */
   function insertDataExec() {

      /*
       //  個別税率ばりでーと
       //  if  個別にチェック && 税額が空
       if(document.form_insert.checkUseDefaultTax[1].checked &&
       document.form_insert["data[menu_tax]"].value.length <1){
       alert("個別税率が入力されていません。");
       return;
       }*/

        // validation
        if (!$('#tax').val()) {
            alert("税率が選択されていません。");
            return;
        }

      showLoading();

      //	データをセット
      var post_string = "mode=insert&client_cd=<?php echo Yii::app()->controller->client_cd; ?>&store_id=<?php echo Yii::app()->controller->store_id; ?>";
      var elem = document.form_insert.elements;
      for (var i in elem) {
         if (!elem[i].type)
            continue;
         if (elem[i].type == "radio" && !elem[i].checked)
            continue;
         if (elem[i].type == "checkbox"){
             if (elem[i].checked){
                 post_string += "&" + elem[i].name + "=1";
             }else{
                 post_string += "&" + elem[i].name + "=0";
             }
             continue;
         }
         post_string += "&" + elem[i].name + "=" + encodeURIComponent(elem[i].value);
      }

        // tax_id
        var tax_id = $("#tax").val();
        post_string += "&data[tax_id]="+tax_id;

      //	メニューグループを加える
      for (var i in menuGroups) {
         post_string += "&data[sub_menu_ids][]=" + menuGroups[i]["menu_id"];

         if ($("#menu_group_required_" + menuGroups[i]["menu_id"]).prop("checked")) {
            post_string += "&data[sub_menu_required][]=1";
         } else {
            post_string += "&data[sub_menu_required][]=0";
         }
      }

      //  カテゴリを加える
      for (var i = 0; i < categories.length; i++) {
         post_string += "&data[category_ids][]=" + categories[i]["category_id"];
      }

      post_string += "&menu_type=<?php echo $product_mode; ?>";

      $.ajax({
         url: "<?php echo Yii::app()->baseUrl; ?>/index.php?r=menus/ajax_insert",
         type: "GET",
         data: post_string,
         dataType: "json",
         success: function(json) {
            hideLoading();


            if (parseInt(json.status) == 901){
                // reload
                alert(json.error_message);
                document.location.reload();
                return;
            }
            else if (parseInt(json.status) != 1000) {
               alert(json.error_message);
               return;
            }
            alert("データ登録しました。");
            datalist = json.result;
            base_datalist = json.result;
            hidemenus = json.hidemenus;
            makeDataList();
            doSearch();

            resetForm();

         },
         error: function() {
            hideLoading();
         },
         complete: function() {
            hideLoading();
         }
      });

        return false;
    }


    /* フォームにデータを反映する */
    function setDataToForm(idx) {
        localStorage.removeItem("menu_name");
        resetForm();

        $("html,body").stop().animate({scrollTop: $('#contenter').offset().top}, 500);

        if ($("#necpf_menucode").length > 0){
            customstorage.removeItem('necpf_menucode');
            $("#necpf_menucode").html("");
            $("#necpf_menucode").html(datalist[idx]["externalMenu"]["code"]);
            customstorage.setItem('necpf_menucode', JSON.stringify(datalist[idx]["externalMenu"]["code"]));
        }
        var elem = document.form_insert.elements;

        for (var i in elem) {
            if (!elem[i].type)
                continue;
            if (elem[i].name.length < 1)
                continue;

            var property_name = elem[i].name.substring(5, elem[i].name.length - 1);


        if (!datalist[idx][property_name]) continue;

        if (property_name == "menu_name") {
            var dname = datalist[idx]["menu_name"];
            dname = dname.replaceAll("&lt;", "<");
            dname = dname.replaceAll("&gt;", ">");
            elem[i].value = dname;
            continue;
        }

        // 1回の注文数上限
        if (property_name === 'menu_limit_in_order') {
            $('#menu_limit_in_order').val(datalist[idx][property_name] !== "0" ? datalist[idx][property_name] : "");
            continue;
        }

        if (property_name == "as_topping") {
            var as_topping = datalist[idx]["as_topping"];
            elem[i].checked = (parseInt(as_topping ,0) > 0);
            console.log(elem[i]);
            continue;
        }

        if (property_name == "menu_tax") {
            if (datalist[idx]["menu_tax"].length > 0) {
                // 個別設定あり
                // 税金フォームを表示し、checkをoffにする
                $(document.form_insert["data[menu_tax]"]).css("display", "inline");
                document.form_insert["checkUseDefaultTax"][0].checked = false;
                document.form_insert["checkUseDefaultTax"][1].checked = true;
            } else {
                $(document.form_insert["data[menu_tax]"]).css("display", "none");
                document.form_insert["checkUseDefaultTax"][0].checked = true;
                document.form_insert["checkUseDefaultTax"][1].checked = false;
            }
        }

        if (property_name == "category_type_id" && datalist[idx][property_name] == 0) {
            document.getElementsByName("data[category_type_id]")[0].checked = true;
            continue;
        }

            if (property_name == 'cooking_place_id' && datalist[idx][property_name] === -1) {
                let cookingPlaceRadio = document.getElementsByName("data[cooking_place_id]")
                let count = cookingPlaceRadio.length;
                for (j = 0; j < count; j++) {
                    cookingPlaceRadio[j].checked = false;
                }
            }

            if (property_name === 'tax_include') {
                $('#tax_include').val(datalist[idx][property_name]);
            }

            if (property_name === 'amount') {
                $('#amount').val(datalist[idx][property_name]);
            }

            if (property_name === 'fraction_method') {
                $('#fraction_method').val(datalist[idx][property_name]);
            }

            if (property_name === 'unit_price') {
                customstorage.setItem('unit_price', JSON.stringify(datalist[idx][property_name]));
            }

            if (property_name === 'notax_unit_price') {
                customstorage.setItem('notax_unit_price', JSON.stringify(datalist[idx][property_name]));
            }

            if (elem[i].type == "radio") {
                if (datalist[idx][property_name] == elem[i].value) {
                    elem[i].checked = true;
                }
                continue;
            }


            elem[i].value = datalist[idx][property_name];
        }
      setCategoryForm(datalist[idx]["categories"], datalist[idx]["categories_label"]);
      //Used to set menu groups item based on selected menu
      setMenuGroupCheck(datalist[idx]["menu_group"]);
      setMenuGroups(datalist[idx]["menu_group"]);
      setPrinters(datalist[idx]["printers"]);

      if (datalist[idx]["current_tax"]){
        console.log(datalist[idx]);
        let taxobj = datalist[idx]["current_tax"];
        let taxobjClass = "-info";
        if (taxobj.tax_id == 1){
            taxobjClass = "-info";
        }
        else if (taxobj.tax_id == 2){
            taxobjClass = "-success";
        }
        else if (taxobj.tax_id == 3){
            taxobjClass = "-danger";
        }
            if (parseInt(taxobj.tax_id, 0) == 2) {
                $('#tax').val(2);
            } else {
                $('#tax').val(3);
            }
        }

       $("[name='data[ignore_receipt_flag]']")[0].checked = (parseInt(datalist[idx]["ignore_receipt_flag"], 0) == 1);
       $("[name='data[ignore_customer_voucher_flag]']")[0].checked = (parseInt(datalist[idx]["ignore_customer_voucher_flag"], 0) == 1);


       updatePriceLabel();

       var style = "display: inline-block;width: 33px; height: 33px;background: ";
       if(datalist['menu_colors_id'] != '0'){
           $("#previewColor").attr('style', style + $("#menu_colors_id option:selected").text());
       }else{
           $("#previewColor").attr('style', style + "transparent");
       }

       // Okage Go で非表示にするフォーム制御
       if ($("[name='data[hide_at_mobileorder]']") &&
       $("[name='data[hide_at_mobileorder]']").length > 0
       ){
        $("[name='data[hide_at_mobileorder]']")[0].checked = (hidemenus.indexOf(parseInt(datalist[idx]["menu_id"], 0)) >= 0);
       }
    }

   /**
    * 税込み、税抜きの自動計算
    */
   function updatePriceLabel(obj) {

      if (!obj) return;

      var tax = $(document.form_insert["data[menu_tax]"]).val();
      var length = tax.length;
      tax = parseFloat(tax);
      if (!tax || tax.length < 1)
         tax = parseFloat("<?php echo $this->default_tax * 100; ?>");
      tax = parseFloat(tax) / 100;

      if($(obj).val().length < 1){
         // 空フォーム
         document.form_insert["data[notax_unit_price]"].value = "";
         document.form_insert["data[unit_price]"].value = "";
         return;
      }
      var currentPrice = parseInt($(obj).val());
      if($(obj).attr("name") === "data[notax_unit_price]"){
         // 税抜き金額を入力
         document.form_insert["data[unit_price]"].value = Math.floor(currentPrice * (1 + tax));
      }
      else if($(obj).attr("name") === "data[unit_price]"){
         // 税込み金額を入力
         document.form_insert["data[notax_unit_price]"].value = Math.floor(currentPrice / (1 + tax));
      }
   }

   /* プリンタをセット */
   function setPrinters(plist) {
      $("#select_printer_1").val("");
      $("#select_printer_2").val("");
      $("#select_printer_3").val("");

      for (var i = 0; i < plist.length; i++) {
         var num = i + 1;
         $("#select_printer_" + num).val(plist[i]["printer_id"]);
      }
   }

    /**
    * カテゴリを表示する
    * @returns {undefined}
    */
   function setCategoryForm(ids, labels) {
      var tbl = $("#tbl_menu_category");
      tbl.css("display", "table");
      tbl.empty();
      categories = [];
      for (var i = 0; i < ids.length; i++) {
         var arr = [];
         arr["category_id"] = ids[i];
         arr["category_name"] = labels[i];
         categories.push(arr);
         tbl.append(
                 $("<tr/>").append(
                 $("<td/>").html(labels[i])
                 )
                 );
      }
      if (categories.length < 1) {
         tbl.css("display", "none");
      }

      //Used to set the categories in storage variable
      savetoLocal('categoryIds',ids);
      savetoLocal('categoryLabels',labels);
   }



   /* データ削除 */
   function deleteData(mid) {

      if (!window.confirm("本当に削除しますか？"))
         return;

      $.ajax({
         url: "<?php echo Yii::app()->baseUrl; ?>/index.php?r=menus/ajax_delete",
         type: "GET",
         data: "menu_id=" + mid + "&mode=<?php echo $product_mode; ?>&client_cd=<?php echo Yii::app()->controller->client_cd; ?>&store_id=<?php echo Yii::app()->controller->store_id; ?>",
         dataType: "json",
         success: function(json) {

            if (parseInt(json.status) != 1000) {
               alert(json.error_message);
               return;
            }

            alert("削除しました。");
            document.location.reload();

            makeDataList(json.result);
            resetForm();

         },
         error: function() {
         },
         complete: function() {
         }
      });
   }

   function linkToSetDetail() {

      var menu_id_form = document.getElementsByName("data[menu_id]")[0];
      if (menu_id_form.value < 1) {
         alert("商品が保存されていません。\n商品を一度保存してから、選択してください。");
         return;
      }
      window.location.href = "./index.php?r=menus/set_detail&menu_id=" + menu_id_form.value;
   }





   /* 検索テキスト入力 */
   function changeText(keyCode, value) {
      // テキストが変更されていなかったら処理をしない
      if (textValue == value) {
         return;
      }

      // 以下処理
      doSearch();
   }


   /* 検索を実行 */
   function doSearch() {


      var new_datalist = [];
      for (var i in base_datalist) {
         new_datalist.push(base_datalist[i]);
      }


      var search_text = $("#search_menu_name").val();
      var search_cate = $("#search_category").val();

      for (var i = new_datalist.length - 1; i >= 0; i--) {
         //	メニューネームテスト

         if (new_datalist[i].menu_name.indexOf(search_text) < 0) {
            new_datalist.splice(i, 1);
         }

         if (search_cate > 0) {
            var flag = false;
            if (new_datalist[i]) {
               for (var row in new_datalist[i].categories) {
                  if (new_datalist[i].categories[row] == search_cate) {
                     flag = true;
                     break;
                  }
               }
            }
            if (!flag) {
               new_datalist.splice(i, 1);
            }
         }

      }

      datalist = new_datalist;
      makeDataList({isFromSearch: true});
   }

    function previewColor(_this, event) {
        var style = "display: inline-block;width: 33px; height: 33px;background: ";
        if($(_this).val() != '0'){
            $("#previewColor").attr('style', style + $("#menu_colors_id option:selected").text());
        }else{
            $("#previewColor").attr('style', style + "transparent");
        }
    }

     // check sessionStorage is available if not use the localStorage
    let customstorage = sessionStorage?sessionStorage:localStorage

    //Used to set the customstorage
    function savetoLocal(key, value) {
        if (value) {
            customstorage.setItem(key, JSON.stringify(value));
        }
    }

    //Used to load the menugroup,category from storage
    function loadFromLocal() {
        var menu_id_form = document.getElementsByName("data[menu_id]")[0];
        if (menu_id_form.value) {
            if (customstorage.getItem('categoryIds')) {
                categoryIds = JSON.parse(customstorage.getItem('categoryIds'));
                categoryLabels = JSON.parse(customstorage.getItem('categoryLabels'));
            }
            if (customstorage.getItem('menuGroupsCheck')) {
                    menuGroupRequiredObj = JSON.parse(customstorage.getItem('menuGroupsCheck'));
            }
            if (customstorage.getItem('menuGroups')) {
                menuGroups = JSON.parse(customstorage.getItem('menuGroups'));
            }
            if (customstorage.getItem('necpf_menucode')) {
                necpfMenuCode = JSON.parse(customstorage.getItem('necpf_menucode'));
            }
            if (customstorage.getItem('unit_price')) {
                storageUnitPrice = JSON.parse(customstorage.getItem('unit_price'));
            }
            if (customstorage.getItem('notax_unit_price')) {
                storageNotaxUnitPrice = JSON.parse(customstorage.getItem('notax_unit_price'));
            }
            // clearLocal();
            if (menuGroups) {
                setMenuGroups(menuGroups);
            }
            if (categoryIds) {
                setCategoryForm(categoryIds, categoryLabels);
            }
            if (necpfMenuCode) {
                $("#necpf_menucode").html("");
                $("#necpf_menucode").html(necpfMenuCode);
            }
            if (storageUnitPrice) {
                $('input[name="data[unit_price]"]').val(storageUnitPrice);
            }
            if (storageNotaxUnitPrice) {
                $('input[name="data[notax_unit_price]"]').val(storageNotaxUnitPrice);
            }

        } else {
            clearLocal();
        }

    }

    //Used to clear the storage items
    function clearLocal() {
        customstorage.clear();
    }

    /***** Confirmation  box *****/
    /**
     * Used show confirmation box
     *
     * @integer pinterColumn holds printer column value
     * @string displayText hols the confirmation alert detail
     */
    function confirmation(displayText) {
    var r = confirm(displayText);
    if (r == true) {
    return true;
    }
    return false;
    }

    function checkDivergence(){
        var divergence = getDivergence();
        return  !(divergence > 10);
    }

    function getDivergence(){

        let tax_id = $('#tax').val();
        if (!tax_id) return 0;
        let rate = (tax_id == 2) ? 0.1 : 0.08;
        let unit = parseInt($('input[name="data[unit_price]"]').val(), 0);
        let notax = parseInt($('input[name="data[notax_unit_price]"]').val(), 0);

        let uprate = parseInt(rate * 1000, 0);
        let prate = parseInt(((unit / notax) - 1) * 1000, 0);
        if (unit > 0) prate = (isNaN(prate) || !prate) ? parseInt(unit * 1000, 0) : parseInt(prate, 0);

        let divergence = Math.abs(uprate - prate);
        return divergence;
    }
</script>

<br />

<link href="<?php echo Yii::app()->baseUrl; ?>/css/datatable/jquery.dataTables.min.css" rel='stylesheet' />
<link href="<?php echo Yii::app()->baseUrl; ?>/css/datatable/style.css" rel='stylesheet' />
<div>
    <div class="row">
        <div class="col-md-12 legend">
            <?php if(Yii::app()->user->hasFlash("success")): ?>
                <div class="alert alert-success"><?php echo Yii::app()->user->getFlash("success"); ?></div>
            <?php endif; ?>
            <?php if(Yii::app()->user->hasFlash("error")): ?>
                <div class="alert alert-danger in alert-block fade"><?php echo Yii::app()->user->getFlash("error"); ?></div>
            <?php endif; ?>
            <legend><?php echo $menu_title; ?>入力</legend>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
           <form id="form_insert" class ="form-basic" name="form_insert" action="" method="POST">
               <input type="text" name="data[menu_id]" style="display:none;" />

               <div class="form-group clearfix menus-border-top">
                   <label class="col-md-2">メニュー名</label>
                   <div class="col-md-10">
                       <?php
                           $config = Configurations::model()->getParams(array(
                               'NECPF_POSREN_USE',
                               'USE_KIOSK_COUPON',
                               'USE_WKD_COOKING_PLACE',
                               'MOBILEORDER_USE_HIDE_SUBMENUS',
                           ), $this->store_id);
                       ?>
                       <?php if ($config['NECPF_POSREN_USE'] != null): ?>
                       <div class="col-md-4" style="width:100%;">
                            <input style="display:inline; width:30%;" name="data[menu_name]" type="text" class="form-control menus-input-background menu_name" id="menu_input_name" />
                            <div style="display:inline; margin-left:10px;">NECPFメニューコード: <span id="necpf_menucode"></span></div>
                       </div>
                       <?php else: ?>
                       <div class="col-md-4">
                            <input name="data[menu_name]" type="text" class="form-control menus-input-background menu_name" id="menu_input_name" />
                       </div>
                       <?php endif; ?>
                   </div>
               </div>

               <div class="form-group clearfix ">
                   <label class="col-md-2">1回の注文数上限
                       <?php foreach ($hints as $key => $hint): ?>
                           <?php if ('key3' == $key): ?>
                            <span id="order_qty_cnd" data-toggle="modal" data-target="#hintmodal" data-hint="<?php echo $hint; ?>">
                                <img src="img/icon_inquiry.png" width="20px"/>
                            </span>
                           <?php endif; ?>
                       <?php endforeach; ?>
                   </label>
                   <div class="col-md-10">
                       <div class="col-md-4">
                           <input name="data[menu_limit_in_order]" type="text" class="form-control menus-input-background" id="menu_limit_in_order" />
                       </div>
                   </div>
               </div>

               <div class="form-group clearfix ">
                   <label class="col-md-2">メニューコード
                       <?php foreach ($hints as $key => $hint): ?>
                           <?php if ('key1' == $key): ?>
                            <span id="menu_code" data-toggle="modal" data-target="#hintmodal" data-hint="<?php echo $hint; ?>">
                                <img src="img/icon_inquiry.png" width="20px"/>
                            </span>
                           <?php endif; ?>
                       <?php endforeach; ?>
                   </label>
                   <div class="col-md-10">
                       <div class="col-md-4">
                           <input name="data[menu_code]" type="text" class="form-control menus-input-background" id="menu_code" />
                       </div>
                   </div>
               </div>

               <?php if ($config['USE_KIOSK_COUPON']): ?>
               <div class="form-group clearfix ">
                   <label class="col-md-2">クーポンコード</label>
                   <div class="col-md-10">
                       <div class="col-md-4">
                           <input name="data[coupon_code]" type="text" class="form-control menus-input-background" id="coupon_code" />
                       </div>
                   </div>
               </div>
               <?php endif; ?>

               <div class="form-group clearfix">
                    <label class="col-md-2 menus-no-border" for="textfield3">価格</label>
                    <div class="col-md-10 menus-no-border">
                        <div class="col-md-2">
                            <label style="border:none; background:none;" for="tax_include">税込/税抜選択</label>
                        </div>
                        <div class="col-md-2">
                            <label style="border:none; background:none;" for="amount">金額入力</label>
                        </div>
                        <div class="col-md-2">
                            <label style="border:none; background:none;" for="tax">税率選択</label>
                        </div>
                        <div class="col-md-2">
                            <label style="border:none; background:none;" for="fraction_method">端数計算</label>
                        </div>
                        <div class="col-md-2">
                            <label style="border:none; background:none;" for="unit_price">税込金額</label>
                        </div>
                        <div class="col-md-2">
                            <label style="border:none; background:none;" for="notax_unit_price">税抜金額</label>
                        </div>
                    </div>
               </div>

               <div class="form-group clearfix">
                    <label class="col-md-2"></label>
                    <div class="col-md-10">
                        <div class="col-md-2">
                            <div class="menus-styled-select menus-w-combo-120">
                                <select id="tax_include" name="data[tax_include]" class="form-control">
                                    <option value="1">税込金額</option>
                                    <option value="2">税抜金額</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="menus-w-combo-120">
                                <input id="amount" name="data[amount]" type="number" class="form-control menus-input-background" style="margin-top: 0px;" onkeydown="return event.keyCode !== 69" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="menus-styled-select menus-w-combo-120">
                                <select id="tax" class="form-control" name="data[tax_id]">
                                    <option value="2" <?php if ($default_tax === 2) echo 'selected'; ?>>10%</option>
                                    <option value="3" <?php if ($default_tax === 3) echo 'selected'; ?>>8%</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="menus-styled-select menus-w-combo-120">
                                <select id="fraction_method" name="data[fraction_method]" class="form-control">
                                    <option value="1">切り捨て</option>
                                    <option value="2">切り上げ</option>
                                    <option value="3">四捨五入</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="menus-w-combo-120">
                                <input id="unit_price" name="data[unit_price]" type="text" class="form-control menus-input-disabled" style="margin-top: 0px;" disabled />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="menus-w-combo-120">
                                <input id="notax_unit_price" name="data[notax_unit_price]" type="text" class="form-control menus-input-disabled" style="margin-top: 0px;" disabled />
                            </div>
                        </div>
                    </div>
               </div>

               <div class="form-group clearfix">
                   <label class="col-md-2">原価</label>
                   <div class="col-md-10">
                       <div class="col-md-4">
                           <input name="data[cost_price]" type="text" class="form-control menus-input-background" id="textfield3" />
                       </div>
                   </div>
               </div>

               <div class="form-group clearfix">
                   <label class="col-md-2 menus-no-border">プリンタ1</label>
                   <div class="col-md-10 menus-no-border menus-pl-30">
                       <div class="menus-styled-select  menus-margin-top-12 menus-w-combo-227">
                           <select id="select_printer_1" class="form-control"   name="data[printer_id][]" id="select">
                                   <option value="">選択してください</option>
                               <?php
foreach ($printers as $pr) {
    echo "<option value='{$pr->printer_id}'>{$pr->printer_name}</option>";
}
?>
                           </select>
                       </div>
                   </div>
               </div>

               <div class="form-group clearfix">
                   <label class="col-md-2 menus-no-border">プリンタ2</label>
                   <div class="col-md-10 menus-no-border menus-pl-30">
                       <div class="menus-styled-select  menus-margin-top-12 menus-w-combo-227">
                           <select id="select_printer_2" class=" form-control"  name="data[printer_id][]" id="select2">
                               <option value="">選択してください</option>
                               <?php
foreach ($printers as $pr) {
    echo "<option value='{$pr->printer_id}'>{$pr->printer_name}</option>";
}
?>
                           </select>
                       </div>
                   </div>
               </div>

               <div class="form-group clearfix">
                   <label class="col-md-2 ">プリンタ3</label>
                   <div class="col-md-10 menus-pl-30">
                       <div class="menus-styled-select  menus-margin-top-12 menus-w-combo-227">
                           <select id="select_printer_3" class="form-control"  name="data[printer_id][]" id="select3">
                               <option value="">選択してください</option>
                               <?php
foreach ($printers as $pr) {
    echo "<option value='{$pr->printer_id}'>{$pr->printer_name}</option>";
}
?>
                           </select>
                       </div>
                   </div>
               </div>

               <div class="form-group clearfix">
                   <label class="col-md-2 ">レシート表示</label>
                   <div class="col-md-10 menus-pl-30">
                       <div class="menus-styled-select  menus-margin-top-12 menus-w-combo-227">
                           <select class="form-control"   name="data[price_type]" >
                               <?php
foreach ($price_types as $key => $pt) {
    echo "<option value='{$key}'>{$pt}</option>";
}
?>
                           </select>
                       </div>
                   </div>
               </div>


               <div class="form-group clearfix">
                   <label class="col-md-2 ">帳票印字</label>
                   <div class="col-md-10 menus-pl-30">
                       <div class=" menus-margin-top-12">
                           <label style="border:none; background:none; display:inline;">レシートに印字しない <input name="data[ignore_receipt_flag]" value="1" type="checkbox"></label>
                           <label style="border:none; background:none; display:inline; margin-left:20px;">顧客伝票に印字しない <input name="data[ignore_customer_voucher_flag]" value="1" type="checkbox"></label>
                       </div>
                   </div>
               </div>


               <div class="form-group clearfix">
                   <table style="width: 100%;">
                       <tr class="menus-border-bottom">
                           <td class="col-md-2" style="background: #f7f5f2;">
                               <span style="font-weight: bold;">メニュー属性</span>
                           </td>
                           <td class="col-md-6" style="padding-bottom: 10px;">
                                   <div class="col-md-6 radio-grp">
                                       <?php
                                       foreach ($menuProperties as $key=>$pt) {
                                           if($key%2 == 0) {
                                                ?>
                                               <input type='radio' id="radio<?php echo $key;?>" name='data[menu_property_id]' value='<?php echo $pt->menu_property_id;?>' /><label for="radio<?php echo $key;?>" class="menus-pl-10 radio-lb"><?php echo $pt->menu_property_name;?></label><br/>

                                           <?php }} ?>
                                   </div>

                                   <div class="col-md-6 radio-grp">
                                       <?php
                                       foreach ($menuProperties as $key=>$pt) {
                                           if($key%2 != 0) {
                                              ?>
                                               <input type='radio' id="radio<?php echo $key;?>"  name='data[menu_property_id]' name='data[menu_property_id]' value='<?php echo $pt->menu_property_id;?>' /><label for="radio<?php echo $key;?>" class="menus-pl-10 radio-lb"><?php echo $pt->menu_property_name;?></label><br/>

                                           <?php }} ?>
                                       <input style="margin-left: -3px;" type='radio' id="radio" name='data[menu_property_id]'  value='0' /> <label for="radio"  class="menus-pl-10 radio-lb">その他</label><br/>
                                   </div>

                           </td>
                           <td style="padding-left: 65px;">

                                   <button type="button" class="btn-blue w-btn-blue menus-button-pd" onclick="javascript:linkToSetDetail();"><i class="glyphicon glyphicon-menu-right menus-icon-glyphicon"></i><span class ="btn-blue-span">画像・詳細設定</span></button>

                           </td>
                       </tr>
                   </table>

               </div>

               <div class="form-group clearfix" <?php if ($this->kitchenDisplayMax() < 1) echo "style='display:none;'"; ?>>
                   <label class="col-md-2 ">キッチンカテゴリ</label>
                   <div class="col-md-10 menus-pl-30 radio-grp">
                       <input type='radio' id="radio10000"  name='data[category_type_id]' checked value='' /><label  for="radio10000" class="menus-pl-10 radio-lb ">所属カテゴリに従う</label>
                   </div>
               </div>
               <div class="form-group clearfix" <?php if ($this->kitchenDisplayMax() < 1) echo "style='display:none;'"; ?>>
                   <label class="col-md-2" style="height: <?php echo count($category_types) * 28; ?>px; min-height:60px;">属性</label>
                   <div class="col-md-10 menus-pl-30 radio-grp" style="padding-top: 10px; height: <?php echo count($category_types) * 28; ?>px;min-height:60px;">
                       <?php
foreach ($category_types as $k=>$ct) {
    echo "<input type='radio' id=\"radio10000$k\"  name='data[category_type_id]' value='{$ct->category_type_id}' /><label for=\"radio10000$k\" class='menus-pl-10 radio-lb'>{$ct->category_type_name}</label><br />";
}
?>
                   </div>
               </div>

                <?php if ($config['USE_WKD_COOKING_PLACE'] == 1): ?>
                <div class="form-group clearfix">
                    <label class="col-md-2" style="height: <?php echo count($cooking_places) * 28; ?>px; min-height:60px;">
                    調理場
                    <?php foreach ($hints as $key => $hint): ?>
                        <?php if ('key2' == $key): ?>
                        <span id="kiticn_category" class="hints" data-toggle="modal" data-target="#hintmodal" data-hint="<?php echo $hint; ?>">
                            <img src="img/icon_inquiry.png" width="20px"/>
                        </span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </label>
                    <?php if ($cooking_places): ?>
                    <div class="col-md-10 menus-pl-30 radio-grp" style="padding-top: 10px; height: <?php echo count($cooking_places) * 28; ?>px;min-height:60px;">
                        <?php
foreach ($cooking_places as $k => $rp) {
    echo "<input type='radio' id=\"radio20000$k\"  name='data[cooking_place_id]' value='{$rp->cooking_place_id}' /><label for=\"radio20000$k\" class='menus-pl-10 radio-lb'>{$rp->cooking_place_name}</label><br />";
}
?>
                    </div>
                    <?php else: ?>
                    <div class="col-md-10">
                        <div class="col-md-8" style="padding-top: 19px;">
                            調理場が設定されていません
                        </div>
                        <div class="col-md-4">
                           <button type="button" class="btn-blue w-btn-blue menus-button-pd" onclick="location.href='<?php echo Yii::app()->baseUrl; ?>/index.php?r=cookingPlace'"><i class="glyphicon glyphicon-menu-right menus-icon-glyphicon"></i><span class ="btn-blue-span">調理場を設定</span></button>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

               <div class="form-group clearfix" <?php if ($product_mode == "main") echo "style='display:none;'"; ?>>
                   <label class="col-md-2 ">トッピング対象</label>
                   <div class="col-md-10 menus-pl-30">
                       <div class=" menus-margin-top-12">
                           <label style="border:none; background:none; display:inline;">トッピング対象 <input name="data[as_topping]" value="1" type="checkbox"></label>
                       </div>
                   </div>
               </div>

               <?php if ((int)$config['MOBILEORDER_USE_HIDE_SUBMENUS'] > 0): ?>
               <div class="form-group clearfix" <?php if ($product_mode == "main") echo "style='display:none;'"; ?>>
                   <label class="col-md-2 " style="line-height:20px; padding-top:10px;">Okage Go では表示しない</label>
                   <div class="col-md-10 menus-pl-30">
                       <div class=" menus-margin-top-12">
                           <label style="border:none; background:none; display:inline;">Okage Go では表示しない <input name="data[hide_at_mobileorder]" value="1" type="checkbox"></label>
                       </div>
                   </div>
               </div>
               <?php endif; ?>

               <div class="form-group clearfix" <?php if ($product_mode != "main") echo "style='display:none;'"; ?>>
                   <label class="col-md-2">メニューグループ</label>
                   <div class="col-md-10">
                       <div class="col-md-8">
                       </div>
                       <div class="col-md-4">
                           <button type="button" class="btn-blue w-btn-blue menus-button-pd" onclick="javascript:showMenuGroup();"><i class="glyphicon glyphicon-menu-right menus-icon-glyphicon"></i><span class ="btn-blue-span">メニューグループを選択</span></button>
                       </div>
                   </div>
               </div>
               <div class="form-group clearfix">
                   <table id="tbl_menu_group"   width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-striped " style="display:none;margin-bottom: 0">
                       <tbody>

                       </tbody>
                   </table>
               </div>

               <div class="form-group clearfix" <?php if ($product_mode != "main") echo "style='display:none;'"; ?>>
                   <label class="col-md-2">カテゴリ</label>
                   <div class="col-md-10">
                       <div class="col-md-8"></div>
                       <div class="col-md-4">
                           <button type="button" class="btn-blue w-btn-blue menus-button-pd" onclick="javascript:showCategory();" ><i class="glyphicon glyphicon-menu-right menus-icon-glyphicon"></i><span class ="btn-blue-span">カテゴリを選択</span></button>
                       </div>
                   </div>
               </div>

               <div class="form-group clearfix">
                   <table id="tbl_menu_category"   width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-striped " style="display:none;margin-bottom: 0">
                       <tbody>

                       </tbody>
                   </table>
               </div>

               <div class="text-center" style="padding-top: 15px;">
                   <button type="button" class="btn-orange" onclick="javascript:insertData();return false;"><i class="glyphicon glyphicon-menu-right"></i><span>登録</span></button>
               </div>
               <input type="hidden" name="checkUseDefaultTax" value="1" />
               <input type="hidden" name="data[menu_tax]" value="" />


              <div align="right"></div>
           </form>
        </div>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-body">
        <h4 class="sub-title"><i class="glyphicon glyphicon-minus primary-color" > </i><?php echo $menu_title;?>一覧</h4>
        <br/>
        <div class="form-group clearfix">
            <div class="col-md-12 menus-search-pl-0">
                <div class="col-md-3 menus-search-pl-0">
                    <input type="text" style="height:35px;" class="form-control menus-input-background" id="search_menu_name" placeholder="メニュー名" value="" onkeydown="textValue = this.value" onkeyup="changeText(event.keyCode, this.value)" />
                </div>
                <div class="col-md-3">
                    <div id="search_category_box" class="menus-styled-select menus-w-combo-227">
                        <select class=" form-control" onchange="doSearch();" id="search_category">
                            <option value="">選択してください</option>
                            <?php
foreach ($categories as $category) {
    echo "<option value='{$category->category_id}'>{$category->category_name}</option>";
}
?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12 menus-search-pl-0" style="margin-top:10px;">
                <label><input class="btn-group" type="checkbox" id="checkAll">すべてチェックする</label>
            </div>
            <div class="col-md-12 menus-search-pl-0" style="margin-top:10px;">
                <input type="text" id="textCopyPrefix" class="form-control" style="display:inline; width:350px; height:35px;" placeholder="コピー後のメニューの先頭につける言葉 ex:軽 " />
                <button id="btnCopyKeigen" class="btn btn-info">軽減税率(8%としてコピー)</button>
            </div>
            <div class="col-md-12 menus-search-pl-0" style="margin-top:10px;">
                <div class="alert alert-info">
                    <div>・金額の微調整等は <?php echo CHtml::link("こちら", array("/menuPrices"), array("style" => "font-weight:bold;"))?> の金額一括設定からお願い致します。</div>
                    <?php if ($config['USE_WKD_COOKING_PLACE'] == 1): ?>
                    <div style="margin-top: 5px;">・調理場の調整は <?php echo CHtml::link("こちら", array("/menuCookingPlace"), array("style" => "font-weight:bold;"))?> の調理場一括設定からお願い致します。</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <table id="datalist_table" width="100%" cellpadding="0" cellspacing="0" class="table table-menus" >
        </table>
    </div>
</div>

<!--POPUP Menu Group -->
<div class="modal fade" id="menuGroupModal" tabindex="-1" role="dialog" aria-labelledby="PopoupModalLabel" aria-hidden="true"
 data-keyboard="true" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="sub-title"><span class="menuTitle"></span></h4>
            <div class="col-sm-12">
                <div class="checkbox-grp  mFilter col-sm-4">
                    <input type="checkbox" name="unselectedMenus" value="0" id="unselectedMenus" class="menuFilter">
                    <label for="unselectedMenus" class="checkbox-lb checkbox-b">選択されていないメニュー</label>
                </div>
                <div class="checkbox-grp  mFilter col-sm-offset-3 col-sm-4">
                    <input type="checkbox" name="selectedMenus" value="1" id="selectedMenus" class="menuFilter">
                    <label for="selectedMenus" class="checkbox-lb checkbox-b">選択されたメニュー​</label>
                </div>
            </div>
        </div>

			<form id="menusChoice" name="menusChoice">
				<div class="modal-body">
					<table style='table-layout: fixed ;' id='menuGroupTable' cellpadding='0' cellspacing='0' class='table table-menus'>
                        <thead>
                            <tr>
                                <th>メニュー名</th>
                                <th>カテゴリー</th>
                                <th>メニューグループ</th>
                                <th>価格 (￥)</th>
                                <th>原価 (￥)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn-orange" name="menuGroupUpdate" id="menuGroupUpdate"> <i class="glyphicon glyphicon-menu-right"></i><span>完了</span> </button>
					<button type="button" class="btn-orange" data-dismiss="modal"><i class="glyphicon glyphicon-menu-right"></i><span>キャンセル</span></button>
				</div>
			</form>
		</div>
	</div>
</div>


<!--POPUP Category -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="PopoupModalLabel" aria-hidden="true"
 data-keyboard="true" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">


            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
			</button>
            <h4 class="sub-title"><span class="menuTitle"></span></h4>
            <div class="col-sm-12">
                <div class="checkbox-grp  mFilter col-sm-4">
                    <input type="checkbox" name="unselectedCategories" value="0" id="unselectedCategories" class="categoryFilter">
                    <label for="unselectedCategories" class="checkbox-lb checkbox-b">未選択のカテゴリ</label>
                </div>
                <div class="checkbox-grp  mFilter col-sm-offset-3 col-sm-4">
                    <input type="checkbox" name="selectedCategories" value="1" id="selectedCategories" class="categoryFilter">
                    <label for="selectedCategories" class="checkbox-lb checkbox-b">選択したカテゴリ</label>
                </div>
            </div>
        </div>
			<form id="categoryChoice" name="categoryChoice">
				<div class="modal-body">
					<table style='table-layout: fixed ;' id='categoryTable' cellpadding='0' cellspacing='0' class='table table-menus'>
                        <thead>
                            <tr>
                                <th>種別名</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn-orange"  name="categoryupdate" id="categoryupdate"> <i class="glyphicon glyphicon-menu-right"></i><span>完了</span> </button>
					<button type="button" class="btn-orange" data-dismiss="modal"><i class="glyphicon glyphicon-menu-right"></i><span>キャンセル</span></button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- ヘルプモーダルダイアログ -->
<div class="modal fade" id="hintmodal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="hint-text"></div>
      </div>
    </div>
  </div>
</div>



<button type="button" id="sampleButton" class="btn btn-primary btn-lg">
	モーダル・ダイアログ 呼び出し
</button>

<!-- モーダル・ダイアログ -->
<div class="modal fade" id="sampleModal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span>×</span></button>
				<h4 class="modal-title">タイトル</h4>
			</div>
			<div class="modal-body">
				本文
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
				<button type="button" class="btn btn-primary">ボタン</button>
			</div>
		</div>
	</div>
</div>

<!-- モダール -->
<div class="btn-wrap">
  <a href="#modal" class="modaal btn js-modal-target" data-modaal-type="inline">リンクをクリック</a>
  <button class="btn js-modal-button-target" data-modal="#modal">ボタンをクリック</button>
</div>
    
<div id="modal" class="modal">
  <p>モーダルの内容が表示されます</p>
</div>
<!-- モダール -->


<main class="container">
  <section class="section section1"> <button class="modal__btn modal__btn-primary" data-micromodal-trigger="modal-1" role="button">モーダルを開く</button></section>

  <!-- ここからモーダルエリアです。 -->
  <div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
        <div role="document">
          <header class="modal__header">
            <h2 class="modal__title" id="modal-1-title">
              モーダルとは
            </h2>
            <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
          </header>
          <main class="modal__content" id="modal-1-content">
            <p>モーダルウィンドウとは、操作が完了するまで親ウィンドウへの操作を受け付けなくさせるタイプのウィンドウです。こちらの例では、コンテンツを浮かび上がるように表示しています。</p>
          </main>
          <footer class="modal__footer">
            <button class="modal__btn modal__btn-primary" data-micromodal-close aria-label="Close this dialog window">わかった！</button>
          </footer>
        </div>
      </div>
    </div>
  </div>
</main>


<script type='text/javascript' src="<?php echo Yii::app()->baseUrl; ?>/js/datatable/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/brajax.js"></script>
<script type='text/javascript' src="js/popup/category.js"></script>
<script type='text/javascript' src="js/popup/menugroup.js?20201028"></script>
<script type='text/javascript' src="js/popup/datatable.js"></script>
<script>
	$(document).ready(function(){
		$(".menu_name").keyup(function() {
			localStorage.removeItem("menu_name");
			var menu_name = $(".menu_name").val();
			localStorage.setItem("menu_name", menu_name);
		});
        $('.hints').on('click', function () {
            // var scrollPosition = $(window).scrollTop();
            // $('body').css('overflow', 'hidden');
            // let hint_message = $(this).data('hint');
            // $('#hintmodal .hint-text').text(hint_message);
            // $('#hintmodal').modal();
            // $('#hintmodal').on('hidden.bs.modal', function () {
            //     $('body').css('overflow', '');
            //     $(window).scrollTop(scrollPosition);

            // let hint_message = $(this).data('hint');
            // $('#hintmodal .hint-text').text(hint_message);
            // $('#hintmodal').modal();

            // // モーダルが閉じる前にスクロール位置を戻す
            // $('#hintmodal').on('hide.bs.modal', function () {
            //     var scrollPosition = $(window).scrollTop();
            //     $('body').css('overflow', '');
            //     $(window).scrollTop(scrollPosition);
            // });

            // // スクロール位置を取得して保存する
            // var scrollPosition = $(window).scrollTop();
            // // モーダルに表示するメッセージを設定する
            // let hint_message = $(this).data('hint');
            // $('#hintmodal .hint-text').text(hint_message);
            // // モーダルを表示する
            // $('#hintmodal').modal();
            // // モーダルが閉じられたときにスクロール位置を復元する
            // $('#hintmodal').on('hidden.bs.modal', function () {
            //     $(window).scrollTop(scrollPosition);
            // });

            // var scrollPosition = $(window).scrollTop();
            // //$('body').css('overflow', 'hidden');
            // let hint_message = $(this).data('hint');
            // $('#hintmodal .hint-text').text(hint_message);
            // $('#hintmodal').modal();
            // $('#hintmodal').on('hide.bs.modal', function () {
            //     $('body').css('overflow', '');
            //     $(window).scrollTop(scrollPosition);
            // });
            //    modalを開いた時
        current_scrollY = $( window ).scrollTop();
        $('#hintmodal').on('shown.bs.modal', function (event) {
            $('body').css( {
                position: 'fixed',
                //width: '100%',
                top: -1 * current_scrollY
            } );
        });

        //  modalを閉じた時
        $('#hintmodal').on('hidden.bs.modal', function (event) {
            $( 'body' ).attr( { style: '' } );
            $( 'html, body' ).prop( { scrollTop: current_scrollY } );
        });
        });


        // モーダルが閉じられた後に実行する処理
        // $('#hintmodal').on('hidden.bs.modal', function () {
        //     $(window).scrollTop(scroll);
        // })

        $('#sampleButton').click( function (event) {
            event.preventDefault();
            event.stopPropagation();
            var modal = $('#sampleModal');
            modal.modal();
            modal.on('shown.bs.modal', function() {
                // ページをスクロースしないようにする
                $('body').css('top', -$(window).scrollTop());
                // モーダルが開いている時にスクロールを固定する
                $('body').addClass('modal-open');
            });
            modal.on('hidden.bs.modal', function() {
                $('body').removeClass('modal-open');
                $('body').css('top', '');
            });
        });

        'use strict';
        //モーダル表示
        if ($(".js-modal-target").length > 0) {
            $(".js-modal-target").modaal();
        }
        if ($(".js-modal-button-target").length > 0) {
            var target = $(".js-modal-button-target").data('modal');
            $(".js-modal-button-target").modaal({
                content_source: target
            });
        }

    });
    MicroModal.init({
  awaitCloseAnimation: true,
  awaitOpenAnimation: true,
  disableScroll: true
});
</script>
