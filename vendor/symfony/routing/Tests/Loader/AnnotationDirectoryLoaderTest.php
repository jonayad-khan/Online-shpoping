
<?php $__env->startSection('content'); ?>
    <div class="men">
        <div class="container">
            <div class="col-md-12 register">
                <h3 class="text-center text-success">Welcome to checkout process. You have to login to complete your valuable order. If you are not registered then please register first. Thanks.</h3>
                <hr/>
                <h1><?php echo e(Session::get('message')); ?></h1>
            </div>
            <div class="col-md-12 register">
                <form action="<?php echo e(url('/customer-login')); ?>" method="POST">
                    <?php echo e(csrf_field()); ?>

                    <div class="register-top-grid">
                        <h1 class="text-center">Login Form Here</h1>
                        <hr/>
                        <div>
                            <span>Email Address<label>*</label></span>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div>
                            <span>Password<label>*</label></span>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div>
                            <input type="submit" value="Login" class="btn btn-success btn-block">
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </form>
            </div>
            <br/>
            <hr/>
            <br/>
            <div class="col-md-12 register">
                <br/><br/>
                <form action="<?php echo e(url('/new-customer')); ?>" method="POST">
                    <?php echo e(csrf_field()); ?>

                    <div class="register-top-grid">
                        <h1 class="text-center">Registration From Here</h1>
                        <br/><br/><br/>
                        <div>
                            <span>First Name<label>*</label></span>
                            <input type="text" name="first_name">
                            <span><?php echo e($errors->has('first_name') ? $errors->first('first_name') : ' '); ?></span>
                        </div>
                        <div>
                            <span>Last Name<label>*</label></span>
                            <input type="text" name="last_name">
                            <span><?php echo e($errors->has('last_name') ? $errors->first('last_name') : ' '); ?></span>
                        </div>
                        <div>
                            <span>Email Address<label>*</label></span>
                            <input 