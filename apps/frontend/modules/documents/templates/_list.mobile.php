<br/>
<?php foreach ($documents_list as $i=>$documents): ?>         
        <?php include_partial('documents/showShort', array('documents'=>$documents, 'hide_wrapper'=>true, 'last'=>($i==(count($documents_list)-1))) ); ?>	
<?php endforeach; ?>