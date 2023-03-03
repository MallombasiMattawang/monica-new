<?php

namespace App\Admin\Extensions\Nav;

use Illuminate\Contracts\Support\Renderable;
use App\Models\TemplateExcel;

class Dropdown implements Renderable
{
  public function render()
  {
    $q_excel = TemplateExcel::select('id', 'name', 'file_excel')->get();
    $html_all = ''; // initialize an empty string variable
    foreach ($q_excel as $q) {
      $html = '<a class="btn btn-app" href="/uploads/'.$q->file_excel.'" target="_blank">
                <i class="fa fa-file-excel-o"></i> '.$q->name.'
            </a>';
      $html_all .= $html; // concatenate each iteration of $html to $html_all
    }
    return <<<HTML
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-th"></i>  Tabel Referensi
    </a>
    <ul class="dropdown-menu" style="padding: 0;box-shadow: 0 2px 3px 0 rgba(0,0,0,.2);">
        <li>
           <div class="box box-solid" style="width: 300px;height: 300px;margin-bottom: 0;">
            <!-- /.box-header -->
            <div class="box-body">
              <a class="btn btn-app" href="/ped-panel/ref-list-activities">
            <i class="fa fa-edit"></i> List Activity
              </a>
              <a class="btn btn-app" href="/ped-panel/ref-bobots">
                <i class="fa fa-tasks"></i> Bobot Activity
              </a>
              <hr>
              <a class="btn btn-app" href="/ped-panel/users">
                <i class="fa fa-users"></i> Verifikator
              </a>
              <a class="btn btn-app" href="/ped-panel/mst-mitras">
                <i class="fa fa-users"></i> List Mitra
              </a>
              <a class="btn btn-app" href="/ped-panel/mst-witels">
                <i class="fa fa-users"></i> List Witel
              </a>

              $html_all
              
              
              
            </div>
            <!-- /.box-body -->
          </div>
      </li>
    </ul>
</li>
HTML;
  }
}
