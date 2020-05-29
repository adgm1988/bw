<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Sale extends Model
{

	protected $guarded=[];
    protected $primaryKey = 'id_sale';

    public function client()
    {
        return $this->belongsTo('App\Client','id_client','id_client');
    }

    public function sale_details()
    {
    	return $this->hasMany('App\SaleDetail', 'id_sale', 'id_sale');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment', 'id_sale');
    }

    public function getBalanceAttribute()
    {
        $sale = $this->sale_details->sum('sale_price') ;
        $payments = $this->payments->sum('amount') ;

        return $sale - $payments;
    }

    public function getExpirationAttribute()
    {
        $date = Carbon::parse($this->date);
        $credit = $this->client->credit;

        return $date->addDays($credit)->format('Y-m-d');
    }

     public function getColorAttribute()
    {
        $date = Carbon::parse($this->date);
        $credit = $this->client->credit;
        $dif = $date->addDays($credit)->diffInDays(Carbon::now(),false);

        if($this->balance < 1 ){
            $color = '';
        }else{
            if($dif<-5){
                $color='bg-success';
            }elseif($dif<0){
                $color = 'bg-warning';
            }else{
                $color='bg-danger';
            }     
        }
        return $color;
    }


}
