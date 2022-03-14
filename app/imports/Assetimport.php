<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class Assetimport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
public function model(array $row)
{
	$data['assetttype']=$row->assetttype;
	$data['assetname']=$row->assetname;
	$data['quantity']=$row->quantity;
	return $data;
       // dd($data); die;
}


}
