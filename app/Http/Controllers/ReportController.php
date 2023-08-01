<?php

namespace App\Http\Controllers;

use App\Models\Changes;
use App\Models\contracts;
use App\Models\customers;
use App\Models\orders;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /** @var User $user */ // PHPDoc комментарий для свойства $auth
    protected $user;
    /** @var orders $user */ // PHPDoc комментарий для свойства $auth
    protected $orders;
    /** @var customers $customers */ // PHPDoc комментарий для свойства $auth
    protected $customers;
    /** @var contracts $contracts */ // PHPDoc комментарий для свойства $auth
    protected $contracts;
    /** @var Changes $сhange */ // PHPDoc комментарий для свойства $auth
    protected $сhange;
    public function reportDateDocument(){


        return view('report.reportDate');

    }

    public function reportDateDocumentSend(Request $request){

        $startdate = $request['startdate'];
        $finishdate = $request['finishdate'];

        $orders = orders::select('orders.*','customers.fio')->join('customers', 'orders.customer', '=', 'customers.id')->where('orders.date', '>=', $startdate)->where('orders.date', '<=', $finishdate)->get()->toArray();
        $orderFinish = orders::select('orders.*','customers.fio')->join('customers', 'orders.customer', '=', 'customers.id')->where('orders.date', '>=', $startdate)->where('orders.date', '<=', $finishdate)->where('orders.status', 1)->get()->toArray();
        return view('report.reportDate', ['orders' => $orders, 'orderFinish' => $orderFinish, 'startdate' => $startdate, 'finishdate' => $finishdate]);


    }

    public function lastChanges(){

        $nameUsers = User::get()->toArray();

        return view('report.lastChanges', ['nameUsers' => $nameUsers]);

    }
    public function lastChangesSend(Request $request){

        $startdate = '';
        $finishdate = '';
        $user = '';
        $type = '';
        $params = request()->all();

        $query = Changes::query();

        foreach ($params as $key => $value) {
            if ($value) {

                if($key == 'startdate'){

                    $startdate = $value;
                    $query->where('date', '>=', $value);

                } else if($key == 'finishdate'){

                    $finishdate = $value;
                    $query->where('date', '<=', $value);

                }else if($key == 'user'){

                    $user = $value;
                    $query->where($key, $value);

                }else if($key == 'type'){

                    $type = $value;
                    $query->where($key, $value);

                }
            }
        }

        $changes = $query->get()->toArray();
        $nameUsers = User::get()->toArray();

        return view('report.lastChanges', ['changes' => $changes, 'startdate' => $startdate, 'finishdate' => $finishdate, 'user' => $user, 'type' => $type, 'nameUsers' => $nameUsers]);


    }

    public function reportSum(){


        return view('report.reportOfSum');

    }
    public function reportSumSend(Request $request){

        $startdate = $request['startdate'];
        $finishdate = $request['finishdate'];
        $sum = 0;
        $orders = orders::select('orders.*','customers.fio')->join('customers', 'orders.customer', '=', 'customers.id')->where('orders.date', '>=', $startdate)->where('orders.date', '<=', $finishdate)->where('orders.status', 1)->get()->toArray();
        foreach($orders as $order){

            $sum += $order['sum'];

        }
        return view('report.reportOfSum', ['orders' => $orders, 'startdate' => $startdate, 'finishdate' => $finishdate, 'sum' => $sum]);


    }

    public function reportStatus(){


        return view('report.reportStatus');

    }

    public function reportStatusSend(Request $request){

        $status = $request['status'];

        $orders = orders::select('orders.*','customers.fio')->join('customers', 'orders.customer', '=', 'customers.id')->where('orders.status', $status)->get()->toArray();

        return view('report.reportStatus', ['orders' => $orders, 'status' => $status]);

    }


}
