<form style=" margin: 0px;" action="<?php $_PHP_SELF ?>" method="POST" novalidate="">
                                            <input style="width: 20%" name="prodname" class="form-control col-md-3 col-xs-6" data-validate-minmax="1,100"  placeholder="# of pcs" required="required" type="number" >
                                            <button type="button" class="btn btn btn-warning"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                        </form>


                                         <input type="number" id="number" name="price" required="required" data-validate-minmax="10,100000" class="form-control col-md-7 col-xs-12" >
                                            <input  hidden="hidden" name="prodid" value="<?php echo $prod['product_id'] ?>">
                                            <input  hidden="hidden" name="cart" value="<?php echo $prod['product_id'] ?>">
                                            <input  hidden="hidden" name="userID" value="<?php echo $data->user_id ?>">
                                            <input  hidden="hidden" name="action" value="addcart">