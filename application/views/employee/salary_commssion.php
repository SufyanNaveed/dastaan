<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h5 class="title">
                    <h5><?php echo 'Salary & Commission List' ?></h5>
                </a>
            </h5>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
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

                <table id="emptable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Month').'-'.$this->lang->line('Year') ?></th>
                        <th><?php echo $this->lang->line('Salary') ?> +  <?php echo 'Commission'; ?> </th>
                        <th><?php echo 'Total Paid Amount'; ?></th>
                        <th><?php echo 'Total Un-Paid Amount'; ?></th> 
                        <th><?php echo 'Action'; ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1;

                    foreach ($employee_commission as $row) {
                        
                        $month_year = date("F", mktime(0, 0, 0, $row['month'], 10)).' - '.$row['year'];                        
                        $salary =  $row['salary'];
                        $commission = $row['commission'];
                        $total = amountExchange($row['salary'] + $row['commission']);
                        $paid_amount = amountExchange($row['paid_amount']);
                        $unpaid_amount = amountExchange(($row['salary'] + $row['commission']) - $row['paid_amount']);
                        // $status = $row['comission_status'];

                        // if ($status == 'unpaid') {
                        //     $url = base_url().'employee/commission_status_update/'.$row['id'].'/'.$row['emp_id'];
                        //     $status = "<a href='$url' class='btn btn-primary btn-xs'>Unpaid</a>";
                        // } else {
                        //     $status = "<label class='label label-success'> Paid </label>";
                        // }

                        $url = '<a class="btn btn-success btn-min-width mr-1 paymentAmount" href="javascript:void(0)"  data-id="'.$row['id'].'" data-month_year="'.$month_year.'" data-unpaid="'.$unpaid_amount.'"><i class="fa fa-dollar"></i> Pay Amount</a>';

                    echo "<tr>
                        <td>$i</td>
                        <td>$month_year</td>
                        <td>$salary + $commission = $total</td>
                        <td>$paid_amount</td>
                        <td>$unpaid_amount</td> 
                        <td>$url</td> 
                    </tr>";
                        $i++;
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Month').'-'.$this->lang->line('Year') ?></th>
                        <th><?php echo $this->lang->line('Salary') ?> +  <?php echo 'Commission'; ?> </th>
                        <th><?php echo 'Total Paid Amount'; ?></th>
                        <th><?php echo 'Total Un-Paid Amount'; ?></th>
                        <th><?php echo 'Action'; ?></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="paymentAmount" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form method="POST" action="<?php echo base_url('employee/commission_amount_update') ?>" role="form">
                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo 'Pay Amount'; ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <label><strong> Month-Year </strong></label>
                        <input type="text" id="month_year" value="" class="form-control" readonly>
                        <br>
                        <label><strong>Enter Amount </strong></label>
                        <input type="number" id="amount" name="amount" value="" class="form-control">
                        <span id="unpaid" style="color:red"></span>
                        <input type="hidden" id="unpaid_amount" value="">
                        <input type="hidden" id="id" name="id" value="">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function () {

        //datatables
        $('#emptable').DataTable({responsive: true});


    });

    $('.delemp').click(function (e) {
        e.preventDefault();
        $('#empid').val($(this).attr('data-object-id'));

    });


    $(document).on('click', ".paymentAmount", function (e) {
        var id= $(this).attr('data-id');
        var month_year= $(this).attr('data-month_year');
        var unpaid= $(this).attr('data-unpaid');
        $('#id').val(id);
        $('#month_year').val(month_year); 
        $('#unpaid').html('Please enter amount less than or equal to this amount: '+ unpaid);
        $('#paymentAmount').modal({backdrop: 'static', keyboard: false});

    });



</script>
