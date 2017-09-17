<?php $__env->startSection('content'); ?>
<div class="container">  
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">管理信息</div>

        <div class="panel-body"> NOTE: Articles posted by admins can only be shown in admin special column.(Gorilla's work column)<br/>
		<a href="<?php echo e(URL('admin/announcements/create')); ?>" class="btn btn-lg btn-primary">新增</a>
        <table class="table table-striped">
          <tr class="row">
            <th class="col-lg-4">内容</th>
            <th class="col-lg-2">标题</th>
            <th class="col-lg-4">查看</th>
            <th class="col-lg-1">编辑</th>
            <th class="col-lg-1">删除</th>
          </tr>
          <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="row">
              <td class="col-lg-6">
                <?php echo e($announcement->body); ?>

              </td>
              <td class="col-lg-2">
                    <?php echo e($announcement->title); ?>

              </td>
              <td class="col-lg-4">
                <a href="<?php echo e(URL('announcements/show/'.$announcement->id)); ?>" target="_blank">
                  <?php echo e(App\Announcement::find($announcement->id)->title); ?>

                </a>
              </td>
              <td class="col-lg-1">
                <a href="<?php echo e(URL('admin/announcements/'.$announcement->id.'/edit')); ?>" class="btn btn-success">编辑</a>
              </td>
              <td class="col-lg-1">
                  <button onclick="deleteInfo(<?php echo e($announcement->id); ?>);"   class="btn btn-danger">删除</button>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>

<?php echo $announcements->render(); ?>
        </div>
      </div>
    </div>
  </div>
</div>  

<script>
function deleteInfo(id)
{
	if(id) {
		var r=confirm('确定要删除吗');
		if(r==true) {
			$.ajax({ 
				url: "<?php echo e(URL('admin/announcements/delete/')); ?>", 
				type: "POST",
				data:{id:id,_token:'<?php echo e(csrf_token()); ?>'},
				success: function(data){
					if(data==1) {
		        		alert('删除成功');
		        		location.href= "<?php echo e(URL('admin/announcements/')); ?>";
					} else {
						alert('删除失败');
					}
		     }});
		}
	}
}
</script>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>