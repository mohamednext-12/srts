<?php

namespace App\Imports;

use App\Client;
use App\Social;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SocialImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            if(!Social::where('cin',$row[0])->exists())
            {
                $social=new Social();
                $social->cin=$row[0];
                $social->save();
            }
            else{
                $social=Social::where('cin',$row[0])->first();
            }
            if(!Client::where('parent_cin',$row[0])->where('name',$row[2])->exists()) {
                $client = new Client();
                $client->name = $row[2];
                $client->parent_cin = $row[0];
                $client->parent_name = $row[1];
                $client->social_id = $social->id;
                $client->save();
            }
            else{
                $client=Client::where('parent_cin',$row[0])->where('name',$row[2])->first();
                $client->social_id=$social->id;
                $client->save();
            }
        }
    }
    public function rules(): array
    {
        return [
            'cin' => 'required|min:8|max:8|unique:socials,cin',

            // Above is alias for as it always validates in batches
            'children' => 'required|min:1|max:2',
        ];
    }
}
