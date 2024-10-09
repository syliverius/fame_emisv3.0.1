<div class="container-fluid p-3">
	<div class="row p-3">
        <!-- Import link -->
        <div class="col-md-12 head">
            <div class="float-end">
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
                            <td><input type="text" class="text-center" name="nauli" id="nauli" value="<?= $n1 = $leave_info->nauli_kiasi; ?>" onchange="findTotal('nauli','nauli_times','nauli_amount')"></td>
                            <td><input type="text" class="text-center" name="nauli_times" id="nauli_times" value="<?= $n2 = $leave_info->nauli_count; ?>" onchange="findTotal('nauli','nauli_times','nauli_amount')"></td>
                            <td><input type="text" class="text-center" id="nauli_amount"  value="<?= $total_nauli=$n1*$n2; ?>" readonly></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Maradhi/Guest</td>
                            <td><input type="text" class="text-center" name="maradhi" id="maradhi" value="<?= $m1 = $leave_info->maradhi_kiasi; ?>" onchange="findTotal('maradhi','maradhi_times','maradhi_amount')"></td>
                            <td><input type="text" class="text-center" name="maradhi_times" id="maradhi_times" value="<?= $m2 = $leave_info->maradhi_count; ?>" onchange="findTotal('maradhi','maradhi_times','maradhi_amount')"></td>
                            <td><input type="text" class="text-center" id="maradhi_amount" value="<?= $total_maradhi = $m1*$m2; ?>" readonly></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Chakula</td>
                            <td><input type="text" class="text-center" name="chakula" id="chakula" value="<?= $c1 = $leave_info->chakula_kiasi; ?>" onchange="findTotal('chakula','chakula_times','chakula_amount')"></td>
                            <td><input type="text" class="text-center" name="chakula_times" id="chakula_times" value="<?= $c2 = $leave_info->chakula_count; ?>" onchange="findTotal('chakula','chakula_times','chakula_amount')"></td>
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