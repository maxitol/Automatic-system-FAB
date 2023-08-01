<?php

namespace App\Http\Controllers;

use App\Models\Changes;
use App\Models\contracts;
use App\Models\customers;
use App\Models\orders;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\Exception\Exception;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

class DocController extends Controller
{

    /** @var orders $user */ // PHPDoc комментарий для свойства $auth
    protected $orders;
    /** @var customers $customers */ // PHPDoc комментарий для свойства $auth
    protected $customers;
    /** @var contracts $contracts */ // PHPDoc комментарий для свойства $auth
    protected $contracts;

    public function reportDownload(Request $request)
    {

        $document = new TemplateProcessor(public_path('/word/otchet.docx'));

        $date = $request['evaluatinDate'];
        $documentInf = $request['document'];
        $technicalCondition = $request['technicalCondition'];
        $cause = $request['cause'];

        if ($request->hasFile('application')) {
            // Папка для сохранения временных файлов
            $temp_dir = sys_get_temp_dir() . '/';
            // Массив для хранения путей к файлам
            $files = [];
            foreach ($request->file('application') as $key => $file) {


                // Получаем имя и расширение файла
                $file_name = $file->getClientOriginalName();
                $file_ext = strtolower($file->getClientOriginalExtension());
                // Проверяем, является ли файл изображением
                if (in_array($file_ext, ['png', 'jpg', 'jpeg', 'gif', ])) {
                    // Генерируем уникальное имя для сохранения файла
                    $new_file_name = uniqid() . '.' . $file_ext;
                    // Сохраняем файл во временную папку
                    if ($file->move($temp_dir, $new_file_name)) {
                        // Добавляем путь к файлу в массив
                        $files[] = $temp_dir . $new_file_name;
                    }
                }
            }

            // Загружаем файл шаблона из папки storage/app
                $countApp = '';
                for($i=0; $i < count($files); $i++){

                   $countApp .= '${image' . $i . '}';

                }
                $document->setValue('images', $countApp);
           //$document->setValue('image0', 123);
            //Заменяем плейсхолдеры изображений на реальные файлы
           for ($i = 0; $i < count($files); $i++) {
                //Устанавливаем путь к файлу и ширину изображения в пикселях
              $document->setImageValue('image' . ($i), array('path' => $files[$i], 'width' => 755, 'height' => 955));
           }
            // Загружаем файл шаблона из папки storage/app

        }else{

            $document->setValue('images', "");

        }
        $orderId = $request['order'];
        $order = orders::find($orderId);
        $customerId = $order->customer;
        $customerInf = customers::find($customerId);
        $contractId = $order->contract;
        $contractInf = contracts::find($contractId);

        $outputFile = 'otchet'.$orderId.'.docx';
        $document->setValue('orderNum', $orderId);
        $document->setValue('object', $order->object);
        $document->setValue('evaluatinDate', date('d.m.Y', strtotime($date)));
        $document->setValue('customerDocument', $documentInf);
        $document->setValue('technicalCondition', $technicalCondition);
        $document->setValue('cause', $cause);
        $document->setValue('orderDate',  date('d.m.Y', strtotime($order->date)));
        $document->setValue('customer', $customerInf->fio);
        $document->setValue('contractDate',  date('d.m.Y', strtotime($contractInf->date)));
        $document->setValue('contractNum', $contractInf->id);


        //$tempPath = public_path($outputFile);
        $document->saveAs($outputFile);

        return response()->download($outputFile)->deleteFileAfterSend();


    }
    public function generateDocx(Request $request)
    {

        $document = new TemplateProcessor(public_path('/word/dogovor.docx'));

        $date = $request['date'];
        $objects = $request['objects'];
        $sum = $request['sum'];
        $contact = $request['contact'];
        $idContract = $request['idContract'];
        $idCustomer = $request['idCustomer'];
        $customer = customers::find($idCustomer);
        $fio = $customer->fio;
        $customerOrg = $customer->name;
        $type = $customer->type;
        $cust = $type . " \"" . $customerOrg . "\"";
        $outputFile = 'dogovor'.$idContract.'.docx';
        $document->setValue('customer', $cust);
        $document->setValue('contractNum', $idContract);
        $document->setValue('date', $date);
        $document->setValue('fio', $fio);
        $document->setValue('sum', $sum);
        $document->setValue('contact', $contact);
        $document->setValue('object', $objects);
        $tempPath = public_path($outputFile);
        $document->saveAs($tempPath);

        return response()->json(['url' => url($outputFile)]);

    }
}
