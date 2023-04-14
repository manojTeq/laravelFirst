<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Auth;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        if($request->ajax()){
            $user = User::latest()->get();
            return DataTables::of($user)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $btn = '<a href="/pdf" class="edit btn btn-primary btn-sm">View </a>';                
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

        }
        return view('users');
    }


    public function getPdf()
    {
         $users = User::latest()->limit(5)->get();         
         $html= view('pdf',compact('users'))->render();
         $mpdf = new \Mpdf\Mpdf();
         $mpdf->WriteHTML($html);
        //  $mpdf->autoScriptToLang=true;
        //  $mpdf->autoLangToFont=true;
         $mpdf->Output();
        
    }

    public function getExcel()
    {   
        $users = User::limit(10)->orderBy('id','asc')->get();
        // dd($users[0]['name'], $users);
        
        $userLogged = User::where('id',Auth::user()->id)->first();

        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet()->setTitle(Auth::user()->name);
        $activeWorksheet->setCellValue('A1', 'Id');

        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Name');
        $sheet1 = $spreadsheet->addSheet($myWorkSheet, 0);        
        $sheet1->setCellValue('A1', 'Name');

        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Email');
        $sheet2 = $spreadsheet->addSheet($myWorkSheet, 1);
        $sheet2->setCellValue('A1', 'Email');

        $rowCount = 2;
        foreach($users as $data)
        {
        $activeWorksheet->setCellValue('A' . $rowCount, $data['id']);
        $sheet1->setCellValue('A' . $rowCount, $data['name']);
        $sheet2->setCellValue('A' . $rowCount, $data['email']);
        $rowCount++;
        }

        $writer = new Xlsx($spreadsheet);
        // $writer->save('hello world.xlsx');

        // redirect output to client browser
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.Auth::user()->name.'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function index1()
    {
        // Role::create(['name'=>'writer','guard_name'=>'admin']);
        // $permission = Permission::create(['name' => 'edit articles']);
        $roles = Role::select('id')->first();
        
        $permission = Permission::where('guard_name', 'admin')->first();
        $roles->syncPermissions($permission->id);

        return view('home');
    }


}
