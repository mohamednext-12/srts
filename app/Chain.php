<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class Chain extends Model
{
    use LogsActivity;
    protected $guarded=[];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
    public function declarations()
    {
        return $this->hasMany(Declaration::class);
    }
    public function getCreatedAtAttribute($date)
    {
//        setlocale(LC_TIME, "fr_FR");
//        $datetime= new \DateTime($date);
//        return $datetime->format('d F, Y');
              Carbon::setLocale('fr');
       return Carbon::parse($date)->format('d F, Y');
    }
    static function chainWithDate($pack)
    {
        $chain=Chain::where('pack',$pack)->where('used',0)->where('declaration_id',null)->get();
        return $chain;
    }

    static function lots($receipt)
    {
            $lots=DB::select('SELECT MIN(`code`) as min, MAX(`code`) as max,type
            FROM
            (SELECT @row_number:= CASE WHEN @id = type THEN @row_number ELSE @row_number + 1 END AS num,
            @id:= pack as pack, receipt,type,`code`
            FROM chains, (SELECT @row_number:= 0, @id:= 1) t ORDER BY `code`) t
            WHERE t.pack = 2 and t.receipt = "'.$receipt.'"
            GROUP BY num,type');

            $tab = [];
            $i=0;
            $j=0;
            foreach ($lots as $lot)
            {

                if ($j==0)
                {
                    $tab[$i]['min']=$lot->min;
                    $tab[$i]['type']=$lot->type;
                }

                else
                {
                    if($tab[$i]['type']!=$lot->type)
                    {
                        $i++;
                        $tab[$i]['type']=$lot->type;
                        $tab[$i]['min']=$lot->min;
                    }else{
                        $tab[$i]['max']=$lot->max;
                    }
                }

                $j++;

            }
        return $tab;
    }

}
