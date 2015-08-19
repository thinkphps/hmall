<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post" name="adminform" action="<?php echo U('admin/add');?>" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<div class="pageFormContent nowrap" layoutH="97">
		<dl>
			<dt>管理员名：</dt>
			<dd>
		        <input name="admin_name" type="text" class="required" />
		    </dd>
		</dl>
		<dl>
			<dt>管理员类型：</dt>
			<dd>
		        <select name="style_id" class="required">
		        	<?php if(is_array($style_list)): foreach($style_list as $key=>$val): ?><option value="<?php echo ($val['style_id']); ?>"><?php echo ($val['style_value']); ?></option><?php endforeach; endif; ?>
		        </select>
		    </dd>
		</dl>
		<dl>
			<dt>密码：</dt>
			<dd>
			    <input name="password" type="password" id="password" class="required alphanumeric" minlength="6" maxlength="20" />
			</dd>
		</dl>
		<dl>
			<dt>确认密码：</dt>
			<dd>
			    <input name="checkpwd" type="password" class="required" equalto="#password" />
		</dd>
		</dl>
		<dl>
			<dt>Email：</dt>
			<dd>
			    <input name="email" type="text" class="email">
		</dd>
		</dl>
		<dl>
			<dt>手机号：</dt>
			<dd>
			    <input name="phone" type="text" class="phone">
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