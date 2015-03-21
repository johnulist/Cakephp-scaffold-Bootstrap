<p>
    <?php
    echo $this->Paginator->counter(array(
        'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
    )); ?>
</p>


<ul class="pagination">
    <?php
    echo $this->Paginator->prev('<', array('tag' => 'li'), null, array('tag' => 'li','class' => 'previous','disabledTag' => 'a'));
    /**
     * 'before' => '<ul class="pagination">',
     * 'after' => '</ul>'
     */
    echo $this->Paginator->numbers(array(
        'tag' => 'li',
        'currentClass' => 'active',
        'currentTag' => 'a',
        'separator' => ''
    ));
    echo $this->Paginator->next('>', array('tag' => 'li'), null, array('tag' => 'li','class' => 'next','disabledTag' => 'a'));
    ?>
</ul>