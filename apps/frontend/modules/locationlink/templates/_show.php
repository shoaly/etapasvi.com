<div id="location_map"></div>
<br/>
<?php foreach($locationlink_tree as $i=>$element): ?>
    <?php include_partial('locationlink/tree_element', array('element'=>$element, 'first'=>($i==0), 'last'=>($i==(count($locationlink_tree)-1)) )); ?>
<?php endforeach ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    $(document).ready(function() {
        locationMap();
    });
</script>