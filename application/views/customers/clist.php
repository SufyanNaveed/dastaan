<?php
$due = false;
if ($this->input->get('due')) {
    $due = true;
} ?>
<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><a
                        href="<?php echo base_url('customers') ?>"
                        class="mr-5">
                    <?php echo $this->lang->line('Clients') ?></a> <a
                        href="<?php echo base_url('customers/create') ?>"
                        class="btn btn-primary btn-sm rounded">
                    <?php echo $this->lang->line('Add new') ?></a> 
                    <a href="<?php echo base_url('customers?due=true') ?>"
                        class="btn btn-danger btn-sm rounded">
                    <?php echo $this->lang->line('Due') ?><?php echo $this->lang->line('Clients') ?></a></h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            
            <div style="text-align:center;"> 
                <?php if(is_array($sum_due) && count($sum_due) > 0){ ?>
                    DUE SUM: <b><?php echo 'Rs: '. number_format($sum_due['total'] - $sum_due['pamnt']); ?></b>
                <?php } ?>
            </div>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content">
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
            <div class="card-body">

                <table id="clientstable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Order No</th>
                        <th>Customer Name</th>
                        <?php if ($due) {
                            echo '  <th>' . $this->lang->line('Due') . '</th>';
                        } ?>
                        <th>Booking Date</th>
                        <th>Delivery Date</th>
                        <th>Mobile</th>
                        <th><?php echo $this->lang->line('Settings') ?></th>


                    </tr>
                    </thead>
                    <tbody>
                    </tbody>

                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Order No</th>
                        <th>Customer Name</th>
                        <?php if ($due) {
                            echo '  <th>' . $this->lang->line('Due') . '</th>';
                        } ?>
                        <th>Booking Date</th>
                        <th>Delivery Date</th>
                        <th>Mobile</th>
                        <th><?php echo $this->lang->line('Settings') ?></th>


                    </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#clientstable').DataTable({
            'processing': true,
            'serverSide': true,
            'stateSave': true,
            responsive: true,
            'order': [],
            'ajax': {
                'url': "<?php echo site_url('customers/load_list')?>",
                'type': 'POST',
                'data': {'<?=$this->security->get_csrf_token_name()?>': crsf_hash <?php if ($due) echo ",'due':true" ?> }
            },
            'columnDefs': [
                {
                    'targets': [0],
                    'orderable': false,
                },
            ],
        });
    });
</script>
<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Delete Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this customer?</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="customers/delete_i">
                <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete-confirm">Delete</button>
                <button type="button" data-dismiss="modal" class="btn">Cancel</button>
            </div>
        </div>
    </div>
</div>