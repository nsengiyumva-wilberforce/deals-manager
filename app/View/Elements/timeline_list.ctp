<?php
/**
 * List all activity.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div id="uTimeline" >
    <?php echo $this->element('paginator', array('updateDivId' => 'uTimeline')); ?>	
    <div class="table-scrollable">
        <table class="table table-hover dataTable">
            <tbody>
                <?php
                if (!empty($Activity)):
                    $page = $this->request->params['paging']['Timeline']['page'];
                    $limit = $this->request->params['paging']['Timeline']['limit'];
                    $i = ($page - 1) * $limit;
                    foreach ($Activity as $row):
                        $i++;

                        ?>
                        <tr  id="<?php echo 'row' . h($row['Timeline']['id']); ?>">
                            <td class="timeline-details">
                                <?php echo $this->Html->image('avatar/thumb/' . $row['User']['picture'], array('class' => 'img-circle img-thumb', 'data-toggle' => 'popover', 'data-content' => $row['Timeline']['user'], 'ref' => 'popover', 'data-content' => h($row['User']['first_name']) . ' ' . h($row['User']['last_name']))); ?>

                                <?php $this->Common->timeline_list($row['Timeline']['module'], $row['Timeline']['activity']); ?>
                                <span>
                                    <i class="fa fa-rocket"> </i> <a href="<?php echo $this->Html->url(array('controller' => 'deals', 'action' => 'view', h($row['Timeline']['deal_id']))); ?>" ref="popover" data-content="View Deal"> <?= h($row['Deal']['name']); ?></a>                         
                                </span>
                                <span>
                                    <i class="fa fa-filter"> </i> <?= h($row['Pipeline']['name']); ?>
                                </span>
                            </td>
                            <td class="text-right timeline-action"> <?php echo $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])); ?> 
                                <a class="table-link danger" href="#" data-toggle="modal" data-target="#delM" onclick="fieldU('TimelineId',<?php echo h($row['Timeline']['id']); ?>)" ref="popover" data-content="Delete Activity">                           
                                    <i class="fa fa-trash-o"></i>
                                </a></td>
                        </tr>
                        <?php
                    endforeach;
                else:
                    echo "<tr><td>No Activity<td></tr>";
                endif;

                ?>
            </tbody>
        </table>
    </div>
    <?php
    if (!empty($Activity)) {
        echo $this->element('pagination');
    }

    ?>
</div>