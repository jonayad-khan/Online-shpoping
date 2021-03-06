ontrol" id="inputName3" placeholder="Add a Number">
                                    <?php echo e($errors->has('product_price') ? $errors->first('product_price') : ''); ?>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputName3" class="col-sm-3 control-label">Product Quantity</label>

                                <div class="col-sm-9">
                                    <input type="number" name="product_quantity" class="form-control" id="inputName3" placeholder="Add a Name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputName3" class="col-sm-3 control-label">Product Short Description</label>

                                <div class="col-sm-9">
                                    <textarea name="short_description" rows="10" class="form-control" placeholder="Enter a Description (optional)"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputDescription3" class="col-sm-3 control-label">Product Long Description</label>
                                <div class="col-sm-9">
                                    <textarea id="editor1" name="long_description" rows="10" cols="80" placeholder="Enter a Description (optional)"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName3" class="col-sm-3 control-label">Product Main Image</label>

                                <div class="col-sm-9">
                                    <input type="file" name="product_image" accept="image/*"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputName3" class="col-sm-3 control-label">Product Sub Image</label>

                                <div class="col-sm-9">
                                    <input type="file" name="sub_image[]" accept="image/*" multiple />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Publication Status</label>

                                <div class="col-sm-9">
                                    <select class="form-control" name="publication_status">
                                        <option>Select Publication Status</option>
                                        <option value="1">Published</option>
                                        <option value="0">Unpublished</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="col-sm-offset-3">
                                <button type="submit" name="btn" class="btn btn-info">Save Product Info</button>
                                <button type="submit" class="btn btn-default">Cancel</button>
                            </div>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>                                                                                                                                                                            <?php
/**
 * @package dompdf
 * @link    http://dompdf.github.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @author  Helmut Tischer <htischer@weihenstephan.org>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */
namespace Dompdf\Renderer;

use Dompdf\Helpers;
use Dompdf\FontMetrics;
use Dompdf\Frame;
use Dompdf\Image\Cache;
use Dompdf\FrameDecorator\ListBullet as ListBulletFrameDecorator;

/**
 * 