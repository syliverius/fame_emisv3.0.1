  <div class="card">
		<div class="card-body">
      &nbsp;&nbsp;
      <div  style="float: right;">
        <button type="button" class="btn btn-secondary" onclick="print()"><i class="bi bi-printer"></i></button>
        <button type="button" class="btn btn-success" onclick="export_to_excel()"><i class="bi bi-file-excel"></i></button>
    </div>
    <div id="print_area">
			<div class="card-title">
				<p style="text-align:right;">Mwaka <?= $year['year_selected']; ?></p>
				<h6><b>SEHEMU 2: TAARIFA ZA WATUMISHI KUTOKUWEPO KAZINI</b></h6>
				<br />
				<p>Taarifa ya orodha ya watumishi wa afya waliopo katika kituo cha huduma na kumbukumbu za kutokuwepo kazini kwa miezi ambayo watumishi hawakuhudhuria kazini na sababu husika.</p>
				<p>2.1	Taarifa ya orodha ya watumishi na kumbukumbu za likizo, mafunzo na kutokuwepo kazini ijazwe kwa kutumia takwimu zilivyo tolewa kwenye ofisi ya utawala kwenye kituo cha kutoa huduma ya afya. Taarifa ya orodha ya watumishi ijazwe mwanzoni mwa mwaka. Jaza jina la mtumishi, na kada. Taarifa za kumbukumbu za muda wa kutokuwepo kituoni na maelezo mengine zitajwe kila mwezi ambapo mtumishi hakuwa kazini, jaza sababu ya kutokuwepo kazini kutumia L kama likizo, M kama mafunzo, K kama kozi fupi na N kama sababu nyingine.</p>
      </div>
				<table class="table table-bordered border-primary" id="myTable">
          <thead class="text-center">
            <tr>
              <td colspan="2">0RODHA YA WATUMISHI</td>
              <td colspan="15">KUMBUKUMBU ZA LIKIZO, MAFUNZO NA KUTOKUWEPO KAZINI</td>
            </tr>
            <tr class="text-center">
              <td colspan="1" rowspan="2">Na.</td>
              <td colspan="1" rowspan="2">Jina</td>
              <td colspan="1" rowspan="2">Kada</td>
              <td colspan="1" rowspan="2">Muda wa kutokuwepo kituoni</td>
              <td colspan="12">Jaza L kwa likizo, M mafunzo ya kujiendeleza, K kozi fupi, N kwa sababu nyingine</td>
              <td colspan="1" rowspan="2">MAELEZO</td>
            </tr>

            <tr class=" text-center">
              <td > J </td>
              <td colspan="1"> F </td>
              <td colspan="1"> M </td>
              <td colspan="1"> A </td>
              <td colspan="1"> M </td>
              <td colspan="1"> J </td>
              <td colspan="1"> J </td>
              <td colspan="1"> A </td>
              <td colspan="1"> S </td>
              <td colspan="1"> O </td>
              <td colspan="1"> N </td>
              <td colspan="1"> D </td>
              </tr>
          </thead>
          <tbody>
                <?php
                  if (isset($output)) {
                    foreach($output as $row){
                ?>
              <tr class='text-center'>
                <td><?= $row['i']; ?></td>
                <td><?= $row['names']; ?></td>
                <td><?= $row['proffesion']; ?></td>
                <td><?= $row['days_left']; ?></td>
                <td><?= $row['jan']; ?></td>
                <td><?= $row['feb']; ?></td>
                <td><?= $row['mach']; ?></td>
                <td><?= $row['apr']; ?></td>
                <td><?= $row['may']; ?></td>
                <td><?= $row['jun']; ?></td>
                <td><?= $row['jul']; ?></td>
                <td><?= $row['aug']; ?></td>
                <td><?= $row['sept']; ?></td>
                <td><?= $row['oct']; ?></td>
                <td><?= $row['nov']; ?></td>
                <td><?= $row['dec']; ?></td>
                <td></td>
              </tr>
                <?php
                  }
                }else{?>
              <tr><td colspan="17"><div class="alert alert-danger alert-dismissible fade show" role="alert"> Sorry!! a roaster for year <?= $year['year_selected']; ?> do not exists <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>   </div></td></tr>
                <?php
                  }
                ?>
          </tbody>
        </table>     
		  </div>
    </div>
	</div>