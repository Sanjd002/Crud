<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between" >
                        <div>Posts</div>
                          <div><a href="<?php echo e(route('posts.create')); ?>" class="btn btn-success">Create Post</a></div>
                    </div>
                </div>

                <div class="card-body">
                 <div class="mb-2">
                      <form class="form-inline" action="">
                      <label for="category_filter">Filter By Category &nbsp;</label>
                       <select class="form-control" id="category_filter" name="category">
                        <option value="">Select Category</option>
                       <?php if(count($categories)): ?>
                          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <option value="<?php echo e($category->name); ?>"  <?php echo e((Request::query('category') && Request::query('category')==$category->name)?'selected':''); ?>  ><?php echo e($category->name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

               
                      </select>
                      <label for="keyword">&nbsp;&nbsp;</label>
                      <input type="text" class="form-control"  name="keyword" placeholder="Enter keyword" id="keyword">
                      <span>&nbsp;</span> 
                       <button type="button" onclick="search_post()" class="btn btn-primary" >Search</button>
                       <?php if(Request::query('category') || Request::query('keyword')): ?>
                        <a class="btn btn-success" href="<?php echo e(route('posts.index')); ?>">Clear</a>
                       <?php endif; ?>

                    </form>
                  </div>
                  <div class="table-responsive">
                    <table style="width: 100%;" class="table table-stripped ">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Title</th>
                          <th>Created By</th>
                          <th>Category</th>
                          <th>Total Comments 
                       
                            <?php if(Request::query('sortByComments') && Request::query('sortByComments')=='asc'): ?>
                                      <a href="javascript:sort('desc')" ><i class="fas fa-sort-down"></i></a>
                            <?php elseif(Request::query('sortByComments') && Request::query('sortByComments')=='desc'): ?>
                            <a href="javascript:sort('asc')" ><i class="fas fa-sort-up"></i></a>
                            <?php else: ?>
                                     <a href="javascript:sort('asc')" ><i class="fas fa-sort"></i></a>
                            <?php endif; ?>
                    
                          </th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(count($posts)): ?>
                          <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td ><?php echo e($post->id); ?></td>
                            <td style="width:35%"><?php echo e($post->title); ?></td>
                            <td ><?php echo e($post->user->name); ?></td>
                            <td ><?php echo e($post->category->name); ?></td>
                            <td align="center"><?php echo e($post->comments_count); ?></td>
                            <td  style="width:250px;">
                              <a  href="<?php echo e(route('posts.show',$post->id)); ?>" class="btn btn-primary">View</a>
                              <a href="<?php echo e(route('posts.edit',$post->id)); ?>" class="btn btn-success">Edit</a>
                              <a href="javascript:delete_post('<?php echo e(route('posts.destroy',$post->id)); ?>')" class="btn btn-danger">Delete</a>
                            </td>
                          </tr>


                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>

                          <tr>
                            <td colspan="6" >No posts found</td>
        
                          </tr>
                        <?php endif; ?>

                
                      </tbody>
                    </table>
  <?php if(count($posts)): ?>
   <?php echo e($posts->appends(Request::query())->links()); ?>

  <?php endif; ?>

                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="post_delete_form" method="post" action="">
  <?php echo csrf_field(); ?>
  <?php echo method_field('DELETE'); ?>
</form>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
  var query=<?php echo json_encode((object)Request::only(['category','keyword','sortByComments'])); ?>;


  function search_post(){

    Object.assign(query,{'category': $('#category_filter').val()});
    Object.assign(query,{'keyword': $('#keyword').val()});

    window.location.href="<?php echo e(route('posts.index')); ?>?"+$.param(query);

  }

  function sort(value){
    Object.assign(query,{'sortByComments': value});

    window.location.href="<?php echo e(route('posts.index')); ?>?"+$.param(query);
  }

  function delete_post(url){

    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this post!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $('#post_delete_form').attr('action',url);
         $('#post_delete_form').submit();
      } 
    });


  }


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_crud-master\resources\views/post/index.blade.php ENDPATH**/ ?>