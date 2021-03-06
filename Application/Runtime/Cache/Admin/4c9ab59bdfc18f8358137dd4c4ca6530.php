<?php if (!defined('THINK_PATH')) exit();?><style type="text/css" media="screen">
.my-uploadify-button {
	background:none;
	border: none;
	text-shadow: none;
	border-radius:0;
}

.uploadify:hover .my-uploadify-button {
	background:none;
	border: none;
}

.fileQueue {
	width: 400px;
	height: 150px;
	overflow: auto;
	border: 1px solid #E5E5E5;
	margin-bottom: 10px;
}
#mix_type input{float:none;}
</style>
<div class="pageContent">
	<form method="post" action="<?php echo U('goods/edit',array('uid'=>$goods_info['goods_id']));?>" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<input type="hidden" name="gc_id" value="<?php echo ($gc_id); ?>">
		<div class="pageFormContent nowrap" layoutH="97">
		<dl>
			<dt>商品名称：</dt>
			<dd>
		        <input name="goods_name" type="text" class="required" value="<?php echo ($goods_info['goods_name']); ?>" />
		    </dd>
		</dl>
		<dl>
			<dt>商品货号：</dt>
			<dd>
		        <input name="goods_num" type="text" value="<?php echo ($goods_info['goods_num']); ?>" />
		    </dd>
		</dl>
		<?php if(isset($type_id)): if($spec_info): ?><dl>
    			<dt>商品规格：</dt>
    			<dd><?php $spec_num = 1; ?>
    		        <?php if(is_array($spec_info)): foreach($spec_info as $key=>$spec): ?><div class="spec spec<?php echo ($spec_num); ?>" mrtype="<?php echo ($spec_num); ?>" value="<?php echo ($spec['spec_id']); ?>"><strong><?php echo ($spec['spec_name']); ?>:</strong>
    		                <?php $spec_arr = unserialize($spec['spec_value']); ?>
    		                <?php if(is_array($spec_arr)): foreach($spec_arr as $skey=>$val): ?><input type="checkbox" name="goods_spec[]" value="<?php echo ($skey); ?>" value_name="<?php echo ($val); ?>" spec_id="<?php echo ($spec['spec_id']); ?>" 
    		                    <?php if(is_array($goods_svalue)): foreach($goods_svalue as $key=>$svalue_arr): $seri = $svalue_arr['spec_goods_seri']; ?>
    		                    	<?php if(is_array($seri)): $i = 0; $__LIST__ = $seri;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$svalue): $mod = ($i % 2 );++$i; $spec_one = explode('.', $svalue); ?>
        		                        <?php if(($spec_one[0] == $spec['spec_id']) AND ($spec_one[1] == $skey)): ?>checked<?php endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; ?>
    		                     /><?php echo ($val); endforeach; endif; ?>
    		            </div>
    		            <?php $spec_num++; endforeach; endif; ?>
    		    </dd>
    		</dl>
		    <dl id="mix_type">
		    <?php if(is_array($goods_svalue)): foreach($goods_svalue as $key=>$svalue): ?><div class="types" data="{implode($svalue['spec_goods_seri'], '-')}">
		        <strong><?php if(is_array($svalue['spec_goods_seri'])): foreach($svalue['spec_goods_seri'] as $skey=>$svalue_one): $svalue_arr = explode('.', $svalue_one); $spec = unserialize($spec_info[$svalue_arr[0]]['spec_value']); echo ($spec[$svalue_arr[1]]); if($skey < count($svalue['spec_goods_seri'])-1): ?>-<?php endif; endforeach; endif; ?>:</strong> 价格<input type="text" name="price_spec[]" value="<?php echo ($svalue['spec_goods_price']); ?>" class="required">库存<input type="text" name="storage_spec[]" value="<?php echo ($svalue['spec_goods_storage']); ?>" class="required"><input type="hidden" name="specs[]" value="{implode($svalue['spec_goods_seri'], '-')}">
		        </div><?php endforeach; endif; ?>
		    </dl><?php endif; ?>
		    
		    <?php if($attr_info): ?><dl>
    			<dt>商品属性：</dt>
    			<dd>
    		        <?php if(is_array($attr_info)): foreach($attr_info as $key=>$attr): ?><div style="height: 30px;"><strong><?php echo ($attr['attr_name']); ?>:</strong>
    		                <?php $attr_arr = unserialize($attr['attr_value']); ?>
    		                <select name="goods_attr[]" style="float: none;">
    		                    <option value="0">其他</option>
    		                <?php if(is_array($attr_arr)): foreach($attr_arr as $skey=>$val): ?><option value="<?php echo ($attr['attr_id']); ?>_<?php echo ($skey); ?>"
    		                    <?php if(is_array($goods_avalue)): foreach($goods_avalue as $key=>$avalue): if(($attr['attr_id'] == $avalue['attr_id']) AND ($avalue['attr_value'] == $skey)): ?>selected<?php endif; endforeach; endif; ?>
    		                    ><?php echo ($val); ?></option><?php endforeach; endif; ?>
    		                </select>
    		            </div><?php endforeach; endif; ?>
    		    </dd>
    		</dl><?php endif; ?>
		    
		    <?php if($brand_info): ?><dl>
    			<dt>商品品牌：</dt>
    			<dd>
    		        <select name="goods_brand" id="goods_brand">
    		            <option value="0">其他</option>
    		        <?php if(is_array($brand_info)): foreach($brand_info as $key=>$brand): ?><option value="<?php echo ($brand['brand_id']); ?>" <?php if($goods_info['brand_id'] == $brand['brand_id']): ?>selected<?php endif; ?>><?php echo ($brand['brand_name']); ?></option><?php endforeach; endif; ?>
    		        </select>
    		    </dd>
    		</dl><?php endif; endif; ?>
		<dl>
			<dt>商品价格：</dt>
			<dd>
		        <input name="goods_price" id="goods_price" type="text" <?php if(!$goods_svalue): ?>class="required" value="<?php echo ($goods_info['goods_price']); ?>"<?php else: ?>readonly="readonly"<?php endif; ?> />
		    </dd>
		</dl>
		<dl>
			<dt>商品库存：</dt>
			<dd>
		        <input name="goods_storage" id="goods_storage" type="text" <?php if(!$goods_svalue): ?>class="required" value="<?php echo ($goods_info['goods_storage']); ?>"<?php else: ?>readonly="readonly"<?php endif; ?> />
		    </dd>
		</dl>
		<dl>
		    <dt>商品图片：</dt>
			<dd>
        		<input id="testFileInput" type="file" name="attach" 
            		uploaderOption="{
            			swf:'/hmall/Public/static/uploadify/scripts/uploadify.swf',
            			uploader:'<?php echo U('goods/upload');?>',
            			formData:{PHPSESSID:'xxx', ajax:1},
            			buttonText:'上传图片',
            			fileSizeLimit:'200KB',
            			fileTypeDesc:'*.jpg;*.jpeg;*.gif;*.png;',
            			fileTypeExts:'*.jpg;*.jpeg;*.gif;*.png;',
            			auto:true,
            			multi:true,
            			onUploadSuccess:uploadifySuccess
            		}"
            	/>
		    </dd>
		    <dd id="image">
		        <?php if(is_array($goods_image)): foreach($goods_image as $key=>$image): ?><div class="<?php echo ($image['atta_id']); ?>"><input type="hidden" name="image[]" value="<?php echo ($image['atta_name']); ?>"><img src="/hmall/Public/upload/goods/<?php echo ($image['atta_name']); ?>" width="60px" height="60px"><a class="drop_img" value="<?php echo ($image['atta_id']); ?>">删除</a></div><?php endforeach; endif; ?>
		    </dd>
		</dl>
		<dl>
		    <dt>商品详情：</dt>
			<dd>
        		<textarea class="editor" name="content" rows="20" cols="100" upLinkUrl="/hmall/Public/static/upload.php" upLinkExt="zip,rar,txt" upImgUrl="/hmall/Public/static/upload.php" upImgExt="jpg,jpeg,gif,png" upFlashUrl="/hmall/Public/static/upload.php" upFlashExt="swf" upMediaUrl="/hmall/Public/static/upload.php" upMediaExt:"avi"><?php echo ($goods_info['goods_content']); ?></textarea>
		    </dd>
		</dl>
		<dl>
			<dt>上架：</dt>
			<dd>
			    <input type="radio" name="goods_show" value="1" <?php if($goods_info['goods_show'] == 1): ?>checked<?php endif; ?> >是
			    <input type="radio" name="goods_show" value="0" <?php if($goods_info['goods_show'] == 0): ?>checked<?php endif; ?> >否
		    </dd>
		</dl>
		<dl>
			<dt>推荐：</dt>
			<dd>
			    <input type="radio" name="goods_recommend" value="1" <?php if($goods_info['goods_recommend'] == 1): ?>checked<?php endif; ?> >是
			    <input type="radio" name="goods_recommend" value="0" <?php if($goods_info['goods_recommend'] == 0): ?>checked<?php endif; ?>>否
		    </dd>
		</dl>
		</div>
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li>
					<div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
				</li>
			</ul>
		</div>
	</form>
</div>
<script type="text/javascript">
function uploadifySuccess(file, data, response){
	data = eval ("(" + data + ")");
	if(data['statusCode'] == 200){
		var time = new Date().getTime();
		$("#image").append('<div class="'+time+'"><input type="hidden" name="image[]" value="'+data['message']+'" /><img src="/hmall/Public/upload/goods/'+data['message']+'" width="60px" height="60px" /><a class="drop_img" value="'+time+'">删除</a></div>');
	}else{
	    alert(data['message']);
	}
}
$("#image").on('click',".drop_img",function(){
	var val = $(this).attr('value');
	$("."+val+"").remove();
})

var count_spec = $(".spec").size();

$(".spec :checkbox").click(function(){
	var mrtype = $(this).parent().attr('mrtype');
	var mrtype_count = 0;
    for(var i = 1; i <= count_spec; i++){
        if(i != mrtype){
            var count_box = $(".spec"+i).find(":checked").size();
            if(count_box == 0){
                break;
            }
        	mrtype_count++;
        }
    }
    if(mrtype_count >= count_spec-1){
        var j = 0;
        var spec_arr = new Array();
        while(j < count_spec){
        	spec_arr[j] = new Array();
        	var index = j+1;
        	var k = 0;
        	$(".spec"+index).find(":checked").each(function(){
            	var value = $(this).val();
            	spec_arr[j][k] = new Array();
            	spec_arr[j][k]['value'] = value;
        		spec_arr[j][k]['spec_id'] = $(this).attr('spec_id');
        		spec_arr[j][k]['name'] = $(this).attr('value_name');
        		spec_arr[j][k]['keys'] = spec_arr[j][k]['spec_id'] + '.' + spec_arr[j][k]['value'];
        		k++;
            });
        	j++;
        }

        var final_arr = new Array();
        var temp_arr = new Array();
        var y = 0;
        for(var n=1; n<spec_arr.length; n++){
                if(n == 1){
                    var n1 = n-1;
                    y = spec_arr[n].length * spec_arr[n1].length - 1;
                    for(var m=0; m<spec_arr[n].length; m++){
                    	for(var p=0; p<spec_arr[n1].length; p++){
                    		temp_arr[y] = new Array();
                        	temp_arr[y]['id'] = spec_arr[n][m]['keys']+'-'+spec_arr[n1][p]['keys'];
                        	temp_arr[y]['name'] = spec_arr[n][m]['name']+'-'+spec_arr[n1][p]['name'];
                        	y--;
                        }
                    }
                    final_arr = temp_arr;
                	temp_arr = [];
                }else{
                	y = spec_arr[n].length * final_arr.length - 1;
                    for(var m=0; m<spec_arr[n].length; m++){
                    	for(var p=0; p<final_arr.length; p++){
                    		temp_arr[y] = new Array();
                        	temp_arr[y]['id'] = spec_arr[n][m]['keys']+'-'+final_arr[p]['id'];
                        	temp_arr[y]['name'] = spec_arr[n][m]['name']+'-'+final_arr[p]['name'];
                        	y--;
                        }
                    }
                    final_arr = temp_arr;
                	temp_arr = [];
                }
        }
        
        for(var n=0; n<final_arr.length; n++){
            var leng = $("#mix_type").find("[data='"+final_arr[n]['id']+"']").length;
            if(leng == 0){
            	$("#mix_type").append('<div class="types" data="'+final_arr[n]['id']+'"><strong>'+final_arr[n]['name']+':</strong> 价格<input type="text" name="price_spec[]" class="required" />库存<input type="text" name="storage_spec[]" class="required" /><input type="hidden" name="specs[]" value="'+final_arr[n]['id']+'"/></div>');
            }
        }

        $(".types").each(function(){
            var data = $(this).attr('data');
            var flag = false;
            for(var q=0; q<final_arr.length; q++){
                if(data == final_arr[q]['id']){
                    flag = true;
                    break;
                }
            }
            
            if(flag == false){
                $(this).remove();
            }
        });
        if($(".types").length >0){
            $("#goods_price").attr("readonly", true);
            $("#goods_storage").attr("readonly", true);
            $("#goods_price").removeClass("required");
            $("#goods_storage").removeClass("required");
        }else{
        	$("#goods_price").attr("readonly", false);
            $("#goods_storage").attr("readonly", false);
            $("#goods_price").addClass("required");
            $("#goods_storage").addClass("required");
        }
    }
})
</script>