<?php foreach ($documents_list as $i=>$documents): ?>    
    <div>        
        <?php include_partial('documents/showShort', array('documents'=>$documents) ); ?>	
    </div>
<?php endforeach; ?>