<?php
/**
 *  Shows Pagination on various modules.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div class="text-right">
    <ul class="pagination">
        <?php
        $firstPage = $this->Paginator->first(__('First'), array('tag' => 'li'));
        if (!empty($firstPage)) {
            echo $firstPage;
        } else {
            echo "<li class='disabled'><span>" . __('First') . "</span></li>";
        }
        if ($this->Paginator->hasPrev()) {
            echo $this->Paginator->prev(__('Previous'), array('tag' => 'li'));
            ;
        } else {
            echo "<li class='disabled'><span>" . __('Previous') . "</span></li>";
        }
        echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentTag' => 'span'));
        if ($this->Paginator->hasNext()) {
            echo $this->Paginator->next(__('Next'), array('tag' => 'li'));
            ;
        } else {
            echo "<li class='disabled'><span>" . __('Next') . "</span></li>";
        }
        $lastPage = $this->Paginator->last(__('Last'), array('tag' => 'li'));
        if (!empty($lastPage)) {
            echo $lastPage;
        } else {
            echo "<li class='disabled'><span>" . __('Last') . "</span></li>";
        }
        echo "<li><span>" . $this->Paginator->counter(array('format' => __('Page %s of %s', '%page%', '%pages%'))) . "</span></li>";

        ?>
    </ul>
</div>
<?php echo $this->Js->writeBuffer(); ?>