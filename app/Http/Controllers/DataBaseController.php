<?php

namespace App\Http\Controllers;

use App\Models\Changes;
use App\Models\contracts;
use App\Models\customers;
use App\Models\orders;
use App\Models\User;
use App\Models\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DataBaseController extends Controller
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
    public function database() {

        return view('database');
    }


//-------------------------------Customers----------------------------------

    public function customers() {

        $customers = customers::get()->toArray();
        return view('databases.customers', ['customers' => $customers]);
    }

    public function addNewCustomersForm() {

        return view('databases.forms.addCustomer');
    }

    public function addCustomers(Request $request) {
        $name = $request['name'];
        $type = $request['type'];
        $contacts = $request['contacts'];
        $fio = $request['fio'];

        if($name=== null){$name='';};

        $customer = new customers();
        $customer->fio = $fio;
        $customer->name = $name;
        $customer->type = $type;
        $customer->contacts = $contacts ;
        $customer->save();

        return true;

    }

    public function editCustomersForm($id) {

        $customer = customers::find($id);

        return view('databases.forms.editCustomers', ['customer' => $customer]);
    }

    public function editCustomers(Request $request) {

        $name = $request['name'];
        $type = $request['type'];
        $contacts = $request['contacts'];
        $id = $request['id'];
        $fio = $request['fio'];

        $customer = customers::find($id);
        if ($customer->name != $name) {
            $changes = new Changes();
            $changes->type = "Заказчик";
            $changes->typeId = $id;
            $changes->user = $request->user()->name;
            $changes->date = now('Europe/Samara')->format('Y-m-d H:i:s');
            $changes->typeColumn = "Организация";
            $changes->oldValue = $customer->name;
            $changes->newValue = $name;
            $changes->save();
        }
        if ($customer->fio != $fio) {
            $changes = new Changes();
            $changes->type = "Заказчик";
            $changes->typeId = $id;
            $changes->user = $request->user()->name;
            $changes->date = now('Europe/Samara')->format('Y-m-d H:i:s');
            $changes->typeColumn = "ФИО";
            $changes->oldValue = $customer->fio;
            $changes->newValue = $fio;
            $changes->save();
        }
        if ($customer->type != $type) {
            $changes = new Changes();
            $changes->type = "Заказчик";
            $changes->typeId = $id;
            $changes->user = $request->user()->name;
            $changes->date = now('Europe/Samara')->format('Y-m-d H:i:s');
            $changes->typeColumn = "Тип заказчика";
            $changes->oldValue = $customer->type;
            $changes->newValue = $type;
            $changes->save();
        }
        if ($customer->contacts != $contacts) {
            $changes = new Changes();
            $changes->type = "Заказчик";
            $changes->typeId = $id;
            $changes->user = $request->user()->name;
            $changes->date = now('Europe/Samara')->format('Y-m-d H:i:s');
            $changes->typeColumn = "Контакты";
            $changes->oldValue = $customer->contacts;
            $changes->newValue = $contacts;
            $changes->save();
        }
        $customer->name = $name;
        $customer->fio = $fio;
        $customer->type = $type;
        $customer->contacts = $contacts ;
        $customer->save();

        return true;
    }

    public function deleteCustomer (Request $request ) {

        $id = $request['id'];

        $customer = customers::find($id);

        if (isset($customer)) {
            $customer->delete();

            return true;
        } else {
            return false;
        }
    }

    //----------------------------ORDERS-------------------------------

    public function orders() {
        $orders = orders::select('orders.*','customers.fio')->join('customers', 'orders.customer', '=', 'customers.id')->get()->toArray();
        return view('databases.orders', ['orders' => $orders]);
    }

    public function addNewOrdersForm($id) {
        $idCon = $id;
        $contract = contracts::find($idCon);
        return view('databases.forms.addOrder', ['contract' => $contract, 'idCon' => $idCon]);
    }

    public function addOrders(Request $request) {

        $idCustomer = $request['customer'];
        $date = $request['date'];
        $idContract = $request['id'];
        $sum = $request['sum'];
        $object = $request['object'];


        $order = new orders();
        $order->customer = $idCustomer;
        $order->date = $date;
        $order->contract = $idContract;
        $order->sum = $sum;
        $order->object = $object;

        $order->save();

        return true;
    }

    public function editOrdersForm($id) {
        $customers = customers::get()->toArray();
        $order = orders::select('orders.*', 'customers.id AS idCus', 'customers.fio')->join('customers', 'orders.customer', '=', 'customers.id')->find($id);

        return view('databases.forms.editOrders', ['order' => $order, 'customers' => $customers]);
    }

    public function editOrders(Request $request) {

        $customer = $request['customer'];
        $date = $request['date'];
        $id = $request['id'];
        $sum = $request['sum'];
        $status = $request['status'];
        $object = $request['object'];

        $order = orders::find($id);
        if ($order->customer != $customer) {
            $changes = new Changes();
            $changes->type = "Заказ";
            $changes->typeId = $id;
            $changes->user = $request->user()->name;
            $changes->date = now('Europe/Samara')->format('Y-m-d H:i:s');
            $changes->typeColumn = "Заказчик";
            $changes->oldValue = $order->customer;
            $changes->newValue = $customer;
            $changes->save();
        }
        if ($order->date != $date) {
            $changes = new Changes();
            $changes->type = "Заказ";
            $changes->typeId = $id;
            $changes->user = $request->user()->name;
            $changes->date = now('Europe/Samara')->format('Y-m-d H:i:s');
            $changes->typeColumn = "Дата заказа";
            $changes->oldValue = $order->date;
            $changes->newValue = $date;
            $changes->save();
        }
        if ($order->sum != $sum) {
            $changes = new Changes();
            $changes->type = "Заказ";
            $changes->typeId = $id;
            $changes->user = $request->user()->name;
            $changes->date = now('Europe/Samara')->format('Y-m-d H:i:s');
            $changes->typeColumn = "Сумма заказа";
            $changes->oldValue = $order->sum;
            $changes->newValue = $sum;
            $changes->save();
        }
        if ($order->object != $object) {
            $changes = new Changes();
            $changes->type = "Заказ";
            $changes->typeId = $id;
            $changes->user = $request->user()->name;
            $changes->date = now('Europe/Samara')->format('Y-m-d H:i:s');
            $changes->typeColumn = "Объект оценки";
            $changes->oldValue = $order->object;
            $changes->newValue = $object;
            $changes->save();
        }
        if ($order->status != $status) {
            $changes = new Changes();
            $changes->type = "Заказ";
            $changes->typeId = $id;
            $changes->user = $request->user()->name;
            $changes->date = now('Europe/Samara')->format('Y-m-d H:i:s');
            $changes->typeColumn = "Статус заказа";
            $changes->oldValue = $order->status;
            $changes->newValue = $status;
            $changes->save();
        }
        $order->customer = $customer;
        $order->date = $date;
        $order->sum = $sum;
        $order->object = $object;
        $order->status = $status;
        $order->save();

        return true;
    }

    public function deleteOrder (Request $request ) {

        $id = $request['id'];

        $order = orders::find($id);

        if (isset($order)) {
            $order->delete();

            return true;
        } else {
            return false;
        }
    }

    //----------------------------NEWS-------------------------------

    public function Newses(){

        $news = News::get()->toArray();
        $news = array_reverse($news);
        return view('home', ['news' => $news]);
    }

    public function deleteNew (Request $request ) {

        $id = $request['id'];

        $new = News::find($id);

        if (isset($new)) {
            $new->delete();

            return true;
        } else {
            return false;
        }
    }

    //----------------------------USER-------------------------------

    public function deleteUser (Request $request ) {

        $id = $request['id'];

        $user = User::find($id);

        if (isset($user)) {
            $user->delete();

            return true;
        } else {
            return false;
        }
    }
//----------------------------CONTRACTS-------------------------------
    public function contracts() {

        $contracts = contracts::select('contracts.*','customers.fio')->join('customers', 'contracts.customer', '=', 'customers.id')->get()->toArray();
        return view('databases.contracts', ['contracts' => $contracts]);
    }

    public function addNewContractsForm() {
        $customers = customers::get()->toArray();

        return view('databases.forms.addContract', ['customers' => $customers]);
    }

    public function addContracts(Request $request) {
         $idCustomer = $request['customer'];
         $date = $request['date'];
         $objects = $request['objects'];

         $contract = new contracts();
         $contract->customer = $idCustomer;
         $contract->date = $date;
         $contract->objects = $objects;
         $contract->save();
         $idContract = $contract->id . '';
        return response()->json(['idContract' => $idContract,
                     'idCustomer' => $idCustomer]);

    }
    public function editContractsForm($id) {
        $customers = customers::get()->toArray();
        $contract = contracts::select('contracts.*', 'customers.fio')->join('customers', 'contracts.customer', '=', 'customers.id')->find($id);
        return view('databases.forms.editContract', ['contract' => $contract, 'customers' => $customers]);
    }

    public function editContracts(Request $request) {

        $customer = $request['customer'];
        $date = $request['date'];
        $objects = $request['objects'];
        $id = $request['id'];

        $contract = contracts::find($id);

        if ($contract->customer != $customer) {
            $changes = new Changes();
            $changes->type = "Договор";
            $changes->typeId = $id;
            $changes->user = $request->user()->name;
            $changes->date = now('Europe/Samara')->format('Y-m-d H:i:s');
            $changes->typeColumn = "Заказчик";
            $changes->oldValue = $contract->customer;
            $changes->newValue = $customer;
            $changes->save();
        }
        if ($contract->date != $date) {
            $changes = new Changes();
            $changes->type = "Договор";
            $changes->typeId = $id;
            $changes->user = $request->user()->name;
            $changes->date = now('Europe/Samara')->format('Y-m-d H:i:s');
            $changes->typeColumn = "Дата договора";
            $changes->oldValue = $contract->date;
            $changes->newValue = $date;
            $changes->save();
        }
        if ($contract->objects != $objects) {
            $changes = new Changes();
            $changes->type = "Договор";
            $changes->typeId = $id;
            $changes->user = $request->user()->name;
            $changes->date = now('Europe/Samara')->format('Y-m-d H:i:s');
            $changes->typeColumn = "Объекты оценки";
            $changes->oldValue = $contract->objects;
            $changes->newValue = $objects;
            $changes->save();
        }

        $contract->customer = $customer;
        $contract->date = $date;
        $contract->objects = $objects;
        $contract->save();

        return true;
    }

    public function deleteContract (Request $request ) {

        $id = $request['id'];

        $contract = contracts::find($id);

        if (isset($contract)) {
            $contract->delete();

            return true;
        } else {
            return false;
        }
    }
}
