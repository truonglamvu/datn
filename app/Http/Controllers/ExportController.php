<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Post\PostRepository;
use Excel;

class ExportController extends Controller
{
    public function index(PostRepository $postRepository)
    {
        $data = $postRepository->getAllExport();
        //dd($data);
        $data = $this->formatData($data);
        //dd($data);
		return $this->createExcelFile($data['sheetData'],$data['mergeData']);
    }

    private function createExcelFile($data, $merge)
    {
        //dd($data, $merge);
        Excel::create('MytourAPI_'.date('dmY',time()), function($excel) use ($data, $merge) {

            $excel->sheet('API_'.date('dmY',time()), function($sheet) use ($data, $merge ) {
                $sheet->fromArray($data);

                $sheet->setMergeColumn([
                    'columns' => ['A','B','C','D','E','F','P'],
                    'rows' => $merge
                ]);

                /**
                 *
                 * Tạo width cho các column
                 *
                 */
                

                $sheet->setWidth(array(
                    'A'     =>  10,
                    'B'     =>  60,
                    'C'     =>  60,
                    'D'     =>  60,
                    'E'     =>  60,
                    'N'     =>  10,
                    'F'     =>  150,
                    'G'     =>  20,
                    'H'     =>  40,
                    'I'     =>  20,
                    'J'     =>  10,
                    'K'     =>  5,
                    'L'     =>  10,
                    'M'     =>  20,
                    'N'     =>  20,
                    'O'     =>  20,
                    'P'     =>  60,
                ));

                $sheet->setBorder('A1:P2000', 'thin');

                /**
                 *
                 * Set Style cho tất cả các column là center
                 *
                 */
                
                $alignment = [
                    'alignment' => [
                        'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    ]
                ];

               // $sheet->getStyle("E2:E1000")->setBackground('#008686');

                $sheet->getStyle('A1:P2000')->getAlignment()->setWrapText(true);

                // End set style

                $sheet->getStyle("A1:P2000")->applyFromArray($alignment);
            });

        })->export('xls');
    }

    private function formatData($apis)
    {
        $data['mergeData'] = [];
        $data['sheetData'] = [];
        $mergeStart = 2;
        $mergeStop  = 1;
        $stt = 0;
        foreach ($apis as $key => $value) {
            $_data = [];
            $_data2 = [];
            $stt++;
            $params = $value->getParamater();
            $error = $value->getError();
            $header = $value->getHeader();
            $max = max(count($params),count($error),count($header));
            for($i = 0; $i < $max; $i++) {
                if($i == 0) {
                    $_data['STT'] = $stt;
                    $_data['System'] = $value->menu->menu_name;
                    $_data['name']   = $value['title'];
                    $_data['Endpoint']   = $value['url'];
                    $_data['Description']   = $this->clean(strip_tags($value['content']));
                    $_data['Method']   = $value->getMethod();
                } else {
                    $_data['System'] = '';
                    $_data['name']   = '';
                    $_data['Endpoint']   = '';
                    $_data['Description']   = '';
                    $_data['Method']   = '';
                }
                $_data['ParamName'] = (isset($params[$i])) ? $params[$i]['key'] : '';
                $_data['ParamValue'] = (isset($params[$i])) ? $params[$i]['value'] : '';
                $_data['ParamDescription'] = (isset($params[$i])) ? $params[$i]['description'] : '';
                $_data['ParamDataType'] = (isset($params[$i])) ? $params[$i]['data_type'] : '';
                if($_data['ParamName'] !== '') {
                    $_data['ParamRequired'] = (isset($params[$i]) && isset($params[$i]['required']) && $params[$i]['required'] === 'required') ? 'Y' : 'N';
                } else {
                    $_data['ParamRequired'] = '';
                }
               
                $_data['ErrorName'] = (isset($error[$i])) ? $error[$i]['error_code'] : '';
                $_data['ErrorValue'] = (isset($error[$i])) ? $error[$i]['description'] : '';
                $_data['HeaderKey'] = (isset($header[$i])) ? $header[$i]['header_key'] : '';
                $_data['HeaderValue'] = (isset($header[$i])) ? $header[$i]['header_value'] : '';

                if($i == 0) {
                   $_data['Response'] = $value->data_return;
                } else {
                   $_data['Response'] = '';
                }

                $data['sheetData'][] = array_values($_data);

            }
            $mergeStop = $mergeStop + $max;

            $data['mergeData'][] = [
                $mergeStart,
                $mergeStop
            ];

            $mergeStart = $mergeStop + 1;

        }

        return $data;
    }

    private function clean($str)
    {
    $str = str_replace("&nbsp;", " ", $str);
    $str = preg_replace('/\s+/', ' ',$str);
    $str = trim($str);
    return $str;
    }
}
