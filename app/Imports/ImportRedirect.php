<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\Redirect;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportRedirect implements WithHeadingRow,ToCollection
{
    /**
    * @param array $collection
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $collections)
    {
        foreach($collections as $collection)
        {
            $Redirect = Redirect::where('from_url',$collection['from_url'])->first();
                if($Redirect){
                    Redirect::where('from_url', $collection['from_url'])
                            ->update([
                                'to_url' => $collection['to_url']
                            ]);
                }else{ 
                    $data = ([
                        'from_url' => $collection['from_url'],
                        'to_url' => $collection['to_url']
                    ]);
                    Redirect::insert($data);
                }  
        }    
    }
}
