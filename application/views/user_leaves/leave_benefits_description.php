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
                            <td><input type="text" class="text-center" name="nauli" id="nauli" onchange="findTotal('nauli','nauli_times','nauli_amount')"></td>
                            <td><input type="text" class="text-center" name="nauli_times" id="nauli_times" onchange="findTotal('nauli','nauli_times','nauli_amount')"></td>
                            <td><input type="text" class="text-center" id="nauli_amount"  readonly></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Malazi/Guest</td>
                            <td><input type="text" class="text-center" name="maradhi" id="maradhi" onchange="findTotal('maradhi','maradhi_times','maradhi_amount')"></td>
                            <td><input type="text" class="text-center" name="maradhi_times" id="maradhi_times" onchange="findTotal('maradhi','maradhi_times','maradhi_amount')"></td>
                            <td><input type="text" class="text-center" id="maradhi_amount" readonly></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Chakula</td>
                            <td><input type="text" class="text-center" name="chakula" id="chakula" onchange="findTotal('chakula','chakula_times','chakula_amount')"></td>
                            <td><input type="text" class="text-center" name="chakula_times" id="chakula_times" onchange="findTotal('chakula','chakula_times','chakula_amount')"></td>
                            <td><input type="text" class="text-center" id="chakula_amount"  readonly></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td colspan="3">Jumla kuu</td>
                            <td><input type="text" class="text-center" id="general_total"  readonly></td>
                        </tr>
                    </tbody>
                </table>
            </div>  
        </div>
    </div>
</div>