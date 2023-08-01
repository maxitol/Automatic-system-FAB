<?php

namespace App\Http\Controllers;

use App\Models\Changes;
use App\Models\contracts;
use App\Models\customers;
use App\Models\orders;
use App\Models\User;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{

    /** @var orders $user */ // PHPDoc комментарий для свойства $auth
    protected $orders;
    /** @var customers $customers */ // PHPDoc комментарий для свойства $auth
    protected $customers;
    /** @var contracts $contracts */ // PHPDoc комментарий для свойства $auth
    protected $contracts;

    public function evaluationView(){
        $orders = orders::where('orders.status', 0)->get()->toArray();
        $contracts = contracts::get()->toArray();
        $customers = customers::get()->toArray();
        return view('Evaluation.evaluationReport', ['orders' => $orders, 'contracts' => $contracts, 'customers' => $customers]);

    }
    public function evaluationRulesView(){

        return view('Evaluation.documentation');

    }
}
