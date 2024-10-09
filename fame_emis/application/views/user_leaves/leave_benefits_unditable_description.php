<div class="container-fluid p-3">
	<div class="row p-3">
        <!-- Import link -->
        <div class="col-md-12 head">
            <div class="">
                <a href="javascript:void(0)" class="btn btn-success" onclick="formToggle('benefit_description');"><i class="bi bi-plus-circle"></i> Mchanganuo wa gharama za kujikimu</a>
            </div>
        </div>
        <!-- Excel file upload form -->
        <div class="col-md-12" id="benefit_description" style="display: none;">
            <div class="col-auto">
                <br />
                <table class="table table-bordered border-primary">
                    <thead class="table-info">
                        <tr>
                            <th>#</th>
                            <th>Maitaji</th>
                            <th>Kiasi</th>
                            <th>* Mara Ngapi</th>
                            <th>Jumla</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Nauli</td>
                            <td><input type="text" class="text-center" value="<?= $n1 = $leave_info->nauli_kiasi; ?>" readonly></td>
                            <td><input type="text" class="text-center" value="<?= $n2 = $leave_info->nauli_count; ?>" readonly></td>
                            <td><input type="text" class="text-center" value="<?= $total_nauli=$n1*$n2; ?>" readonly></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Maradhi/Guest</td>
                            <td><input type="text" class="text-center" value="<?= $m1 = $leave_info->maradhi_kiasi; ?>" readonly></td>
                            <td><input type="text" class="text-center" value="<?= $m2 = $leave_info->maradhi_count; ?>" readonly></td>
                            <td><input type="text" class="text-center" value="<?= $total_maradhi = $m1*$m2; ?>" readonly></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Chakula</td>
                            <td><input type="text" class="text-center" value="<?= $c1 = $leave_info->chakula_kiasi; ?>" readonly></td>
                            <td><input type="text" class="text-center" value="<?= $c2 = $leave_info->chakula_count; ?>" readonly></td>
                            <td><input type="text" class="text-center" id="chakula_amount" value="<?= $total_chakula = $c1*$c2; ?>" readonly></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td colspan="3">Jumla kuu</td>
	                            <td><input type="text" class="text-center" id="general_total" value="<?= $total_nauli + $total_maradhi + $total_chakula; ?>" readonly></td>
	                        </tr>
	                    </tbody>
	                </table>
	            </div>  
	        </div>
	    </div>
	</div>