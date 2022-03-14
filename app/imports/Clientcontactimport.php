<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class Clientcontactimport implements ToModel, WithHeadingRow
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
	$data['clientstaff']=$row->clientstaff;
	$data['clientemail']=$row->clientemail;
	$data['clientphone']=$row->clientphone;
	$data['clientdesignation']=$row->clientdesignation;
    $data['clientname']=$row->clientname;

	return $data;
       // dd($data); die;
}


}
