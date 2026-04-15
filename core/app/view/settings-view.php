<div class="row">
<div class="col-md-12">
<h1>Configuracion</h1>

<?php

$configurations = ConfigurationData::getAll();

?>

<?php if(count($configurations)>0):?>
<br>
<div class="box box-primary">
<div class="box-header">
	<h3 class="box-title">Configuracion</h3>
</div>
<div class="box-body">
<table class="table table-bordered">
<thead>
	<th>Clave</th>
	<th>Valor</th>
</thead>
<?php foreach($configurations as $conf):?>
<tr>
	<td><?php echo $conf->name;?></td>
	<td>
		<?php if($conf->kind==1): // es boolean?>
			<input type="checkbox" name="<?php echo $conf->short;?>" <?php if($conf->val=="1"){ echo "checked";}?>>
		<?php elseif($conf->kind==2):?>
			<input type="text" class="form-control input-sm" name="<?php echo $conf->short;?>" value="<?php echo $conf->val;?>">
		<?php endif; ?>
	</td>
</tr>
<?php endforeach;?>
</table>
</div>
</div>

<?php endif; ?>


</div>
</div>
