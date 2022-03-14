
<!DOCTYPE html>
<html>
<style>
table, th, td {
  border:1px solid black;
}
</style>
<body>

<table style="width:60%">
    <thead>
        <tr>
            
            <th>Store Code </th>
                            <th>Barcode  </th>
                            <th>Asset Name</th>
                            <th>Asset Type</th>
							 <th>Verified At</th>
                          
            
         <!--   <th>Edit</th>
            <th>Contact</th>
            <th>Deactivate</th>-->
        </tr>
        
    </thead>
    <tbody>
         @foreach($assets as $assetData)
        <tr>

            <td>{{$assetData->store_code ??'' }}</td>
                            <td>{{$assetData->barcode }}</td>
                            <td>{{$assetData->asset_name}}</td>
                            <td>{{$assetData->asset_type }}</td>
							 <td>{{$assetData->verified_at}}</td>
							
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>

