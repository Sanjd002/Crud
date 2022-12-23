<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    
                    <div class="d-flex justify-content-between" >
                        <div>Create Posts </div>
                          <div><a href="<?php echo e(route('posts.index')); ?>" class="btn btn-success">Back</a></div>
                    </div>
                </div>

                <div class="card-body">
                 <form action="<?php echo e(route('posts.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                      <label for="title">Title :</label>
                      <input type="text" value="<?php echo e(old('title')); ?>" class="form-control"  id="title" placeholder="Enter title" name="title" >
                      <?php if($errors->any('title')): ?>
                        <span class="text-danger"> <?php echo e($errors->first('title')); ?></span>
                      <?php endif; ?>
                    </div>
                    <div class="form-group">
                      <label for="description">Description :</label>
                      <textarea class="form-control" id="description" placeholder="Enter description" name="description"><?php echo e(old('description')); ?></textarea>
                        <?php if($errors->any('description')): ?>
                        <span class="text-danger"> <?php echo e($errors->first('description')); ?></span>
                      <?php endif; ?>
                    </div>
                    <div class="form-group">
                      <label for="image">Image :</label>
                      <input type="file" class="form-control " id="image" placeholder="Choose an image" name="image" >
                      <?php if($errors->any('image')): ?>
                        <span class="text-danger"> <?php echo e($errors->first('image')); ?></span>
                      <?php endif; ?>
                    </div>
                    <div class="form-group">
                      <label for="category">Category :</label>
                      <select class="form-control" id="category" name="category">
                        <option value="">Select Category</option>

                        <?php if(count($categories)): ?>
                          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <option value="<?php echo e($category->id); ?>"  <?php echo e((old('category') && old('category')==$category->id )?'selected':''); ?>  ><?php echo e($category->name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        
                      </select>
                    <?php if($errors->any('category')): ?>
                        <span class="text-danger"> <?php echo e($errors->first('category')); ?></span>
                      <?php endif; ?>
                    </div>
                    <div class="form-group">
                      <label for="tags">Tags :</label>
                      <select class="form-control" id="tags" name="tags[]" multiple>
                        <option value="">Select Tags</option>
                          <?php if(count($tags)): ?>
                          <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <option value="<?php echo e($tag->id); ?>" 
<?php echo e((old('tags') && in_array($tag->id,old('tags')) )?'selected':''); ?> 
                             ><?php echo e($tag->name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                      </select>
                               <?php if($errors->any('tags')): ?>
                        <span class="text-danger"> <?php echo e($errors->first('tags')); ?></span>
                      <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
 $("#category").select2({
    placeholder: "Select a category",
    allowClear: true
  });

  $("#tags").select2({
    placeholder: "Select tags",
    allowClear: true
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_crud-master\resources\views/post/create.blade.php ENDPATH**/ ?>