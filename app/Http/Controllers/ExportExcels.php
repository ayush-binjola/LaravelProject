<?php

namespace App\Http\Controllers;

use App\Exports\MallExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcels extends Controller
{
   function exportMall()
   {
       return Excel::download(new MallExport,'malls.xlsx');
   }
}
