<?php
/**
 * View for report table and chart
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>	
<div id="container" class="manager-table"></div>
<table class="table table-striped table-bordered table-hover dataTable report-table">
    <thead>
        <tr>
            <th><?php echo __('Stage Name'); ?></th>
            <th><?= h($title); ?></th>													
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($stages)) {
            foreach ($stages as $row) {
                $rep[] = array("'" . $row['Stage']['name'] . "'," . $row['Deal']['total']);

                ?>	
                <tr>
                    <td> <?= h($row['Stage']['name']); ?></td>
                    <td> <?php
                        if ($motive == 4 || $motive == 5 || $motive == 6) {
                            echo h($setting['Setting']['currency_symbol']);
                        }

                        ?><?= h($row['Deal']['total']); ?></td>
                </tr>	
                <?php
            }
        }

        ?>
        <?php
        $repJson = json_encode($rep);
        $repJson = str_replace('"', ' ', $repJson);

        ?>                               

    <tbody>
</table>
<!-- Custom Jquery -->
<script>
    $(function () {
        // Make monochrome colors and set them as default for all pies
        Highcharts.getOptions().plotOptions.pie.colors = (function () {
            var colors = ['#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
                    base = Highcharts.getOptions().colors[0],
                    i;

            for (i = 0; i < 10; i += 1) {
                colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
            }
            return colors;
        }());

        // Build the chart
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            credits: {
                enabled: false
            },
            title: {
                text: <?php echo "'" . $title . "'"; ?>
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                    type: 'pie',
                    name: 'Deals',
                    data: <?php echo $repJson; ?>
                }]
        });
    });
</script>
<!-- End Custom Jquery -->
