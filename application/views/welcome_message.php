<div class="container">
    <div class="row">
        <div id="get_row">
            <form id="get_row_col" method="post">
                <div class="col-md-6">
                    <input type="hidden" name="action" value="get_form" >
                    <input type="hidden" name="url" id="url" value="<?php echo site_url('create_form'); ?>" >
                    <lable for="number_of_row" >Number of Rows:</lable>
                    <input type="number" name="number_of_row"  min="2" max="8" id="number_of_row"  class="form-control" >
                </div>
                <div class="col-md-6"> 
                    <lable for="number_of_column" >Number of Columns:</lable>
                    <input type="number" name="number_of_column" id="number_of_column" min="2" max="5" class="form-control"  >
                </div>
                
                <div class="col-md-12"> 
                    <input type="submit" id="create_form" value="create"  class="btn btn-primary pull-right"  >
                    
                </div>
            </form>            
        </div>
        <div id="add_data">
            
        </div>
    </div>
</div>
