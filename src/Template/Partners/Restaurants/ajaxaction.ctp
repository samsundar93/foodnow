<?php
if($action == 'showMap'){
    echo $this->GoogleMap->map(['id'=>$map['map_id'],'height'=>'400px']);
    echo "**********";
    echo $this->GoogleMap->addMarker($map['map_id'],
        'custome_markerid',
        ['latitude' => $map['latitude'], 'longitude' => $map['longitude']],
        [
            'windowText' => $map['address']]
    );
    echo $addCircle  =  $this->GoogleMap->addCircle(
        $map['map_id'],
        $map['map_id']."Circle".$map['id'],
        array(
            "latitude"  => $map['latitude'],
            "longitude" => $map['longitude']
        ),
        $map['miles'],
        array(
            "fillColor"   => $map['color'],
            "fillOpacity" => 0.3
        )
    );
    exit();
}
?>