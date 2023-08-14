<?php
/**
 * Tickets list.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div class="dataTables_wrapper" id="uTicket" >
    <div class="row">
        <?php echo $this->element('paginator', array('updateDivId' => 'uTicket')); ?>
    </div>		
    <div class="table-scrollable">

        <table class="table table-hover dataTable table-striped">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('Ticket.id', __('ID')); ?></th>
                    <th><?php echo $this->Paginator->sort('Ticket.subject', __('Subject')); ?></th>
                    <th><?php echo $this->Paginator->sort('Ticket.type_id', __('Department')); ?></th>
                    <th><?php echo __('Submitted By'); ?></th>
                    <th><?php echo $this->Paginator->sort('Ticket.company_id', __('Company')); ?></th>
                    <th><?php echo $this->Paginator->sort('Ticket.assign', __('Assign To')); ?></th>
                    <th><?php echo $this->Paginator->sort('Ticket.created', __('Created')); ?></th>
                    <th><?php echo $this->Paginator->sort('Ticket.status', __('Status')); ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($tickets)) {
                    $page = $this->request->params['paging']['Ticket']['page'];
                    $limit = $this->request->params['paging']['Ticket']['limit'];
                    $i = ($page - 1) * $limit;
                    foreach ($tickets as $row) {
                        $i++;

                        ?>
                        <tr  id="<?php echo 'row' . h($row['Ticket']['id']); ?>">
                            <td><?= '#' . h($row['Ticket']['id']); ?></td>
                            <td><?= h($row['Ticket']['subject']); ?></td>
                            <td><?= h($row['TicketType']['name']); ?></td>
                            <td><?= h($row['User']['first_name']) . ' ' . h($row['User']['last_name']); ?></td>
                            <td><?= h($row['Company']['name']); ?></td>
                            <td><?= h($row['Assign']['first_name']) . ' ' . h($row['Assign']['last_name']); ?></td>
                            <td><?php echo $this->Time->format($this->Common->dateTime(), h($row['Ticket']['created'])); ?></td>
                            <td><?= $this->Common->ticket_status($row['Ticket']['status']); ?></td>
                            <td>	
                                <?php echo $this->Html->link('<i class="fa fa-eye"></i>', array('controller' => 'tickets', 'action' => 'view', h($row['Ticket']['id'])), array('escape' => false, 'class' => 'table-link', 'ref' => 'popover', 'data-content' => __('View'))); ?>
                                <?php if ($this->Common->isAdmin()): ?>
                                    <a class="table-link danger" href="#" data-toggle="modal" data-target="#delTicketM" onclick="fieldU('TicketId',<?php echo h($row['Ticket']['id']); ?>)" ref="popover" data-content="<?php echo __('Delete'); ?>">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php
                    }
                }

                ?>
            </tbody>
        </table>
    </div>
    <?php
    if (!empty($tickets)) {
        echo $this->element('pagination');
    }

    ?>
</div>
